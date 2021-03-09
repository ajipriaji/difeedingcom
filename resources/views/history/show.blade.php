@extends('layout/main')

@section('container')
<section></section>
    <!-- ======= Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          {{-- <h2>Histori Perhitungan</h2> --}}
          <h3>Telusuri Lagi Perhitungan <span>Anda</span></h3>
          <p>Kumpulan histori perhitungan yang pernah dilakukan sesuai tanggal tebar</p>
        </div>
      <div class="row">
        @foreach ($histories as $his)
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="100">
          <div class="icon-box1">
                <h4 class="title"><a>Tanggal Tebar : {{ showDateTime($his->tanggal_tbr, 'l, d F Y') }} </a></h4>
                <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">Rerata Awal</th>
                        <td colspan="2" align="right"> {{ round(($his->rerata_awal),2) }} </td>
                        <td align="left">gram/ekor</td>
                      </tr>
                      <tr>
                        <th scope="row">Biomas Awal</th>
                        <td colspan="2" align="right">{{ bcdiv($his->biomas_awal,1,2) }}</td>
                        <td align="left">kg</td>
                      </tr>
                      <tr>
                        <th scope="row">Rerata Bobot Ikan Akhir</th>
                        <td colspan="2" align="right">{{bcdiv($his->rerata_akhir,1,2)}}</td>
                        <td align="left">gram/ekor</td>
                      </tr>
                      <tr>
                        <th scope="row">Biomas Akhir</th>
                        <td colspan="2" align="right">{{bcdiv(($his->t_biomas)/1000,1,1)}}</td>
                        <td align="left">kg</td>
                      </tr>
                      <tr>
                        <th scope="row">Total Kebutuhan Pakan</th>
                        <td colspan="2" align="right">{{bcdiv($his->t_pakan_kumulatif/1000,1,2)}}</td>
                        <td align="left">kg</td>
                      </tr>
                      <tr>
                        <th scope="row">Food Conversion Ratio (FCR)</th>
                        <td colspan="2" align="right">{{round($his->FCR,2)}}</td>
                        <td align="left"></td>
                      </tr>
                      <tr>
                        <th scope="row">Laju Pertumbuhan Spesifik</th>
                        <td colspan="2" align="right">{{round($his->laju_pertumbuhan*100,2)}}</td>
                        <td align="left">% per hari</td>
                      </tr>
                      <tr>
                        <th scope="row">Kematian</th>
                        <td colspan="2" align="right">{{$his->kematian}}</td>
                        <td align="left">%</td>
                      </tr>
                      <tr>
                        <th scope="row">Kematian Harian</th>
                        <td colspan="2" align="right">{{bcdiv($his->kematian_harian,1,2)}}</td>
                        <td align="left">% per hari</td>
                      </tr>
                    </tbody>
                  </table>
                  <button class="btn btn-outline-success"><a href="{{ url('/histori/'.$his->id) }}">Tabel Harian</a></button>
                  <button class="btn btn-outline-warning"><a href="{{ url('/histori/'.$his->id.'/edit') }}">Ubah</a></button>
                  <form action="{{ url('/histori/'.$his->id) }}" method="post">
                    <br>
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Hapus</button>
                  </form>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </section>
  

@endsection