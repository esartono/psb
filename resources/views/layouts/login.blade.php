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

  <title>{{ config('app.name') }}</title>

  <link rel="stylesheet" href="/css/app.css">
  <style>
    .sign-in {
      padding: 0.25rem !important;
      text-align: left !important;
      font-weight: 800;
      margin-bottom: 1.5rem
    }
    .sign-in img {
      background-color: #fff;
      padding: 0.5rem;
      width: 40;
      margin: 0 10px 0 0;
      border: 1px solid #fff;
      border-radius: 0.25rem 0 0 0.25rem;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">PPDB Online - SIT Nurul Fikri - Depok</a>
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
