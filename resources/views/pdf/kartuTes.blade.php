<table class="cardTest" align="center">
    <tr>
        <th colspan="2"  align="center">
            <h1 style="margin-bottom: -10px">KARTU SELEKSI</h1>
            <h3>PPDB SIT Nurul Fikri - {{ Auth::user()->tpname }}</h3>
        </th>
    </tr>
    <tr>
        <th colspan="2" align="center" style="background-color: black; color: white; font-size: 16px">
            {{ $calonsnya->gelnya->unitnya->name }}
        </th>
    </tr>
    <tr>
        <th colspan="2" align="center">
            <img class="qrcode" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(120)->margin(0.2)->merge('img/logo.png', .2, true)->generate($calonsnya->uruts)) !!} ">
            <div class="qr">{{ $calonsnya->uruts }} </div>
        </th>
    </tr>
    <tr>
        <th align="left" width="40%">Nama Lengkap</th>
        <td>{{ $calonsnya->name }}</td>
    </tr>
    <tr>
        <th align="left">Jenis Kelamin</th>
        <td>{{ $calonsnya->kelamin }}</td>
    </tr>
    <tr>
        <th align="left">Tempat, Tanggal Lahir</th>
        <td>{{ formatIndo($calonsnya->tgl_lahir) }}</td>
    </tr>
    <tr>
        <th align="left">Kelas Tujuan</th>
        <td>{{ $calonsnya->kelasnya->name }}</td>
    </tr>
    <tr>
        <th align="left">Asal Sekolah</th>
        <td>{{ $calonsnya->asal_sekolah }}</td>
    </tr>
    <tr>
        <th align="left">Jadwal Seleksi</th>
        <td><b>{{ $calonsnya->jadwal->seleksi !== '-'  ? formatIndo($calonsnya->jadwal->seleksi) : "Jadwal belum tersedia" }}</b></td>
    </tr>
</table>
