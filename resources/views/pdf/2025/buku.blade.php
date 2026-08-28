@extends('pdf.2023.template_seragam')

@section('isi')
    <div class="hal1">
        <br>
        <br>
        <br>
        <center>
            <b>
                LEMBAR PENGAMBILAN BUKU SISWA BARU <br>
                SEKOLAH ISLAM TERPADU NURUL FIKRI
            </br>
        </center>
        <br>
        <p style="margin-top: 10px">Terima kasih sudah melunasi biaya daftar ulang penerimaan siswa baru SIT Nurul Fikri.</p>
        <table class="biodata">
            <tr>
                <td width="40%">Unit Sekolah</td>
                <td>{{ $calonsnya->gelnya->unitnya->name }}</td>
            </tr>
            <tr>
                <td>No. Pendaftaran</td>
                <td>{{ $calonsnya->uruts }}</td>
            </tr>
            <tr>
                <td>Nama Calon Siswa</td>
                <td>{{ $calonsnya->name }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>{{ $calonsnya->kelamin }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>{{ $calonsnya->kelasnya->name }}</td>
            </tr>
            <tr>
                <td>Kriteria Pendaftaran</td>
                <td>
                    @if($calonsnya->ck_id === 1) Umum @endif
                    @if($calonsnya->ck_id === 2) Siswa SIT NF @endif
                    @if($calonsnya->ck_id === 3) Pegawai SIT NF @endif
                </td>
            </tr>
            <tr>
                <td>Ketersediaan Media Pembelajaran</td>
                <td>
                    @if($buku['siap'] === 'SIAP') SIAP @endif
                    @if($buku['siap'] === 'BELUM') BELUM @endif
                </td>
            </tr>
            <tr>
                <td colspan="2"><b><br>Jadwal Pengambilan Media Pembelajaran</b><br></td>
            </tr>
            <tr>
                <td>Hari, Tanggal</td>
                <td>{{ $buku['hari'] }}, {{ $buku['tanggal'] }}</td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>{{ $buku['jam'] }}</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>SDIT - SMPIT Nurul Fikri</td>
            </tr>
            {{-- <tr>
                <td>Serial Number CHROMEBOOK</td>
                <td><b>{{ $buku->chromebook }}</b></td>
            </tr> --}}
        </table>
        <p>Silahkan cetak formulir ini sebagai bukti dalam proses pengambilan media pembelajaran</p>
        <table class="ttd">
            <tr>
                <td>Penerima</td>
                <td width="30%"></td>
                <td>Petugas</td>
            </tr>
            <tr>
                <td>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>
                    Tanda tangan
                </td>
                <td width="30%"></td>
                <td>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>
                    Tanda tangan dan Stempel
                </td>
            </tr>
        </table>
@endsection
