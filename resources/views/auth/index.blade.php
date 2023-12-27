@extends('layouts.default')

@section('main')

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