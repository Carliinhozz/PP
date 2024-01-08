@extends('layouts.default')
@section('title')
    Editar playlist
@endsection
@section('main')

<div class="container-fluid row gap-1 justify-content-center p-5">
    <button class="btn edit-btn col-5 active" onclick="showMorning()">Manhã</button>
    <button class="btn edit-btn col-5" onclick="showAfternoon()">Tarde</button>
</div>

<div class="container" id="morningPlaylist">
    <div class="card card-body">
        <ul class="list-group list-group-numbered">
            @if (!$morning_playlist_musics->isEmpty())
                @foreach ($morning_playlist_musics as $music)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{$music->title}}</div>
                            {{$music->artist}}
                        </div>
                        <div class="align-items-end">
                            <p>{{gmdate("i:s", $music->duration)}}</p>
                        </div>
                    </li>
                @endforeach
                <p>Duração total:{{gmdate("i:s", $morning_playlist->duration)}}</p>
                <a class="btn btn-enter" href="{{route('playlist.add_index', ['id' => $morning_playlist->id])}}">Editar</a>
            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Sem músicas!</h4>
                    <a class="btn btn-enter" href="{{route('music.index')}}">Solicitar músicas</a>
                </div>
            @endif
        </ul>
    </div>
</div>

<div class="container" id="afternoonPlaylist" style="display: none;">
    <div class="card card-body">
        <ul class="list-group list-group-numbered">
            @if (!$afternoon_playlist_musics->isEmpty())
                @foreach ($afternoon_playlist_musics as $music)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{$music->title}}</div>
                            {{$music->artist}}
                        </div>
                        <div class="align-items-end">
                            <p>{{gmdate("i:s", $music->duration)}}</p>
                        </div>
                    </li>
                @endforeach
                <p>Duração total:{{gmdate("i:s", $afternoon_playlist->duration)}}</p>
                <a class="btn btn-enter" href="{{route('playlist.add_index', ['id' => $afternoon_playlist->id])}}">Editar</a>
            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Sem músicas!</h4>
                    <a class="btn btn-enter" href="{{route('music.index')}}">Solicitar músicas</a>
                </div>
            @endif
        </ul>
    </div>
</div>

<style>
    .btn.edit-btn.active {
        background-color: #F8E182;
        color: #534881;
    }
</style>

<script>
    function showMorning() {
        document.getElementById('morningPlaylist').style.display = 'block';
        document.getElementById('afternoonPlaylist').style.display = 'none';
        document.querySelector('.btn.edit-btn.col-5.active').classList.remove('active');
        document.querySelector('.btn.edit-btn.col-5').classList.add('active');
    }

    function showAfternoon() {
        document.getElementById('morningPlaylist').style.display = 'none';
        document.getElementById('afternoonPlaylist').style.display = 'block';
        document.querySelector('.btn.edit-btn.col-5.active').classList.remove('active');
        document.querySelectorAll('.btn.edit-btn.col-5')[1].classList.add('active');
    }
</script>

@endsection