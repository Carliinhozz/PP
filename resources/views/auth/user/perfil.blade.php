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
                        <a href="#dados" class="text-left text-light col-12" onclick="showContent('dados')">Dados pessoais</a>
                        <a href="#pedidos" class="text-left text-light col-12" onclick="showContent('pedidos')">Seus pedidos</a>
                        <a href="#agendamentos" class="text-left text-light col-12" onclick="showContent('agendamentos')">Seus agendamentos</a>
                        <a href="#ficha-instrumentos" class="text-left text-light col-12" onclick="showContent('ficha-instrumentos')">Ficha de Instrumentos</a>
                    </div>
                </div>
            </div>
            <div id="container2" class="col-md-8 text-light" style="background-color: #6B6198;">
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
                    <div class="row">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="tipo-instrumento">Tipo de Instrumento:</label>
                            <select class="form-control" name="instrument_model" id="instrument_model">
                                @foreach ($instrument_models as $model)
                                    <option value="{{ $model->id }}">{{ $model->model }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="instrumento">Instrumento:</label>
                            <select class="form-control" name="instrumento" id="instrumento">
                                
                            </select>
                        </div>
                        <button class="btn btn-primary">Buscar</button>
                    </div>
                    <div style="background-color: #534881; padding: 20px; color: white; margin-top: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h4>Guitarra</h4>
                            <div>
                                <label for="status">Status:</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Disponível</option>
                                    <option value="0">Indisponível</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                        <div>
                            <label for="descrition">Descrição:</label>
                            <input type="text" id="descrition" name="descrition" class="form-control" placeholder="Digite a descrição">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #profile {
            background-color: #534881;
            text-align: left;
            padding: 20px;
            color: white;
            height: 100%;
        }

        #profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        #container2 {
            max-height: calc(100vh - 80px);
            overflow-y: auto;
        }

        .pedido-list {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            color: black;
        }

        .pedido-list ol {
            list-style-type: decimal;
            padding-left: 20px;
        }

        .content {
            display: none;
        }

        .content.active {
            display: block;
        }
    </style>

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