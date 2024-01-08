<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title', 'Rádio Desopila')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  
  <link href="public\favicon.ico" rel="icon">
  <link href="public\favicon.ico" rel="apple-touch-icon">

  <!-- Adicionando ícones via CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">


  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/main.css" rel="stylesheet">
  
   
</head>
<body>
    
    @include('layouts.header')
    
    @yield('main')
    
    @yield('footer')
   <!-- Vendor JS Files -->
   <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="/assets/vendor/aos/aos.js"></script>
   <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
   <script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>
   <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
   <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
   <script src="/assets/vendor/php-email-form/validate.js"></script>
 
   <!-- Template Main JS File -->
   <script src="/assets/js/main.js"></script>
</body>
</html>