@extends('layouts.default')
@section('title')
    Adicionar músicas
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
                <form action="{{route('music.delete', ['id'=>$playlist->id, 'music_id' => $music->id])}}" method="post">
                    @csrf
                    <button data-mdb-ripple-init class="btn btn-danger">Apagar</button>
                </form>
                <form action="{{route('playlist.add_store', ['id'=>$playlist->id, 'music_id' => $music->id])}}" method="post">
                    @csrf
                    <button data-mdb-ripple-init class="btn btn-success">Adicionar</button>
                </form>
                <p class="mt-1 mb-0">{{gmdate("i:s", $music->duration)}}</p>
            </div>       
        </li>
    @endforeach
    <p>Playlist do dia: {{$newDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $playlist->day)
        ->format('d-m-Y')}}</p>
    <p>Duração total:{{gmdate("i:s", $playlist->duration)}}</p>                   
    </ul>
@else
    <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Sem músicas!</h4>
    <hr>
    <a  class="btn btn-enter col-4 d-inline" href="{{route('music.index')}}">Solicite músicas</a> 
    <p class="mb-0 mt-2">Duração total:{{gmdate("i:s", $playlist->duration)}}</p>
    </div> 
    </ul>
@endif


<ul class="list-group list-group-numbered p-5"> 
    <p>Músicas da playlist:</p>
    @if (!$playlist_musics->isEmpty())
        @foreach ($playlist_musics as $music)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{$music->title}}</div>
                    {{$music->artist}}   
                </div>
                <div class="align-items-end">
                    <form action="{{route('playlist.delete', ['id'=>$playlist->id, 'music_id' => $music->id])}}" method="post">
                        @csrf
                        <button data-mdb-ripple-init class="btn btn-danger">Deletar</button>
                    </form>
                    <p class="mt-1 mb-0">{{gmdate("i:s", $music->duration)}}</p>
                </div>       
            </li>
        @endforeach
            <form action="{{route('playlist.store',['id'=>$playlist->id])}}" method="post">
                @csrf
                <button data-mdb-ripple-init class="btn btn-enter col-4">Salvar</button>
            </form>             
        </ul>
        
    @else
        <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Sem músicas!</h4>
        <a  class="btn btn-enter col-4 d-inline" href="{{route('music.index')}}">Solicite músicas</a> 
        </div>
        </ul>
        
    @endif
    @endsection
@section('footer')
    
@endsection