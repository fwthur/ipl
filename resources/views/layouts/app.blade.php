<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        .card .card-body{
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo/logo-wi-color-sm.svg') }}" alt="" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">Dashboard</a>
                        </li>
                        @if(Auth::user()->roles == 'admin')
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">User Managements</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Content Management System
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('categories.index') }}">Category</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('wisata.index') }}">Wisata</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                            @if(Auth::user()->roles == 'admin')
                                <a href="{{ route('transactions.index') }}" class="nav-link">Transaction Reports</a>
                            @endif
                            @if(Auth::user()->roles == 'user')
                                <a href="{{ route('transactions.index') }}" class="nav-link">History Transactions</a>
                            @endif
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <div class="auth">
                        @guest
                            @if(Route::has('login'))
                                <a href="{{ route('login') }}" class="btn btn-secondary">{{ __('Masuk') }}</a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Daftar') }}</a>
                            @endif
                        @else
                            <div class="dropdown">
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
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container mt-5 pt-5">
                <div class="row">
                    <div class="col-md-3 mt-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <img src="{{ asset('img/icon/user.jpg') }}" alt="" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                <h4 class="fw-bold mt-3">{{ Auth::user()->name }}</h4>
                                <p class="text-primary">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 mt-3">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
