@extends('layouts.default')

@section('main')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position relative d-flex justify-content-around">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-1 flex-column justify-content-center text-center text-lg-start">
          <h2>Rádio Desopila</h2>
          <p>A plataforma da Rádio Desopila é fonte de comunicação e entretenimento dentro da escola e por isso se tornou um ponto de convergência para a diversidade de vozes e interesses, através de programas culturais, revista, pedidos de música, etc., a rádio se esforça para oferecer conteúdo que informe, inspire e, claro, divirta.
          </p>
        </div>
        <!-- <div class="video-index col-lg-6 order-1 order-lg-2">
          <img src="assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div> -->
        <div class="video-index col-lg-6 order-2">
          <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
          <img src="assets/img/about-2.jpg" class="img-fluid rounded-4" alt=""> -->
          <video src="https://www.youtube.com/watch?v=DTIetbQKFEY" controls class="rounded video">
                <!-- <source src="assets/videos/Alfabeto.mkv">
                <source src="assets/videos/Alfabeto.mp4">
                <source src="assets/videos/Alfabeto.mov"> -->
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Painel horizontal para usuários não autenticados -->
  @if (!Auth::check())
    <section class="container social-panel">
          <div class="col-lg-12">
            <h3 class="mb-2">Conecte-se conosco nas plataformas:</h3>
            <div class="social-icons">
              <a id="insta-icon" href="https://www.instagram.com/radio_desopila/?utm_source=ig_web_button_share_sheet&igshid=OGQ5ZDc2ODk2ZA==" target="_blank" title="Instagram"><img src="assets/img/plataformas/instagram.png" alt="Instagram"></a>
              <a id="insta-icon"href="https://www.youtube.com/channel/UCEoxxtXdjrVTmIl-op0kT0w" target="_blank" title="YouTube"><img src="assets/img/plataformas/youtube.png" alt="YouTube"></a>
              <a id="insta-icon"href="https://open.spotify.com/show/4i0Gru4spSte7Gdf5ppqzk?si=13f981c031ae40d6" target="_blank" title="Spotify"><img src="assets/img/plataformas/spotify.png" alt="Spotify"></a>
              <a id="insta-icon"href="https://deezer.page.link/p9ZSg7kZFP1YLQMN7" target="_blank" title="Deezer"><img src="assets/img/plataformas/deezer.png" alt="Deezer"></a>
              <a id="insta-icon"href="https://podcasts.apple.com/us/podcast/r%C3%A1dio-desopila-ifrn/id1509957658" target="_blank" title="Apple Podcasts"><img src="assets/img/plataformas/apple-podcasts.png" alt="Apple Podcasts"></a>
            </div>
          </div>
    </section>
  @endif
@endsection

@section('footer')
  @include('layouts.footer')
@endsection

<div id="preloader"></div>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>