<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ADMESYS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/38a763211a.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark shadow-sm">
            <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#offcanvas" role="button" aria-controls="offcanvas">
              <span class="navbar-toggler-icon"></span>
            </a>
            <a class="navbar-brand me-auto ms-3" href="{{ url('/') }}">
                {{ config('app.name', 'ADMESYS') }}
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container ms-5">
                <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="{{url('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="">Ventas</a>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Trabajos
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{url('trabajo/nuevo')}}">Nuevo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{url('trabajo/listado')}}">Listado de Proyectos</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                          </ul>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            RRHH
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="">Usuarios</a></li>
                            <li><hr class="dropdown-divider"></li>
                            {{-- <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                          </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
       
            
        

        {{-- <div class="offcanvas offcanvas-start offcanvas-backdrop position-absolute sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel"> --}}
    <!-- Authentication Links -->

        <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="offcanvas">
            <div class="offcanvas-body p-0">
                <nav class="navbar-dark">
                    
                    <ul class="navbar-nav">
                        <li>
                            <a class="nav-link text-dark" href="{{route('home')}}">
                                <span class="mx-2"><i class="fa-solid fa-gauge"></i></span>
                                <span>PANEL</span></a>
                        </li>
                        <li><hr class="divider"></li>
                        <li class="nav-item dropdown ">
                            
                            
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapseTrabajo" role="button" aria-expanded="false" aria-controls="collapseTrabajo">
                            <span class="mx-2"><i class="fa-solid fa-clipboard mx-2"></i></span>
                            <span>TRABAJOS</span>                         </a>
                        
                        <div class="collapse" id="collapseTrabajo">
                          <div class="ms-4 mt-2">
                            Opciones de flujo de trabajo
                          </div>
                        </div>
                        </li>
                      <li><hr class="divider"></li>
                      <li>
                        <a class="nav-link" href="">USUARIO</a>
                      </li>
                    </ul>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{url('proyectos')}}">Nuevo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                          </ul>
                </nav>    
            </div>  

            <div class="dropdown mt-3">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                Dropdown button
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div>
          
        </div>
 
        <main class="py-4 position-relative top56">
            @yield('content')
        </main>
        
    </div>
</body>
</html>
