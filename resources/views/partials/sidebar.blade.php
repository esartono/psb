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
      <div class="user-panel mt-3 pb-3 d-flex">
        <div class="image">
          <img src="/img/user.svg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      @if(Auth::user()->isAdministrator())
      <div class="user-panel">
        <a href="/login_as" class="btn btn-danger btn-block">
          {{ __('Login As') }}
        </a>
      </div>
      @endif

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(Auth::user()->isHaveAccess([1,3,4]))
          <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-th cyan"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="/graph" class="nav-link">
              <i class="nav-icon fas fa-chart-line yellow"></i>
              <p>
                Grafik
              </p>
            </a>
          </li> --}}
          <li class="nav-item has-treeview">
            <router-link to="/siswa" class="nav-link">
              <i class="nav-icon fas fa-thumbs-up green"></i>
              <p>
                Data Siswa Baru
              </p>
            </router-link>
          </li>
          @if(Auth::user()->isHaveAccess([1]))
          <li class="nav-item has-treeview">
            <router-link to="/statistik" class="nav-link">
                <i class="nav-icon fas fa-chart-pie orange"></i>
              <p>
                Statistik
              </p>
            </router-link>
          </li>
          {{-- <li class="nav-item has-treeview">
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
          </li> --}}
          @if(Auth::user()->isAdministrator())
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
              <!-- <li class="nav-item">
                <router-link to="/master/seragam" class="nav-link">
                <i class="fas fa-caret-right nav-icon"></i>
                  <p>Seragam</p>
                </router-link>
              </li> -->
            </ul>
          </li>
          @endif
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
              <li class="nav-item">
                <router-link to="/config/faq" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>F A Q</p>
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
              <li class="nav-item">
                <router-link to="/berkas" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Kelengkapan Berkas
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/waitingList" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Waiting List</p>
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
          @if(Auth::user()->isAdministrator())
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-calendar nav-icon TK"></i>
              <p>
                Data Jadwal Tes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/tes" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Jadwal Tes
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/non-tes" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Non Jadwal Tes
                  </p>
                </router-link>
              </li>
            </ul>
          </li>
          @endif
          @if(!Auth::user()->isAdministrator())
            <li class="nav-item">
              <router-link to="/tes" class="nav-link">
                <i class="nav-icon fa fa-calendar TK"></i>
                <p>
                  Jadwal Tes
                </p>
              </router-link>
            </li>
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate blue"></i>
              <p>
                Data Hasil Tes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->isHaveAccess([1]))
                <li class="nav-item">
                  <router-link to="/cpdHasil/0" class="nav-link">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Belum</p>
                  </router-link>
                </li>
              @endif
              <li class="nav-item">
                <router-link to="/cpdHasil/1" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Diterima</p>
                </router-link>
              </li>
              @if(Auth::user()->isHaveAccess([1]))
                <li class="nav-item">
                  <router-link to="/cpdHasil/2" class="nav-link">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>Cadangan</p>
                  </router-link>
                </li>
              @endif
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
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-comments nav-icon orange"></i>
              <p>
                Wawancara Ortu & Siswa
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/wawancara/pewawancara" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Pewawancara
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/wawancara/instrumen-wawancara" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Instrumen
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/wawancara/rubrik-wawancara" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Rubrik
                  </p>
                </router-link>
              </li>
              @if(Auth::user()->isHaveAccess([1]))
                <router-link to="/wawancara/aspek-perilaku" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Aspek Perilaku
                  </p>
                </router-link>
              @endif
              <li class="nav-item">
                <router-link to="/wawancara/rekap" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Rekap Wawancara
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <form id="wawancara" class="mb-3" role="form" method="POST" action="{{ route('tesWawancara') }}">
                  @csrf
                  <a href="/teswawancara" class="nav-link">
                    <i class="fas fa-caret-right nav-icon"></i>
                    <p>
                      Tes Wawancara
                    </p>
                  </a>
                </form>
              </li>
            </ul>
          </li>
          @if(Auth::user()->isHaveAccess([1,4]))
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-money-check-alt nav-icon green"></i>
              <p>
                Data Keuangan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/bayartagihan" class="nav-link">
                <!-- <router-link to="" class="nav-link"> -->
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Data Bayar Tagihan
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/bayarspps" class="nav-link">
                <!-- <router-link to="" class="nav-link"> -->
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Data Bayar SPP
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="/wawancara-keu" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Wawancara Keuangan
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <router-link to="/tagihan" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Data Tagihan
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/impruf" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Data Ikut Impruf
                  </p>
                </router-link>
              </li>
              <li class="nav-item menu-is-opening">
                <a href="#" class="nav-link">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Setting
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: block;">
                  <li class="nav-item">
                    <router-link to="/config/tagihanPSB" class="nav-link">
                      <i class="fas fa-caret-right nav-icon"></i>
                      <p>Biaya PPDB</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/config/biayaSPP" class="nav-link">
                      <i class="fas fa-caret-right nav-icon"></i>
                      <p>Biaya SPP</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/config/Immersion" class="nav-link">
                      <i class="fas fa-caret-right nav-icon"></i>
                      <p>Biaya Program Immersion</p>
                    </router-link>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          @endif
          {{-- @if(Auth::user()->isHaveAccess([1,6])) --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-tshirt nav-icon yellow"></i>
              <p>
                Data Seragam & Buku
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/seragam" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Data Seragam Calon
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/suratseragam" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Surat Pengambilan Seragam
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/suratbuku" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Surat Pengambilan Buku
                  </p>
                </router-link>
              </li>
            </ul>
          </li>
          {{-- @endif --}}
        @endif
        @if(Auth::user()->isHaveAccess([1, 6]))
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-tshirt nav-icon yellow"></i>
              <p>
                Data Seragam PPDB
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/seragam" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Data Seragam Calon
                  </p>
                </router-link>
              </li>
              {{-- <li class="nav-item">
                <router-link to="/suratseragam" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>
                    Surat Pengambilan Seragam
                  </p>
                </router-link>
              </li> --}}
            </ul>
          </li>
          <li class="nav-item">
            <router-link to="/ambil" class="nav-link">
              <i class="nav-icon fas fa-qrcode red"></i>
              <p>
                Input Pengambilan
              </p>
            </router-link>
          </li>
        @endif
        @if(Auth::user()->isHaveAccess([1,4]))
          <li class="nav-item">
            <router-link to="/email" class="nav-link">
              <i class="nav-icon fa fa-envelope teal"></i>
              <p>
                Data Email
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