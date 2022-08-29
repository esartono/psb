@extends('emails.template')

@section('isi')
    <div>
        <table class="cardTest" align="center">
            <tr>
                <th colspan="2"  align="center">
                    <h1>KARTU SELEKSI</h1>
                    <h3>{{ $calonsnya->gelnya->unitnya->name }}</h3>
                </th>
            </tr>
            <tr>
                <th colspan="2" align="center" style="padding: 0px !important">
                    <img src="{!!$message->embedData(QrCode::format('png')->size(150)->generate($calonsnya->uruts), 'QrCode.png', 'image/png')!!}">
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
                <td>{{ $calonsnya->tgl_lahir->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <th>Kelas Tujuan</th>
                <td>{{ $calonsnya->kelasnya->name }}</td>
            </tr>
            <tr>
                <th>Tes Seleksi</th>
                <td><b>{{ $calonsnya->jadwal->seleksinya }}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 2px !important; text-align: center"><h2>Kartu Wajib dibawa saat tes seleksi</h2></td>
            </tr>
        </table>
    </div>
@endsection
