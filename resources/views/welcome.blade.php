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
                        <a href="{{ route('login') }}" class="btn btn-primary shadow-sm">Iniciar seción</a>
                        </div>
                        @if (Route::has('register'))
                        <div class="text-center m-2">
                            <a href="{{ route('register') }}" class="btn btn-primary shadow-sm">Registrase</a>
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
                      <p><a class="btn btn-primary btn-lg" href="mailto:contacto@space4clinic.com?subject=contacto desde la web" role="button">Solicite una demostración &raquo;</a></p>
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
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Sobre Nosotros</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" src="{{url('/images/doctors.png')}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Historia clínica</h5>
                                        <p class="card-text">
                                            Visualice la historia clínica de sus pacientes y comparta con otros profesionales aspectos 
                                            relevantes.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="text-center text-white" style="background-color: #3f51b5">
                <!-- Grid container -->
                <div class="container">
                  <!-- Section: Links -->
                  <section class="mt-5">
                    <!-- Grid row-->
                    <div class="row text-center d-flex justify-content-center pt-5">
                      <!-- Grid column -->
                      <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                          <a href="#exampleModal" class="text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" >Sobre nosotros</a>
                        </h6>
                      </div>
                      <!-- Grid column -->
            
                      <!-- Grid column -->
                      <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                          <a href="mailto:soporte@space4clinic.com?subject=contacto desde la web" class="text-white">Soporte técnico</a>
                        </h6>
                      </div>
                      <!-- Grid column -->
            
                      <!-- Grid column -->
                      <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                          <a href="mailto:contacto@space4clinic.com?subject=contacto desde la web" class="text-white">Sugerencias</a>
                        </h6>
                      </div>
                      <!-- Grid column -->
            
                      <!-- Grid column -->
                      {{-- <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                          <a href="#!" class="text-white">Help</a>
                        </h6>
                      </div> --}}
                      <!-- Grid column -->
            
                      <!-- Grid column -->
                      <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                          <a href="mailto:contacto@space4clinic.com?subject=contacto desde la web" class="text-white">Contacto</a>
                        </h6>
                      </div>
                      <!-- Grid column -->
                    </div>
                    <!-- Grid row-->
                  </section>
                  <!-- Section: Links -->
            
                  <hr class="my-5" />
            
                  <!-- Section: Text -->
                  <section class="mb-5">
                    <div class="row d-flex justify-content-center">
                      <div class="col-lg-8">
                        <p>
                          Si requiere una cotización a una demostración, contáctese con nosotros para poder conocer nuestro sistema. 
                          Estamos abiertos a cualquier sugerencia que nos ayude a mejorar.
                          En caso de sugerencias sobre el sistema nuestro equipo de soporte se pondrá en contacto con uds.
                        </p>
                      </div>
                    </div>
                  </section>
                  <!-- Section: Text -->
            
                  <!-- Section: Social -->
                  <section class="text-center mb-5">
                    <a href="mailto:contacto@space4clinic.com?subject=contacto desde la web" class="text-white text-decoration-none me-4">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="16" 
                            height="16" 
                            fill="currentColor" 
                            class="bi bi-envelope" 
                            viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                        </svg>
                    </a>
                    <a href="" class="text-white text-decoration-none me-4">
                    
                      <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-instagram" 
                        viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                      </svg>
                    </a>
                    <a href="https://www.linkedin.com/company/space-for-clinic/" class="text-white text-decoration-none me-4">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="16" height="16" 
                            fill="currentColor" 
                            class="bi bi-linkedin" 
                            viewBox="0 0 16 16">
                            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                        </svg>
                    </a>
                    <a href="" class="text-white text-decoration-none me-4">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="16" 
                            height="16" 
                            fill="currentColor" 
                            class="bi bi-facebook" 
                            viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg>
                        
                    </a>
                    <a href="" class="text-white me-4">
                      <i class="fab fa-github"></i>
                    </a>
                  </section>
                  <!-- Section: Social -->
                </div>
                <!-- Grid container -->
            
                <!-- Copyright -->
                <div
                     class="text-center p-3"
                     style="background-color: rgba(0, 0, 0, 0.2)"
                     >
                  © 2020 Copyright:
                  <a class="text-white" href="#!"
                     >Rodrigo Suarez</a
                    >
                </div>
                <!-- Copyright -->
              </footer>
    </body>
</html>
