@extends('pdf.2023.template_seragam')

@section('isi')
    <div class="hal1">
        <center>
            <b>Ketentuan dan Prosedur Pengambilan Seragam Calon Siswa Baru <br>
                SEKOLAH ISLAM TERPADU NURUL FIKRI <br>
                tahun ajaran 2023/2024</b>
        </center>
        <p style="margin-top: 18px;">
            <b>Ketentuan umum</b>
            <ol>
                <li>Calon siswa baru yang <b>bisa mengambil seragam</b> adalah yang <b>sudah melunasi biaya</b> pendidikan Penerimaan Siswa Baru.</li>
                <li>Pengambilan seragam <b>dapat diwakilkan</b> dengan membawa <b>Lembar Pengambilan Seragam</b> yang dicetak dari laman nurulfikri.sch.id menu PPDB SIT NF kemudian login menggunakan username dan password masing-masing</li>
                <li>Pengambilan seragam dilakukan di <b>SDIT-SMPIT Nurul Fikri</b> sesuai dengan jadwal yang ditentukan oleh panitia.</li>
                <li>Pengambilan seragam dilaksanakan dengan teknis <b><i>Drive Thru</i>, tidak diperkenankan turun dari kendaraan</b></li>
                <li>Pengambilan seragam dilaksanakan pada hari, tanggal dan jam yang sudah ditentukan.</li>
                <li>Pengambilan seragam dijadwalkan <b>per sesi dengan durasi 30 menit, untuk 15 orang</b>.</li>
                <li><b>Jadwal pengambilan</b> seragam dapat dilihat pada <b>Lembar Pengambilan Seragam</b>, yang dapat dicetak dari laman ppdb.nurulfikri.sch.id</li>
                <li>Bagi ananda yang <b>belum menerima jadwal</b> pembagian seragam, akan dijadwalkan kemudian.</li>
                <li>Informasi lebih lanjut tentang pembagian seragam silakan melalui pesan <i>whats app</i> ke nomor <b>+62 813-3533-0100</b>.</li>
            </ol>
        </p>
        <p><b>Ketentuan Komplain Seragam</b></p>
        <ol>
            <li>Dalam kemasan seragam sudah tertera jenis dan jumlah paket seragam yang dibagikan, serta petunjuk pencucian pertama.</li>
            <li>Silakan bapak/ibu memeriksa jumlah seragam yang sudah diterima, mohon dipastikan sesuai dengan jumlah yang tertera pada tabel ceklis seragam.</li>
            <li>Silakan bapak/ibu memeriksa kondisi seragam yang diterima, dalam kondisi tidak cacat.</li>
            <li><b>Masa komplain seragam</b> dapat dilakukan selambat-lambatnya <b>7 hari kerja</b> setelah seragam diterima dengan mengisi link berikut https://bit.ly/Komplain-Seragam-SITNF</li>
            <li>Seragam yang dikomplain, silakan <b>dikembalikan</b> ke Toko Sekolah, selambat-lambatnya 7 hari setelah pengambilan seragam.</li>
            <li>Jika seragam yang dikomplain tersedia di Toko sekolah, bapak/ibu bisa langsung menukar seragam yang dikomplain dengan seragam yang tersedia.</li>
            <li>Jika seragam yang dikomplain tidak tersedia di Toko sekolah, mohon bapak/ibu menunggu untuk proses produksi sesuai dengan jenis seragam yang dikomplain selambat-lambatnya 10 hari kerja setelah seragam yang dikomplain diterima oleh Toko Sekolah.</li>
            <li>Pengambilan penukaran seragam yang dikomplain, dengan menyerahkan kembali tanda terima seragam yang dikomplain.</li>
            <li>Toko Sekolah, berlokasi di SDIT-SMPIT Nurul Fikri, Jam Operasional 07.30 – 16.00 WIB.</li>
        </ol>
    </p>
    <div class="page-break"></div>
    <div class="hal2">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <center>
            <b>
                LEMBAR PENGAMBILAN SERAGAM <br>
                CALON SISWA BARU <br>
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
                <td>Ketersediaan Seragam</td>
                <td>
                    @if($seragam->siap === 'SIAP') SIAP @endif
                    @if($seragam->siap === 'BELUM') BELUM @endif
                </td>
            </tr>
            <tr>
                <td colspan="2"><b><br>Jadwal Pengambilan Seragam</b><br></td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>{{ $seragam->hari }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>{{ $seragam->tanggal }}</td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>{{ $seragam->jam }}</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>SDIT - SMPIT Nurul Fikri</td>
            </tr>
        </table>
        <p>Silahkan cetak formulir ini sebagai bukti dalam proses pengambilan seragam</p>
        <table class="ttd">
            <tr>
                <td>Petugas Pemeriksa</td>
                <td width="30%"></td>
                <td>Petugas Pembagian Seragam</td>
            </tr>
            <tr>
                <td>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>
                    Tanda tangan dan Stempel
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
