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
                                <td>8 Agustus 2026 <br>pukul 08.00 WIB</td>
                                <td>8 Agustus 2026 <br>pukul 08.00 WIB</td>
                                <td>8 Agustus 2026 <br>pukul 08.00 WIB</td>
                                <td>8 Agustus 2026 <br>pukul 08.00 WIB</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td class="tebal" colspan="5">Calon siswa asal Sekolah Islam Terpadu Nurul Fikri (Internal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td style="text-align: center !important"> - </td>
                                <td> 19 dan 20 September 2026 </td>
                                <td> 12 dan 13 September 2026 </td>
                                <td> 5 dan 6 September 2026 </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td style="text-align: center !important"> - </td>
                                <td> 2 Oktober 2026 </td>
                                <td> 25 September 2026 </td>
                                <td> 18 September 2026 </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td style="text-align: center !important"> - </td>
                                <td> 2 - 6 Oktober 2026</td>
                                <td> 25 - 30 September 2026</td>
                                <td> 18 - 23 September 2026</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - I (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td> 17 Oktober 2026</td>
                                <td> 17 dan 18 Oktober 2026</td>
                                <td> 10, 11, 17 dan 18 Oktober 2026</td>
                                <td> 26, 27 September 2026, <br> 3, 4, 10 dan 11 Oktober 2026</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td> 27 Oktober 2026 </td>
                                <td> 30 Oktober 2026 </td>
                                <td> 30 Oktober 2026 </td>
                                <td> 23 Oktober 2026 </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>27 Oktober - <br>1 November 2026</td>
                                <td>30 Oktober - <br>4 November 2026</td>
                                <td>30 Oktober - <br>4 November 2026</td>
                                <td>23 - 28 Oktober 2024</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - II (Eksternal) <span style="font-weight: 700; color: red">* Akan Dibuka Jika Kuota Tersedia</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>14 November 2026</td>
                                <td>14 November 2026</td>
                                <td>14 November 2026</td>
                                <td>14 November 2026</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>26 November 2026</td>
                                <td>26 November 2026</td>
                                <td>26 November 2026</td>
                                <td>26 November 2026</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>26 November - <br> 1 Desember 2026</td>
                                <td>26 November - <br> 1 Desember 2026</td>
                                <td>26 November - <br> 1 Desember 2026</td>
                                <td>26 November - <br> 1 Desember 2026</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - III (Eksternal) <span style="font-weight: 700; color: red">* Akan Dibuka Jika Kuota Tersedia</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>5 Desember 2026</td>
                                <td>5 Desember 2026</td>
                                <td>5 Desember 2026</td>
                                <td>5 Desember 2026</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>17 Desember 2026</td>
                                <td>17 Desember 2026</td>
                                <td>17 Desember 2026</td>
                                <td>17 Desember 2026</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>17 - 22 Desember 2026</td>
                                <td>17 - 22 Desember 2026</td>
                                <td>17 - 22 Desember 2026</td>
                                <td>17 - 22 Desember 2026</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td class="tebal">Pengukuran Seragam</td>
                                <td>
                                    16 Januari 2027<hr>
                                    Putra : 08.00 - 10.00 WIB<br>
                                    Putri : 10.00 - 12.00 WIB
                                </td>
                                <td>
                                    16 Januari 2027<hr>
                                    Putra : 08.00 - 10.00 WIB<br>
                                    Putri : 10.00 - 12.00 WIB
                                </td>
                                <td>
                                    Putra : <br>23 Januari 2027 (13.00 - 16.00 WIB)<hr>
                                    Putri : <br>30 Januari 2027 (13.00 - 16.00 WIB)
                                </td>
                                <td>
                                    Putra : <br>23 Januari 2027 (08.00 - 12.00 WIB)<hr>
                                    Putri : <br>30 Januari 2027 (08.00 - 12.00 WIB)
                                </td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td class="tebal">Pengambilan Seragam</td>
                                <td colspan="4">
                                    Mulai tanggal 23 Mei 2027 (jadwal akan diinfokan kemudian)<br>
                                    1 - 20 Juni 2027 masa komplain seragam
                                </td>
                            <tr>
                                <td>8.</td>
                                <td class="tebal">Pembagian Buku</td>
                                <td colspan="4">
                                    Siswa baru : 9 Juli 2027, 08.00 - 12.00 WIB, jadwal akan diinfokan kemudian <br>
                                    Siswa mutasi : 10 Juli 2027, jam 08.00 - 12.00 WIB
                                </td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td class="tebal">Prediksi Awal Masuk</td>
                                <td colspan="4">
                                    12 Juli 2027
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
