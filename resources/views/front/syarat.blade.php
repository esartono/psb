@extends('front.template1')

@section('isi')
<style type="text/css">

    body {
        color: black
    }
    .jarak {
        margin-bottom: 10px;
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
    .roman li {
        list-style: upper-roman;
        display: list-item;
        font-weight: 800;
        color: #000;
        margin-bottom: 20px;
    }

    .biasa li {
        list-style: decimal;
        font-weight: 400;
        text-transform: none;
        padding: 0 0 0 10px;
        margin: 0 0 0 20px;
    }

    .step1 li {
        list-style: lower-latin;
        font-weight: 400;
        text-transform: none;
    }

    .step2 li {
        list-style-type: square;
        font-weight: 400;
        text-transform: none;
    }
    .khusus {
        border: 0px !important;
    }
    .khusus th, .khusus td {
        padding: 3px !important;
        border: 0px !important;
    }
    tr {
        vertical-align : middle;"
    }
</style>
<section class="banner-area relative">
    <div class="container">
        <div class="section-top-border justify-content-center">
            <div class="progress-table-wrap">
                <div class="progress-table" style="padding: 25px">
                    <ol class="roman">
                        <li>Syarat Pendaftaran
                            <div class="jarak"></div>
                            <ol class="biasa">
                                <li>Melakukan pendaftaran online pada laman ppdb.nurulfikri.sch.id</li>
                                <li>Membayar biaya pendaftaran sesuai ketentuan</li>
                                <li>Melakukan upload dokumen (Maksimal 5 hari setelah pelunasan):
                                    <ol class="step1">
                                        <li>Scan KTP orangtua</li>
                                        <li>Scan kartu Keluarga</li>
                                        <li>Scan Akte Kelahiran</li>
                                        <li>Scan Rapor dengan ketentuan sebagai berikut :
                                            <ul class="step2">
                                                <li>Untuk calon SMP scan rapor SD hanya kelas 4 dan kelas 5</li>
                                                <li>Untuk calon SMA scan rapor SMP kelas 7 dan kelas 8</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>Jenis Seleksi<div class="jarak"></div>
                            <table class="table table-bordered table-striped" style="width: 80%; margin-left: 30px">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Unit</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center">TKIT</td>
                                        <td>
                                            <ol class="biasa">
                                                <li>Observasi (dibantu Psikolog)</li>
                                                <li>Wawancara Orang Tua</li>
                                                <li>Mengisi Form surat keterangan sehat</li>
                                                <li>Minimal usia :
                                                    <table class="khusus">
                                                        <tr>
                                                            <td>PG</td>
                                                            <td>:</td>
                                                            <td>Kelahiran Juli {{ $patokan-4 }} - Juni {{ $patokan-3 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>TK A</td>
                                                            <td>:</td>
                                                            <td>Kelahiran Juli {{ $patokan-5 }} - Juni {{ $patokan-4 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>TK B</td>
                                                            <td>:</td>
                                                            <td>Kelahiran Juli {{ $patokan-6 }} - Juni {{ $patokan-5 }}</td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center">SDIT</td>
                                        <td>
                                            <ol class="biasa">
                                                <li>Psikotes</li>
                                                <li>Wawancara Orang tua</li>
                                                <li>Mengisi form surat Keterangan Sehat</li>
                                                <li>Usia minimal 5 tahun 10 bulan pada Juli {{ $patokan }} Kelahiran Maksimal Oktober {{ $patokan-6 }}</li>
                                                <li>Tes Akademik (bagi Siswa mutasi/pindahan)</li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center">SMPIT</td>
                                        <td>
                                            <ol class="biasa">
                                                <li>Psikotes</li>
                                                <li>Tes Potensi Akademik (Kemampuan Matematika dan Literasi)</li>
                                                <li>Mengisi form surat Keterangan Sehat</li>
                                                <li>Wawancara Orang tua</li>
                                                <li>Wawancara Siswa</li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center">SMAIT</td>
                                        <td>
                                            <ol class="biasa">
                                                <li>Psikotes</li>
                                                <li>Tes Potensi Akademik (Kemampuan Matematika dan Literasi)</li>
                                                <li>Menyerahkan Hasil Tes Bebas Narkoba dari Rumah Sakit, Klinik atau Laboratorium dengan komponen minimal : Amphetamine (AMP), Metamphitamine ( MET), Cocaine (COC), Ganja (THC)</li>
                                                <li>Mengisi form surat Keterangan Sehat</li>
                                                <li>Wawancara Orang tua</li>
                                                <li>Wawancara Siswa</li>
                                            </ol>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                        <li>Ketentuan Seleksi<div class="jarak"></div>
                            <ol class="biasa">
                                <li>Psikotes (Observasi untuk unit TK) dilaksanakan secara offline sesuai jadwal yang sudah ditentukan</li>
                                <li>Tes Potensi Akademik dilaksanakan secara Offline sesuai dengan tanggal yang ditentukan, dengan muatan tes tentang Kemampuan Numerik dan Literasi.</li>
                                <li>Wawancara Orang Tua Calon siswa dan Wawancara Calon Siswa dilaksanakan dalam satu hari tes secara langsung sesuai jadwal.</li>
                                <li>Peserta tes melakukan upload surat keterangan sehat dari dokter pada laman web sebelum pelaksanaan seleksi.</li>
                                <li>Untuk calon siswa SMP dan SMA melakukan input nilai rapor website, mata pelajaran sebagai berikut:
                                    <br>
                                    <br>
                                    <table class="table table-bordered table-striped" style="width: 80%">
                                        <tr>
                                            <th width="15%">Unit</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Kelas</th>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center">SMP</td>
                                            <td>
                                                <ol class="biasa">
                                                    <li>Pendidikan Agama Islam</li>
                                                    <li>Bahasa Indonesia</li>
                                                    <li>Matematika</li>
                                                    <li>Ilmu Pengetahuan Alam</li>
                                                    <li>Ilmu Pengetahuan Sosial</li>
                                                </ol>
                                            </td>
                                            <td>Kelas 4 dan Kelas 5</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center">SMA</td>
                                            <td>
                                                <ol class="biasa">
                                                    <li>Pendidikan Agama Islam</li>
                                                    <li>Bahasa Indonesia</li>
                                                    <li>Bahasa Inggris</li>
                                                    <li>Matematika</li>
                                                    <li>Ilmu Pengetahuan Alam</li>
                                                    <li>Ilmu Pengetahuan Sosial</li>
                                                </ol>
                                            </td>
                                            <td>Kelas 7 dan kelas 8</td>
                                        </tr>
                                    </table>
                                </li>
                            </ol>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
