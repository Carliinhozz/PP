<header id="header" class="header d-flex align-items-center">
{{-- 
  TODO: classe header com problema 
  TODO: verificar tamanho da imagem
  --}}
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{url('/')}}" class="align-items-center">

        <img src="assets/img/Logo.png" alt="Logo" class="p-2 mt-2 w-25">
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{url('/')}}">Página inicial</a></li>
          <li><a href="{{url('/quadros')}}">Quadros</a></li>
          <li><a href="{{url('/sobre')}}">Sobre nós</a></li>
          @if (Auth::check())
            <li><a href="{{url('/perfil')}}">Perfil</a></li>
          @else
            <li><a class="btn btn-enter w-auto p-lg-2" role="button" href="{{url('login')}}">Entrar</a></li>
          @endif
          
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
  <!-- End Header -->