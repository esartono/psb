@extends('front.template1')

@section('isi')
<style type="text/css">

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
                                <td>1 September 2023</td>
                                <td>1 September 2023</td>
                                <td>1 September 2023</td>
                                <td>1 September 2023</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td class="tebal" colspan="5">Calon siswa asal Sekolah Islam Terpadu Nurul Fikri (Internal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td style="text-align: center !important"> - </td>
                                <td>30 September 2023</td>
                                <td>23 September 2023</td>
                                <td>23 dan 24 September 2023</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td style="text-align: center !important"> - </td>
                                <td>10 Oktober 2023</td>
                                <td>3 Oktober 2023</td>
                                <td>4 Oktober 2023</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td style="text-align: center !important"> - </td>
                                <td>10 - 15 Oktober 2023</td>
                                <td>3 - 8 Oktober 2023</td>
                                <td>4 - 9 Oktober 2023</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - I (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>14 Oktober 2023</td>
                                <td>7 dan 21 Oktober 2023</td>
                                <td>21 dan 22 Oktober 2023</td>
                                <td>8, 14 dan 15 Oktober 2023</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>24 Oktober 2023</td>
                                <td>17 Oktober 2023</td>
                                <td>31 Oktober 2023</td>
                                <td>24 Oktober 2023</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>24 - 29 Oktober 2023</td>
                                <td>17 - 22 Oktober 2023</td>
                                <td>31 Oktober - 5 November 2023</td>
                                <td>24 - 29 Oktober 2023</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - II (Eksternal) <span style="font-weight: 700; color: red">* Akan Dibuka Jika Kuota Tersedia</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>18 November 2023</td>
                                <td>11 November 2023</td>
                                <td>18 November 2023</td>
                                <td>18 November 2023</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>23 November 2023</td>
                                <td>21 November 2023</td>
                                <td>27 November 2023</td>
                                <td>27 November 2023</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>20 - 24 November 2023</td>
                                <td>21 - 26 November 2023</td>
                                <td>27 - 30 November 2023</td>
                                <td>27 - 30 November 2023</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - III (Eksternal) <span style="font-weight: 700; color: red">* Akan Dibuka Jika Kuota Tersedia</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>16 Desember 2023</td>
                                <td>16 Desember 2023</td>
                                <td>9 Desember 2023</td>
                                <td>9 Desember 2023</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>20 Desember 2023</td>
                                <td>21 Desember 2023</td>
                                <td>19 Desember 2023</td>
                                <td>19 Desember 2023</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>20 - 24 Desember 2023</td>
                                <td>21 - 26 Desember 2023</td>
                                <td>19 - 24 Desember 2023</td>
                                <td>19 - 24 Desember 2023</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td class="tebal">Pengukuran Seragam</td>
                                <td>
                                    13 Januari 2024<br>
                                    Putra : 08.00 - 10.00<br>
                                    Putri : 10.00 - 12.00
                                </td>
                                <td>
                                    13 Januari 2024<br>
                                    Putra : 08.00 - 10.00<br>
                                    Putri : 10.00 - 12.00
                                </td>
                                <td>
                                    Putra : 20 Januari 2024 (13.00 - 16.00)<br>
                                    Putri : 27 Januari 2024 (13.00 - 16.00)
                                </td>
                                <td>
                                    Putra : 20 Januari 2024 (08.00 - 12.00)<br>
                                    Putri : 27 Januari 2024 (08.00 - 12.00)
                                </td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td class="tebal">Pengambilan Seragam</td>
                                <td colspan="4">
                                    Mulai tanggal 1 Juni 2024 (jadwal akan diinfokan kemudian)<br>
                                    1 - 30 Juni 2024 masa komplain seragam
                                </td>
                            <tr>
                                <td>8.</td>
                                <td class="tebal">Pembagian Buku</td>
                                <td colspan="4">
                                    Siswa baru : 22 Juni 2024, 08.00 - 16.00, jadwal akan diinfokan kemudian <br>
                                    Siswa mutasi : 13 Juli 2024, jam 08.00 - 16.00 WIB
                                </td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td class="tebal">Prediksi Awal Masuk</td>
                                <td colspan="4">
                                    15 Juli 2024
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="4">10.</td>
                                <td class="tebal" colspan="5">
                                    Seleksi susulan setelah seleksi Eksternal III, dilaksanakan sepekan sekali dengan jadwal sebagai berikut: <br><span style="font-weight: 700; color: red">* Akan Dibuka Jika Kuota Tersedia</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important">TK</td>
                                <td style="text-align: center !important">Jumat</td>
                                <td>Jam 10.00 - 12.00</td>
                                <td colspan="2">Di TKIT Nurul Fikri atau Online</td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important">SD</td>
                                <td style="text-align: center !important">Kamis</td>
                                <td>Jam 08.00 - 12.00</td>
                                <td colspan="2">Di SDIT Nurul Fikri atau Online</td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important">SMP dan SMA</td>
                                <td style="text-align: center !important">Jumat</td>
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
