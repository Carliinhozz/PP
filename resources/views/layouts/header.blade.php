<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="{{url('/')}}" class="align-items-center">
            <img src="assets/img/Logo.png" alt="Logo" class="p-2 mt-2 w-25">
        </a>
        <nav id="navbar" class="navbar">
            <ul>
            <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Página inicial</a></li>
                @if (Auth::check())
                    <li><a href="{{ url('/fazeragendamento') }}" class="{{ Request::is('fazeragendamento') ? 'active' : '' }}">Fazer Agendamento</a></li>
                    <li><a href="{{ url('/musicas') }}" class="{{ Request::is('musicas') ? 'active' : '' }}">Pedir Música</a></li>
                    <li><a href="{{ route('playlist.index') }}" class="{{ Request::is('playlist') ? 'active' : '' }}">Editar playlist</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('perfil') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                            @auth {{ auth()->user()->name }} @endauth
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #534881;">
                            <a class="dropdown-item" href="{{ url('/perfil') }}" style="color: white;">Dados do Usuário</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item" style="color: white;">Sair</button>
                            </form>
                        </div>
                    </li>
                @else
                    <li><a href="{{url('/quadros')}}" class="{{ Request::is('quadros') ? 'active' : '' }}">Quadros</a></li>
                    <li><a href="{{url('/sobre')}}" class="{{ Request::is('sobre') ? 'active' : '' }}">Sobre nós</a></li>
                    <li><a class="btn btn-enter w-auto p-lg-2" role="button" href="{{url('login')}}">Entrar</a></li>
                @endif
            </ul>
        </nav>
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
</header>