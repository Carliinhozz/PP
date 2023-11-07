@extends('layouts.default')
@section('main')
    <form action="{{route('musicas.store')}}" method="post">
        @csrf
        <input type="text" name="search" placeholder="Pesquise a música">
        <button>Pesquisar</button>
    </form>
    <form action="{{route('login.index')}}" method="post">
        @csrf
        
        <button>Login</button>
    </form>
    
    @isset($response)
        @foreach ($response as $music)
            <img src="{{$music->album->cover}}" alt="">
            <h5>{{$music->title}}</h5>
            <label for="artist">{{$music->artist->name}}</label><br>
           
        @endforeach
    @endisset
@endsection