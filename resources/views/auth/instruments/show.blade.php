@extends('layouts.default')

@section('title')
    Editar Instrumento
@endsection

@section('main')
    <section id="editar-instrumento" class="editar-instrumento">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-in">
                <div class="col-lg-12">
                    <h2 class="text-black">Editar Instrumento</h2>
                    <div class="purple-box rounded-3 p-4">
                        <form class="p-3" method="POST" action="{{ route('instruments.update', ['id' => $instrument->id]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label text-white">Nome:</label>
                                <input type="text" value="{{ $instrument->name }}" class="form-control" name="name" placeholder="Nome">
                            </div>
                            <div class="mb-3">
                                <label for="instrument_model" class="form-label text-white">Tipo de instrumento:</label>
                                <select class="form-select" name="instrument_model" id="instrument_model">
                                    <option value="1" {{ $instrument->model_id === 1 ? 'selected' : '' }}>Sopro</option>
                                    <option value="2" {{ $instrument->model_id === 2 ? 'selected' : '' }}>Corda</option>
                                    <option value="3" {{ $instrument->model_id === 3 ? 'selected' : '' }}>Percussão</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="institucional_code" class="form-label text-white">Número de tombamento:</label>
                                <input type="text" class="form-control" value="{{ $instrument->institucional_code }}" name="institucional_code" placeholder="Número de tombamento">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label text-white">Descrição:</label>
                                <input type="text" value="{{ $instrument->description }}" class="form-control" name="description" placeholder="Descrição">
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-enter">Salvar</button>
                            </div>
                        </form>

                        @if ($delete_condicion)
                            <form method="POST" action="{{ route('instruments.delete', ['id' => $instrument->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
