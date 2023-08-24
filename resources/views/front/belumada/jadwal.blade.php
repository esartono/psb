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
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td class="tebal" colspan="5">Calon siswa asal Sekolah Islam Terpadu Nurul Fikri (Internal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td></td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td></td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td></td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - I (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - II (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td class="tebal" colspan="5">Calon siswa NON Sekolah Islam Terpadu Nurul Fikri - III (Eksternal)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Seleksi</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pengumuman</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Daftar Ulang</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td class="tebal">Pengukuran Seragam</td>
                                <td colspan="4" class="text-center tebal">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td class="tebal">Pengambilan Seragam</td>
                                <td colspan="4" class="text-center tebal">Belum Tersedia</td>
                            <tr>
                                <td>8.</td>
                                <td class="tebal">Pembagian Buku</td>
                                <td colspan="4" class="text-center tebal">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td class="tebal">Prediksi Awal Masuk</td>
                                <td colspan="4" class="text-center tebal">Belum Tersedia</td>
                            </tr>
                            <tr>
                                <td rowspan="5">10.</td>
                                <td class="tebal" colspan="5">
                                    Seleksi susulan setelah seleksi Eksternal III, dilaksanakan sepekan sekali dengan jadwal sebagai berikut:
                                </td>
                            </tr>
                            <tr>
                                <td>TK</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td colspan="2">Di TKIT Nurul Fikri atau Online</td>
                            </tr>
                            <tr>
                                <td>SD</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td colspan="2">Di SDIT Nurul Fikri atau Online</td>
                            </tr>
                            <tr>
                                <td>SMP</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td colspan="2">Di SMPIT Nurul Fikri atau Online</td>
                            </tr>
                            <tr>
                                <td>SMA</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td class="text-center">Belum Tersedia</td>
                                <td colspan="2">Di SMAIT Nurul Fikri atau Online</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
