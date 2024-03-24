<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@livewireStyles()
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     {{-- <meta http-equiv="refresh" content="30"> --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
    <title>{{ config('app.name', 'ADMESYS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Fonts -->
    <link rel="icon" href="{{ URL::asset('public/favicon.ico') }}" type="image/x-icon"/>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/38a763211a.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @stack('meta')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md vw-100 fixed-top navbar-dark bg-dark shadow-sm">
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
                          <a class="nav-link mx-4 active" aria-current="page" href="{{url('home')}}">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle mx-4 " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Turnos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{route('appointment.index')}}">Calendario</a></li>
                                <li><a class="dropdown-item" href="{{route('agendas.index')}}">Agendas</a></li>

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle mx-4 " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Institución
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="">Buscar</a></li>
                            <li><a class="dropdown-item" href="{{route('institution.show')}}">Usuarios</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{route('institution.room')}}">Habitaciones</a></li>
                            @can('institution.sheets')
                                <li><a class="dropdown-item" href="{{route('institution.sheets')}}">Planillas</a></li>
                            @endcan
                            @can('report.index')
                                <li><a class="dropdown-item" href="{{route('report.index')}}">Reportes</a></li>
                            @endcan
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
                                    {{ ucfirst(Auth::user()->name)." ".ucfirst(Auth::user()->lastName) }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ route('patient.home') }}">Soy Paciente</a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
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
       
            
        


    <!-- SIDE BAR -->

        <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="offcanvas">
            <div class="offcanvas-body p-0">
                <nav class="navbar-dark">
                    
                    <ul class="navbar-nav">
                        <li>
                            <a class="nav-link text-dark" href="{{route('dashboard')}}">
                                <span class="mx-2"><i class="fa-solid fa-gauge"></i></span>
                                <span class="text-primary fw-bold">PANEL</span></a>
                        </li>
                        <li><hr class="divider"></li>
                        <li class="nav-item dropdown ">
                            
                            
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapsePaciente" role="button" aria-expanded="false" aria-controls="collapsePaciente">
                                
                                <span class="text-primary fw-bold ms-2">PACIENTES</span>
                            </a>
                        
                            <div class="collapse" id="collapsePaciente">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('paciente.create')}}"><i class="fa-solid fa-user-plus mx-2"></i>Nuevo Paciente</a>
                                </span>
                            </div>
                            <div class="collapse" id="collapsePaciente">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('paciente.index')}}"><i class="fa-solid fa-list-ul mx-2"></i>Listado de Pacientes</a>
                                </span>
                            </div>
                        </li>
                        <li class="nav-item dropdown mt-4">
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapseAccounts" role="button" aria-expanded="false" aria-controls="collapseAccounts">
                                
                                <span class="text-primary fw-bold mx-2">CAJAS</span>
                            </a>
                            @can('accounts.show')
                                <div class="collapse" id="collapseAccounts">
                                    <span class="ms-2">
                                        <a class="dropdown-item ms-4" href="{{route('accounts.show')}}">
                                            <i class="fa-solid fa-file-circle-plus mx-2"></i>Saldos de caja</a>
                                    </span>
                                </div>
                                {{-- <div class="collapse" id="collapseAccounts">
                                    <span class="ms-2">
                                        <a class="dropdown-item ms-4" href="{{route('notes.show')}}">
                                            <i class="fa-solid fa-list-ul mx-2"></i>Mis notas</a>
                                    </span>
                                </div> --}}
                            @endcan
                        </li>
                        <li><hr class="divider"></li>
                        @can('profession')
                        <li class="nav-item dropdown ">                           
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapseEspecialidad" role="button" aria-expanded="false" aria-controls="collapseUsuario">
                                
                                <span class="text-primary fw-bold mx-2">ESPECIALIDADES</span>
                            </a>
                            @can('profession.add')
                            <div class="collapse" id="collapseEspecialidad">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('profession.index',)}}"><i class="fa-solid fa-graduation-cap mx-2"></i>Agregar Especialidad</a>
                                </span>
                            </div>
                            <div class="collapse" id="collapseEspecialidad">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('registration.list',)}}"><i class="fa-solid fa-id-card mx-2"></i>Mis Matrículas</a>
                                </span>
                            </div>
                            @endcan
                            @can('profession.create')
                            <div class="collapse" id="collapseEspecialidad">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('profession.create')}}"><i class="fa-solid fa-user-plus mx-2"></i>Nueva Especialidad</a>
                                </span>
                            </div>
                            <div class="collapse" id="collapseEspecialidad">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('profession.list')}}"><i class="fa-solid fa-list-ul mx-2"></i>Listado de Especialidades</a>
                                </span>
                            </div>
                            @endcan
                            @can('entity.create')
                            <div class="collapse" id="collapseEspecialidad">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('entity.create')}}"><i class="fa-regular fa-building mx-2"></i>Entidades</a>
                                </span>
                            </div>
                            @endcan
                        </li>
                        
                        <li><hr class="divider"></li>
                        @endcan
                        @can('user')
                        <li class="nav-item dropdown ">                           
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapseUsuario" role="button" aria-expanded="false" aria-controls="collapseUsuario">
                                <span class="text-primary fw-bold mx-2">USUARIOS</span>
                            </a>
                        
                            <div class="collapse" id="collapseUsuario">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('user.create')}}"><i class="fa-solid fa-user-plus mx-2"></i>Nuevo Usuario</a>
                                </span>
                            </div>
                            <div class="collapse" id="collapseUsuario">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('user.index')}}"><i class="fa-solid fa-list-ul mx-2"></i>Listado de Usuarios</a>
                                </span>
                            </div>
                            
                        </li>
                        <li><hr class="divider"></li>
                        @endcan
                        
                        @can('institution.index')

                        <li class="nav-item dropdown ">                           
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapseInstitution" role="button" aria-expanded="false" aria-controls="collapseUsuario">
                                
                            <span class="text-primary fw-bold mx-2">INSTITUCIONES</span>
                            </a>
                            {{-- @can('profession.add') --}}
                            <div class="collapse" id="collapseInstitution">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('institution.index',)}}"><i class="fa-solid fa-hospital mx-2"></i>Listado</a>
                                </span>

                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('institution.create',)}}"><i class="fa-solid fa-plus mx-2"></i>Nueva Institución</a>
                                </span>
                        </div>

                        </li>
                        <li><hr class="divider"></li>
                        @endcan
                        
                        @can('role.index')
                        <li class="nav-item dropdown ">                           
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapseRoles" role="button" aria-expanded="false" aria-controls="collapseRoles">
                                
                                <span class="text-primary fw-bold mx-2">PERMISOS</span>
                            </a>
                        
                            <div class="collapse" id="collapseRoles">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('role.index')}}"><i class="fa-solid fa-user-lock mx-2"></i>Roles</a>
                                </span>
                            </div>
                            <div class="collapse" id="collapseRoles">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('permission.create')}}"><i class="fa-solid fa-lock mx-2"></i>Nuevo Permiso</a>
                                </span>
                            </div>
                        </li>
                        <li><hr class="divider"></li>
                        @endcan
                        
                        @can('sheet.index')
                        <li class="nav-item dropdown ">                           
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapsePlanillas" role="button" aria-expanded="false" aria-controls="collapsePlanillas">
                                
                                <span class="text-primary fw-bold mx-2">PLANILLAS</span>
                            </a>
                        
                            <div class="collapse" id="collapsePlanillas">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('sheet.index')}}">
                                        
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table mx-1" viewBox="0 0 16 16">
                                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z"/>
                                        </svg>
                                        Nueva Planilla
                                    </a>
                                </span>
                            </div>
                            <div class="collapse" id="collapsePlanillas">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('permission.create')}}"><i class="fa-solid fa-lock mx-2"></i>Nuevo Permiso</a>
                                </span>
                            </div>
                        </li>
                        <li><hr class="divider"></li>
                        @endcan
                        @can('services.index')
                        <li class="nav-item dropdown ">                           
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapseServices" role="button" aria-expanded="false" aria-controls="collapseServices">
                                
                                <span class="text-primary fw-bold mx-2">SERVICIOS</span>
                            </a>
                        
                            <div class="collapse" id="collapseServices">
                                <span class="ms-2">
                                    <a class="dropdown-item ms-4" href="{{route('services.new')}}">
                                        
                                        
                                    <svg 
                                    xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-table mx-1" viewBox="0 0 122.88 108.82">
                                        <path d="M3.1,56.47H21.3a3.11,3.11,0,0,1,3.1,3.1v37.2a3.11,3.11,0,0,1-3.1,3.1H3.1A3.11,3.11,0,0,1,0,
                                            96.77V59.57a3.11,3.11,0,0,1,3.1-3.1ZM28.42,96.23V60H47.77c6.92,1.24,13.84,5,20.75,9.35H81.2c5.73.34,8.74,6.16,
                                            3.17,10-4.45,3.26-10.31,3.07-16.32,2.54-4.15-.21-4.33,5.36,0,5.38,1.5.12,3.13-.23,4.56-.24,7.5,0,13.68-1.44,
                                            17.46-7.36L92,75.16l18.85-9.35c9.44-3.1,16.14,6.77,9.19,13.63a247,247,0,0,1-42,24.71c-10.4,6.33-20.81,6.11-31.21,
                                            0l-18.4-7.92ZM62,7.65a1.15,1.15,0,0,0-.39-.21.72.72,0,0,0-.32,0,1.11,1.11,0,0,0-.73.38l-2.53,3a1.53,1.53,0,0,
                                            1-1.9.37c-.34-.18-.7-.35-1.06-.5s-.79-.31-1.17-.44-.77-.24-1.22-.37-.83-.23-1.22-.32A1.54,1.54,0,0,1,50.3,
                                            8.12L49.92,4a1.29,1.29,0,0,0-.12-.42,1.22,1.22,0,0,0-.23-.29.72.72,0,0,0-.32-.17.92.92,0,0,0-.41,0l-5.31.52a1.42,
                                            1.42,0,0,0-.41.12,1.17,1.17,0,0,0-.34.28,1.08,1.08,0,0,0-.18.33v0a.89.89,0,0,0,0,.33l.37,3.89a1.54,1.54,0,0,1-1.12,
                                            1.63c-.32.11-.68.24-1.09.41s-.76.34-1.08.51l-.06,0c-.34.18-.7.37-1,.57l-.1,0c-.34.2-.67.41-1,.62a1.55,1.55,0,0,
                                            1-1.82-.08L32.24,9.57a1.28,1.28,0,0,0-.35-.2.69.69,0,0,0-.3,0,1.31,1.31,0,0,0-.41.13l-.06,0a1.34,1.34,0,0,
                                            0-.25.23L27.52,13.8a1.3,1.3,0,0,0-.23.41.87.87,0,0,0,0,.32v.07a.9.9,0,0,0,.1.34l0,.05a1.16,1.16,0,0,0,.24.26l3,
                                            2.53A1.52,1.52,0,0,1,31,19.69a11.4,11.4,0,0,0-.49,1,12.37,12.37,0,0,0-.44,1.17c-.12.37-.25.77-.38,1.22s-.23.84-.32,
                                            1.22A1.53,1.53,0,0,1,28,25.54l-4.13.38a1.23,1.23,0,0,0-.41.12,1.13,1.13,0,0,0-.3.24.9.9,0,0,0-.17.32,1,1,0,0,0,0,
                                            .4l.52,5.31a1.22,1.22,0,0,0,.12.42,1.11,1.11,0,0,0,.27.34,1.35,1.35,0,0,0,.33.18,1.09,1.09,0,0,0,.37,0l3.89-.37A1.53,
                                            1.53,0,0,1,30.06,34c.11.32.25.69.42,1.09s.33.75.51,1.09l.07.14c.16.31.34.65.54,1l.67,1.1a1.55,1.55,0,0,1-.1,1.8L29.4,
                                            43.63a1.5,1.5,0,0,0-.18.32.9.9,0,0,0,0,.29,1.16,1.16,0,0,0,.12.42,1,1,0,0,0,.26.31c1.38,1.15,2.8,2.28,4.17,3.44a1.05,
                                            1.05,0,0,0,.3.15.94.94,0,0,0,.38,0h0a1.42,1.42,0,0,0,.44-.12l.05,0a2.47,2.47,0,0,0,.27-.21l2.5-3a1.53,1.53,0,0,1,
                                            1.91-.38,11.47,11.47,0,0,0,1.06.5c.39.17.78.31,1.17.44s.76.25,1.22.38.83.23,1.22.32a1.53,1.53,0,0,1,1.19,1.44L45.86,
                                            52a1.1,1.1,0,0,0,.13.41.93.93,0,0,0,.23.3,1.11,1.11,0,0,0,.32.17,1.09,1.09,0,0,0,.41,0l5.3-.52a1.28,1.28,0,0,0,
                                            .43-.12l0,0A1.24,1.24,0,0,0,53,52a1.28,1.28,0,0,0,.21-.37.72.72,0,0,0,0-.36l-.36-3.9a1.53,1.53,0,0,1,
                                            1-1.6c.39-.13.78-.28,1.16-.44l.12,0c.32-.14.64-.3,1-.48l.06,0c.38-.19.75-.39,1.08-.59l1.11-.67a1.52,1.52,0,0,1,
                                            1.79.11l3.38,2.76a1.35,1.35,0,0,0,.33.18h0a.69.69,0,0,0,.32,0,1,1,0,0,0,.41-.11,1.22,1.22,0,0,0,.3-.27c1.15-1.38,
                                            2.28-2.8,3.44-4.17a.89.89,0,0,0,.15-.29,1.15,1.15,0,0,0,0-.38v0a1.5,1.5,0,0,0-.12-.44,1.21,1.21,0,0,
                                            0-.25-.32l-3-2.44a1.52,1.52,0,0,1-.39-1.92,11.47,11.47,0,0,0,.5-1.06c.17-.41.32-.8.44-1.16s.24-.78.37-1.23.23-
                                            .82.32-1.22a1.53,1.53,0,0,1,1.47-1.19L72,30a1.29,1.29,0,0,0,.42-.12,1.54,1.54,0,0,0,.29-.23,1.11,1.11,0,0,0,.17-
                                            .32v0a1.13,1.13,0,0,0,0-.38l-.52-5.3a1.31,1.31,0,0,0-.12-.41l0-.06a1.26,1.26,0,0,0-.25-.28,1.08,1.08,0,0,0-.33-
                                            .18h0a.89.89,0,0,0-.33,0L67.4,23a1.55,1.55,0,0,1-1.6-1c-.13-.37-.27-.76-.45-1.16s-.35-.82-.52-1.15l0-.07a11.26,
                                            11.26,0,0,0-.56-1c-.2-.34-.43-.68-.66-1a1.54,1.54,0,0,1,.09-1.85l2.74-3.39a1.15,1.15,0,0,0,.2-.35.67.67,0,0,0,0-
                                            .29,1.38,1.38,0,0,0-.13-.42l0-.07a1.17,1.17,0,0,0-.21-.24L62.55,7.93A1.46,1.46,0,0,1,62,7.65Zm41.38,24.6a1.54,
                                            1.54,0,0,0-1.15-.36,1.62,1.62,0,0,0-1.06.57l-1.53,1.85a10.69,10.69,0,0,0-1.51-.64c-.54-.17-1-.32-1.58-.45l-.24-
                                            2.58a1.57,1.57,0,0,0-.55-1.06,1.45,1.45,0,0,0-1.14-.33l-3.26.32a1.61,1.61,0,0,0-1,.54A1.51,1.51,0,0,0,90,31.26l.22,
                                            2.37a9.37,9.37,0,0,0-1.53.65,11.4,11.4,0,0,0-1.4.82l-2.06-1.66a1.42,1.42,0,0,0-1.12-.37,1.6,1.6,0,0,0-1.06.58l-2,
                                            2.49a1.55,1.55,0,0,0,.21,2.21L83,39.88a9.6,9.6,0,0,0-.63,1.51c-.18.54-.33,1-.46,1.58l-2.58.24a1.6,1.6,0,0,0-
                                            1.06.55A1.46,1.46,0,0,0,78,44.91l.32,3.25a1.58,1.58,0,0,0,.55,1.05,1.47,1.47,0,0,0,1.14.36l2.37-.22A9.79,9.79,0,
                                            0,0,83,50.87a15.71,15.71,0,0,0,.82,1.44l-1.66,2a1.41,1.41,0,0,0-.36,1.12,1.58,1.58,0,0,0,.57,1L84.9,58.6a1.5,1.5,
                                            0,0,0,1.15.33,1.68,1.68,0,0,0,1.08-.54l1.54-1.88a9.25,9.25,0,0,0,1.51.64,14.89,14.89,0,0,0,1.58.45L92,60.19a1.61,
                                            1.61,0,0,0,.55,1.05,1.49,1.49,0,0,0,1.15.34l3.25-.32A1.62,1.62,0,0,0,98,60.71a1.51,1.51,0,0,0,.36-1.15l-.23-
                                            2.37a8.69,8.69,0,0,0,1.53-.65,14.52,14.52,0,0,0,1.43-.81l2,1.66a1.51,1.51,0,0,0,1.15.36,1.54,1.54,0,0,0,
                                            1.06-.57l2.08-2.52a1.53,1.53,0,0,0,.34-1.15,1.64,1.64,0,0,0-.55-1.08l-1.88-1.52A8.9,8.9,0,0,0,106,49.4a15.43,
                                            15.43,0,0,0,.45-1.57l2.59-.24a1.57,1.57,0,0,0,1-.55,1.48,1.48,0,0,0,.34-1.15l-.32-3.25a1.62,1.62,0,0,0-.55-1,
                                            1.51,1.51,0,0,0-1.15-.37l-2.37.23a11.13,11.13,0,0,0-.65-1.53,8.72,8.72,0,0,0-.82-1.4l1.67-2.06a1.46,1.46,0,0,0,
                                            .36-1.12,1.62,1.62,0,0,0-.57-1.06l-2.5-2.05-.08,0ZM93.5,39.08a6.73,6.73,0,0,1,2.52.25,6.58,6.58,0,0,1,2.15,1.16,
                                            6.36,6.36,0,0,1,1.55,1.89,6,6,0,0,1,.72,2.41,6.71,6.71,0,0,1-.25,2.52,6.21,6.21,0,0,1-3,3.71,6.17,6.17,0,0,
                                            1-2.41.71,6.51,6.51,0,0,1-2.52-.25,6.61,6.61,0,0,1-2.16-1.15,6.53,6.53,0,0,1-1.54-1.9A5.92,5.92,0,0,1,87.79,
                                            46a6.28,6.28,0,0,1,3.3-6.22,5.92,5.92,0,0,1,2.41-.72ZM62.56,4.5a4.64,4.64,0,0,1,1,.45,1.48,1.48,0,0,1,.6.3L68.19,
                                            8.6a4.19,4.19,0,0,1,.94,1.09l.08.13a4.23,4.23,0,0,1,.48,1.52A3.72,3.72,0,0,1,69.52,13a4.19,4.19,0,0,1-.71,
                                            1.29l-2.06,2.56.13.21a13.49,13.49,0,0,1,.71,1.36q.36.7.6,1.29l.08.2,2.7-.26a3.85,3.85,0,0,1,1.56.14l.08,0a4.19,
                                            4.19,0,0,1,1.28.69l.14.12a4.18,4.18,0,0,1,.89,1.1l.08.13a4.2,4.2,0,0,1,.43,1.45c0,1.34.34,3.94.52,5.34a4,4,0,0,
                                            1-.11,1.51l0,.09a4,4,0,0,1-.75,1.41l0,0a4.06,4.06,0,0,1-1.19,1,4.42,4.42,0,0,1-1.52.46l-3.18.28-.08.29c-.11.4-
                                            .25.85-.43,1.36s-.33,1-.5,1.37l-.08.17,2.19,1.77a4.14,4.14,0,0,1,1,1.29A4.28,4.28,0,0,1,71.62,41v.05a3.93,3.93,
                                            0,0,1-.13,1.6A4.14,4.14,0,0,1,70.82,44l-3.49,4.22a4,4,0,0,1-1.21,1,3.92,3.92,0,0,1-1.53.48A4.07,4.07,0,0,1,63,
                                            49.57l-.08,0a4.29,4.29,0,0,1-1.26-.68l-2.59-2.11-.26.15c-.44.26-.87.49-1.28.69s-.76.38-1.17.56L56,48.3,56.28,
                                            51a3.91,3.91,0,0,1-.17,1.65A4.26,4.26,0,0,1,55.35,54l-.06.06a4.39,4.39,0,0,1-1.13.91l-.1,0a4.28,4.28,0,0,
                                            1-1.44.43c-1.34,0-3.94.35-5.34.53a4.23,4.23,0,0,1-1.6-.13,4,4,0,0,1-1.41-.76l-.05,0a4.38,4.38,0,0,1-.95-1.2,
                                            4.15,4.15,0,0,1-.46-1.52l-.29-3.17-.28-.08-1.36-.43c-.48-.16-1-.33-1.37-.51l-.19-.08-1.8,2.19a4,4,0,0,1-1.17.91l-
                                            .11.07a4.6,4.6,0,0,1-1.39.4H34.8a4,4,0,0,1-1.61-.13,4.2,4.2,0,0,1-1.33-.68l-4.23-3.49a4.12,4.12,0,0,1-1-1.21,4.17,
                                            4.17,0,0,1-.48-1.51A3.6,3.6,0,0,1,26.32,43,4,4,0,0,1,27,41.73l2.11-2.59L29,38.89c-.22-.37-.43-.77-.64-1.19l0,
                                            0c-.25-.46-.46-.9-.65-1.35l-.09-.23-2.68.25a3.87,3.87,0,0,1-1.64-.16,4,4,0,0,1-1.28-.7l-.15-.11a4.36,4.36,0,0,
                                            1-1-1.25,4.21,4.21,0,0,1-.43-1.44c0-1.35-.35-3.91-.53-5.33A4.1,4.1,0,0,1,20,25.73a4,4,0,0,1,.76-1.41l0,0a4.42,
                                            4.42,0,0,1,1.2-1,4.15,4.15,0,0,1,1.52-.45l3.17-.29.08-.29c.12-.39.26-.85.43-1.35s.34-1,.51-1.38l.08-.19L25.7,
                                            17.63a4.22,4.22,0,0,1-1-1.11l-.06-.1A3.92,3.92,0,0,1,24.22,15l0-.08a4,4,0,0,1,.16-1.61,4.18,4.18,0,0,1,
                                            .78-1.41l3.35-4.09a3.92,3.92,0,0,1,1.1-.93l.12-.08a4,4,0,0,1,1.52-.48,3.59,3.59,0,0,1,1.63.17,4.28,4.28,0,0,1,
                                            1.29.71l2.57,2.07L37,9.07c.41-.24.83-.46,1.25-.67s.88-.44,1.29-.62l.24-.09L39.51,5a3.85,3.85,0,0,1,.14-1.56l0-
                                            .08a4.19,4.19,0,0,1,.69-1.28L40.49,2a4.28,4.28,0,0,1,1.23-1A4.13,4.13,0,0,1,43.17.55c1.34,0,3.94-.34,5.34-.52a4,
                                            4,0,0,1,1.6.13,4,4,0,0,1,1.41.75l0,0a4.34,4.34,0,0,1,1,1.19A4.42,4.42,0,0,1,53,3.66l.28,3.18.29.08c.39.11.85.25,
                                            1.36.42l1.37.51.2.09,1.73-2.09a4.08,4.08,0,0,1,1.22-1A4.15,4.15,0,0,1,61,4.35a3.77,3.77,0,0,1,1.61.15ZM46.71,
                                            16.11a13.72,13.72,0,0,1,2.31,0,12.18,12.18,0,0,1,2.36.47h0a12.34,12.34,0,0,1,2.12.89l.09.05a12.59,12.59,0,0,1,
                                            1.8,1.21l0,0a12.48,12.48,0,0,1,2.89,3.55,10.57,10.57,0,0,1,.92,2.19,10.93,10.93,0,0,1,.44,2.36v0a12.65,12.65,0,
                                            0,1,0,2.3,11.2,11.2,0,0,1-.46,2.36l0,.1a12.25,12.25,0,0,1-.86,2,13.25,13.25,0,0,1-1.25,1.9l-.1.11a12.2,12.2,0,0,
                                            1-3.47,2.81,11.49,11.49,0,0,1-2.2.92,12.34,12.34,0,0,1-2.35.44,14.2,14.2,0,0,1-2.35,0,12,12,0,0,1-2.36-.47h0a12.58,
                                            12.58,0,0,1-2.11-.89,13.6,13.6,0,0,1-1.9-1.26l0,0a12.25,12.25,0,0,1-1.6-1.62,13.21,13.21,0,0,1-1.3-1.92,11.35,11.35,
                                            0,0,1-.91-2.2,10.93,10.93,0,0,1-.44-2.36v0a12.65,12.65,0,0,1,0-2.3,11.2,11.2,0,0,1,.46-2.36h0a12,12,0,0,1,.89-
                                            2.12l.05-.09a11.65,11.65,0,0,1,1.21-1.81l.08-.1a11.28,11.28,0,0,1,1.56-1.53,13.15,13.15,0,0,1,1.92-1.29,11.3,11.3,
                                            0,0,1,2.19-.92,12.59,12.59,0,0,1,2.36-.44Zm2,3.07a9.62,9.62,0,0,0-1.78,0h0a8.82,8.82,0,0,0-1.73.32,8.2,8.2,0,0,
                                            0-1.59.66,10.44,10.44,0,0,0-1.47,1A9.3,9.3,0,0,0,41,22.26l0,0a9.32,9.32,0,0,0-.9,1.35l0,.08a9.46,9.46,0,0,0-.66,
                                            1.59A8.85,8.85,0,0,0,39,27.06a10.57,10.57,0,0,0,0,1.78v0a8.36,8.36,0,0,0,.33,1.74A7.85,7.85,0,0,0,40,32.2a9.54,
                                            9.54,0,0,0,1,1.46,8.38,8.38,0,0,0,1.18,1.2,9.55,9.55,0,0,0,1.41.93,10.11,10.11,0,0,0,1.6.67,8,8,0,0,0,1.73.34,
                                            9.94,9.94,0,0,0,1.81,0,9.06,9.06,0,0,0,1.74-.32A8,8,0,0,0,52,35.82a9.64,9.64,0,0,0,1.47-1,9.3,9.3,0,0,0,1.14-
                                            1.12l0,0a9.49,9.49,0,0,0,1-1.44,10.86,10.86,0,0,0,.65-1.52v-.06a9,9,0,0,0,.35-1.74,10.57,10.57,0,0,0,0-1.78v0a8.36,
                                            8.36,0,0,0-.33-1.74,8.1,8.1,0,0,0-.66-1.59,9.08,9.08,0,0,0-1-1.46,8.38,8.38,0,0,0-1.18-1.2,9.64,9.64,0,0,0-1.33-
                                            .89l-.08,0a10,10,0,0,0-1.6-.67,8.06,8.06,0,0,0-1.72-.34ZM16.25,85.85a3.56,3.56,0,1,1-3.55,3.56,3.56,3.56,0,0,1,3.55-3.56Z"/>
                                    </svg>
                                        Nuevo Servicio
                                    </a>
                                    
                                    <span class="ms-2">
                                        <a class="dropdown-item ms-4" href="{{route('services.new')}}"><i class="fa-solid fa-gears mx-2"></i>Servicios</a>
                                    </span>
                                </span>
                            </div>
                        </li>
                        <li><hr class="divider"></li>
                        @endcan
                        <li class="nav-item dropdown ">                           
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapseObraSocial" role="button" aria-expanded="false" aria-controls="collapseObraSocial">
                                
                                <span class="text-primary fw-bold mx-2">COBERTURA</span>
                            </a>
                            @can('insurance.index')
                                <div class="collapse" id="collapseObraSocial">
                                    <span class="ms-2">
                                        <a class="dropdown-item ms-4" href="{{route('insurance.create')}}"><i class="fa-solid fa-file-circle-plus mx-2"></i>Nueva Obra Social</a>
                                    </span>
                                </div>
                                <div class="collapse" id="collapseObraSocial">
                                    <span class="ms-2">
                                        <a class="dropdown-item ms-4" href="{{route('insurance.show')}}"><i class="fa-solid fa-list-ul mx-2"></i>Listado de Obra Sociales</a>
                                    </span>
                                </div>
                            @endcan

                            @can('insurance.active')
                                <div class="collapse" id="collapseObraSocial">
                                    <span class="ms-2">
                                        <a class="dropdown-item ms-4" href="{{route('insurance.active')}}"><i class="fa-solid fa-list-ul mx-2"></i>Mis Obras Sociales</a>
                                    </span>
                                </div>

                            @endcan

                            
                        </li>
                        <li><hr class="divider"></li>
                        <li class="nav-item dropdown ">                           
                            <a class="dropdown-item dropdown-toggle text-dark" data-bs-toggle="collapse" href="#collapseNotas" role="button" aria-expanded="false" aria-controls="collapseNotas">
                                
                                <span class="text-primary fw-bold mx-2">NOTAS</span>
                            </a>
                            @can('notes.create')
                                <div class="collapse" id="collapseNotas">
                                    <span class="ms-2">
                                        <a class="dropdown-item ms-4" href="{{route('notes.create')}}">
                                            <i class="fa-solid fa-file-circle-plus mx-2"></i>Nueva Nota</a>
                                    </span>
                                </div>
                                {{-- <div class="collapse" id="collapseNotas">
                                    <span class="ms-2">
                                        <a class="dropdown-item ms-4" href="{{route('notes.show')}}">
                                            <i class="fa-solid fa-list-ul mx-2"></i>Mis notas</a>
                                    </span>
                                </div> --}}
                            @endcan

                            {{-- @can('notes.show')
                                <div class="collapse" id="collapseNotas">
                                    <span class="ms-2">
                                        <a class="dropdown-item ms-4" href="{{route('notes.show')}}">
                                            <i class="fa-solid fa-list-ul mx-2"></i>Notas por profesional</a>
                                    </span>
                                </div>

                            @endcan --}}

                            
                        </li>
                        <li><hr class="divider"></li>
                        
                    </ul>
                </nav>    
            </div>  

            
          
        </div>
 
        <main class="py-4 position-relative top56">
            @yield('content')

        </main>
        
    </div>
@livewireScripts()

</body>

@yield('scripts')

</html>
