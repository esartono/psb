@extends('front.template1')

@section('isi')
<style type="text/css">

    body {
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
    td:nth-child(3), td:nth-child(4), td:nth-child(5), td:nth-child(6), td:nth-child(7) {
        text-align: center;
    }
    .khusus td{
        text-align: left;
    }
    .spesial {
        border: 0px !important;
    }
    .spesial td{
        border: 0px !important;
        text-align: left;
        padding: 0 5px;
    }
    .khusus td:nth-child(3){
        text-align: center;
    }

</style>
<section class="banner-area relative">
    <div class="container">
        <div class="section-top-border justify-content-center">
            <h3 class="mt-60 mb-2 text-white">Biaya PPDB SIT Nurul Fikri</h3>
            <h4 class="mb-20 text-white">Tahun Ajaran {{ $tp }}</h4>
            <div class="progress-table-wrap">
                <div class="progress-table" style="padding: 25px">
                    <p>A. Biaya Pendaftaran dan Seleksi</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Pendaftar</th>
                                <th>TK</th>
                                <th>SD</th>
                                <th>SMP</th>
                                <th>SMA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Asal Non SIT Nurul Fikri</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Asal SIT Nurul Fikri</td>
                                <td style="background-color: grey">-</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Anak Pegawai SIT Nurul Fikri</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="mt-40">B. Biaya Pendidikan (Daftar Ulang)</p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Komponen PPDB</th>
                                <th>PG / TK A</th>
                                <th>TK B</th>
                                <th>SD</th>
                                <th>SMP</th>
                                <th>SMA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> - </td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                                <td>Belum tersedia</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="mt-40">C. Tambahan Biaya Untuk Siswa dengan Penanganan Lanjutan (Khusus Pendaftar SD)</p>
                    <table class="table table-bordered table-striped khusus">
                        <thead>
                            <tr>
                                <th>Komponen Biaya</th>
                                <th>Kategori</th>
                                <th>Biaya</th>
                                <th>Include</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pendaftaran</td>
                                <td>Semua Kategori</td>
                                <td>Belum tersedia</td>
                                <td>Assessment Lanjutan</td>
                            </tr>
                            <tr>
                                <td>SPP Bulanan</td>
                                <td>Kategori A</td>
                                <td>Belum tersedia</td>
                                <td>PPI</td>
                            </tr>
                            <tr>
                                <td>SPP Bulanan</td>
                                <td>Kategori B</td>
                                <td>Belum tersedia</td>
                                <td>PPI dan Terapi</td>
                            </tr>
                            <tr>
                                <td>Biaya tambahan perbulan</td>
                                <td>Terapi Khusus</td>
                                <td>Belum tersedia</td>
                                <td>per pertemuan per Terapi</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="spesial">
                        **Keterangan : <br>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>Kategori A</td>
                            <td>:</td>
                            <td>Anak dengan hambatan belajar ringan</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Kategori B</td>
                            <td>:</td>
                            <td>Anak dengan hambatan belajar sedang (<i>Slow Learner</i>)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>PPI</td>
                            <td>:</td>
                            <td>Program Pembelajaran Individual</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
