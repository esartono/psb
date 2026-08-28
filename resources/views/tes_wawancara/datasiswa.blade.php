<div class="inbox-area">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Data Pribadi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seleksi-tab" data-bs-toggle="tab" data-bs-target="#seleksi" type="button" role="tab" aria-controls="profile" aria-selected="false">Kelengkapan Wawancara</button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="wawancara-tab" data-bs-toggle="tab" data-bs-target="#wawancara" type="button" role="tab" aria-controls="contact" aria-selected="false">Hasil Wawancara</button>
                    </li> --}}
                </ul>
                <div class="breadcomb-wp mt-4">
                    <div class="breadcomb-icon">
                        <i class="fa-solid fa-user color-{{ unit($calon->gelnya->unit_id) }} border-{{ unit($calon->gelnya->unit_id) }}"></i>
                    </div>
                    <div class="breadcomb-ctn">
                        <h3 style="margin-bottom: -2px;">{{ $calon->uruts }}</h3>
                        <p style="font-size: 110%">{{ $calon->name }}</p>
                    </div>
                </div>
                <hr>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="inbox-left-sd" style="padding: 0 !important">
                            <div class="inbox-status">
                                <table class="table">
                                    <tr>
                                        <td><span class="mdi mdi-calendar-month-outline"></span></td>
                                        <td style="text-align: left">Tempat, Tanggal Lahir : <br>
                                            <b>{{ $calon->tempat_lahir }}, {{ formatIndo($calon->tgl_lahir) }}</b>
                                        </td>
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
                                        <td style="text-align: left">
                                            Ayah : <b>{{ $calon->ayah_nama }}</b><br>
                                            Ibu : <b>{{ $calon->ibu_nama }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="mdi mdi-home"></span></td>
                                        <td style="text-align: left">Alamat : <br>
                                            <b>{{ $calon->alamat }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="mdi mdi-school"></span></td>
                                        <td style="text-align: left">Asal Sekolah : <b>{{ $calon->asal_sekolah }}</b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seleksi" role="tabpanel" aria-labelledby="seleksi-tab">
                        <div class="overflow-auto" style="height: 550px; width: 100%; border: solid 1px red; padding: 5px; border-radius: 5px">
                            <h5 class="mt-3">Data kelengkapan seleksi</h5><hr>
                            <div class="accordion">
                                @if($adaseleksi == 0)
                                    <div class="alert alert-danger" role="alert">
                                        ... Belum Input Data Kelengkapan Seleksi ...
                                    </div>
                                @else
                                    @foreach ($kelengkapanseleksi as $d)
                                        <div class="accordion-item">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $d->no }}" aria-expanded="true" aria-controls="{{ $d->no }}">
                                                {{ $d->no_soal }}. {{ $d->pertanyaan }}
                                            </button>
                                            <div id="{{ $d->no }}" style="text-align: left !important" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                            @if($d->jawaban)
                                                <div class="accordion-body">
                                                    @if(strlen($d->jawaban) == 1)
                                                        @if($d->jawaban == 1)
                                                            Setuju,
                                                        @endif
                                                        @if($d->jawaban == 0)
                                                            Tidak Setuju,
                                                        @endif
                                                    @else
                                                        {{ $d->jawaban }}
                                                    @endif            
                                                    @if($d->catatan)
                                                        <br>{{ $d->catatan }}
                                                    @endif
                                                </div>
                                            @endif
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="wawancara" role="tabpanel" aria-labelledby="wawancara-tab">
                        <div class="overflow-auto" style="height: 550px; width: 100%; border: solid 1px red; padding: 5px; border-radius: 5px">
                            <h5 class="mt-3">Data Wawancara Orang Tua</h5><hr>
                            <div class="accordion">
                                @if($adawawancaraortu == 0)
                                    <div class="alert alert-danger" role="alert">
                                        ... Belum Input Data Kelengkapan Seleksi ...
                                    </div>
                                @else
                                    @foreach ($wawancaraortu as $d)
                                        <div class="accordion-item">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $d->no }}" aria-expanded="true" aria-controls="{{ $d->no }}">
                                                {{ $d->no_soal }}. {{ $d->pertanyaan }}
                                            </button>
                                            <div id="{{ $d->no }}" style="text-align: left !important" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                            @if($d->jawaban)
                                                <div class="accordion-body">
                                                    @if(strlen($d->jawaban) == 1)
                                                        @if($d->jawaban == 1)
                                                            Setuju,
                                                        @endif
                                                        @if($d->jawaban == 0)
                                                            Tidak Setuju,
                                                        @endif
                                                    @else
                                                        {{ $d->jawaban }}
                                                    @endif            
                                                    @if($d->catatan)
                                                        <br>{{ $d->catatan }}
                                                    @endif
                                                </div>
                                            @endif
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div>
                    <a href="/wawancara" class="btn btn-success float-start">Dashboard</a>
                    <a class="btn btn-secondary text-white float-end" href="{{ route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-power-off"></i> &nbsp; {{ __('Logout') }} </b>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div> --}}
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