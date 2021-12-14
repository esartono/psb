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
                <td>{{ $calonsnya->lahir }}</td>
            </tr>
            <tr>
                <th>Kelas Tujuan</th>
                <td>{{ $calonsnya->kelasnya->name }}</td>
            </tr>
            <tr>
                <th>Jadwal Seleksi</th>
                <td>{{ $calonsnya->jadwal->seleksinya }}</td>
            </tr>
        </table>
    </div>
@endsection
