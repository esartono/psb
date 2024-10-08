<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>
  
  <link rel="icon" href="{{ URL::asset('/img/favicon.ico') }}" type="image/x-icon"/>
  <link rel="stylesheet" href="/css/app.css" type="text/css">
  <style type="text/css">
    .sign-in {
      padding: 0.2rem !important;
      text-align: left !important;
      font-weight: 800;
      margin-bottom: 1.5rem
    }
    .sign-in img {
      background-color: #fff;
      padding: 0.2rem;
      margin: 0 8px 0 0;
      border-radius: 0.25rem 0 0 0.25rem;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box" style="margin-top: 0 !important">
  <div class="login-logo">
    <img src="/img/logo.png" style="width: 30%; heigth: auto"><br>
    <h4>PPDB Online <br> SIT Nurul Fikri - Depok</h4>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      @yield('content')
    </div>
  </div>
</div>
<script src="/js/app.js"></script>

</body>
</html>
