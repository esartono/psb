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
                                <td>1 September 2021</td>
                                <td>1 September 2021</td>
                                <td>1 September 2021</td>
                                <td>1 September 2021</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td class="tebal" colspan="5">Calon siswa asal Sekolah Islam Terpadu Nurul Fikri (Internal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td></td>
                                <td>2 Oktober 2021</td>
                                <td>25 September 2021</td>
                                <td>26 September 2021</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td></td>
                                <td>12 Oktober 2021</td>
                                <td>5 Oktober 2021</td>
                                <td>6 Oktober 2021</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td></td>
                                <td>12 - 16 Oktober 2021</td>
                                <td>5 - 9 Oktober 2021</td>
                                <td>6 - 9 Oktober 2021</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - I (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>16 Oktober 2021</td>
                                <td>16 Oktober 2021</td>
                                <td>9 dan 10 Oktober 2021</td>
                                <td>9, 10 dan 17 Oktober 2021</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>26 Oktober 2021</td>
                                <td>26 Oktober 2021</td>
                                <td>19 Oktober 2021</td>
                                <td>26 Oktober 2021</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>26 - 30 Oktober 2021</td>
                                <td>26 - 30 Oktober 2021</td>
                                <td>19 - 23 Oktober 2021</td>
                                <td>26 - 30 Oktober 2021</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - II (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>13 November 2021</td>
                                <td>13 November 2021</td>
                                <td>14 November 2021</td>
                                <td>14 November 2021</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>23 November 2021</td>
                                <td>23 November 2021</td>
                                <td>23 November 2021</td>
                                <td>23 November 2021</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>23 - 27 November 2021</td>
                                <td>23 - 27 November 2021</td>
                                <td>23 - 27 November 2021</td>
                                <td>23 - 27 November 2021</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - III (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td>18 Desember 2021</td>
                                <td>18 Desember 2021</td>
                                <td>11 Desember 2021</td>
                                <td>11 Desember 2021</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td>28 Desember 2021</td>
                                <td>28 Desember 2021</td>
                                <td>21 Desember 2021</td>
                                <td>21 Desember 2021</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td>28 - 31 Desember 2021</td>
                                <td>28 - 31 Desember 2021</td>
                                <td>21 - 28 Desember 2021</td>
                                <td>21 - 28 Desember 2021</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td class="tebal">Pengukuran Seragam</td>
                                <td colspan="4">
                                    Pengukuran Seragam secara ONLINE bagi calon siswa yang diterima dan sudah melakukan daftar ulang mulai 10 Janauri 2021 di laman web ppdb.nurulfikri.sch.id
                                </td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td class="tebal">Pengambilan Seragam</td>
                                <td colspan="4">
                                    16 – 31 Mei 2022 untuk masing-masing unit akan dijadwalkan kemudian <br>
                                    1 – 30 Juni 2022 Masa Komplain Seragam
                                </td>
                            <tr>
                                <td>8.</td>
                                <td class="tebal">Pembagian Buku</td>
                                <td colspan="4">
                                    21 – 30 Juni 2022, jadwal masing-masing unit akan diinfokan kemudian
                                </td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td class="tebal">Prediksi Awal Masuk</td>
                                <td>11 – 15 Juli 2022</td>
                                <td>11 – 15 Juli 2022</td>
                                <td>11 – 15 Juli 2022</td>
                                <td>11 – 15 Juli 2022</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
