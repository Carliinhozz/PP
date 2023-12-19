@extends('layouts.default')

@section('title')
    Perfil
@endsection

@section('main')
    <div class="container-fluid" style="padding-top: 80px;"> <!-- Ajuste o valor conforme necessário -->
        <div class="row">
            <div class="col col-4">
                <!-- Seção com opções do perfil -->
                <div class="row w-100">
                    <div class="col">
                        Foto
                    </div>
                </div>
                <div class="row w-100">
                    <div class="col">
                        Dados pessoais
                    </div>
                </div>
                <div class="row w-100">
                    <div class="col">
                        Seus pedidos
                    </div>
                </div>
                <div class="row w-100">
                    <div class="col">
                        Seus agendamentos
                    </div>
                </div>
            </div>
            <div class="col col-8 justify-content-center">
                <!-- Seção de dados pessoais do usuário -->
                <div class="row">
                    <span>Dados pessoais:</span>
                </div>
                <div class="row">
                    <span>{{ Auth::user()->email_ifrn }}</span>
                </div>
                <div class="row">
                    <span>{{ Auth::user()->role }}</span>
                </div>
                <div class="row">
                    <span>{{ Auth::user()->registration }}</span>
                </div>

                <!-- Adicionar botão de logout se o usuário estiver autenticado -->
                @if (Auth::check())
                    <div class="row mt-3">
                        <form action="{{ url('/logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection