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
<p>Duração total:{{gmdate("i:s", $playlist->duration)}}</p>
 
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