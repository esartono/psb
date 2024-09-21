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
    tr {
        vertical-align : middle;"
    }
    tr hr {
        margin: 0.5em;
        background-color: black !important;
        border-color: black !important; 
    }
</style>
<section class="banner-area relative">
    <div class="container">
        <div class="section-top-border justify-content-center">
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
                                <td class="tebal">Pembukaan Pendaftaran Online</td>
                                <td>1 September 2024 pukul 07.00 WIB</td>
                                <td>1 September 2024 pukul 07.00 WIB</td>
                                <td>1 September 2024 pukul 07.00 WIB</td>
                                <td>1 September 2024 pukul 07.00 WIB</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td class="tebal" colspan="5">Calon siswa asal Sekolah Islam Terpadu Nurul Fikri (Internal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td style="text-align: center !important"> - </td>
                                <td> 21 September 2024 </td>
                                <td> 21 September 2024 </td>
                                <td> 14 dan 15 September 2024 </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td style="text-align: center !important"> - </td>
                                <td> 2 Oktober 2024 </td>
                                <td> 1 Oktober 2024 </td>
                                <td> 25 September 2024 </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td style="text-align: center !important"> - </td>
                                <td> 2 - 6 Oktober 2024</td>
                                <td> 1 - 5 Oktober 2024</td>
                                <td> 25 - 29 September 2024</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - I (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td> 12 dan 26 Oktober 2024</td>
                                <td> 19 dan 20 Oktober 2024</td>
                                <td> 19 dan 20 Oktober 2024</td>
                                <td> 5, 6, 12 dan 13 Oktober 2024</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td> 17 Oktober 2024 <hr> 30 Oktober 2024 </td>
                                <td> 28 Oktober 2024 </td>
                                <td> 29 Oktober 2024 </td>
                                <td> 22 Oktober 2024 </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>17 - 21 Oktober 2024 <hr> 30 Oktober - 3 November 2024</td>
                                <td>28 Oktober - 1 November 2023</td>
                                <td>29 Oktober 2024 - 2 November 2024</td>
                                <td>22 - 26 Oktober 2023</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - II (Eksternal) <span style="font-weight: 700; color: red">* Akan Dibuka Jika Kuota Tersedia</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>16 November 2024</td>
                                <td>16 November 2024</td>
                                <td>17 November 2024</td>
                                <td>17 November 2024</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>21 November 2024</td>
                                <td>21 November 2024</td>
                                <td>26 November 2024</td>
                                <td>26 November 2024</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>21 - 25 November 2024</td>
                                <td>21 - 25 November 2024</td>
                                <td>26 - 30 November 2024</td>
                                <td>26 - 30 November 2024</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - III (Eksternal) <span style="font-weight: 700; color: red">* Akan Dibuka Jika Kuota Tersedia</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>14 Desember 2024</td>
                                <td>15 Desember 2024</td>
                                <td>15 Desember 2024</td>
                                <td>15 Desember 2024</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>19 Desember 2024</td>
                                <td>23 Desember 2024</td>
                                <td>23 Desember 2024</td>
                                <td>23 Desember 2024</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>20 - 24 Desember 2024</td>
                                <td>23 - 27 Desember 2024</td>
                                <td>23 - 27 Desember 2024</td>
                                <td>23 - 27 Desember 2024</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td class="tebal">Pengukuran Seragam</td>
                                <td>
                                    18 Januari 2025<hr>
                                    Putra : 08.00 - 10.00<br>
                                    Putri : 10.00 - 12.00
                                </td>
                                <td>
                                    18 Januari 2025<hr>
                                    Putra : 08.00 - 10.00<br>
                                    Putri : 10.00 - 12.00
                                </td>
                                <td>
                                    Putra : <br>25 Januari 2025 (13.00 - 16.00)<hr>
                                    Putri : <br>26 Januari 2025 (13.00 - 16.00)
                                </td>
                                <td>
                                    Putra : <br>25 Januari 2025 (13.00 - 16.00)<hr>
                                    Putri : <br>26 Januari 2025 (13.00 - 16.00)
                                </td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td class="tebal">Pengambilan Seragam</td>
                                <td colspan="4">
                                    Mulai tanggal 22 Mei 2025 (jadwal akan diinfokan kemudian)<br>
                                    1 - 30 Juni 2025 masa komplain seragam
                                </td>
                            <tr>
                                <td>8.</td>
                                <td class="tebal">Pembagian Buku</td>
                                <td colspan="4">
                                    Siswa baru : 22 Juni 2025, 08.00 - 16.00, jadwal akan diinfokan kemudian <br>
                                    Siswa mutasi : 13 Juli 2025, jam 08.00 - 16.00 WIB
                                </td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td class="tebal">Prediksi Awal Masuk</td>
                                <td colspan="4">
                                    14 Juli 2025
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
                                <td style="text-align: center !important">Sabtu</td>
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
