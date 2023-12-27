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
        @if (isset($morning_playlist_musics))
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
            <p>Duração total:{{gmdate("i:s", $morning_playlist_duration)}}</p>
            <a href="{{route('playlist.edit', ['id' => $afternoon_playlist_id])}}">Editar</a>
        </ul>
        @else
        
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Sem músicas!</h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
      <div class="card card-body">
        <ul class="list-group list-group-numbered"> 
        @if (isset($afternoon_playlist_musics))
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
            <p>Duração total:{{gmdate("i:s", $afternoon_playlist_duration)}}</p>
            <a href="">Editar</a>
        </ul>
        @else
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Sem músicas!</h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
          </div>
        @endif
        
      </div>
    </div>
  </div>
</div>
@endsection