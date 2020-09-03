@extends('pdf.template')

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
                <th colspan="2" align="center">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($calonsnya->uruts)) !!} ">
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
                <th>Asal Sekolah</th>
                <td>{{ $calonsnya->asal_sekolah }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 2px !important; text-align: center">
                    <h2>Kartu Wajib dibawa saat tes seleksi</h2>
                    @switch($calonsnya->gelnya->unitnya->catnya->name)
                        @case('TK')
                            <p>Jam 07.30 - 10.00 WIB di TKIT Nurul Fikri</p>
                            @break
                        @case('SMP')
                            <p>Jam 07.00 - 15.00 WIB di SMPIT Nurul Fikri</p>
                            @break
                        @case('SMA')
                            <p>Jam 07.00 - 15.00 WIB di SMAIT Nurul Fikri</p>
                            @break
                        @default
                    @endswitch
                </td>
            </tr>
        </table>
    </div>
    <!-- <div class="page-break"></div>
    <div class="hal2">
        @include('pdf.teskesehatan')
    </div> -->
@endsection
