<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Aplikasi PPDB | 2022-2023</title>

  <link rel="stylesheet" href="/css/app.css" type="text/css" >

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
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/img/logo.svg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Aplikasi PPDB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/user.svg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-th cyan"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/master/admin" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Admin</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/master/user" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>User</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/master/unit" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Unit</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/master/kelas" class="nav-link">
                <i class="fas fa-caret-right nav-icon"></i>
                  <p>Kelas</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Konfigurasi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/config/tp" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Tahun Pelajaran</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/config/gelombang" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Gelombang</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/config/biayates" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Biaya Tes</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user green"></i>
              <p>
                Profile
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout')}}" class="nav-link"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off red"></i>
                <p>{{ __('Logout') }}</p>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
<div class="container">
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary">
            <h3 class="card-title">Data Pendaftaran</h3>
            <div class="card-tools">
              <div class="input-group" style="width: 300px;">
                <div class="input-group-prepend">
                    <span class="input-group-text"> Pilih berdasarkan : </span>
                </div>
                <select class="form-control float-right">
                  <option selected>Jenis Kelamin</option>
                  <option value="1">Kategori</option>
                </select>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-bordered table-hover">
              <col width="250" />
              <col width="100" />
              <col width="100" />
              <thead>
                <tr>
                  <th rowspan="2" class="align-middle">Unit</th>
                  <th rowspan="2" class="align-middle">Kuota</th>
                  <th rowspan="2" class="align-middle">Sisa Kuota</th>
                  <th colspan="3">Total</th>
                  <th colspan="3">Baru</th>
                  <th colspan="3">Aktif</th>
                </tr>
                <tr>
                  <th>L</th>
                  <th>P</th>
                  <th>Total</th>
                  <th>L</th>
                  <th>P</th>
                  <th>Total</th>
                  <th>L</th>
                  <th>P</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>SD</td>
                  <th>100</th>
                  <th>200</th>
                  <th>300</th>
                  <th>100</th>
                  <th>300</th>
                  <th>100</th>
                  <th>200</th>
                  <th>300</th>
                  <th>100</th>
                  <th>200</th>
                  <th>300</th>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="card border-success">
          <div class="card-header bg-success">
            <h3 class="card-title">Data Keuangan</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-bordered table-hover">
              <col width="250" />
              <col width="100" />
              <col width="100" />
              <thead>
                <tr>
                  <th rowspan="2" class="align-middle">Unit</th>
                  <th colspan="4">Total Pendaftaran</th>
                  <th colspan="4">Pendaftaran Aktif</th>
                </tr>
                <tr>
                  <th>Umum</th>
                  <th>Internal</th>
                  <th>Pegawai</th>
                  <th>Total</th>
                  <th>Umum</th>
                  <th>Internal</th>
                  <th>Pegawai</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>SD</td>
                  <th>200</th>
                  <th>300</th>
                  <th>100</th>
                  <th>300</th>
                  <th>100</th>
                  <th>200</th>
                  <th>300</th>
                  <th>100</th>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</div>
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
    <strong>Copyright &copy; 2019 <a href="https://nurulfikri.sch.id">SIT Nurul Fikri</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<script src="/js/app.js"></script>
</body>
</html>
