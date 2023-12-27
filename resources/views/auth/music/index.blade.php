@extends('layouts.default')

@section('main')
    <div class="p-5">
        <form class="input-group" action="{{route('music.search')}}" method="post">
            @csrf
            
                <input type="text" class="form-control rounded" 
                @isset($search)
                    value="{{$search}}"
                @endisset  
                placeholder="Pesquise a música" name="search"/>
                <button class="btn btn-enter" data-mdb-ripple-init>Pesquisar</button>
              
        </form>
    </div>
    @isset($it_worked)   
        @if ($it_worked && $response != null)
            <div class="card-deck">
                {{-- FIXME: arrumar o sistema de cartões ou pensar em uma forma melhor --}}
                @foreach ($response as $music)
                    <div class="card" style="width: 18rem;">
                        <img src="{{$music->album->cover_big}}" class="card-img-top img-fluid" alt="...">
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
                            <button href="" class="btn btn-primary">Solicitar música</button>
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
@section('footer')
    @include('layouts.footer'){{-- se tiver footer coloca, se não tiver não coloca o include--}}
@endsection