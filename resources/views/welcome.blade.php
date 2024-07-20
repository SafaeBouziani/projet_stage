<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Card Request</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
  
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
 
 
    <link href="{{ asset('assets_welcome/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_welcome/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_welcome/vendor/aos/aos.css" rel="stylesheet') }}">
    <link href="{{ asset('assets_welcome/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_welcome/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

      <!-- Main CSS File -->
  <link href="{{ asset('assets_welcome/css/main.css') }}" rel="stylesheet">
  <style>
  #navmenu a {
    display: inline-block; /* Ensures the links are inline */
    margin-left: 10px; /* Adjust spacing as needed */
  }
  </style>
</head>
<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
  
      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('logo_universite.png') }}" alt="logo">
        <h1 class="sitename">Card Request</h1>
      </a>
  
      <nav id="navmenu" class="navmenu">
        @if (Route::has('login'))
          @auth
            @if(Auth::user()->hasRole('admin'))
              <a class="btn-getstarted flex-md-shrink-0" href="{{ url('/admin/dashboard') }}">
                Dashboard
              </a>
            @else
              <a class="btn-getstarted flex-md-shrink-0" href="{{ url('/user/dashboard') }}">
                Dashboard
              </a>
            @endif
          @else
          <a class="btn-getstarted flex-md-shrink-0" href="{{ route('login') }}">
            Log in
          </a>
          @if (Route::has('register'))
            <a class="btn-getstarted flex-md-shrink-0" href="{{ route('register') }}">
              Register
            </a>
          @endif
          @endauth
        @endif
      </nav>
    </div>
  </header>
  

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">IBN TOFAIL UNIVERSITY</h1>
            <p data-aos="fade-up" data-aos-delay="100">Get your professional card<br> now with ease and simplicity</p>
            <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
              <a href="{{ route('login') }}" class="btn-get-started">Get Started <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="{{ asset('assets_welcome/img/hero-img.png') }}" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section>

  </main>
  <footer id="footer" class="footer">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Card request</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets_welcome/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets_welcome/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets_welcome/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets_welcome/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets_welcome/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets_welcome/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets_welcome/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets_welcome/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets_welcome/js/main.js') }}"></script>

</body>

</html>
