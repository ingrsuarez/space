<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ADMESYS') }}</title>

        <!-- Scripts -->
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
        
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        
            @if (Route::has('login'))
            <nav class="navbar navbar-expand-sm d-flex flex-row">

                <div class="navbar-brand">
                    <img class="m-2 logo rounded float-start shadow placeholder-wave" src="{{url('/images/logo-512x512.png')}}" alt="Image"/>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    @auth
                        <a href="{{ url('/home') }}" class="navbar-brand position-relative end-0">Home</a>
                    @else
                        <div class="text-center m-2">
                        <a href="{{ route('login') }}" class="btn btn-primary shadow-sm">Log in</a>
                        </div>
                        @if (Route::has('register'))
                        <div class="text-center m-2">
                            <a href="{{ route('register') }}" class="btn btn-primary shadow-sm">Register</a>
                        </div>
                        @endif
                        
                    @endauth
                   
                </div>
                
                               
            </nav>  
            @endif
            
            <div class="py-4 position-relative top-0 start-0">
                
                @if (session('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- <div class="mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="" class="underline text-gray-900 dark:text-white">Descripción</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Admesys es un sistema de gestión diseñado para adpatarse a las necesidades de su empresa. Gracias a un soporte continuo, logramos tener un feedback que permite mantener el sistema actualizado.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="" class="underline text-gray-900 dark:text-white">Flexibilidad</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    El sistema integra las tecnologías disponibles y nuestro equipo de trabajo las une para lograr cumplir con las necesidades que se presentan, acompañando a su empresa en los cambios.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="" class="underline text-gray-900 dark:text-white">Novedades</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- CARUSEL 
                    <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{url('/images/doctors.png')}}" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{url('/images/doctor_tech.jpg')}}" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{url('/images/doctor_agenda.jpeg')}}" alt="...">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div> --}}
                  <div class="jumbotron bg-light shadow-lg pb-2 mb-4">
                    <div class="container bg-body-tertiary">
                        <h1 class="display-4">Historia clínica Profesional!</h1>
                        <p class="fs-5">Space4clinic esta diseñado para permitir la comunicación entre profesionales de la salud mediante una 
                        historia clínica dinámica y agil. Tambien ofrece la posibilidad de crear agendas y administrar turnos para pacientes.
                        Resumen de atención de pacientes. Administre sus convenios con obras sociales, precios y notas directamente desde 
                        su perfil de usuario.    
                        </p>
                      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
                    </div>
                  </div>
            
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{url('/images/doctors.png')}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Historia clínica</h5>
                                    <p class="card-text">
                                        Visualice la historia clínica de sus pacientes y comparta con otros profesionales aspectos relevantes.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{url('/images/doctor_tech.jpg')}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Acceso digital</h5>
                                    <p class="card-text">
                                        Space4clinic cuenta con acceso personal por usuario. Con su cuenta podra configurar su agenda,
                                        instituciones donde atiende, sus convenios y precios, sin necesidad de notificar a los
                                        recepcionisas de cada lugar donde atiende.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{url('/images/doctor_agenda.jpeg')}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Agenda institucional</h5>
                                    <p class="card-text">
                                        Agenda de turnos, bloqueo de dias y horarios editables.
                                        Confirmación de turnos por whats app, reagendar turnos, verificación de turnos 
                                        por paciente. Agenda separada por institución.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            {{-- <a href="" class="ml-1 underline">
                                Shop
                            </a> --}}
                            <a href="" class="ml-1 underline">
                                SPACE FOR CLINICS
                            </a>
                        </div>
                    </div>

                    {{-- <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div> --}}
                </div>
            </div>
           
    </body>
</html>
