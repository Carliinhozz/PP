@extends('layouts.default')
@section('title')
    Perfil
@endsection
@section('main')
    <div class="container pt-5">
        <div class="row no-gutters">
            <div id="container1" class="col-md-4">
                <div id="profile" class="d-flex flex-column align-items-center">
                    <img src="assets/img/user.png" alt="Foto do Perfil">
                    <h3 class="text-light">@auth {{ auth()->user()->name }} @endauth</h3>
                    <div class="container row justify-content-start gap-5 mt-4">
                        <a href="#dados" class="text-left text-light col-12 op-perfil" onclick="showContent('dados')">Dados pessoais</a>
                        <a href="#pedidos" class="text-left text-light col-12 op-perfil" onclick="showContent('pedidos')">Seus pedidos</a>
                        <a href="#agendamentos" class="text-left text-light col-12 op-perfil" onclick="showContent('agendamentos')">Seus agendamentos</a>
                        <a href="#ficha-instrumentos" class="text-left text-light col-12 mb-4 op-perfil" onclick="showContent('ficha-instrumentos')">Ficha de Instrumentos</a>
                    </div>
                </div>
            </div>
            <div id="container2" class="col-md-8 text-light">
                <div id="content-dados" class="container mt-4 content active">
                    <div class="perfil-title">
                        <h3>Dados pessoais:</h3>
                    </div>
                    <h4 class="perfil-descricao mt-4">Email:</h4>
                    <p class="perfil-info">{{ Auth::user()->email_ifrn }}</p>
                    <h4 class="perfil-descricao">Matrícula:</h4>
                    <p class="perfil-info">{{ Auth::user()->registration }}</p>
                    <h4 class="perfil-descricao">Tipo de usuário:</h4>
                    <p class="perfil-info">{{ Auth::user()->role }}</p>
                </div>
                <div id="content-pedidos" class="content">
                    <div class="perfil-title mt-4">
                        <h3>Seus Pedidos:</h3>
                    </div>
                    <div class="pedido-list">
                        <ol>
                            @if ($musics->isNotEmpty())
                                @foreach ($musics as $music)
                                    <li>
                                        <div><b>{{$music->title}}</b></div>
                                        <p>{{$music->artist}}</p>
                                    </li>
                                @endforeach
                        </ol>
                        @else
                            <p>Sem pedidos</p>
                        @endif
                    </div>
                </div>
                <div id="content-agendamentos" class="content">
                    <div class="perfil-title mt-4">
                        <h3>Seus Agendamentos:</h3>
                    </div>
                    <div class="agendamento-list">
                        @if ($borrows->isNotEmpty())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Instrumento</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrows as $borrow)
                                    <tr>
                                    <td>{{ \Carbon\Carbon::parse($borrow->day)->format('d-m-Y') }}</td>
                                    <td>{{ $borrow->time }}</td>
                                    <td>
                                        @foreach ($borrow->instruments as $instrument)
                                            {{ $instrument->name }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach

                                        <form action="{{ route('borrow.delete', ['id' => $borrow->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Cancelar</button>
                                        </form>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Sem agendamentos</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
                </div>
                <div id="content-ficha-instrumentos" class="content">
                    <div class="perfil-title mt-4">
                        <h3>Ficha de Instrumentos:</h3>
                    </div>
                    <div class="row gap-3 mt-3">
                        <div class="form-group col-4">
                            <label for="tipo-instrumento">Tipo de Instrumento:</label>
                            <select class="form-control" name="instrument_model" id="instrument_model">
                                @foreach ($instrument_models as $model)
                                    <option value="{{ $model->id }}">{{ $model->model }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4 mr-2">
                            <label for="instrumento">Instrumento:</label>
                            <select class="form-control" name="instrumento" id="instrumento">
                                
                            </select>
                        </div>
                        <div class="col-3 d-flex flex-column justify-content-end align-items-center"><button class="btn-instrumento">Buscar</button></div>
                    </div>
                    <div class="box-instrumento mt-5">
                        <div class="info-instrumento">
                            <h4>Guitarra</h4>
                                <div class="row gap-3">
                                    <div class="col-3">
                                        <label for="status">Status:</label>
                                        <select class="form-control" name="status" id="status">
                                        <option value="1">Disponível</option>
                                        <option value="0">Indisponível</option>
                                        </select>
                                    </div>
                                <div class="col-8">
                                    <label for="descrition">Descrição:</label>
                                    <!-- <input type="text" name="descrition" class="form-control" placeholder="Digite a descrição"> -->
                                    <textarea name="" id="descrition" name="descrition" class="form-control" placeholder="Digite a descrição" rows="1"></textarea>
                                </div>
                                <div class="col-12 mt-5 d-flex flex-column justify-content-end align-content-end">
                                    <button class="btn-save">Salvar</button>
                                </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const contents = document.querySelectorAll('.content');
            const hash = window.location.hash.substring(1);

            contents.forEach((content) => {
                content.classList.remove('active');
            });

            if (hash) {
                const targetContent = document.getElementById(`content-${hash}`);
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            } else {
                const defaultContent = document.getElementById('content-dados');
                if (defaultContent) {
                    defaultContent.classList.add('active');
                }
            }
        });

        function showContent(contentId) {
            const contents = document.querySelectorAll('.content');
            contents.forEach((content) => {
                content.classList.remove('active');
            });

            const targetContent = document.getElementById(`content-${contentId}`);
            if (targetContent) {
                targetContent.classList.add('active');
                window.location.hash = contentId;
            }
        }
        
    </script>

@endsection