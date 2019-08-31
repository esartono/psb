@extends('pdf.template')

@section('isi')
        <p>
        <b><i>Assalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
        Terimakasih anda telah melakukan pendaftaran calon siswa baru SIT Nurul Fikri. Ini merupakan tahap awal dari Pendaftaran Penerimaan Siswa Baru SIT Nurul Fikri.
        Berikut data yang telah Anda isikan :
        </p>
        <table class="biodata">
            <tr>
                <th width="30%">Nama Lengkap</th>
                <td>{{ $calonsnya->name }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $calonsnya->kelamin }}</td>
            </tr>
            <tr>
                <th>Tempat, Tanggal Lahir</th>
                <td>{{ $calonsnya->tempat_lahir }}, {{ date('d M Y', strtotime($calonsnya->tgl_lahir)) }}</td>
            </tr>
            <tr>
                <th>Kelas Tujuan</th>
                <td>{{ $calonsnya->kelasnya->name }}</td>
            </tr>
        </table>
        <br>
        <center>Nomor pendaftarannya adalah : </center>
        <table class="kotak">
            <tr>
                <td>{{ $calonsnya->uruts }}</td>
            </tr>
        </table>
        <p>Untuk melanjutkan proses pendaftaran, silakan melunasi biaya pendaftaran sejumlah:
            Rp. {{ number_format($calonsnya->biayates->biayanya->biaya) }},-, 
            batas waktu pembayaran sampai tanggal : <b>{{ date('d M Y', strtotime($calonsnya->biayates->expired)) }}</b></p>
        <p>Terima kasih.</p>
@endsection
