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
                                <th>CCEC & TK</th>
                                <th>SD</th>
                                <th>SMP</th>
                                <th>SMA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td class="tebal">Pembukaan Pendaftaran Online</td>
                                <td>10 Agustus 2025 <br>pukul 08.00 WIB</td>
                                <td>10 Agustus 2025 <br>pukul 08.00 WIB</td>
                                <td>10 Agustus 2025 <br>pukul 08.00 WIB</td>
                                <td>10 Agustus 2025 <br>pukul 08.00 WIB</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td class="tebal" colspan="5">Calon siswa asal Sekolah Islam Terpadu Nurul Fikri (Internal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td style="text-align: center !important"> - </td>
                                <td> 20 dan 21 September 2025 </td>
                                <td> 13 dan 14 September 2025 </td>
                                <td> 6 dan 7 September 2025 </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td style="text-align: center !important"> - </td>
                                <td> 2 Oktober 2025 </td>
                                <td> 26 September 2025 </td>
                                <td> 19 September 2025 </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td style="text-align: center !important"> - </td>
                                <td> 2 - 7 Oktober 2025</td>
                                <td> 26 September - <br>1 Oktober 2025</td>
                                <td> 19 - 24 September 2025</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - I (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td> 18 Oktober 2025</td>
                                <td> 18 dan 19 Oktober 2025</td>
                                <td> 5, 11 dan 12 Oktober 2025</td>
                                <td> 27, 28 September 2025, <br> 4 dan 5 Oktober 2025</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td> 24 Oktober 2025 </td>
                                <td> 30 Oktober 2025 </td>
                                <td> 24 Oktober 2025 </td>
                                <td> 17 Oktober 2025 </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>24 - 29 Oktober 2025 </td>
                                <td>30 Oktober - <br>3 November 2025</td>
                                <td>24 - 29 Oktober 2025</td>
                                <td>17 - 22 Oktober 2024</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - II (Eksternal) <span style="font-weight: 700; color: red">* Akan Dibuka Jika Kuota Tersedia</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>22 November 2025</td>
                                <td>15 November 2025</td>
                                <td>15 November 2025</td>
                                <td>1 November 2025</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>27 November 2025</td>
                                <td>25 November 2025</td>
                                <td>25 November 2025</td>
                                <td>12 November 2025</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>27 November - <br> 2 Desember 2025</td>
                                <td>25 - 30 November 2025</td>
                                <td>25 - 30 November 2025</td>
                                <td>12 - 17 November 2025</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - III (Eksternal) <span style="font-weight: 700; color: red">* Akan Dibuka Jika Kuota Tersedia</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>6 Desember 2025</td>
                                <td>6 Desember 2025</td>
                                <td>6 Desember 2025</td>
                                <td>6 Desember 2025</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>15 Desember 2025</td>
                                <td>18 Desember 2025</td>
                                <td>18 Desember 2025</td>
                                <td>18 Desember 2025</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>15 - 20 Desember 2025</td>
                                <td>18 - 23 Desember 2025</td>
                                <td>18 - 23 Desember 2025</td>
                                <td>18 - 23 Desember 2025</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td class="tebal">Pengukuran Seragam</td>
                                <td>
                                    17 Januari 2026<hr>
                                    Putri : 13.00 - 15.00 WIB<br>
                                    Putra : 13.00 - 15.00 WIB
                                </td>
                                <td>
                                    17 Januari 2026<hr>
                                    Putri : 13.00 - 15.00 WIB<br>
                                    Putra : 13.00 - 15.00 WIB
                                </td>
                                <td>
                                    Putri : <br>17 Januari 2026 (08.00 - 10.00 WIB)<hr>
                                    Putra : <br>18 Januari 2026 (08.00 - 10.00 WIB)
                                </td>
                                <td>
                                    Putri : <br>17 Januari 2026 (10.00 - 12.00 WIB)<hr>
                                    Putra : <br>18 Januari 2026 (10.00 - 12.00 WIB)
                                </td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td class="tebal">Pengambilan Seragam</td>
                                <td colspan="4">
                                    Mulai tanggal 23 Mei 2026 (jadwal akan diinfokan kemudian)<br>
                                    1 - 20 Juni 2026 masa komplain seragam
                                </td>
                            <tr>
                                <td>8.</td>
                                <td class="tebal">Pembagian Buku</td>
                                <td colspan="4">
                                    Siswa baru : 9 Juli 2026, 08.00 - 12.00 WIB, jadwal akan diinfokan kemudian <br>
                                    Siswa mutasi : 10 Juli 2026, jam 08.00 - 16.00 WIB
                                </td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td class="tebal">Prediksi Awal Masuk</td>
                                <td colspan="4">
                                    13 Juli 2026
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
