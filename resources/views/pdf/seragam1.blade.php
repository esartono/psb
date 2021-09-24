@extends('pdf.template_seragam')

@section('isi')
        <center>
            <b>
                Ketentuan Pengambilan Seragam Calon Siswa Baru <br>
                SEKOLAH ISLAM TERPADU NURUL FIKRI <br>
            </b>
        </center>
        <br>
        <p>
            <b>Ketentuan umum</b>
            <ol>
                <li>Calon siswa baru yang bisa mengambil seragam adalah yang <b>sudah melunasi biaya pendidikan</b> Penerimaan Siswa Baru.</li>
                <li>Pengambilan seragam dapat diwakilkan dengan membawa <b>Lembar Pengambilan Seragam</b> yang dicetak dari laman nurulfikri.sch.id menu PPDB SIT NF kemudian login menggunakan username dan password masing-masing</li>
                <li>Pengambilan seragam dilakukan di <b>SD-SMP Nurul Fikri</b> sesuai dengan jadwal yang ditentukan oleh panitia.</li>
                <li>Proses pengambilan seragam tetap memperhatikan ketentuan <b>protokol kesehatan pencegahan penularan covid-19.</b></li>
                <li>Petugas yang terlibat dalam pembagian seragam, melaksanakan standar sebagai berikut:
                    <ul>
                        <li>Memakai masker</li>
                        <li>Mengenakan sarung tangan</li>
                        <li>Mengenakan <i>Face Sheild</i></li>
                        <li>Menjaga jarak</li>
                        <li>Tidak berkerumun</li>
                    </ul>
                </li>
                <li>Pengambilan seragam dilaksanakan dengan teknis <b><i>Drive Thru</i>, dan tidak diperkenankan turun dari kendaraan</b></li>
                <li>Pengambilan seragam dilaksanakan pada hari, tanggal dan jam yang telah ditentukan</li>
                <li>Pengambilan seragam dijadwalkan <b>1 sesi durasi 30 menit, untuk 10 orang</b>.</li>
                <li><b>Jadwal pengambilan</b> seragam dapat dilihat pada <b>Lembar Pengambilan Seragam</b> yang dapat dicetak dari laman <b>nurulfikri.sch.id</b> pada menu PPDB SIT NF (login menggunakan username dan password masing-masing) mulai tanggal <b>28 Mei 2021</b>.</li>
                <li>Bagi ananda yang belum menerima jadwal pembagian, akan dijadwalkan kemudian.</li>
                <li>Komplain seragam dapat dilakukan selambat-lambatnya <b>7 hari kerja</b> setelah pengambilan seragam, dengan mengkonfirmasi melalui nomor <b>+62 813-8809-6733</b></li>0
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
        <br>
        <center>
            <b>
                PROSEDUR PENGAMBILAN SERAGAM <br>
                SEKOLAH ISLAM TERPADU NURUL FIKRI
            </b>
        </center>
        <br>
        <ol>
        <p><b>Pos 1: Pintu Gerbang Utama (2 orang)</b></p>
            <li>Petugas keamanan melakukan <b>pengukuran suhu tubuh</b> siswa atau orangtua yang akan mengambil seragam.</li>
            <li>Petugas keamanan yang bertugas pintu gerbang utama melalui <i>Handy Talky</i> <b>menyampaikan nama calon siswa yang akan mengambil seragam</b> kepada petugas pembagian.</li>
            <li>Petugas keamanan yang bertugas di areal parkir depan loby SDIT NF, <b>menjaga antrian kendaraan atau orangtua</b> yang akan mengambil seragam (<b>2 orang</b>).</li>
            <li>Antrian kendaraan dibatasi sampai dengan sisi pagar loby SDIT Nurul Fikri.</li>
        <br>
        <br>
        <p><b>Pos 2: Samping Gedung Penunjang (2 orang)</b></p>
            <li>Petugas pemeriksa bukti daftar ulang seragam <b>memeriksa bukti daftar ulang</b> dan memastikan bahwa calon siswa yang akan mengambil seragam sudah melunasi biaya daftar ulang</li>
            <li>Jika orangtua tidak membawa lembar pengambilan seragam, maka petugas pos 2 <b>mencetak lembar pengambilan seragam</b> dari laman <b>nurulfikri.sch.id</b> pada menu PPDB SIT NF</li>
            <li>Petugas memberikan paraf dan stempel pada form daftar ulang.</li>
        <br>
        <br>
        <p><b>Pos 3: Pengambilan Seragam (4 orang)</b></p>
            <li>Petugas pembagian seragam <b>menyiapkan seragam</b> sesuai nama yang akan mengambil seragam.</li>
            <li>Orangtua menyerahkan lembar pengambilan seragam <b>yang sudah distempel dan paraf</b> oleh petugas pemeriksa.</li>
            <li>Petugas pembagian seragam <b>memberikan seragam</b> sesuai nama yang tertera pada bukti daftar ulang.</li>
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
        <center>
            <b>
                LEMBAR PENGAMBILAN SERAGAM <br>
                CALON SISWA BARU <br>
                SEKOLAH ISLAM TERPADU NURUL FIKRI
            </b>
        </center>
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
                <td>Status Pembayaran Daftar Ulang</td>
                <td>{{ $seragam->lunas_daul }}</td>
            </tr>
            <tr>
                <td>Ketersediaan Seragam</td>
                <td>
                    @if($seragam->siap === 'SIAP') SIAP @endif
                    @if($seragam->siap === 'BELUM') BELUM @endif
                </td>
            </tr>
            <tr>
                <td colspan="2"><b>Jadwal Pengambilan Seragam</b></td>
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
