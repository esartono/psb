<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Aplikasi PSB | 2020-2021</title>
        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
            <div class="container">
            <a href="#" class="brand-link">
            <img src="/img/logo.png"
                alt="Logo SIT Nurul Fikri"
                class="img-circle elevation-3 mr-3"
                width="50"
                height="50"
                style="opacity: .8">
                <span class="brand-text mr-3">Aplikasi PSB | 2020-2021</span>
            </a>
            <ul class="nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    @if (Route::has('login'))
                        @auth
                            @if (auth()->user()->isAdmin())
                                <a class="btn btn-primary btn-sm" href="{{ url('/home') }}">Dashboard Admin </a>
                            @endif
                            @if (auth()->user()->isUser())
                                <a class="btn btn-primary btn-sm" href="{{ url('/ppdb') }}">Home</a>
                            @endif
                        @endauth
                    @endif
                </li>
            </ul>
        </div>
    </body>
</html>
