@extends('layout/main')

@section('container')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1>Welcome to di<span>feeding</span>
      </h1>
      <h2>Kami adalah sebuah team yang bekerja untuk mempermudah kegiatan perikanan anda</h2>
    </div>
  </section><!-- End Hero -->
  

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          
          {{-- <h3>Apa itu di<span>feeding</span>?</h3> --}}
          <h3>Apa itu <img src="assets/img/ic_logo_color@3x.png" class="img-fluid" style="width: 200px; height: auto;" alt="">?</h3>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
            <img src="assets/img/about.jpg" style="border-radius: 24px" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column" data-aos="fade-up" data-aos-delay="100">
            <h3>Sebuah Website Untuk Melakukan Perhitungan Budidaya Ikan Anda</h3>
            <p>
              Difeeding memberikan informasi digital mengenai dunia perikanan untuk membantu anda meningkatkan hasil panen, memastikan keuntungan serta keberlanjutan budidaya anda.
            </p>
            <div class="d-flex">
              <a href="{{route('fcr')}}" class="btn-get-started scrollto">Coba Sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= FCR Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          
          {{-- <h3>Apa itu di<span>feeding</span>?</h3> --}}
          <h3>Sekilas <span>Info</span></h3>
        </div>

        <div class="row">
          <div class="col-lg-6 content d-flex flex-column" data-aos="zoom-out" data-aos-delay="100">
            <h3>Apakah itu FCR?</h3>
            <p>
              Pengertian FCR (Food Convertion Ratio) adalah perbandingan antara berat pakan yang sudah diberikan dalam siklus periode dengan berat total (biomas)
              yang dihasilkan saat dilakukan sampling
            </p>
            <div class="d-flex">
              <a href="#" class="btn-get-started scrollto">Baca Selengkapnya</a>
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/fcr.jpg" style="border-radius: 24px" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </section><!-- End FCR Section -->

    <!-- ======= Featured Services Section ======= -->
    {{-- <section id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">
  
          <div class="row justify-content-center">
            <div class="col-md-auto d-flex align-items-stretch">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"><i class="bx bxl-dribbble"></i></div>
                
                <?php
                // if (Auth::check()) {
                //   echo "<h4 class='title'><a href='".route('fcr')."'>Hitung FCR Perikanan</a></h4>"
                //     ;
                //   # code...
                // }else{
                //   echo "<h4 class='title'>"."<a href='".route('harus_login')."'>Hitung Food Convertion Ratio (FCR) Perikanan</a></h4>";
                // }
                ?>              
                <p class="description">Menghitung biomas dan juga kebutuhan pakan harian ikan</p>
              </div>
            </div>
        </div> --}}
      </section><!-- End Featured Services Section -->
      
    

@endsection