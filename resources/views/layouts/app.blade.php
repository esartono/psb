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

    <title>{{ config('app.name') }} | {{ auth()->user()->tpname }}</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light bg-teal">
    <div class="container">
      <a href="/home" class="navbar-brand" style="color: #fff !important"> Dashboard ORTU &nbsp;&nbsp;| </a>
      <a href="https://bit.ly/Kesehatan-PPDB" class="btn bg-yellow"> Health Screening Form - PPDB SIT Nurul Fikri </a>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" class="user-image" alt="User Image" style="height: 35px;"/>
            {{ Auth::user()->name }} &nbsp; &nbsp;
            <i class="fas fa-caret-down"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="{{ route('logout')}}" class="nav-link"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <p class="indigo"><b> <i class="fas fa-power-off"></i> &nbsp;  {{ __('Logout') }} </b></p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper">
    <div class="content">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            IT Team - SIT Nurul Fikri
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2021 <a href="https://nurulfikri.sch.id">SIT Nurul Fikri</a>.</strong>
    </footer>
</div>
<!-- ./wrapper -->
<script type="application/javascript" src="/js/app.js"></script>
@stack('js')
</body>
</html>
