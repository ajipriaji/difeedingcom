<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Difeeding Indonesia</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{!! asset('assets/img/favicon.png') !!}" rel="icon">
  <link href="{!! asset('assets/img/apple-touch-icon.png') !!}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{!! asset('assets/vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
  <link href="{!! asset('assets/vendor/icofont/icofont.min.css') !!}" rel="stylesheet">
  <link href="{!! asset('assets/vendor/boxicons/css/boxicons.min.css') !!}" rel="stylesheet">
  <link href="{!! asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') !!}" rel="stylesheet">
  <link href="{!! asset('assets/vendor/venobox/venobox.css') !!}" rel="stylesheet">
  <link href="{!! asset('assets/vendor/aos/aos.css') !!}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{!! asset('assets/css/style.css') !!}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      {{-- <h1 class="logo mr-auto"><a href=" {{ route('home') }} ">di<span>feeding</span></a></h1> --}}
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="{{route('home')}}" class="logo mr-auto"><img src="{!! asset('assets/img/ic_logo_color@3x.png') !!}" alt="logo_difeeding"></a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>        
                <?php
          
                if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
                    //Login Success
                    $name = Auth::user()->name;
                    $id = Auth::user()->id;
                    $avatar = Auth::user()->avatar;
                    echo "<li><a href='".route('fcr')."'>Kalkulator FCR</a></li>";
                    echo "<li><a href='".route('histori')."'>Histori</a></li>";
                    echo "<li><a href='#'>Blog</a></li>";
                    echo "<li class='dropdown'>";
                    // echo "<img src='.$avatar.' alt='.$name.' 
                    //       style='border: 1px solid #cccccc; border-radius: 5px; width: 39px; height: auto; float:left; margin-right: 7px;' >";
                    echo "<a class='dropdown-toggle' role='button' data-toggle='dropdown'>".$name."</a>";
                    echo "<div class='dropdown-menu'>";
                    echo "<a href='".url('/edit_profile/'.$id)."'>Edit Profile</a>";         
                    echo "<a href='".route('logout')."'>logout</a>";
                    echo "</div>";         
                } else { // false
                  echo "<li><a href='".route('harus_login')."'>Kalkulator FCR</a></li>";  
                  echo "<li><a href='#'>Blog</a></li>";  
                  echo "<li><a href='". route('login')  ."'> Masuk </a></li>";
                    
                }
          
              ?>
        </li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  
    @yield('container')

    
  </main><!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Difeeding</h3>
            <p>
              Surakarta <br>
              Central Java<br>
              Indonesia <br><br>
              <strong>Phone:</strong> 0852-9058-7282<br>
              <strong>Email:</strong> info@difeeding.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Perusahaan</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Tentang Kami</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Karir</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Blog</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Media</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Produk</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('fcr')}}">Hitung FCR</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Media Sosial Kami</h4>
            <p>Interaksi lebih dekat dengan kami</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Difeeding</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{!! asset('assets/vendor/jquery/jquery.min.js') !!}"></script>
  <script src="{!! asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
  <script src="{!! asset('assets/vendor/jquery.easing/jquery.easing.min.js') !!}"></script>
  <script src="{!! asset('assets/vendor/php-email-form/validate.js') !!}"></script>
  <script src="{!! asset('assets/vendor/waypoints/jquery.waypoints.min.js') !!}"></script>
  <script src="{!! asset('assets/vendor/counterup/counterup.min.js') !!}"></script>
  <script src="{!! asset('assets/vendor/owl.carousel/owl.carousel.min.js') !!}"></script>
  <script src="{!! asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') !!}"></script>
  <script src="{!! asset('assets/vendor/venobox/venobox.min.js') !!}"></script>
  <script src="{!! asset('assets/vendor/aos/aos.js') !!}"></script>


  <!-- Template Main JS File -->
  <script src="{!! asset('assets/js/main.js') !!}"></script>
</body>

</html>