@extends('front.template1')

@section('isi')
<style>
    body, b {
        color: black
    }
    table, th, td {
        border: 1px solid black !important;
    }
    th {
        background-color: aquamarine;
        font-weight: 800;
        color: black;
        text-align: center;
    }
    td:first-child {
        text-align: center;
    }
    td:nth-child(2){
        width: 200px !important;
    }
    .tebal {
        font-weight: 800;
    }
</style>
<section class="banner-area relative">
    <div class="container">
        <div class="section-top-border justify-content-center">
            <h3 class="mt-30 mb-2 text-white">Jadwal PPDB SIT Nurul Fikri</h3>
            <h4 class="mb-20 text-white">Tahun Ajaran {{ $tp }}</h4>
            <div class="progress-table-wrap">
                <div class="progress-table" style="padding: 25px">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kegiatan</th>
                                <th>TK</th>
                                <th>SD</th>
                                <th>SMP</th>
                                <th>SMA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td class="tebal">Pendaftaran Online</td>
                                <td>1 September 2022</td>
                                <td>1 September 2022</td>
                                <td>1 September 2022</td>
                                <td>1 September 2022</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td class="tebal" colspan="5">Calon siswa asal Sekolah Islam Terpadu Nurul Fikri (Internal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td></td>
                                <td>1 Oktober 2022</td>
                                <td>24 September 2022</td>
                                <td>25 September 2022</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td></td>
                                <td>11 Oktober 2022</td>
                                <td>4 Oktober 2022</td>
                                <td>5 Oktober 2022</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td></td>
                                <td>11 - 16 Oktober 2022</td>
                                <td>4 - 9 Oktober 2022</td>
                                <td>5 - 10 Oktober 2022</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - I (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>15 Oktober 2022</td>
                                <td>8 Oktober 2022</td>
                                <td>15 dan 16 Oktober 2022</td>
                                <td>8 dan 9 Oktober 2022</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>25 Oktober 2022</td>
                                <td>18 Oktober 2022</td>
                                <td>25 Oktober 2022</td>
                                <td>18 Oktober 2022</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>25 - 30 Oktober 2022</td>
                                <td>18 - 23 Oktober 2022</td>
                                <td>25 - 30 Oktober 2022</td>
                                <td>18 - 23 Oktober 2022</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - II (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>19 November 2022</td>
                                <td>12 November 2022</td>
                                <td>13 November 2022</td>
                                <td>13 November 2022</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>24 November 2022</td>
                                <td>22 November 2022</td>
                                <td>23 November 2022</td>
                                <td>23 November 2022</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>24 - 30 November 2022</td>
                                <td>22 - 27 November 2022</td>
                                <td>23 - 28 November 2022</td>
                                <td>23 - 28 November 2022</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - III (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>17 Desember 2022</td>
                                <td>17 Desember 2022</td>
                                <td>18 Desember 2022</td>
                                <td>18 Desember 2022</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>27 Desember 2022</td>
                                <td>27 Desember 2022</td>
                                <td>27 Desember 2022</td>
                                <td>27 Desember 2022</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>27 - 31 Desember 2022</td>
                                <td>27 - 31 Desember 2022</td>
                                <td>27 - 31 Desember 2022</td>
                                <td>27 - 31 Desember 2022</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td class="tebal">Pengukuran Seragam</td>
                                <td colspan="4">
                                    Pengukuran Seragam secara ONLINE bagi calon siswa yang diterima dan sudah melakukan daftar ulang mulai 10 Janauri 2022 di laman web ppdb.nurulfikri.sch.id
                                </td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td class="tebal">Pengambilan Seragam</td>
                                <td colspan="4">
                                    16 – 31 Mei 2023 (jadwal akan diinfokan kemudian) <br>
                                    1 – 30 Juni 2023 (Masa Komplain Seragam)
                                </td>
                            <tr>
                                <td>8.</td>
                                <td class="tebal">Pembagian Buku</td>
                                <td colspan="4">
                                    Siswa baru : 24 Juni 2023, 08.00 - 16.00, jadwal akan diinfokan kemudian <br>
                                    Siswa mutasi : 15 Juli 2023, jam 08.00 - 16.00 WIB
                                </td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td class="tebal">Prediksi Awal Masuk</td>
                                <td colspan="4">
                                    11 – 15 Juli 2023
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="4">10.</td>
                                <td class="tebal" colspan="5">
                                    Seleksi susulan setelah seleksi Eksternal III, dilaksanakan sepekan sekali dengan jadwal sebagai berikut:
                                </td>
                            </tr>
                            <tr>
                                <td>TK</td>
                                <td>Kamis</td>
                                <td>Jam 08.00 - 12.00</td>
                                <td colspan="2">Di TKIT Nurul Fikri atau Online</td>
                            </tr>
                            <tr>
                                <td>SD</td>
                                <td>Kamis</td>
                                <td>Jam 08.00 - 12.00</td>
                                <td colspan="2">Di SDIT Nurul Fikri atau Online</td>
                            </tr>
                            <tr>
                                <td>SMP dan SMA</td>
                                <td>Sabtu</td>
                                <td>Jam 08.00 - 12.00</td>
                                <td colspan="2">Di SMPIT Nurul Fikri atau Online</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
