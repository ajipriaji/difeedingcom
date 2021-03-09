@extends('layout/main')
@section('container')

<?php 
$tmp_bobot = $rerata_awal; 
$tmp_kelangsungan_hidup = 100;
// $tmp_ikan_hdp = $jumlah_tbr;
$tmp_biomas = $biomas_awal;
$tmp_fr = $FRAwal;
$tmp_pakan_harian = 0;
$tmp_pakan_kumulatif = ($rerata_awal * $jumlah_tbr)*$FRAwal/100;
$hari = 1;

?>

<section>
</section>

<section id="featured-services" class="featured-services">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center">
      <div class="col-md-lg d-flex align-items-stretch">
        <div class="icon-box1" data-aos="fade-up" data-aos-delay="100">
          <h4 class="title"><a>Hasil</a></h4>
          
          <table class="table">
            <tbody>
              <tr>
                <th scope="row">Rerata Awal</th>
                <td colspan="2" align="right">{{ round($rerata_awal,2) }}</td>
                <td align="left">gram/ekor</td>
              </tr>
              <tr>
                <th scope="row">Biomas Awal</th>
                <td colspan="2" align="right">{{ bcdiv($biomas_awal,1,2) }}</td>
                <td align="left">kg</td>
              </tr>
              <tr>
                <th scope="row">Rerata Bobot Ikan Akhir</th>
                <td colspan="2" align="right">{{ bcdiv($rerata_akhir,1,2) }}</td>
                <td align="left">gram/ekor</td>
              </tr>
              <tr>
                <th scope="row">Biomas Akhir</th>
                <td colspan="2" align="right">{{ bcdiv($t_biomas/1000,1,1) }}</td>
                <td align="left">kg</td>
              </tr>
              <tr>
                <th scope="row">Total Kebutuhan Pakan</th>
                <td colspan="2" align="right">{{ bcdiv($t_pakan_kumulatif/1000,1,2) }}</td>
                <td align="left">kg</td>
              </tr>
              <tr>
                <th scope="row">Food Conversion Ratio (FCR)</th>
                <td colspan="2" align="right">{{ round($t_pakan_kumulatif/($t_biomas-$biomas_awal),2) }}</td>
                <td align="left"></td>
              </tr>
              <tr>
                <th scope="row">Laju Pertumbuhan Spesifik</th>
                <td colspan="2" align="right">{{ round($laju_pertumbuhan*100,2) }}</td>
                <td align="left">% per hari</td>
              </tr>
              <tr>
                <th scope="row">Kematian</th>
                <td colspan="2" align="right">{{ bcdiv($kematian,1,2) }}</td>
                <td align="left">%</td>
              </tr>
              <tr>
                <th scope="row">Kematian Harian</th>
                <td colspan="2" align="right">{{ bcdiv($kematian_harian,1,2) }}</td>
                <td align="left">% per hari</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
  </div>
</section>
</div>
</div>
</div>
</section><!-- End Contact Section -->


<section id="featured-services" class="featured-services">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center">
      <div class="col-lg-auto">
        <div class="icon-box1" data-aos="zoom-in" data-aos-delay="100">
          <h4 class="title"><a>Tabel Harian</a></h4> 
            <div class="table-responsive">  
              <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Hari Ke</th>
                        <th scope="col">Bobot</th>
                        <th scope="col">Kelangsungan Hidup</th>
                        <th scope="col">Ikan Hidup</th>
                        <th scope="col">Prediksi Biomas (gram)</th>
                        <th scope="col">Prediksi Biomas (kg)</th>
                        <th scope="col">Feeding Ratio</th>
                        <th scope="col">Pakan harian (gram)</th>
                        <th scope="col">Pakan harian (kg)</th>
                        <th scope="col">Pakan kumulatif (gram)</th>
                        <th scope="col">Pakan kumulatif (kg)</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td align='center'> {{ round($rerata_awal,2) }}</td>
                            <td align='center'> {{ $tmp_kelangsungan_hidup }}%</td>
                            <td align='center'> {{ $jumlah_tbr }} </td>
                            <td align='center'> {{ bcdiv($rerata_awal * $jumlah_tbr,1,0) }}</td>
                            <td align='center'> {{ bcdiv(($rerata_awal * $jumlah_tbr)/1000,1,1) }} </td>
                            <td align='center'> {{ bcdiv($FRAwal,1,1)}}%</td>
                            <td align='center'> {{ bcdiv(($rerata_awal * $jumlah_tbr)*$FRAwal/100,1) }} </td>
                            <td align='center'> {{ bcdiv((($rerata_awal * $jumlah_tbr)*$FRAwal/100)/1000,1,2) }} </td>
                            <td align='center'> {{ bcdiv(($rerata_awal * $jumlah_tbr)*$FRAwal/100,1) }} </td>
                            <td align='center'> {{ bcdiv((($rerata_awal * $jumlah_tbr)*$FRAwal/100)/1000,1,2) }} </td>
                        </tr>
                    
                        <?php 
                        for ($i=1; $i < $lama_plhr ; $i++) { 
                            $hari = $hari + 1;
                            echo "<tr>
                                  <td>".$hari."</td>";

                            $tmp_bobot = $tmp_bobot + ($tmp_bobot * $laju_pertumbuhan);
                            echo "<td align='center'>".round($tmp_bobot,2)."</td>";
            
                            $tmp_kelangsungan_hidup = $tmp_kelangsungan_hidup - $kematian_harian; 
                            echo "<td align='center'>".bcdiv($tmp_kelangsungan_hidup,1)."%</td>";
            
                            $tmp_ikan_hdp = ($tmp_kelangsungan_hidup * $jumlah_tbr)/100;
                            echo "<td align='center'>".round($tmp_ikan_hdp)."</td>";
                            
                            $tmp_biomas = $tmp_bobot * $tmp_ikan_hdp;
                            echo "<td align='center'>".round($tmp_biomas)."</td>";
                            echo "<td align='center'>".bcdiv($tmp_biomas/1000,1,1)."</td>";
            
                            $tmp_fr = $tmp_fr-($SelisihFR/($lama_plhr-1));
                            echo "<td align='center'>".bcdiv($tmp_fr,1,1)."%</td>";
            
                            $tmp_pakan_harian = $tmp_biomas*($tmp_fr/100);
                            echo "<td align='center'>".bcdiv($tmp_pakan_harian,1)."</td>";
                            echo "<td align='center'>".bcdiv(($tmp_pakan_harian/1000),1,2)."</td>";
            
                            $tmp_pakan_kumulatif = $tmp_pakan_kumulatif + $tmp_pakan_harian;
                            echo "<td align='center'>".bcdiv($tmp_pakan_kumulatif,1)."</td>";
                            echo "<td align='center'>".bcdiv(($tmp_pakan_kumulatif/1000),1,2)."</td>";
            
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
@endsection