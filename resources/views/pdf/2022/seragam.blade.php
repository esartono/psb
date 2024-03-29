@extends('pdf.template_seragam')

@section('isi')
        <center>
            <b>
                Ketentuan dan Prosedur Pengambilan Seragam Calon Siswa Baru <br>
                SEKOLAH ISLAM TERPADU NURUL FIKRI <br>
                Tahun Ajaran 2021/2022
            </b>
        </center>
        <br>
        <p>
            <b>Ketentuan umum</b>
            <ol>
                <li>Calon siswa baru yang bisa mengambil seragam adalah yang sudah melunasi biaya pendidikan.</li>
                <li>Pengambilan seragam dapat diwakilkan dengan membawa Lembar Pengambilan Seragam yang dicetak dari laman nurulfikri.sch.id menu PPDB SIT NF kemudian login menggunakan username dan password masing-masing</li>
                <li>Pengambilan seragam dilakukan di SD-SMP Nurul Fikri sesuai dengan jadwal yang ditentukan oleh panitia.</li>
                <li>Proses pengambilan seragam tetap memperhatikan ketentuan protocol kesehatan pencegahan penularan covid-19</li>
                <li>Petugas yang terlibat dalam pembagian seragam, melaksanakan standar sebagai berikut:
                    <ul>
                        <li>Memakai masker</li>
                        <li>Mengenakan sarung tangan</li>
                        <li>Mengenakan face sheild</li>
                        <li>Sering mencuci tangan</li>
                        <li>Menjaga jarak</li>
                        <li>Tidak berkumpul</li>
                    </ul>
                </li>
                <li>Pengambilan seragam dilaksanakan dengan teknis Drive Thru</li>
                <li>Pengambilan seragam dijadwalkan 1 sesi dengan durasi 30 menit, untuk 10 orang (sesuai dengan jadwal yang telah ditentukan).</li>
            </ol>
        </p>
        <p><b>Prosedur</b></p>
        <ol>
            <b>Pos 1: Pintu Gerbang Utama (2 orang)</b>
            <li>Petugas keamanan melakukan pengukuran suhu tubuh siswa atau orangtua yang akan mengambil seragam.</li>
            <li>Petugas keamanan yang bertugas pintu gerbang utama melalui HT menyampaikan nama kepada petugas pembagian seragam calon siswa yang akan mengambil seragam</li>
            <li>Petugas keamanan yang bertugas di areal parkir depan loby SDIT NF, menjaga antrian kendaraan atau orangtua yang akan mengambil seragam (2 orang).</li>
            <li>Antrian kendaraan dibatasi sampai dengan sisi pagar loby SDIT Nurul Fikri.</li>
        <br>
        <br>
            <b>Pos 2: Kantin, pintu 1 (3 orang)</b>
            <li>Petugas pemeriksa bukti daftar ulang seragam memeriksa bukti daftar ulang dan memastikan bahwa calon siswa yang akan mengambil seragam sudah melunasi biaya daftar ulang</li>
            <li>Jika orangtua tidak membawa bukti daftar ulang, maka petugas pos 2 mencetak bukti daftar ulang dari laman ppdb.nurulfikri.sch.id</li>
            <li>Petugas memberikan paraf dan stempel pada form daftar ulang.</li>
        <br>
        <br>
            <b>Pos 3: Pengambilan Seragam (4 orang)</b>
            <li>Petugas pembagian seragam menyiapkan seragam sesuai nama yang akan mengambil seragam.</li>
            <li>Orangtua menyerahkan bukti daftar ulang yang sudah distempel dan tanda tangan oleh petugas pemeriksa.</li>
            <li>Petugas pembagian seragam memberikan seragam sesuai nama yang tertera pada bukti daftar ulang.</li>
        </ol>
    </div>
    <div class="page-break"></div>
    <div class="hal3">
        <br>
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
        <p>Terima kasih sudah melunasi biaya daftar ulang penerimaan siswa baru SIT Nurul Fikri.</p>
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
                <td colspan="2"><b><br>Jadwal Pengambilan Seragam</b><br><br></td>
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
        <br>
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
