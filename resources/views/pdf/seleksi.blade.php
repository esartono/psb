@extends('pdf.template')

@section('isi')
    <div>
        <table class="cardTest" align="center">
            <tr>
                <th colspan="2"  align="center">
                    <h1 style="margin-bottom: -10px">KARTU SELEKSI</h1>
                    <h3>PPDB SIT Nurul Fikri - {{ Auth::user()->tpname }}</h3>
                </th>
            </tr>
            <tr>
                <th colspan="2" align="center" style="background-color: black; color: white">
                    {{ $calonsnya->gelnya->unitnya->name }}
                </th>
            </tr>
            <tr>
                <th colspan="2" align="center">
                    <img class="qrcode" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->margin(0.2)->merge('img/logo.png', .2, true)->generate($calonsnya->uruts)) !!} ">
                    <div class="qr">{{ $calonsnya->uruts }} </div>
                </th>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $calonsnya->name }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $calonsnya->kelamin }}</td>
            </tr>
            <tr>
                <th>Tempat, Tanggal Lahir</th>
                <td>{{ formatIndo($calonsnya->tgl_lahir) }}</td>
            </tr>
            <tr>
                <th>Kelas Tujuan</th>
                <td>{{ $calonsnya->kelasnya->name }}</td>
            </tr>
            <tr>
                <th>Asal Sekolah</th>
                <td>{{ $calonsnya->asal_sekolah }}</td>
            </tr>
            <tr>
                <th>Jadwal Seleksi</th>
                <td><b>{{ $calonsnya->jadwal->seleksi !== '-'  ? formatIndo($calonsnya->jadwal->seleksi) : "Jadwal belum tersedia" }}</b></td>
            </tr>
            <tr>
                <th>Lokasi Tes <b>OFFLINE</b></th>
                <td>
                    <b>{{ $calonsnya->gelnya->unitnya->name }} </b><br>
                    {{ $calonsnya->gelnya->unitnya->address }}, Cimanggis Depok
                </td>
            </tr>
        </table>
    </div>
    @if($calonsnya->gel_id == 3)
    <p> Tes Terdiri dari :</p>
    <ol>
        <li>Tes akademik siswa (<i>offline</i>) pada pukul 07.00 - 08.15</li>
        <li>Tes psikologi (<i>offline)</i> pada pukul 08.30 - 12.00</li>
        <li>Wawancara orangtua calon siswa (<i>offline</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
        <li>Wawancara administrasi sekolah (<i>offline</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
        <li>Wawancara calon siswa (<i>offline</i>) pada pukul 13.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
    </ol>
    @endif
    @if($calonsnya->gel_id == 4)
    <p> Tes Terdiri dari :</p>
    <ol>
        <li>Tes akademik siswa (<i>offline dan siswa diwajibkan membawa laptop</i>) pada pukul 07.00 - 08.30</li>
        <li>Tes psikologi (<i>offline)</i> pada pukul 08.45 - 12.00</li>
        <li>Wawancara orangtua calon siswa (<i>offline</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
        <li>Wawancara administrasi sekolah (<i>offline\</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
        <li>Wawancara calon siswa (<i>offline\</i>) pada pukul 13.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
    </ol>
    @endif
    <!-- <div class="page-break"></div>
    <div class="hal2">
        {{-- @include('pdf.teskesehatan') --}}
    </div> -->
@endsection
