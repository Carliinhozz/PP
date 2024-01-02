@extends('layouts.default')

@section('main')
<section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-1 flex-column justify-content-center text-center text-lg-start">
          <h2>Pedidos de música</h2>
          <p>Sua música favorita tocando nos corredores do IFRN!</p>
        </div>
        <div class="col-lg-6 order-2 input-search">
        <form class="input-group" action="{{route('music.search')}}" method="post">
            @csrf
                <input type="text" class="form-control rounded" 
                @isset($search)
                    value="{{$search}}"
                @endisset  
                placeholder="Pesquise a música" name="search"/>
                <button class="btn btn-search" data-mdb-ripple-init>Pesquisar</button>
        </form>
</div>
</section>
</div>
    @isset($it_worked)   
        @if ($it_worked && $response != null)
            <div class="container grid-container card-deck">
                {{-- FIXME: arrumar o sistema de cartões ou pensar em uma forma melhor --}}
                @foreach ($response as $music)
                    <div class="grid-item card">
                            <img src="{{$music->album->cover_big}}">
                            <div class="card-body">
                            <h5 class="card-title">{{$music->title}}</h5>
                            <p class="card-text">{{$music->artist->name}}</p>
                            <form method="POST" action="{{route('music.store', ['id' => $music->id])}}">
                                @csrf
                                <div class="card-text">
                                    <select class="form-select" name="time">
                                        <option value= 0>Matutino</option>
                                        <option value= 1>Vespertino</option>
                                    </select>
                                </div>
                            <button href="" class="btn btn-music">Solicitar música</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Erro</h4>
                <p>Nenhum resultado para: {{$search}}</p>
                <hr>
               
            </div>
        @endif
    @endisset
    
        
    
@endsection