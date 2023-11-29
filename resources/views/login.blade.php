@extends('layouts.default')
@section('main')
    <form action="" method="get">
        @csrf
        <input type="text" name="search" placeholder="Pesquise a música">
        <button>Pesquisar</button>
    </form>

@endsection