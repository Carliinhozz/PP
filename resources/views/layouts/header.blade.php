
  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{url('/')}}" class="align-items-center">

        <img src="assets/img/Logo.png" alt="Logo" class="p-2 mt-2 w-25">
      </a>
      <nav id="navbar" class="navbar">
      <ul>
        <li><a href="{{url('/')}}" class="{{ Request::is('/') ? 'active' : '' }}">Página inicial</a></li>
        @if (Auth::check())
          <li><a href="{{url('/fazeragendamento')}}" class="{{ Request::is('fazeragendamento') ? 'active' : '' }}">Fazer Agendamento</a></li>
          <li><a href="{{route('music.index')}}" class="{{ Request::is('pedirmusica') ? 'active' : '' }}">Pedir Música</a></li>
          <li><a href="{{route('playlist.index')}}">Editar playlist</a></li>
          <li><a href="{{url('/perfil')}}" class="{{ Request::is('perfil') ? 'active' : '' }}">Perfil</a></li>
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