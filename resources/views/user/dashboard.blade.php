@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-3 p-1 mt-2">
            <a href="tambahcalon" class="btn btn-success btn-lg"><i class="fas fa-user-plus"> </i><b> Tambah Calon Siswa </b></a>
        </div>
    </div>
    @foreach($calons as $calon)
    <div style="border-bottom: 2px solid grey" class="row justify-content-center mb-4">
        <div class="col-md-5 mb-3">
            <div class="card h-100">
                <div class="card-header white" class="'bg-'{{ $calon->gelnya->unitnya->catnya->name }}' card-'{{ $calon->gelnya->unitnya->catnya->name }}'-outline'">
                    <h5>Data Calon Peserta - {{ $calon->gelnya->unitnya->name }}</h5>
                    <div class="card-tools">
                        <!-- <router-link to="'/editcalon/'+$calon->id" class="btn btn-sm btn-warning"><i class="fas fa-user-edit"> </i><b> Edit </b></router-link> -->
                    </div>
                </div>
                <div class="card-body box-profile">
                    <!-- <div class="text-center">
                        <img src="/img/logo.png" class="profile-user-img img-fluid img-circle" alt="Logo NF">
                    </div> -->
                    <h3 class="profile-username text-center text-uppercase">{{ $calon->name }}</h3>
                    <p class="text-muted text-center">{{ $calon->uruts }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Tempat, Tanggal lahir</b> <a class="float-right">{{ $calon->tempat_lahir }}, {{ $calon->tgl_lahir  }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Jenis Kelamin</b> <a class="float-right">{{ $calon->kelamin }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Kelas Tujuan</b> <a class="float-right">Kelas {{ $calon->kelasnya->name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Daftar</b> <a class="float-right">{{ $calon->tgl_daftar  }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-3">
            <div class="card h-100">
            <div class="card-header p-2" class="'bg-'+calon->gelnya->unitnya->catnya->name+' card-'+calon->gelnya->unitnya->catnya->name+'-outline'">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link dashboard"
                            href="'#daftar'+$calon->id" data-toggle="tab">
                            Pendaftaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dashboard"
                            class="$calon->status == 1 ? 'active' : ''"
                            href="'#seleksi'+$calon->id" data-toggle="tab">
                            Seleksi
                        </a>
                        <a class="nav-link dashboard"
                            href="'#seleksi'+$calon->id" data-toggle="tab">
                            Seleksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dashboard"
                            class="$calon->hasil->hasil == 'Kosong' ? 'disabled' : 'active'"
                            href="'#pengumuman'+$calon->id" data-toggle="tab">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dashboard"
                            class="$calon->hasil->tagihan == 'Kosong' || $calon->hasil->hasil->lulus !== 1 ? 'disabled' : ''"
                            href="'#daul'+$calon->id" data-toggle="tab">Daftar Ulang</a>
                    </li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane"
                        class="$calon->status == 0 ? 'active' : ''"
                        id="'daftar'+$calon->id">
                        <div class="clearfix text-center">
                            <h3>Biaya Pendaftaran PSB</h3>
                            <hr>
                            <h1>{{ $calon->biayates->biayanya->biaya  }}</h1>
                            <hr>
                            <p>Dibayarkan melalui rekening Virtual Account Bank Syariah Mandiri (BSM):</p>
                            <h3><b>{{ $calon->uruts }}</b></h3>
                            Paling lambat pembayaran dilakukan pada tanggal : <b>{{ $calon->biayates->expired }}</b>
                            <a href="'biayatesPDF/'+ $calon->id " class="btn btn-success mt-3">Cetak Tata Cara Pembayaran</a>
                        </div>
                    </div>
                    <div class="tab-pane"
                        class="$calon->status == 1 && $calon->hasil->hasil == 'Kosong' ? 'active' : 'disabled'"
                        id="'seleksi'+$calon->id">
                        <ul class="timeline timeline-inverse">
                            <li class="time-label">
                                <a href="'/seleksiPDF/'+ $calon->id " class="$calon->status == 1" class="btn btn-success">Cetak Kartu Seleksi</a>
                            </li>
                            <li>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Tes Seleksi ( <b> $calon->jadwal->seleksi </b> )</h3>
                                    <div class="timeline-body">
                                        <p>
                                            Tahapan Tes terdiri dari :
                                            <ul>
                                                <li class="calon->gelnya->unitnya->catnya->name == 'SMP' || calon->gelnya->unitnya->catnya->name == 'SMA'">Tes Akademik Siswa</li>
                                                <li>Tes Psikologi</li>
                                                <li>Tes Kemampuan Berbahasa Inggris</li>
                                                <li class="calon->gelnya->unitnya->catnya->name == 'SMP' || calon->gelnya->unitnya->catnya->name == 'SMA'">Tes Wawancara Siswa</li>
                                                <li>Tes Wawancara Orang Tua (<b>Wajib dihadiri oleh kedua Orang Tua</b>)</li>
                                                <li class="calon->gelnya->unitnya->catnya->name == 'SMP' || calon->gelnya->unitnya->catnya->name == 'SMA'">
                                                    Pelaksanaan Tes akan dimulai pukul 07.00 sampai dengan 15.00
                                                </li>
                                                <li class="calon->gelnya->unitnya->catnya->name == 'SD'">
                                                    Pelaksanaan Tes akan dimulai pukul 07.30 sampai dengan 09.30 atau pada pukul 09.30 sampai dengan 11.30 (akan dikonfirmasi ulang oleh panitia).
                                                </li>
                                                <li class="calon->gelnya->unitnya->catnya->name == 'TK'">
                                                    Pelaksanaan Tes akan dimulai pukul 07.30 sampai dengan 10.00
                                                </li>
                                            </ul>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane"
                        class="$calon->hasil->hasil == 'Kosong' ? 'disabled' : 'active'"
                        id="'pengumuman'+$calon->id">
                        <div class="clearfix text-center">
                            <h3>Pengumuman</h3>
                            <hr>
                            <p>Berdasarkan keputusan panitia PPDB SIT Nurul Fikri menyatakan:</p>
                            <h2 class="$calon->hasil->hasil->lulus === 1"><b>Diterima</b></h2>
                            <h2 class="$calon->hasil->hasil->lulus === 2"><b>Cadangan</b></h2>
                            <h2 class><b>Tidak Diterima</b></h2>
                            <hr>
                            <p> $calon->hasil->hasil->catatan </p>
                            <br>
                            <a class="$calon->hasil->hasil->lulus === 1"
                            href="'DaftarUlangPDF/'+$calon->id" class="btn btn-success btn-lg">Cetak Bukti Daftar Ulang</a>
                            <a class="$calon->hasil->hasil->lulus === 1"
                            href="'AmbilSeragamPDF/'+$calon->id" class="btn btn-success btn-lg">Cetak Bukti Pengambilan Seragam</a>

                        </div>
                    </div>
                    <div class="tab-pane"
                        class="$calon->hasil->tagihan == 'Kosong' ? 'disabled' : ''"
                        id="'daul'+$calon->id">
                        <div class="clearfix">
                            <h3 class="text-center">Daftar Ulang</h3>
                            <a class="$calon->hasil->hasil->lulus === 1"
                            href="'DaftarUlangPDF/'+$calon->id" class="btn btn-success btn-lg">Cetak Bukti Daftar Ulang</a>
                            <a class="$calon->hasil->hasil->lulus === 1"
                            href="'AmbilSeragamPDF/'+$calon->id" class="btn btn-success btn-lg">Cetak Bukti Pengambilan Seragam</a>
                            <hr>
                            <table width="100%" class="table-bordered">
                                <tr>
                                    <th width="37%">Keterangan</th>
                                    <th width="23%">Biaya</th>
                                    <td width="40%" rowspan="9">
                                        <ol>
                                            <li>Pembayaran dilakukan pada tanggal : <br><b> $calon->jadwal->keterangan </b></li>
                                            <li>Apabila sampai dengan batas waktu yang ditentukan belum melakukan pembayaran daftar ulang, maka siswa dianggap mengundurkan diri. </li>
                                            <li>Pembayaran melalui Rekening Virtual Bank BJB Syariah :
                                                <center><h3 class="mt-3 red"><u><b> $calon->hasil->hasil->va </b></u></h3>
                                                <p>atas nama: {{ $calon->name }}</p></center>
                                            </li>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dana Pengembangan</td>
                                    <td class="$calon->hasil->tagihan" class="text-right"> $calon->hasil->tagihan->pengembangan </td>
                                </tr>
                                <tr>
                                    <td>Dana Pendidikan</td>
                                    <td class="$calon->hasil->tagihan" class="text-right"> $calon->hasil->tagihan->pendidikan </td>
                                </tr>
                                <tr>
                                    <td>Iuran SPP bulan Juli</td>
                                    <td class="$calon->hasil->tagihan" class="text-right"> $calon->hasil->tagihan->spp </td>
                                </tr>
                                <tr>
                                    <td>Iuran Komite Sekolah / tahun</td>
                                    <td class="$calon->hasil->tagihan" class="text-right"> $calon->hasil->tagihan->komite </td>
                                </tr>
                                <tr>
                                    <td>Dana Seragam</td>
                                    <td class="$calon->hasil->tagihan" class="text-right"> $calon->hasil->tagihan->seragam </td>
                                </tr>
                                <tr>
                                    <td>Potongan</td>
                                    <td class="$calon->hasil->tagihan" class="text-right">( $calon->hasil->tagihan->diskon )</td>
                                </tr>
                                <tr>
                                    <td>Infaq</td>
                                    <td class="$calon->hasil->tagihan" class="text-right"> $calon->hasil->tagihan->infaq </td>
                                </tr>
                                <tr>
                                    <th>TOTAL TAGIHAN</th>
                                    <td class="text-right">
                                        ($calon->hasil->tagihan->pengembangan+
                                        $calon->hasil->tagihan->pendidikan+
                                        $calon->hasil->tagihan->spp+
                                        $calon->hasil->tagihan->komite+
                                        $calon->hasil->tagihan->seragam+
                                        $calon->hasil->tagihan->infaq)-
                                        $calon->hasil->tagihan->diskon</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
