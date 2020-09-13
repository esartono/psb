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

  <title>PPDB Online SIT Nurul Fikri | 2020-2021</title>

  <link rel="stylesheet" href="/css/app.css">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E2EXL2S2X8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-E2EXL2S2X8');
</script>

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
    <a href="#" class="brand-link">
      <img src="/img/logo.svg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PPDB Online</span>
    </a>

    @if(Auth::check())
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
            <router-link to="/siswa" class="nav-link">
              <i class="nav-icon fas fa-thumbs-up green"></i>
              <p>
                Data Siswa Baru
              </p>
            </router-link>
          </li>
          @if(Auth::user()->isAdmin())
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie orange"></i>
              <p>
                Statistik
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/statistik/mentah" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Mentah ( Status Aktif )</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/statistik/mentah_terima" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Mentah ( Status Diterima )</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/statistik/all" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>All</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/statistik/aktif" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/statistik/terima" class="nav-link">
                  <i class="fas fa-grin-beam nav-icon"></i>
                  <p>Di Terima</p>
                </a>
              </li>
            </ul>
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
              <li class="nav-item">
                <router-link to="/master/seragam" class="nav-link">
                <i class="fas fa-caret-right nav-icon"></i>
                  <p>Seragam</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs yellow"></i>
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
                <router-link to="/config/jdokus" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Jenis Dokumen</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/config/kategori" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Kategori</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/config/gelombang" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Gelombang</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/config/jadwal" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Jadwal</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/config/biayates" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Biaya Tes</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/config/agreement" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Persetujuan</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/config/berita" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Berita</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users indigo"></i>
              <p>
                Data Siswa & Pegawai
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/datasiswanf" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Data Siswa SIT NF</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/datapegawai" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Data Pegawai</p>
                </router-link>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-graduation-cap nav-icon blue"></i>
              <p>
                Data Calon Siswa
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/cpdAll" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>CPD Semua</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/cpd/0" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>CPD Baru</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/cpd/1" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>CPD Aktif</p>
                </router-link>
              </li>

              <!-- <li class="nav-item">
                <router-link to="/cpdBaru" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>CPD Baru</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/cpdAktif" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>CPD Aktif</p>
                </router-link>
              </li> -->
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <router-link to="/tes" class="nav-link">
              <i class="nav-icon fas fa-calendar TK"></i>
              <p>
                Jadwal Tes
              </p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate blue"></i>
              <p>
                Data Hasil Tes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/cpdHasil/0" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Belum</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/cpdHasil/1" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Diterima</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/cpdHasil/2" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Cadangan</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/cpdHasil/3" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Tidak Diterima</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/cpdHasil/4" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Mengundurkan Diri</p>
                </router-link>
              </li>
            </ul>
          </li>
          @if(Auth::user()->isAdmin()||Auth::user()->isAdminKeu())
          <!-- <li class="nav-item">
            <a href="/waw-keu" class="nav-link">
              <i class="nav-icon fas fa-money-check-alt green"></i>
              <p>
                Wawancara Keuangan
              </p>
            </a>
          </li> -->
          @endif
          <li class="nav-item">
            <router-link to="/tagihan" class="nav-link">
              <i class="nav-icon fas fa-wallet green"></i>
              <p>
                Data Tagihan
              </p>
            </router-link>
          </li>
          @if(Auth::user()->isAdmin())
          <li class="nav-item">
            <router-link to="/suratseragam" class="nav-link">
              <i class="nav-icon fas fa-tshirt yellow"></i>
              <p>
                Data Surat Seragam
              </p>
            </router-link>
          </li>
          @endif
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
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    @endif
    <!-- /.sidebar -->
  </aside>

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
    <strong>Copyright &copy; 2019 <a href="https://nurulfikri.sch.id">SIT Nurul Fikri</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<script src="/js/app.js"></script>
</body>
</html>
