@extends('layouts.default')

@section('main')

  <!-- Adicionando o Contêiner da Playlist do Dia para Usuários Autenticados -->
  @if (Auth::check())
    <section id="playlist" class="playlist">
      <div class="container">
        <div class="row">
          <h2>Playlist do dia</h2>
          <div class="container col-lg-2">
            <ul class="playlist-tabs row justify-content-center">
              <li onclick="showPlaylist('manha', event)" class="active col-12 mt-4">Manhã</li>
              <li onclick="showPlaylist('tarde', event)" class="col-12">Tarde</li>
            </ul>
          </div>
          <div class="col-lg-10">
            <div id="manha" class="container playlist-content">
              <ol class="row justify-content-center">
                @if($morning_musics->isNotEmpty())
                  @foreach ($morning_musics as $music)
                      <li>{{$music->title}}</li>
                  @endforeach
                @else
                  <li>Sem músicas ate o momento</li>
                @endif
                <!-- Adicione mais músicas conforme necessário -->
              </ol>
            </div>
            <div id="tarde" class="playlist-content" style="display: none;">
              <ol>
                @if($afternoon_musics->isNotEmpty())
                  @foreach ($afternoon_musics as $music)
                      <li>{{$music->title}}</li>
                  @endforeach
                @else
                  <li>Sem músicas ate o momento</li>
                @endif
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
          <h2>Agendamentos</h2>
          <div class="col-lg-12">
            <ul class="agendamentos-days d-flex justify-content-around">
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