<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'To Do App') }}</title>

    <!-- <script src="{{ asset('js/jquery-slim.min.js') }}" ></script> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav-bar.css') }}" rel="stylesheet">
    <!-- Material Design -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <div >
        <nav class="navbar navbar-expand-md mb-auto">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/actividades') }}">
                    <img src="{{ asset('images/icon_apps/logo_desktop.png') }}" class="img-thumbnail" style="height: 45px;">
                    {{ config('app.name', 'To Do App - Prueba Técnica El Pa&iacute;s') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/">{{ __('Iniciar Sesión') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name_1.' '.Auth::user()->surname_1 }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Salir') }}
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

    </div>
    <main class="container-full">
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar" class="active">
                <ul class="list-unstyled components">

                    @forelse ($modules as $module)
                        <li>
                            <a href="{{ url('/', [$module->link]) }}" class="">
                                <i class="material-icons" style="cursor:pointer; font-size:45px;">{{ $module->min_icon }}</i>
                                <span style="">{{ $module->descripcion }}</span>
                            </a>
                        </li>
                    @empty
                        <p>No hay modulos parametrizados.</p>
                    @endforelse
                </ul>
            </nav>

            <div class="content" id="app" style="width: 100%;">
                @yield('content')
            </div>
        </div>
    </main>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/actividades.js') }}"></script>
</body>
</html>