{{-- @extends('pdf.2023.template_seragam')

@section('isi')
<div class="hal1"> --}}
    <br>
    <center>
        <b>KETENTUAN PENGGUNAAN CHROMEBOOK <br>
            SEKOLAH ISLAM TERPADU NURUL FIKRI <br>
            Tahun Ajaran - {{ Auth::user()->tpname }}
        </b>
    </center>
    <br>
    <p style="margin-top: 18px;">
    <ol>
        <li style="margin-bottom: 1.5em">Penggunaan chromebook dalam kegiatan pembelajaran SMP IT/SMA IT Nurul Fikri adalah implementasi Program Transformasi Digital yang dilaksanakan di SMP IT/SMA IT Nurul Fikri.</li>
        <li style="margin-bottom: 1.5em">SMP IT/SMA IT Nurul Fikri menyerahkan Chromebook kepada siswa kelas 7 dan kelas 10 tahun ajaran {{ Auth::user()->tpname }} sebagai sarana belajar.</li>
        <li style="margin-bottom: 1.5em">Chromebook diserah terimakan kepada siswa untuk digunakan selama belajar di SMP IT/SMA IT Nurul Fikri dan siswa berkewajiban untuk menjaga dan memelihara chromebook dengan baik.</li>
        <li style="margin-bottom: 1.5em">Siswa hanya dapat menggunakan chrome book dengan akun sekolah yang diberikan selama masih menjadi siswa SMP IT/SMA IT Nurul Fikri. Chromebook digunakan siswa untuk belajar di sekolah maupun di luar sekolah.</li>
        <li style="margin-bottom: 1.5em">Status chromebook bagi siswa adalah DIPINJAMKAN selama belajar di SIT Nurul Fikri, dan tidak diperkenankan dipinjamkan atau dialihkan kepada orang lain. Chrome book menjadi hak milik siswa setelah menamatkan proses pembelajaran di SMP IT/SMA IT Nurul Fikri.</li>
        <li style="margin-bottom: 1.5em">Siswa wajib menjaga kondisi chromebook sebaik mungkin sehingga tidak rusak ataupun hilang.</li>
        <li style="margin-bottom: 1.5em">Jika terjadi chromebook hilang, rusak permanen karena kelalaian, atau rusak karena kecelakaan, maka sekolah tidak menyediakan chromebook pengganti. Siswa harus menyediakan chromebook pengganti dengan biaya mandiri agar tetap dapat mengikuti pembelajaran berbasis digital di sekolah.</li>
    </ol>
    </p>
    </p>
    <div class="page-break"></div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <center>
            <b>
                LEMBAR PENGAMBILAN PERANGKAT PEMBELAJARAN <br>
                CALON SISWA BARU <br>
                SEKOLAH ISLAM TERPADU NURUL FIKRI
                </br>
        </center>
        <br>
        <p style="margin-top: 10px">Terima kasih sudah melunasi biaya daftar ulang penerimaan siswa baru SIT Nurul Fikri.</p>
        <table class="biodata" style="font-size: 90%">
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
            {{-- <tr>
                <td>Kriteria Pendaftaran</td>
                <td>
                    @if($calonsnya->ck_id === 1) Umum @endif
                    @if($calonsnya->ck_id === 2) Siswa SIT NF @endif
                    @if($calonsnya->ck_id === 3) Pegawai SIT NF @endif
                </td>
            </tr> --}}
            <tr>
                <td colspan="2"><b><br>Jadwal Pengambilan Media Pembelajaran</b></td>
            </tr>
            @if($calonsnya->gelnya->unitnya->name == 'SMPIT Nurul Fikri')
                <tr>
                    <td>Hari, Tanggal</td>
                    <td>Sabtu, 23 Mei 2026</td>
                </tr>
                <tr>
                    <td>Jam</td>
                    <td>08.00 - 15.00</td>
                </tr>
            @endif
            @if($calonsnya->gelnya->unitnya->name == 'SMAIT Nurul Fikri')
                <tr>
                    <td>Hari, Tanggal</td>
                    <td>Sabtu, 23 Mei 2026</td>
                </tr>
                <tr>
                    <td>Jam</td>
                    <td>08.00 - 15.00</td>
                </tr>
            @endif
            <tr>
                <td>Tempat</td>
                <td>SDIT - SMPIT Nurul Fikri</td>
            </tr>
            {{-- <tr>
                <td colspan="2"><br><b>Username and Password Chromebook</b></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>username@nurulfikri.sch.id</td>
            </tr>
            <tr>
                <td>Password</td>
                <td>Password <br> <small style="font-size: 75%"><code>*segera lakukan penggantian password default</code></small></td>
            </tr> --}}
            {{-- <tr>
                <td>Serial Number CHROMEBOOK</td>
                <td><b>{{ $siap->chromebook }}</b></td>
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
                    Nama dan Tanda tangan
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
        {{-- @endsection --}}