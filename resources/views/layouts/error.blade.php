<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="/css/app.css" type="text/css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper" id="app">
  <div class="content-wrapper">
      <div class="row justify-content-center">
          @yield('content')
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
