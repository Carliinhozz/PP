@extends('layouts.default')
@section('title')
    Editar observação
@endsection
@section('main')
    <form action="{{route('borrow.update', ['id' => $borrow->id])}}" method="post" class="p-5">
        @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Aluno</label>
                <input class="form-control" type="text" value="{{$user->name}}" aria-label="readonly input example" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Instrumentos</label>
                <input class="form-control" type="text" value="@foreach ($borrow->instruments as $instrument)
                {{$instrument->name}}@endforeach" aria-label="readonly input example" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1"  class="form-label">Observação</label>
                <input class="form-control" 
                @if($borrow->observations != null)
                    value="{{$borrow->observations}}"
                @endif
                name="observations" type="text">

            </div>
            <button class="btn btn-enter">Salvar</button>
    </form>
@endsection
@section('footer')
    
@endsection