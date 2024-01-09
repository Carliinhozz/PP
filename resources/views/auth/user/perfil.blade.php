@extends('layouts.default')
@section('title')
    Perfil
@endsection
@section('main')
    <div class="container pt-5">
        <div class="row justify-content-center mb-4">
            <div id="container1" class="col-md-4">
                <div id="profile" class="d-flex flex-column align-items-center">
                <img src="https://suap.ifrn.edu.br/{{ auth()->user()->img }}" onerror="this.src='assets/img/user.png'" alt="Foto do Perfil">
                    <h3 class="text-light">@auth {{ auth()->user()->name }} @endauth</h3>
                    <div class="container row justify-content-start gap-5 mt-2 p-4 nav-perfil">
                        <a href="#dados" class="text-left text-light col-12 b-perfil active" onclick="showContent('dados')">Dados pessoais</a>
                        <a href="#pedidos" class="text-left text-light col-12 b-perfil" onclick="showContent('pedidos')">Seus pedidos</a>
                        <a href="#agendamentos" class="text-left text-light col-12 b-perfil" onclick="showContent('agendamentos')">Seus agendamentos</a>
                        @if (auth()->user()->admin > 0)
                        <a href="#allagendamentos" class="text-left text-light col-12 b-perfil" onclick="showContent('allagendamentos')">Todos os agendamentos</a>
                        @endif
                        @if (auth()->user()->admin == 1)
                        <a href="#ficha-instrumentos" class="text-left text-light col-12 b-perfil" onclick="showContent('ficha-instrumentos')">Ficha de Instrumentos</a>
                        @endif
                    </div>
                </div>
            </div>
            <div id="container2" class="col-md-8 text-light ctn-2">
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
                        @if ($musics->isNotEmpty())
                            <ul>
                                @foreach ($musics as $music)
                                    <li>
                                        <div><p><b>{{ $music->title }}</b> - {{ $music->artist }}</p></div>
                                        <hr>
                                    </li>
                                @endforeach
                            </ul>
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
                @if (auth()->user()->admin > 0)
                <div id="content-allagendamentos" class="content">
                    <div class="perfil-title mt-4">
                        <h3>Todos os Agendamentos:</h3>
                    </div>
                    <div class="agendamento-list">
                        @if (\App\Models\Borrow::all()->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Instrumento</th>
                                        <th>Situação</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Borrow::all() as $borrow)
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
                                            </td>
                                            @if ($borrow->finished == 1)
                                                <td>Finalizado</td>
                                            @elseif ($borrow->finished == 0)
                                                <td>Pendente</td>
                                            @endif
                                            <td>
                                                @if ($borrow->finished == 1)
                                                    <form action="{{ route('borrow.delete', ['id' => $borrow->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Apagar</button>
                                                    </form>
                                                @elseif ($borrow->finished == 0)
                                                    <form action="{{ route('borrow.delete', ['id' => $borrow->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Cancelar</button>
                                                    </form>
                                                @endif
                                                <form action="{{route('borrow.edit', ['id' => $borrow->id])}}" method="get" >
                                                    <button class="btn btn-info ml-2">Editar Observação</button>
                                                </form>
                                                @if ($borrow->observations !== '')
                                                <i class="bi bi-circle-fill text-danger"></i>
                                                @elseif ($borrow->observations == null)
                                                @endif
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
                @else
                @endif
                @if (auth()->user()->admin == 1)
                <div id="content-ficha-instrumentos" class="content">
                    <div class="perfil-title mt-4">
                        <h3>Ficha de Instrumentos:</h3>
                    </div>
                @csrf
                <div class="row gap-3 mt-3">
                    <div class="form-group col-4 mr-2">
                        <label for="instrument">Instrumento:</label>
                        <select class="form-control" name="instrument" id="instrument" onchange="this.form.submit()">
                            @foreach ($instruments as $instrument)
                                <option value="{{ $instrument->id }}" {{ $instrument->id == $instrument->id ? 'selected' : '' }}>{{ $instrument->name }} - {{ $instrument->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                    <div class="box-instrumento mt-5">
                        @if(isset($instrument))
                            <h4 id="instrumentName">{{ $instrument->name }} - {{ $instrument->description }}</h4>
                            <form action="{{ route('instruments.edit', ['id' => $instrument->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="disponibility">Disponibilidade:</label>
                            <select class="form-control" name="disponibility" id="disponibility">
                                <option value="1" {{ $instrument->disponibility == 1 ? 'selected' : '' }}>Disponível</option>
                                <option value="0" {{ $instrument->disponibility == 0 ? 'selected' : '' }}>Indisponível</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição:</label>
                            <textarea name="description" class="form-control">{{ $instrument->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                            </div>
                        @endif
                    </div>
                    @else
                    @endif
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
    };
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#instrument').change(function() {
            var instrumentId = $(this).val();

            $.ajax({
                type: 'POST',
                url: '{{ url('instrumentos/get-details') }}/' + instrumentId,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    $('#instrumentName').text(data.name);
                    $('#disponibility').val(data.disponibility);
                    $('textarea[name="description"]').val(data.description);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<meta name="csrf-token" content="{{ csrf_token() }}">



@endsection