<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} | {{ auth()->user()->tpname }}</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper" id="app">
  <div class="content-wrapper">
      <div class="row justify-content-center">
          @yield('content')
      </div>
      <div class="text-center">
        @if (auth()->user()->isAdmin())
          <a class="btn btn-primary btn-lg" href="{{ url('/home') }}">Home </a>
        @endif
        @if (auth()->user()->isUser())
          <a class="btn btn-primary btn-lg" href="{{ url('/psb') }}">Home</a>
        @endif
      </div>
  </div>

    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            IT Team - SIT Nurul Fikri
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2019 <a href="https://nurulfikri.sch.id">SIT Nurul Fikri</a>.</strong>
    </footer>
</div>
<!-- ./wrapper -->

<script src="/js/app.js"></script>
</body>
</html>
