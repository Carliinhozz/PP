@extends('layouts.default')
@section('title')
    Instrumento
@endsection
@section('main')
<form class="p-5" method="POST" action="{{route('instruments.update',['id'=>$instrument->id])}}">
    @csrf
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Descrição</label>
      <div class="col-sm-10">
        <input type="text" value="{{$instrument->description}}" class="form-control" name="description" placeholder="Descrição">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Número de tombamento</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="{{$instrument->institucional_code}}" name="institucional_code" placeholder="Número de tombamento">
      </div>
    </div>
    <div class="form-group">
        <label>Tipo de instrumento</label>
        <select class="form-control" name="instrument_model" id="instrument_model">
            @foreach ($instrument_models as $model)
                <option value="{{$model->id}}" {{ $model->id == $instrument->instrument_model_id ? 'selected' : '' }}>{{$model->model}}</option>
            @endforeach
        </select>
      </div>   
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-enter">Salvar</button>
      </div>
    </div>
</form>
@if ($delete_condicion)
    <div class="form-group row">
        <div class="col-sm-10">
            <form method="POST" action="{{route('instruments.delete',['id'=>$instrument->id])}}">
                @csrf
                <button class="btn btn-enter">Deletar</button>
            </form>
        </div>
    </div>
@endif

@endsection
@section('footer')

@endsection