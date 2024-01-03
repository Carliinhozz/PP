@extends('layouts.default')
@section('title')
    Perfil
@endsection
@section('main')
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="row no-gutters">
            <div id="container1" class="col-md-4">
                <div id="profile" class="d-flex flex-column align-items-center">
                    <img src="assets/img/user.png" alt="Foto do Perfil">
                    <h3 style="color: white;">Perfil</h3>
                    <a href="#dados" class="text-left" onclick="showContent('dados')">Dados pessoais</a>
                    <a href="#pedidos" class="text-left" onclick="showContent('pedidos')">Seus pedidos</a>
                    <a href="#agendamentos" class="text-left" onclick="showContent('agendamentos')">Seus agendamentos</a>
                    <a href="#ficha-instrumentos" class="text-left" onclick="showContent('ficha-instrumentos')">Ficha de Instrumentos</a>
                </div>
            </div>
            <div id="container2" class="col-md-8" style="background-color: #6B6198; color: white;">
                <div id="content-dados" class="content active">
                    <h3>Dados pessoais:</h3>
                    <p>{{ Auth::user()->email_ifrn }}</p>
                    <p>{{ Auth::user()->role }}</p>
                    <p>{{ Auth::user()->registration }}</p>
                </div>
                <div id="content-pedidos" class="content">
                    <h3>Seus Pedidos:</h3>
                    <div class="pedido-list">
                        <h4>Janeiro 2024</h4>
                        <ol>
                            <li>Música 1</li>
                            <li>Música 2</li>
                            <li>Música 3</li>
                        </ol>
                    </div>
                </div>
                <div id="content-agendamentos" class="content">
                    <h3>Seus Agendamentos:</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Data e Hora</th>
                                <th>Instrumentos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01/01/2024 10:00 AM</td>
                                <td>Piano</td>
                            </tr>
                            <tr>
                                <td>02/01/2024 02:30 PM</td>
                                <td>Guitarra</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="content-ficha-instrumentos" class="content">
                    <h3>Ficha de Instrumentos:</h3>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="tipo-instrumento">Tipo de Instrumento:</label>
                            <select class="form-control" name="tipo-instrumento" id="tipo-instrumento">
                                <option value="sopro">Sopro</option>
                                <option value="percussao">Percussão</option>
                                <option value="corda">Corda</option>
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
                                    <option value="disponivel">Disponível</option>
                                    <option value="indisponivel">Indisponível</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                        <div>
                            <label for="descricao">Descrição:</label>
                            <input type="text" id="descricao" name="descricao" class="form-control" placeholder="Digite a descrição">
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