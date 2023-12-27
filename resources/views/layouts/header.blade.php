
@if (Auth::check())
  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{url('/')}}" class="align-items-center">

        <img src="assets/img/Logo.png" alt="Logo" class="p-2 mt-2 w-25">
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{url('/')}}">Página inicial</a></li>
          <li><a href="{{url('/agendamentos')}}">Agendamentos</a></li>
          <li><a href="{{route('music.index')}}">Pedir música</a></li>
          <li><a href="{{route('playlist.index')}}">Editar playlist</a></li>
          <li><a href="{{url('/perfil')}}">Perfil</a></li>
          
          
          {{-- <li><a href="#team">Team</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li> --}}
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header>
@else
  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{url('/')}}" class="align-items-center">

        <img src="assets/img/Logo.png" alt="Logo" class="p-2 mt-2 w-25">
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{url('/')}}">Página inicial</a></li>
          <li><a href="{{url('/quadros')}}">Quadros</a></li>
          <li><a href="{{url('/sobre')}}">Sobre nós</a></li>
      
          <li><a class="btn btn-enter w-auto p-lg-2" role="button" href="{{url('login')}}">Entrar</a></li>
          
          
          {{-- <li><a href="#team">Team</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li> --}}
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header>
@endif


  <!-- End Header -->
<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
      <a href="{{url('/')}}">
        <img src="assets/img/Logo.png" alt="Logo" class="p-2 mt-2 w-25">
      </a>
      @if (Auth::check())
        <span class="text-white mx-2">{{ Auth::user()->name }}</span>
      @endif
    </div>
    <nav id="navbar" class="navbar">
      <ul>
        <li><a href="{{url('/')}}" class="{{ Request::is('/') ? 'active' : '' }}">Página inicial</a></li>
        @if (Auth::check())
          <li><a href="{{url('/fazeragendamento')}}" class="{{ Request::is('fazeragendamento') ? 'active' : '' }}">Fazer Agendamento</a></li>
          <li><a href="{{url('/pedirmusica')}}" class="{{ Request::is('pedirmusica') ? 'active' : '' }}">Pedir Música</a></li>
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
