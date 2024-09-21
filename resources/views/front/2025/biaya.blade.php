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
        text-align: right;
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
        text-align: right;
    }

</style>
<section class="banner-area relative">
    <div class="container">
        <div class="section-top-border justify-content-center">
            <div class="progress-table-wrap">
                <div class="progress-table" style="padding: 25px">
                    <p>A. Biaya Pendaftaran dan Seleksi</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Pendaftar</th>
                                <th>CCEC</th>
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
                                <td>Rp. 200,000</td>
                                <td>Rp. 500,000</td>
                                <td>Rp. 650,000</td>
                                <td>Rp. 800,000</td>
                                <td>Rp. 850,000</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Asal SIT Nurul Fikri</td>
                                <td>Rp. 200,000</td>
                                <td>Rp. 500,000</td>
                                <td>Rp. 500,000</td>
                                <td>Rp. 500,000</td>
                                <td>Rp. 500,000</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Anak Pegawai SIT Nurul Fikri</td>
                                <td>Rp. 200,000</td>
                                <td>Rp. 250,000</td>
                                <td>Rp. 325,000</td>
                                <td>Rp. 400,000</td>
                                <td>Rp. 425,000</td>
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
                            @foreach ($biaya as $k=>$b)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $b['komponen'] }}</td>
                                <td>Rp. {{ number_format($b['tka']) }}</td>
                                <td>Rp. {{ number_format($b['tkb']) }}</td>
                                <td>Rp. {{ number_format($b['sd']) }}</td>
                                <td>Rp. {{ number_format($b['smp']) }}</td>
                                <td>Rp. {{ number_format($b['sma']) }}</td>
                            </tr>
                            @endforeach
                            @foreach ($seragam as $k=>$b)
                            <tr>
                                <td>{{ $k+3 }}</td>
                                <td>{{ $b['komponen'] }}</td>
                                <td>Rp. {{ number_format($b['tka']) }}</td>
                                <td>Rp. {{ number_format($b['tkb']) }}</td>
                                <td>Rp. {{ number_format($b['sd']) }}</td>
                                <td>Rp. {{ number_format($b['smp']) }}</td>
                                <td>Rp. {{ number_format($b['sma']) }}</td>
                            </tr>
                            @endforeach
                            <tr><td colspan="8"></td></tr>
                            <tr style="background-color: #76d7c4">
                                <td colspan="2">TOTAL PUTRA</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'tka'))+$seragam[0]['tka']) }}</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'tkb'))+$seragam[0]['tkb']) }}</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'sd'))+$seragam[0]['sd']) }}</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'smp'))+$seragam[0]['smp']) }}</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'sma'))+$seragam[0]['sma']) }}</td>
                            </tr>
                            <tr style="background-color: #85c1e9">
                                <td colspan="2">TOTAL PUTRI</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'tka'))+$seragam[1]['tka']) }}</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'tkb'))+$seragam[1]['tkb']) }}</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'sd'))+$seragam[1]['sd']) }}</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'smp'))+$seragam[1]['smp']) }}</td>
                                <td style="color: black; text-align: right; font-weight: 800;">Rp. {{ number_format(array_sum(array_column($biaya, 'sma'))+$seragam[1]['sma']) }}</td>
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
                                <td>Rp. 500,000</td>
                                <td>Assessment Lanjutan</td>
                            </tr>
                            <tr>
                                <td>SPP Bulanan</td>
                                <td>Kategori A</td>
                                <td>Rp. 200,000</td>
                                <td>PPI</td>
                            </tr>
                            <tr>
                                <td>SPP Bulanan</td>
                                <td>Kategori B</td>
                                <td>Rp. 700,000</td>
                                <td>PPI dan Terapi</td>
                            </tr>
                            <tr>
                                <td>Biaya tambahan perbulan</td>
                                <td>Terapi Khusus</td>
                                <td>Rp. 150,000</td>
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
<div class="section-title position-relative mb-4 pb-4">
    <h2 class="mb-2"></h2>
</div>
@include('front.ketentuan')
@endsection
