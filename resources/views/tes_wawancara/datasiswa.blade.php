<div class="inbox-area">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                <div class="inbox-left-sd">
                    <div class="breadcomb-wp">
                        <div class="breadcomb-icon">
                            <i class="fa-solid fa-user color-{{ unit($calon->gelnya->unit_id) }} border-{{ unit($calon->gelnya->unit_id) }}"></i>
                        </div>
                        <div class="breadcomb-ctn">
                            <h3 style="margin-bottom: -2px;">{{ $calon->uruts }}</h3>
                            <p style="font-size: 110%">{{ $calon->name }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="inbox-status">
                        <table class="table">
                            <tr>
                                <td><span class="mdi mdi-calendar-month-outline"></span></td>
                                <td style="text-align: left">Tempat, Tanggal Lahir : <b>{{ $calon->tempat_lahir }}, {{ formatIndo($calon->tgl_lahir) }}</b></td>
                            </tr>
                            <tr>
                                <td><span class="mdi mdi-clipboard-account"></span></td>
                                <td style="text-align: left">Jenis Kelamin : <b>{{ $calon->kelamin }}</b></td>
                            </tr>
                            <tr>
                                <td><span class="mdi mdi-account-school"></span></td>
                                <td style="text-align: left">Kelas Tujuan : <b>Kelas {{ $calon->kelasnya->name }}</b></td>
                            </tr>
                            <tr>
                                <td><span class="mdi mdi-account-tie"></span></td>
                                <td style="text-align: left">Nama Ayah : <b>{{ $calon->ayah_nama }}</b></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="text-align: left">Nama Ibu : <b>{{ $calon->ibu_nama }}</b></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="pt-4">
                                    <a href="/wawancara" class="btn btn-success float-start">Dashboard</a>
                                    <a class="btn btn-secondary text-white float-end" href="{{ route('logout')}}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-power-off"></i> &nbsp; {{ __('Logout') }} </b>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>              
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
                <div class="inox-left-sd">
                    <div class="widget-tabs-int" style="font-size: 0.9rem">
                        <div class="row">
                            @include('tes_wawancara.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>