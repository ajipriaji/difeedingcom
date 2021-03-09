@extends('layout/main')
<section>

@section('container')

    </section>
    <!-- ======= Form Section ======= -->
    <section id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">
          <div class="row justify-content-center">
            <div class="col-md-lg d-flex align-items-stretch">
              <div class="icon-box1" data-aos="fade-up" data-aos-delay="100">
                <h4 class="title"><a>Form Pengihutung Rasio Pakan Harian</a></h4>

                        {{-- menampilkan error validasi --}}
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <br/>
                         <!-- form validasi -->
                        <form action="{{ route('fcr') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Jumlah Tebar</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="jumlah_tbr" value="{{ old('jumlah_tbr') }}" placeholder="Masukkan Jumlah Tebar" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                                    <div class="input-group-append">
                                      <span class="input-group-text">ekor</span>
                                    </div>
                                </div>
                                  <small id="ket_jumlah_tbr" class="form-text text-muted"><span>Jumlah Tebar</span> adalah jumlah benih pada saat awal tebar, ex: 5000 benih</small>
                            </div>
                        
                            <div class="form-group">
                                <label>Size Benih</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="size_bnh" value="{{ old('size_bnh') }}" placeholder="Masukkan Size Benih">
                                    <div class="input-group-append">
                                      <span class="input-group-text">ekor/kg</span>
                                    </div>
                                  </div>
                                <small id="ket_size_bnh" class="form-text text-muted"><span>Size Benih</span> adalah jumlah benih dalam 1kg saat panen, ex: 650 benih per kg</small>
                            </div>
                            <div class="form-group">
                                <label>Size Panen</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="size_pnn" value="{{ old('size_pnn') }}" placeholder="Masukkan Size Panen">
                                    <div class="input-group-append">
                                      <span class="input-group-text">ekor/kg</span>
                                    </div>
                                  </div>
                                <small id="ket_size_pnn" class="form-text text-muted"><span>Size Panen</span> adalah jumlah ikan dalam 1kg, ex: 9 ekor per kg</small>
                            </div>
                            <div class="form-group">
                                <label>Lama Pemeliharaan</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="lama_plhr" value="{{ old('lama_plhr') }}" placeholder="Masukkan Lama Pemeliharaan">
                                    <div class="input-group-append">
                                      <span class="input-group-text">hari</span>
                                    </div>
                                  </div>
                                <small id="ket_lama_plhr" class="form-text text-muted"><span>Lama Pemeliharaan</span> adalah waktu yang dihitung dari awal tebar benih hingga panen</small>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Tebar</label>
                                <input id="datepicker" type="date" class="form-control" name="tanggal_tbr" value="{{ old('tanggal_tbr') }}" placeholder="Isi berupa angka">
                                <small id="ket_tgl_tbr" class="form-text text-muted"><span>Tanggal Tebar</span> adalah Tanggal yang diinginkan saat akan mulai tebar</small>
                            </div>
                            <div class="form-group">
                                <label>Kelangsungan Hidup</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="kelangsungan_hdp" value="{{ old('kelangsungan_hdp') }}" placeholder="Masukkan Kelangsungan Hidup">
                                    <div class="input-group-append">
                                      <span class="input-group-text">%</span>
                                    </div>
                                  </div>
                                <small id="ket_kelangsungan_hdp" class="form-text text-muted"><span>Kelangsungan Hidup</span> adalah persentase jumlah ikan hidup disaat panen, ex 80% </small>
                            </div>
                            <div class="form-group">
                                <label>Feeding Ratio Awal</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="FRAwal" value="{{ old('FRAwal') }}" placeholder="Masukkan Feeding Ratio Awal">
                                    <div class="input-group-append">
                                      <span class="input-group-text">%</span>
                                    </div>
                                  </div>
                                  <small id="ket_fr_awal" class="form-text text-muted"><span>Feeding Rate Awal</span> adalah persentase pemberian pakan pada awal pemeliharaan, ex: 5% </small>
                            </div>
                            <div class="form-group">
                                <label>Feeding Rate Akhir</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="FRAkhir" value="{{ old('FRAkhir') }}" placeholder="Masukkan Feeding Ratio Akhir">
                                    <div class="input-group-append">
                                      <span class="input-group-text">%</span>
                                    </div>
                                  </div>
                                  <small id="ket_fr_awal" class="form-text text-muted"><span>Feeding Rate Akhir</span> adalah persentase pemberian pakan pada akhir pemeliharaan, ex: 3% </small>
                            </div>
                            <div class="form-group text-center">
                                <input class="btn btn-outline-dark" type="submit" value="Hitung">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </section>         
@endsection