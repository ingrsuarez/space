<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @livewireStyles()
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ADMESYS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Captcha --}}
    {{-- {!! NoCaptcha::renderJs() !!} --}}
    <script src="https://www.google.com/recaptcha/api.js?render=6LdQNEsoAAAAAP65UIQlJOGiGId3CbgNzGx024ZM"></script>

    <script>
        document.addEventListener('submit',function(e){
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('6LdQNEsoAAAAAP65UIQlJOGiGId3CbgNzGx024ZM', {action: 'submit'}).then(function(token) {
                    let form = e.target;
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'response';
                    input.value = token;

                    form.appendChild(input);
                    form.submit();

                });
            });
        });
    </script>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark shadow-sm">
            
            <a class="navbar-brand me-auto ms-3" href="{{ url('/') }}">
                {{ config('app.name', 'ADMESYS') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container ms-5">
                <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav d-flex flex-row ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link mx-1" href="{{ route('login') }}">{{ __('Login') }}</a>
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
        {{-- <div class="offcanvas offcanvas-start sidebar-nav d-none" tabindex="-1" id="offcanvas">    
          
          
        </div> --}}
           
        <div class="position-relative top56">
            @yield('content')
        </div>
        
    </div>
    @livewireScripts()
</body>
</html>