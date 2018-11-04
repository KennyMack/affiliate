<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <script type="text/javascript">
        window.BASE_URL = '{{ url('/') }}';

    </script>
</head>
<body>
    <div id="app">
        <loading-component></loading-component>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <!--<a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>-->
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo-main" src="{{ asset('/assets/img/logo_vantangens.png') }}" alt="Logotipo">
                </a>
                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (!Auth::guest())
                            @if (Auth::user()->isEmployee())
                                <li class="dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        Cadastros Básicos <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="nav-link" href="{{ url('admin', 'categories') }}">Categorias</a></li>
                                        <li><a class="nav-link" href="{{ url('admin','countries') }}">Pais</a></li>
                                        <li><a class="nav-link" href="{{ url('admin','states') }}">Estado</a></li>
                                        <li><a class="nav-link" href="{{ url('admin','cities') }}">Cidade</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="text-dark" href="{{ url('admin', 'companies') }}">Empresas</a>
                                </li>
                            @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-2">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            @if (!Auth::guest())
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6" style="padding-left: 30px; padding-top: 10px">
                                        <breadcrumb-component></breadcrumb-component>
                                    </div>
                                    <div class="col-md-6">
                                        @yield('control')
                                    </div>
                                </div>

                            </div>
                            @endif

                            <div class="card-body">
                                <div class="row">
                                    @yield('header')
                                </div>
                                <div class="row">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if(Session::has('message_success'))
                                        <div class="alert alert-success alert-dismissible fade show"
                                             style="margin: 0 auto"
                                             role="alert">
                                            {{ Session::get('message_success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if(Session::has('message_warning'))
                                        <div class="alert alert-warning alert-dismissible fade show"
                                             style="margin: 0 auto"
                                             role="alert">
                                            {{ Session::get('message_warning') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    @endif
                                    @if(Session::has('message_danger'))
                                        <div class="alert alert-danger alert-dismissible fade show"
                                             style="margin: 0 auto"
                                             role="alert">
                                            {{ Session::get('message_danger') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script type="text/javascript">
        /*$(window).load(function() {
            console.log('load');
            $('#ModalLoading').css({
                'display':  'block'
            });
        });
        $(window).ready(function () {
            console.log('ready');
            $('#ModalLoading').css({
                'display': 'none'
            });
        });*/
    </script>
    @yield('scripts')
</body>
</html>
