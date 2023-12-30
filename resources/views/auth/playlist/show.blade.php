@extends('layouts.default')
@section('title')
    Playlist
@endsection
@section('main')

<ul class="list-group list-group-numbered p-5"> 
    @if (!$musics->isEmpty())
        @foreach ($musics as $music)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{$music->title}}</div>
                    {{$music->artist}}   
                </div>
                <div class="align-items-end">
                    <form action="{{route('playlist.delete', ['id'=>$playlist->id, 'id_music' => $music->id])}}" method="post">
                        @csrf
                        <button data-mdb-ripple-init class="btn btn-danger">Deletar</button>
                    </form>
                    <p class="mt-1 mb-0">{{gmdate("i:s", $music->duration)}}</p>
                </div>       
            </li>
        @endforeach
        <p>Duração total:{{gmdate("i:s", $playlist->duration)}}</p>
        <a  class="col-4 btn btn-secondary" href="{{route('playlist.add', ['id'=>$playlist->id])}}">Adicionar músicas</a>   
        <a class="btn btn-enter col-4" href="">Salvar</a>            
    </ul>
    @else
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Sem músicas!</h4>
        <a  class="btn btn-enter col-4 d-inline" href="">Adicionar músicas</a> 
      </div>
    </ul>
    @endif    
@endsection
@section('footer')
    @include('layouts.footer'){{-- se tiver footer coloca, se não tiver não coloca o include--}}
@endsection