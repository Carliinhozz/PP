@extends('layouts.default')
@section('title')
    Perfil
@endsection
@section('main')
    <div class="container-fluid " style="padding-top: 80px;">
        <div class="row">
            <div class="col col-4  ">
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
                        Seus agendamenstos
                    </div>
                    
                </div>
            </div>
            <div class="col col-8  justify-content-center">
                <div class="row">
                    <span>Dados pessoais:</span>
                </div>
                <div class="row">
                    <span>{{Auth::user()->email_ifrn}}</span>
                </div>
                <div class="row">
                    <span>{{Auth::user()->role}}</span>
                </div>
                <div class="row">
                    <span>{{Auth::user()->registration}}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
   
@endsection