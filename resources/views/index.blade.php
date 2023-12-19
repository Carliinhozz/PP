@extends('layouts.default')

@section('main')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 flex-column justify-content-center text-center text-lg-start">
          <h2>Rádio Desopila</h2>
          <p>A plataforma da Rádio Desopila é fonte de comunicação e entretenimento dentro da escola e por isso se tornou um ponto de convergência para a diversidade de vozes e interesses, através de programas culturais, revista, pedidos de música, etc., a rádio se esforça para oferecer conteúdo que informe, inspire e, claro, divirta.
          </p>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Painel horizontal para usuários não autenticados -->
  @if (!Auth::check())
    <section id="social-panel" class="social-panel">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h3>Conecte-se conosco nas plataformas:</h3>
            <div class="social-icons">
              <a href="https://www.instagram.com/radio_desopila/?utm_source=ig_web_button_share_sheet&igshid=OGQ5ZDc2ODk2ZA==" target="_blank" title="Instagram"><img src="assets/img/plataformas/instagram.png" alt="Instagram"></a>
              <a href="https://www.youtube.com/channel/UCEoxxtXdjrVTmIl-op0kT0w" target="_blank" title="YouTube"><img src="assets/img/plataformas/youtube.png" alt="YouTube"></a>
              <a href="https://open.spotify.com/show/4i0Gru4spSte7Gdf5ppqzk?si=13f981c031ae40d6" target="_blank" title="Spotify"><img src="assets/img/plataformas/spotify.png" alt="Spotify"></a>
              <a href="https://deezer.page.link/p9ZSg7kZFP1YLQMN7" target="_blank" title="Deezer"><img src="assets/img/plataformas/deezer.png" alt="Deezer"></a>
              <a href="https://podcasts.apple.com/us/podcast/r%C3%A1dio-desopila-ifrn/id1509957658" target="_blank" title="Apple Podcasts"><img src="assets/img/plataformas/apple-podcasts.png" alt="Apple Podcasts"></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- Adicionando o Contêiner da Playlist do Dia para Usuários Autenticados -->
  @if (Auth::check())
    <section id="playlist" class="playlist">
      <div class="container">
        <div class="row">
          <h3>Playlist do dia</h3>
          <div class="col-lg-4">
            <ul class="playlist-tabs">
              <li onclick="showPlaylist('manha', event)" class="active">Manhã</li>
              <li onclick="showPlaylist('tarde', event)">Tarde</li>
              <li onclick="showPlaylist('noite', event)">Noite</li>
            </ul>
          </div>
          <div class="col-lg-8">
            <div id="manha" class="playlist-content">
              <ol>
                <li>Se - Djavan</li>
                <li>Esse Cara sou eu - Roberto Carlos</li>
                <!-- Adicione mais músicas conforme necessário -->
              </ol>
            </div>
            <div id="tarde" class="playlist-content" style="display: none;">
              <ol>
                <li>Gol bolinha 2 - MC Pedrinho</li>
                <li>Show das poderosas - Anitta</li>
                <!-- Adicione mais músicas conforme necessário -->
              </ol>
            </div>
            <div id="noite" class="playlist-content" style="display: none;">
              <ol>
                <li>Azul da Cor do Mar - Tim Maia</li>
                <!-- Adicione mais músicas conforme necessário -->
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- Adicionando o Contêiner de Agendamentos para Usuários Autenticados -->
  @if (Auth::check())
    <section id="agendamentos" class="agendamentos">
      <div class="container">
        <div class="row">
          <h3>Agendamentos</h3>
          <div class="col-lg-12">
            <ul class="agendamentos-days">
              <li onclick="showContent('segunda', 'agendamentos')" class="active">Segunda</li>
              <li onclick="showContent('terca', 'agendamentos')">Terça</li>
              <li onclick="showContent('quarta', 'agendamentos')">Quarta</li>
              <li onclick="showContent('quinta', 'agendamentos')">Quinta</li>
              <li onclick="showContent('sexta', 'agendamentos')">Sexta</li>
            </ul>
            <div id="segunda" class="agendamentos-content">
              <ul>
                <li>7h - 9h</li>
                <li>8h - 9h</li>
                <li>15h - 16h</li>
                <!-- Adicione mais agendamentos conforme necessário -->
              </ul>
            </div>
            <div id="terca" class="agendamentos-content" style="display: none;">
              <ul>
                <li>7h - 8h</li>
                <li>8h - 9h</li>
                <li>15h - 16h</li>
                <!-- Adicione mais agendamentos conforme necessário -->
              </ul>
            </div>
            <div id="quarta" class="agendamentos-content" style="display: none;">
              <ul>
                <li>7h - 9h</li>
                <li>8h - 9h</li>
                <li>15h - 16h</li>
                <!-- Adicione mais agendamentos conforme necessário -->
              </ul>
            </div>
            <div id="quinta" class="agendamentos-content" style="display: none;">
              <ul>
                <li>7h - 8h</li>
                <li>8h - 9h</li>
                <li>15h - 16h</li>
                <!-- Adicione mais agendamentos conforme necessário -->
              </ul>
            </div>
            <div id="sexta" class="agendamentos-content" style="display: none;">
              <ul>
                <li>7h - 8h</li>
                <li>8h - 9h</li>
                <li>15h - 16h</li>
                <!-- Adicione mais agendamentos conforme necessário -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif
@endsection

@section('footer')
  @include('layouts.footer')
@endsection

<style>
  .playlist-tabs li {
    cursor: pointer;
    user-select: none;
    list-style: none; /* Remova o ponto antes do texto */
  }

  .playlist-tabs li.active {
    font-weight: bold;
  }

  .agendamentos-days li {
    cursor: pointer;
    user-select: none;
    list-style: none; /* Remova o ponto antes do texto */
    display: inline-block; /* Alinhe os dias horizontalmente */
    margin-right: 10px; /* Adicione margem entre os dias */
  }

  .agendamentos-days li.active {
    font-weight: bold;
  }

  .social-panel {
    background-color: #f8f9fa;
    padding: 20px 0;
    text-align: center;
  }

  .social-icons img {
    width: 50px; /* Ajuste a largura dos ícones conforme necessário */
    margin: 0 10px;
  }

</style>

<script>
  function showPlaylist(target, event) {
    event.preventDefault();

    var tabs = document.querySelectorAll('.playlist-tabs li');
    var playlists = document.querySelectorAll('.playlist-content');

    tabs.forEach(tab => {
      tab.classList.remove('active');
    });

    playlists.forEach(playlist => {
      playlist.style.display = 'none';
    });

    document.getElementById(target).style.display = 'block';

    var activeTab = event.target;
    activeTab.classList.add('active');
  }

  function showContent(target, container) {
    var tabs = document.querySelectorAll('.' + container + '-days li');
    var content = document.querySelectorAll('.' + container + '-content');

    tabs.forEach(tab => {
      tab.classList.remove('active');
    });

    content.forEach(item => {
      item.style.display = 'none';
    });

    document.getElementById(target).style.display = 'block';

    var activeTab = event.target;
    activeTab.classList.add('active');
  }
</script>

<div id="preloader"></div>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>