@extends('layout/main')

@section('container')

<?php 
$tmp_bobot = $histories->rerata_awal; 
$tmp_kelangsungan_hidup = 100;
$tmp_biomas = $histories->biomas_awal;
$tmp_fr = $histories->FRAwal;
$tmp_pakan_harian = 0;
$tmp_pakan_kumulatif = ($histories->rerata_awal * $histories->jumlah_tbr)*$histories->FRAwal/100;
$hari = 1;

?>

<section></section>
<section id="featured-services" class="featured-services">
    <div class="container" data-aos="fade-up">
      <div class="row ">
        <div class="col-md-12 col-lg-12 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box1" data-aos="fade-up" data-aos-delay="100">
            <h4 class="title"><a>Tanggal Tebar : {{ showDateTime($histories->tanggal_tbr, 'l, d F Y') }}</a></h4>
              <div class="table-responsive"> 
                <table class="table">
                    <thead>
                      <tr>
                        {{-- <th scope="col">Tanggal</th> --}}
                        <th scope="col">Hari Ke</th>
                        <th scope="col">Bobot</th>
                        <th scope="col">kelangsungan Hidup</th>
                        <th scope="col">Ikan Hidup</th>
                        <th scope="col">Prediksi Biomas (gram)</th>
                        <th scope="col">Prediksi Biomas (kg)</th>
                        <th scope="col">FR (5%-3%)</th>
                        <th scope="col">Pakan harian (gram)</th>
                        <th scope="col">Pakan harian (kg)</th>
                        <th scope="col">Pakan kumulatif (gram)</th>
                        <th scope="col">Pakan kumulatif (kg)</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td> {{ round($histories->rerata_awal,2) }} </td>
                            <td> {{ $tmp_kelangsungan_hidup }}</td>
                            <td> {{ $histories->jumlah_tbr }} </td>
                            <td> {{ bcdiv($histories->rerata_awal * $histories->jumlah_tbr,1,0) }}</td>
                            <td> {{ bcdiv(($histories->rerata_awal * $histories->jumlah_tbr)/1000,1,1) }} </td>
                            <td> {{ $histories->FRAwal}} </td>
                            <td> {{ bcdiv(($histories->rerata_awal * $histories->jumlah_tbr)*$histories->FRAwal/100,1,2) }} </td>
                            <td> {{ bcdiv((($histories->rerata_awal * $histories->jumlah_tbr)*$histories->FRAwal/100)/1000,1,2) }} </td>
                            <td> {{ bcdiv(($histories->rerata_awal * $histories->jumlah_tbr)*$histories->FRAwal/100,1,2) }} </td>
                            <td> {{ bcdiv((($histories->rerata_awal * $histories->jumlah_tbr)*$histories->FRAwal/100)/1000,1,2) }} </td>
                        </tr>
                    
                        <?php 
                        for ($i=1; $i < $histories->lama_plhr ; $i++) { 
                            $hari = $hari + 1;
                            echo "<tr>
                                  <td>".$hari."</td>";
    
                            $tmp_bobot = $tmp_bobot + ($tmp_bobot * $histories->laju_pertumbuhan);
                            echo "<td>".round($tmp_bobot,2)."</td>";
            
                            $tmp_kelangsungan_hidup = $tmp_kelangsungan_hidup - $histories->kematian_harian; 
                            echo "<td>".bcdiv($tmp_kelangsungan_hidup,1,2)."</td>";
            
                            $tmp_ikan_hdp = ($tmp_kelangsungan_hidup * $histories->jumlah_tbr)/100;
                            echo "<td>".round($tmp_ikan_hdp)."</td>";
                            
                            $tmp_biomas = $tmp_bobot * $tmp_ikan_hdp;
                            echo "<td>".round($tmp_biomas)."</td>";
                            echo "<td>".bcdiv($tmp_biomas/1000,1,1)."</td>";
            
                            $tmp_fr = $tmp_fr-($histories->SelisihFR/($histories->lama_plhr-1));
                            echo "<td>".bcdiv($tmp_fr,1,2)."</td>";
            
                            $tmp_pakan_harian = $tmp_biomas*($tmp_fr/100);
                            echo "<td>".bcdiv($tmp_pakan_harian,1,2)."</td>";
                            echo "<td>".bcdiv(($tmp_pakan_harian/1000),1,2)."</td>";
            
                            $tmp_pakan_kumulatif = $tmp_pakan_kumulatif + $tmp_pakan_harian;
                            echo "<td>".bcdiv($tmp_pakan_kumulatif,1,2)."</td>";
                            echo "<td>".bcdiv(($tmp_pakan_kumulatif/1000),1,2)."</td>";
            
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </section>

@endsection