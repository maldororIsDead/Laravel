<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .links > a {
            color: #636b6f;
            padding: 20px 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links .navbar-brand {
            font-size: 24px;
        }
    </style>
</head>
<body>
<div id="app">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="links">
                <a class="navbar-brand" href="{{ url('/') }}">JobSearch</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active links">
                        <a class="nav-link" href="{{ url('/') }}">Главная <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item links">
                        <a class="nav-link" href="{{ route('all-vacancies') }}">Вакансии</a>
                    </li>
                    <li class="nav-item links">
                        <a class="nav-link" href="{{ route('all-resumes') }}">Резюме</a>
                    </li>
                    <li class="nav-item links">
                        <a class="nav-link" href="#">Новости</a>
                    </li>
                    <li class="nav-item links">
                        <a class="nav-link" href="#">О нас</a>
                    </li>
                </ul>
                <form action="@if (Auth::check() && Auth::user()->isCompany()) {{ url('search/resumes') }} @else {{ url('search/vacancies') }}  @endif"
                      method="GET" class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" name="search" type="text" placeholder="Поиск..."
                           aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Поиск</button>
                </form>
                <div class="links form-inline mt-2 mt-md-0">
                    <nav class="navbar">
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="links"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                <li class="links"><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @else
                                <li class="nav-item dropdown links">
                                    @if (Route::has('login'))
                                        <div class="links form-inline mt-2 mt-md-0">
                                            @auth
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle"
                                                   href="{{ url('/home') }}" role="button" data-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }} <span class="caret"></span>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item"
                                                       href="{{ url('/home') }}">{{ Auth::user()->name }}</a>
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">
                                                        @csrf
                                                    </form>
                                                </div>
                                            @else
                                                <div class="links">
                                                    <a href="{{ route('login') }}">Login</a>
                                                    <a href="{{ route('register') }}">Register</a>
                                                </div>
                                            @endauth
                                        </div>
                                    @endif
                                </li>
                            @endguest
                        </ul>
                    </nav>
                </div>
            </div>
        </nav>
    </header>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->

            </div>
        </div>
    </nav>

    <main class="py-4 my-md-5">
        @yield('content')
    </main>
</div>

</body>
</html>
