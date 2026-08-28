<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }} | {{ auth()->user()->tpname }}</title>
  
  <link rel="icon" href="{{ URL::asset('/img/favicon.ico') }}" type="image/x-icon"/>
  <link rel="stylesheet" href="/css/app.css" type="text/css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @yield('content')
        <router-view :key="$route.path"></router-view>
        <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      IT Team - SIT Nurul Fikri
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 - {{  date("Y") }} <a href="https://nurulfikri.sch.id">SIT Nurul Fikri</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->
<script>
  window.tp = @json(auth()->user()->tpname)
</script>
<script src="/js/app.js"></script>
@stack('jawa')
</body>
</html>
