@extends('layouts.default')
@section('title')
    Instrumentos
@endsection
@section('main')
<form class="p-5" method="POST" action="{{route('instruments.store')}}">
    @csrf
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Descrição</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="description" placeholder="Descrição">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Número de tombamento</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="institucional_code" placeholder="Número de tombamento">
      </div>
    </div>
    <div class="form-group">
        <label>Tipo de instrumento</label>
        <select class="form-control" name="instrument_model">
            @foreach ($instrument_models as $model)
                <option value="{{$model->id}}">{{$model->model}}</option>
            @endforeach
        </select>
      </div>   
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-enter">Adicionar</button>
      </div>
    </div>
    
</form>

@if ($instruments->isNotEmpty())
    <div class="row justify-content-center">
        <ul class="list-group col-10">
            @foreach ($instruments as $instrument)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                {{$instrument->description}}
                <div class="align-items-end">
                        <a href="{{route('instruments.show',['id'=>$instrument->id])}}" class="btn btn-enter">Editar</a>
                    {{-- <form action="{{route('playlist.add_store', ['id'=>$playlist->id, 'music_id' => $music->id])}}" method="post">
                        @csrf
                        <button data-mdb-ripple-init class="btn btn-success">Adicionar</button>
                    </form> --}}
                </div>       
            </li>
            @endforeach      
        </ul>
    </div>
  
@endif
@endsection
@section('footer')
    
@endsection
