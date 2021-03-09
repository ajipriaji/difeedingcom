@extends('layout/main')

@section('container')

    <section>
    </section>
    <!-- ======= Form Section ======= -->
    <section id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">
          <div class="row justify-content-center">
            <div class="col-md-lg d-flex align-items-stretch">
              <div class="icon-box1" data-aos="fade-up" data-aos-delay="100">
                <h4 class="title"><a>Form Edit Rasio Pakan Harian</a></h4>

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
                        <form action="{{ url('/histori/'.$histories->id) }}" method="post">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label>Jumlah Tebar</label>
                                <input class="form-control" type="number" name="jumlah_tbr" value="{{ $histories->jumlah_tbr }}" placeholder="Isi berupa angka">
                            </div>
                            <div class="form-group">
                                <label>Size Benih</label>
                                <input class="form-control" type="number" name="size_bnh" value="{{ $histories->size_bnh }}" placeholder="Isi berupa angka">
                            </div>
                            <div class="form-group">
                                <label>Size Panen</label>
                                <input class="form-control" type="number" name="size_pnn" value="{{ $histories->size_pnn }}" placeholder="Isi berupa angka">
                            </div>
                            <div class="form-group">
                                <label>Lama Pemeliharaan</label>
                                <input class="form-control" type="number" name="lama_plhr" value="{{ $histories->lama_plhr }}" placeholder="Isi berupa angka">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Tebar</label>
                                <input id="datepicker" type="date" class="form-control" name="tanggal_tbr" value="{{ date_format($histories->tanggal_tbr,"Y-m-d") }}" placeholder="Isi berupa angka">
                            </div>
                            <div class="form-group">
                                <label>Kelangsungan Hidup</label>
                                <input class="form-control" type="number" name="kelangsungan_hdp" value="{{ $histories->kelangsungan_hdp }}" placeholder="Isi berupa angka">
                            </div>
                            <div class="form-group">
                                <label>Feeding Rate Awal</label>
                                <input class="form-control" type="number" name="FRAwal" value="{{ $histories->FRAwal }}" placeholder="Isi berupa angka">
                            </div>
                            <div class="form-group">
                                <label>Feeding Rate Akhir</label>
                                <input class="form-control" type="number" name="FRAkhir" value="{{ $histories->FRAkhir }}" placeholder="Isi berupa angka">
                            </div>
                            <div class="form-group text-center">
                                <input class="btn btn-outline-dark" type="submit" value="Ubah Data">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </section>         
@endsection