@extends('pdf.template')

@section('isi')
    <div>
        <b><i>Assalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
        <center><h1>MOHON MAAF, MOHON MENUNGGU JADWAL PEMBAGIAN SERAGAM ANDA PADA BATCH BERIKUTNYA.</h1></center>
        <br>
        Penerimaan Peserta Dididk Baru Sekolah Islam Terpadu Nurul Fikri tahun ajaran 2021/2022, untuk data peserta didik adalah sebagai berikut :
        </div>
        <table class="biodata">
            <tr>
                <th width="30%">No. Pendaftaran</th>
                <td>{{ $calonsnya->uruts }}</td>
            </tr>
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
                <td>{{ $calonsnya->tgl_lahir->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <th>Kelas Tujuan</th>
                <td>Kelas {{ $calonsnya->kelasnya->name }}</td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>Tertanda</p>
        <br>
        <br>
        <br>
        <b>Panitia PPDB SIT Nurul Fikri</b>
    </div>
@endsection
