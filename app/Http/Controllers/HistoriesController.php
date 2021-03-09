<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Histories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoriesController extends Controller
{
    function show_histori()
    {
        $id = Auth::user()->id;
        $name = Auth::user()->name;
        //$histories = Histories::all();
        $histories = Histories::where('user_id', $id)->get();
        return view('history/show',['histories'=>$histories, 'nama'=>$name]);
    }

    public function show($id)
    {
        $histories = Histories::where('id', $id)->first();
        return view('history.tabel_harian', ['histories'=>$histories]);
        // return $histories;
    }

    public function destroy($id)
    {
        $histories = Histories::where('id', $id)->first();
        Histories::destroy($histories->id);
        return redirect('histori')->with('status', 'Data perhitungan berhasil dihapus!');
        // return $histories;
    }

    public function edit($id)
    {
        $histories = Histories::where('id', $id)->first();
        return view('history/edit',compact('histories'));
    }

    public function update(Request $request,$id)
    {
        $data = array();
        $data['jumlah_tbr']         = $request->jumlah_tbr;
        $data['size_bnh']           = $request->size_bnh;
        $data['size_pnn']           = $request->size_pnn;
        $data['lama_plhr']          = $request->lama_plhr;
        $data['tanggal_tbr']        = $request->tanggal_tbr;
        $data['kelangsungan_hdp']   = $request->kelangsungan_hdp;
        $data['FRAwal']             = $request->FRAwal;
        $data['FRAkhir']            = $request->FRAkhir;
        $data['SelisihFR']          = $data['FRAwal']-$data['FRAkhir'];

        $rules = [
            'jumlah_tbr'        => 'required|numeric',
            'size_bnh'          => 'required|numeric',
            'size_pnn'          => 'required|numeric',
            'lama_plhr'         => 'required|numeric',
            'tanggal_tbr'       => 'required|date',
            'kelangsungan_hdp'  => 'required|numeric',
            'FRAwal'            => 'required|numeric',
            'FRAkhir'           => 'required|numeric'
        ];
 
        $messages = [
            'jumlah_tbr.required'             => 'Jumlah Tebar wajib di isi',
            'size_bnh.required'               => 'Size Benih wajib di isi',
            'size_pnn.required'               => 'Size Panen wajib di isi',
            'lama_plhr.required'              => 'Lama Pemeliharaan wajib di isi',
            'tanggal_tbr.required'            => 'Tanggal Tebar wajib di isi',
            'kelangsungan_hdp.required'       => 'Kelangsungan hidup wajib di isi',
            'FRAwal.required'                 => 'Feeding rate awal wajib di isi',
            'FRAkhir.required'                => 'Feeding rate akhir Tebar wajib di isi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $tes = new AutofeedController();
        //Kirim data awal ke view
        $data['rerata_awal'] = $tes->rerata_awal($data['size_bnh']);
        $data['biomas_awal'] = $tes->biomas_awal($data['jumlah_tbr'],$data['size_bnh']);
        $data['rerata_akhir'] = $tes->rerata_akhir($data['size_pnn']);
        $data['laju_pertumbuhan'] = $tes->laju_pertumbuhan($data['rerata_awal'],$data['rerata_akhir'], $data['lama_plhr']);
        $data['kematian'] = $tes->kematian($data['kelangsungan_hdp']);
        $data['kematian_harian'] = $tes->kematian_harian($this->kematian($data['kelangsungan_hdp']), $data['lama_plhr']);
        
        //Hitung perulangan tabel
        $t_bobot = $tes->rerata_awal($data['size_bnh']);
        $t_kelangsungan_hidup = 100;
        $t_ikan_hdp = $data['jumlah_tbr'];
        $t_biomas = $tes->biomas_awal($data['jumlah_tbr'],$data['size_bnh']);
        $t_fr = $data['FRAwal'];
        $t_pakan_harian = 0;
        $t_pakan_kumulatif = ($tes->rerata_awal($data['size_bnh']) * $data['jumlah_tbr'])*$data['FRAwal']/100;
    
        
        for ($i=1; $i < $data['lama_plhr']; $i++) { 
            $t_bobot = $t_bobot + ($t_bobot * $tes->laju_pertumbuhan($data['rerata_awal'],$data['rerata_akhir'], $data['lama_plhr']));
            $t_kelangsungan_hidup = $t_kelangsungan_hidup - $tes->kematian_harian($this->kematian($data['kelangsungan_hdp']), $data['lama_plhr']);
            $t_ikan_hdp = ($t_kelangsungan_hidup * $data['jumlah_tbr'])/100;
            $t_biomas = $t_bobot * $t_ikan_hdp;
            $t_fr = $t_fr-($data['SelisihFR']/($data['lama_plhr']-1));
            $t_pakan_harian = $t_biomas*($t_fr/100);
            $t_pakan_kumulatif = $t_pakan_kumulatif + $t_pakan_harian;
        }
        $total_kebutuhan_pakan = $t_pakan_kumulatif/1000;
        $FCR = $t_pakan_kumulatif/($t_biomas-$data['biomas_awal']);

        $get = array();
        $get['t_bobot']=$t_bobot;
        $get['t_kelangsungan_hidup']=$t_kelangsungan_hidup;
        $get['t_ikan_hdp']=$t_ikan_hdp;
        $get['t_biomas']=$t_biomas;
        $get['t_fr']=$t_fr;
        $get['t_pakan_harian']=$t_pakan_harian;
        $get['t_pakan_kumulatif']=$t_pakan_kumulatif;
        $get['total_kebutuhan_pakan']=$total_kebutuhan_pakan;
        $get['FCR']=$FCR;
        
        $id_user = Auth::user()->id;

        Histories::where('id', $id)
            ->update([
                'user_id'               => $id_user,
                'jumlah_tbr'            => $data['jumlah_tbr'],
                'size_bnh'              => $data['size_bnh'],
                'size_pnn'              => $data['size_pnn'],
                'lama_plhr'             => $data['lama_plhr'],
                'tanggal_tbr'           => $data['tanggal_tbr'],
                'kelangsungan_hdp'      => $data['kelangsungan_hdp'],
                'FRAwal'                => $data['FRAwal'],
                'FRAkhir'               => $data['FRAkhir'],
                'SelisihFR'             => $data['SelisihFR'],
                'rerata_awal'           => $data['rerata_awal'],
                'biomas_awal'           => $data['biomas_awal'],
                'rerata_akhir'          => $data['rerata_akhir'],
                'laju_pertumbuhan'      => $data['laju_pertumbuhan'],
                'kematian'              => $data['kematian'],
                'kematian_harian'       => $data['kematian_harian'],
                't_bobot'               => $get['t_bobot'],
                't_kelangsungan_hidup'  => $get['t_kelangsungan_hidup'],
                't_ikan_hdp'            => $get['t_ikan_hdp'],
                't_biomas'              => $get['t_biomas'],
                't_fr'                  => $get['t_fr'],
                't_pakan_harian'        => $get['t_pakan_harian'],
                't_pakan_kumulatif'     => $get['t_pakan_kumulatif'],
                'total_kebutuhan_pakan' => $get['total_kebutuhan_pakan'],
                'FCR'                   => $get['FCR'],  
            ]);
        return redirect('histori')->with('status_edit', 'Data perhitungan berhasil diedit!');
    }
    public function hitung_tabel($SelisihFR,$lj_ptmbhn,$mati_harian,$rerata_awal,$bio_awal,$FRAwal,$jumlah_tbr,$lama_plhr)
    {
        $t_bobot = $rerata_awal;
        $t_kelangsungan_hidup = 100;
        $t_ikan_hdp = $jumlah_tbr;
        $t_biomas = $bio_awal;
        $t_fr = $FRAwal;
        $t_pakan_harian = 0;
        $t_pakan_kumulatif = ($rerata_awal * $jumlah_tbr)*$FRAwal/100;
        
        for ($i=0; $i < $lama_plhr ; $i++) { 
            $t_bobot = $t_bobot + ($t_bobot * $lj_ptmbhn);
            $t_kelangsungan_hidup = $t_kelangsungan_hidup - $mati_harian;
            $t_ikan_hdp = ($t_kelangsungan_hidup * $jumlah_tbr)/100;
            $t_biomas = $t_bobot * $t_ikan_hdp;
            $t_fr = $t_fr-($SelisihFR/($lama_plhr-1));
            $t_pakan_harian = $t_biomas*($t_fr/100);
            $t_pakan_kumulatif = $t_pakan_kumulatif + $t_pakan_harian;
        }

        return [$t_bobot,$t_kelangsungan_hidup,$t_ikan_hdp,$t_biomas,$t_fr,$t_pakan_harian];
    }
    
    public function rerata_awal($size_bnh){
        $rata_awal = 1000/$size_bnh;
        return $rata_awal;
    }

    public function biomas_awal($jumlah_tbr, $size_bnh){
        $bio_awal= $jumlah_tbr/$size_bnh;
        return $bio_awal;
    }

    public function rerata_akhir($size_pnn){
        $rata_akhir= 1000/$size_pnn;
        return $rata_akhir;
    }

    public function kematian($kelangsungan_hdp){
        $mati= 100-$kelangsungan_hdp;
        return $mati;
    }

    public function kematian_harian($kematian, $lama_plhr){
        $mati_harian= $kematian/$lama_plhr;
        return $mati_harian;
    }

    public function laju_pertumbuhan($rerata_awal,$rerata_akhir,$lama_plhr)
    {
        $lj_ptmbhn = (log($rerata_akhir)-log($rerata_awal))/$lama_plhr;
        return $lj_ptmbhn;
    }

    function tampildata_api()
    {
        $data = Histories::all();

        return response()->json(
            [
                "message" => "Success",
                "data" => $data
            ]
            );
    }

    function tampildatauser_api($id)
    {
        $data = Histories::where('user_id', $id)->get();

        return response()->json(
            [
                "message" => "Success",
                "data" => $data
            ]
            );
    }

    function tambahdata_api(Request $request)
    {
        $data = array();
        $data['id']                 = $request->id;
        $data['jumlah_tbr']         = $request->jumlah_tbr;
        $data['size_bnh']           = $request->size_bnh;
        $data['size_pnn']           = $request->size_pnn;
        $data['lama_plhr']          = $request->lama_plhr;
        $data['tanggal_tbr']        = $request->tanggal_tbr;
        $data['kelangsungan_hdp']   = $request->kelangsungan_hdp;
        $data['FRAwal']             = $request->FRAwal;
        $data['FRAkhir']            = $request->FRAkhir;
        $data['SelisihFR']          = $data['FRAwal']-$data['FRAkhir'];

        $rules = [
            'jumlah_tbr'        => 'required|numeric',
            'size_bnh'          => 'required|numeric',
            'size_pnn'          => 'required|numeric',
            'lama_plhr'         => 'required|numeric',
            'tanggal_tbr'       => 'required|date',
            'kelangsungan_hdp'  => 'required|numeric',
            'FRAwal'            => 'required|numeric',
            'FRAkhir'           => 'required|numeric'
        ];
 
        $messages = [
            'jumlah_tbr.required'             => 'Jumlah Tebar wajib di isi',
            'size_bnh.required'               => 'Size Benih wajib di isi',
            'size_pnn.required'               => 'Size Panen wajib di isi',
            'lama_plhr.required'              => 'Lama Pemeliharaan wajib di isi',
            'tanggal_tbr.required'            => 'Tanggal Tebar wajib di isi',
            'kelangsungan_hdp.required'       => 'Kelangsungan hidup wajib di isi',
            'FRAwal.required'                 => 'Feeding rate awal wajib di isi',
            'FRAkhir.required'                => 'Feeding rate akhir Tebar wajib di isi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $tes = new AutofeedController();
        //Kirim data awal ke view
        $data['rerata_awal'] = $tes->rerata_awal($data['size_bnh']);
        $data['biomas_awal'] = $tes->biomas_awal($data['jumlah_tbr'],$data['size_bnh']);
        $data['rerata_akhir'] = $tes->rerata_akhir($data['size_pnn']);
        $data['laju_pertumbuhan'] = $tes->laju_pertumbuhan($data['rerata_awal'],$data['rerata_akhir'], $data['lama_plhr']);
        $data['kematian'] = $tes->kematian($data['kelangsungan_hdp']);
        $data['kematian_harian'] = $tes->kematian_harian($this->kematian($data['kelangsungan_hdp']), $data['lama_plhr']);
        
        //Hitung perulangan tabel
        $t_bobot = $tes->rerata_awal($data['size_bnh']);
        $t_kelangsungan_hidup = 100;
        $t_ikan_hdp = $data['jumlah_tbr'];
        $t_biomas = $tes->biomas_awal($data['jumlah_tbr'],$data['size_bnh']);
        $t_fr = $data['FRAwal'];
        $t_pakan_harian = 0;
        $t_pakan_kumulatif = ($tes->rerata_awal($data['size_bnh']) * $data['jumlah_tbr'])*$data['FRAwal']/100;
    
        
        for ($i=1; $i < $data['lama_plhr']; $i++) { 
            $t_bobot = $t_bobot + ($t_bobot * $tes->laju_pertumbuhan($data['rerata_awal'],$data['rerata_akhir'], $data['lama_plhr']));
            $t_kelangsungan_hidup = $t_kelangsungan_hidup - $tes->kematian_harian($this->kematian($data['kelangsungan_hdp']), $data['lama_plhr']);
            $t_ikan_hdp = ($t_kelangsungan_hidup * $data['jumlah_tbr'])/100;
            $t_biomas = $t_bobot * $t_ikan_hdp;
            $t_fr = $t_fr-($data['SelisihFR']/($data['lama_plhr']-1));
            $t_pakan_harian = $t_biomas*($t_fr/100);
            $t_pakan_kumulatif = $t_pakan_kumulatif + $t_pakan_harian;
        }
        $total_kebutuhan_pakan = $t_pakan_kumulatif/1000;
        $FCR = $t_pakan_kumulatif/($t_biomas-$data['biomas_awal']);

        $get = array();
        $get['t_bobot']=$t_bobot;
        $get['t_kelangsungan_hidup']=$t_kelangsungan_hidup;
        $get['t_ikan_hdp']=$t_ikan_hdp;
        $get['t_biomas']=$t_biomas;
        $get['t_fr']=$t_fr;
        $get['t_pakan_harian']=$t_pakan_harian;
        $get['t_pakan_kumulatif']=$t_pakan_kumulatif;
        $get['total_kebutuhan_pakan']=$total_kebutuhan_pakan;
        $get['FCR']=$FCR;
        
        $histories = new Histories;
        $histories->user_id             = $data['id'];
        $histories->jumlah_tbr          = $data['jumlah_tbr'];
        $histories->size_bnh            = $data['size_bnh'];
        $histories->size_pnn            = $data['size_pnn'];
        $histories->lama_plhr           = $data['lama_plhr']; 
        $histories->tanggal_tbr         = $data['tanggal_tbr']; 
        $histories->kelangsungan_hdp    = $data['kelangsungan_hdp'];
        $histories->FRAwal              = $data['FRAwal'];
        $histories->FRAkhir             = $data['FRAkhir'];
        $histories->SelisihFR           = $data['SelisihFR'];
        $histories->rerata_awal         = $data['rerata_awal'];
        $histories->biomas_awal         = $data['biomas_awal'];
        $histories->rerata_akhir        = $data['rerata_akhir'];
        $histories->laju_pertumbuhan    = $data['laju_pertumbuhan'];
        $histories->kematian            = $data['kematian'];
        $histories->kematian_harian     = $data['kematian_harian'];
        $histories->t_bobot             = $get['t_bobot'];
        $histories->t_kelangsungan_hidup = $get['t_kelangsungan_hidup'];
        $histories->t_ikan_hdp          = $get['t_ikan_hdp'];
        $histories->t_biomas            = $get['t_biomas'];
        $histories->t_fr                = $get['t_fr'];
        $histories->t_pakan_harian      = $get['t_pakan_harian'];
        $histories->t_pakan_kumulatif   = $get['t_pakan_kumulatif'];
        $histories->total_kebutuhan_pakan = $get['total_kebutuhan_pakan'];
        $histories->FCR                 = $get['FCR'];

        $histories->save();
        
        return response()->json(
            [
                "message" => "Success",
                "data" =>$histories
            ]
            );
            
    }
}
