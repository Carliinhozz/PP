@extends('layouts.default')
@section('title')
    Bolsistas
@endsection
@section('main')
    <div class="container-fluid p-5">
        <div class="row justify-content-center">
            <div class="col col-8">
                <form class="row" action="{{route('admin.search')}}" method="post">
                    <div class="input-group mb-3">
                        @csrf
                        <input type="text" class="form-control" placeholder="Matrícula do aluno" aria-label="Recipient's username" name="registration">
                        <button class="btn btn-enter">Button</button>
    
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-start">
            
            @if ($result->isNotEmpty())
                <div class="col-6 col">
                    <label for="formGroupExampleInput" class="form-label">Resultado da busca</label>
                    <ul class="list-group">
                        @foreach ($result as $user)
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <p><b>{{$user->name}}</b></p>
                                    <p>{{$user->registration}}</p>
                                </div>
                                <div class="align-items-end">
                                    @if ($user->admin == 1)
                                    <form action="{{route('admin.delete', ['id'=>$user->id])}}" method="post">
                                        @csrf
                                        <button data-mdb-ripple-init class="btn btn-danger">Desvincular</button>
                                    </form>
                                    @else
                                    <form action="{{route('admin.promote', ['id'=>$user->id])}}" method="post">
                                        @csrf
                                        <button data-mdb-ripple-init class="btn btn-success">Vincular</button>
                                    </form>
                                    @endif
                                    
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="col-6 col">
                    <label for="formGroupExampleInput" class="form-label">Resultado da busca</label>
                    <ul class="list-group">
                        <li class="list-group-item">Sem resultado</li>
                    </ul>
                </div>
            @endif
               
            @if ($admins->isNotEmpty())
             
                <div class="col-6 col">
                    <label for="formGroupExampleInput" class="form-label">Bolsistas</label>
                    <ul class="list-group">
                        @foreach ($admins as $admin)
                            <li class="list-group-item">
                                <div class="ms-2 me-auto">
                                    <p><b>{{$admin->name}}</b></p>
                                    <p>{{$admin->registration}}</p>
                                </div>
                                <div class="align-items-end">
                                    <form action="{{route('admin.delete', ['id'=>$admin->id])}}" method="post">
                                        @csrf
                                        <button data-mdb-ripple-init class="btn btn-danger">Desvincular</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="col-6 col">
                    <label for="formGroupExampleInput" class="form-label">Bolsistas</label>
                    <ul class="list-group">
                        <li class="list-group-item">Sem bolsistas</li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('footer')
    
@endsection