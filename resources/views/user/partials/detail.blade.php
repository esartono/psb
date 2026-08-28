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
                        <div class="text-center mb-3">
                            <a href="/editcalon/{{ $calon->id }}" class="btn btn-info btn-sm text-white"><i class="fas fa-user-edit"> </i><b> Edit Data calon siswa</b></a>
                        </div>
                        <table class="table">
                            <tr>
                                <td><span class="mdi mdi-calendar-month-outline"></span></td>
                                <td>Tempat, Tanggal Lahir : <b>{{ $calon->tempat_lahir }}, {{ formatIndo($calon->tgl_lahir) }}</b></td>
                            </tr>
                            <tr>
                                <td><span class="mdi mdi-clipboard-account"></span></td>
                                <td>Jenis Kelamin : <b>{{ $calon->kelamin }}</b></td>
                            </tr>
                            <tr>
                                <td><span class="mdi mdi-account-school"></span></td>
                                <td>Kelas Tujuan : <b>Kelas {{ $calon->kelasnya->name }}</b></td>
                            </tr>
                            <tr>
                                <td><span class="mdi mdi-calendar-text"></span></td>
                                <td>Terdaftar pada tanggal : <b>{{ formatIndo($calon->tgl_daftar) }}</b></td>
                            </tr>
                            @if($calon->tahap !== 9)
                            <tr>
                                <td><span class="mdi mdi-email-check"></span></td>
                                <td>Email pendaftar : <b>{{ auth()->user()->email }}</b></td>
                            </tr>
                            @endif
                            @if($calon->tahap == 4)
                            <tr>
                                <td></td>
                                <td><a href='/dokumen/{{ $calon->id }}' class="btn btn-sm btn-danger btn-block "><i class="fa fa-book"> </i> &nbsp;Upload Dokumen</a></td>
                            </tr>
                            @endif
                            @if($calon->tahap >= 5)
                                @if($calon->hasil['hasil']->lulus == 1)
                                    <tr>
                                        <td><span class="mdi mdi-bank-check"></span></td>
                                        {{-- <td style="font-weight: 700">Rekening Virtual Account Bank BJB Syariah</td> --}}
                                        <td style="font-weight: 700">Rekening Virtual Account Bank Muamalat Indonesia</td>
                                    </tr>
                                    <tr>
                                        <td><span class="mdi mdi-credit-card-check"></span></td>
                                        <td style="font-weight: 700">
                                            {{-- @if($calon->hasil['hasil']->va == '')
                                                Nomor Virtual Account : 888 276 {{ $calon->uruts }} 0
                                            @else
                                                Nomor Virtual Account : 888 876 {{ $calon->uruts }} 1
                                            @endif --}}
                                            @php
                                                $va_unit = 0;
                                                if(substr($calon->uruts, 4, 2) == '31'){
                                                    $va_unit = '011';
                                                }
                                                if(substr($calon->uruts, 4, 2) == '32'){
                                                    $va_unit = '012';
                                                }
                                                if(substr($calon->uruts, 4, 2) == '33'){
                                                    $va_unit = '013';
                                                }
                                                if(substr($calon->uruts, 4, 2) == '34'){
                                                    $va_unit = '014';
                                                }
                                            @endphp
                                            Nomor Virtual Account : 8600 {{ $va_unit }} {{ $calon->uruts }}
                                        </td>
                                    </tr>
                                @else
                                    OKE
                                @endif
                            @endif
                            @if(substr($calon->uruts, 4, 2) == '33' || substr($calon->uruts, 4, 2) == '34')
                                @if($calon->tahap == 9)
                                    <tr>
                                        <td><span class="mdi mdi-email-check"></span></td>
                                        <td>Username Chromebook : <b>{{ $chromebook['username'] ?? '-' }} </b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="mdi mdi-key-outline"></span></td>
                                        <td>Password Chromebook : <b>{{ $chromebook['password'] ?? '-' }} </b></td>
                                    </tr>
                                @endif
                            @endif
                            @if($calon->inggris <> 'Kosong')
                            <tr>
                                <td><span class="mdi mdi-note-multiple"></span></td>
                                <td>English Placement Test :</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Username</td>
                                            <td>:</td>
                                            <td>{{ $calon->inggris['username'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td>:</td>
                                            <td>{{ $calon->inggris['password'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Access Code</td>
                                            <td>:</td>
                                            <td>{{ $calon->inggris['access_code'] }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
                <div class="inox-left-sd">
                    <div class="widget-tabs-int" style="font-size: 0.9rem">
                        {{-- <div class="tab-hd">
                        <h2>Tabs With animations</h2>
                        <p>You may add optional animation classes to animate the tab panes when switching. Please refer the Animations page to get all the available classes <a target="_blank" href="https://daneden.github.io/animate.css/">Click Here</a>.</p>
                        </div> --}}
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                @include('user.partials.detail_ket')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>