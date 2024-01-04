@extends('layouts.default')

@section('title')
    Instrumentos
@endsection

@section('main')
    <section id="cadastrar-instrumento" class="cadastrar-instrumento">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-in">
                <div class="col-lg-12">
                <h2>Cadastrar Instrumento</h2>
                    <div class="purple-box rounded-3 p-4">
                        <form action="{{ route('instruments.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label text-white">Nome:</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nome" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="instrument_model" class="form-label text-white">Tipo de instrumento:</label>
                                    <select class="form-select" name="instrument_model" id="instrument_model" required>
                                        @foreach ($instrument_models as $model)
                                            <option value="{{ $model->id }}">{{ $model->model }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="institucional_code" class="form-label text-white">Número de tombamento:</label>
                                    <input type="text" class="form-control" name="institucional_code" id="institucional_code" placeholder="Número de tombamento" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="description" class="form-label text-white">Descrição:</label>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Descrição">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-enter">Adicionar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($instruments->isNotEmpty())
        <div class="row justify-content-center">
            <ul class="list-group col-10">
                @foreach ($instruments as $instrument)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        {{ $instrument->description }}
                        <div class="align-items-end">
                            <a href="{{ route('instruments.show',['id'=>$instrument->id]) }}" class="btn btn-enter">Editar</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
