@extends('layouts.default')
@section('title')
    Editar playlist
@endsection
@section('main')


<p class="p-5">
  <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Manhã</a>
  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Tarde</button>
</p>
<div class="row">
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
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
            <a class="btn btn-enter" href="{{route('playlist.show', ['id' => $morning_playlist->id])}}">Editar</a>            
        </ul>
        @else
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Sem músicas!</h4>
                <a class="btn btn-enter" href="{{route('music.index')}}">Solicitar músicas</a> 
            </div>
        @endif
      </div>
    </div>
  </div>
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
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
            <a class="btn btn-enter" href="{{route('music.index')}}">Editar</a>            
        </ul>
        @else
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Sem músicas!</h4>
            <a class="btn btn-enter" href="{{route('music.index')}}">Solicitar músicas</a> 
          </div>
        @endif
        
      </div>
    </div>
  </div>
</div>
@endsection