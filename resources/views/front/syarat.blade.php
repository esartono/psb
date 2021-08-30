@extends('front.template1')

@section('isi')
<style>
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

    .khusus {
        border: 0px !important;
    }
    .khusus th, .khusus td {
        padding: 3px !important;
        border: 0px !important;
    }

</style>
<section class="banner-area relative">
    <div class="container">
        <div class="section-top-border justify-content-center">
            <h3 class="mt-30 mb-2 text-white">Syarat dan Ketentuan PPDB SIT Nurul Fikri</h3>
            <h4 class="mb-20 text-white">Tahun Ajaran 2022/2023</h4>
            <div class="progress-table-wrap">
                <div class="progress-table" style="padding: 25px">
                    <ol class="roman">
                        <li>Syarat Pendaftaran
                            <div class="jarak"></div>
                            <ol class="biasa">
                                <li>Melakukan pendaftaran online pada laman ppdb.nurulfikri.sch.id</li>
                                <li>Membayar biaya pendaftaran sesuai ketentuan</li>
                                <li>Melakukan upload dokumen :
                                    <ol class="step1">
                                        <li>Scan KTP orangtua</li>
                                        <li>Scan kartu Keluarga</li>
                                        <li>Scan Akte Kelahiran</li>
                                        <li>Scan Rapor (SMP dan SMA)</li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>Jenis Seleksi<div class="jarak"></div>
                            <table class="table table-bordered table-striped" width="70%">
                                <thead>
                                    <tr>
                                        <th>Unit</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="bg-TK">TKIT</td>
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
                                                            <td>Kelahiran Juni 2018 - Juli 2019</td>
                                                        </tr>
                                                        <tr>
                                                            <td>TK A</td>
                                                            <td>:</td>
                                                            <td>Kelahiran Juni 2017 - Juli 2018</td>
                                                        </tr>
                                                        <tr>
                                                            <td>TK B</td>
                                                            <td>:</td>
                                                            <td>Kelahiran Juni 2016 - Juli 2017</td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-SD">SDIT</td>
                                        <td>
                                            <ol class="biasa">
                                                <li>Psikotes</li>
                                                <li>Wawancara Orang tua</li>
                                                <li>Mengisi form surat Keterangan Sehat</li>
                                                <li>Usia minimal 5 tahun 10 bulan pada Juli 2022 Kelahiran Maksimal Oktober 2016</li>
                                                <li>Tes Akademik (bagi Siswa mutasi/pindahan)</li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-SMP">SMPIT</td>
                                        <td>
                                            <ol class="biasa">
                                                <li>Psikotes</li>
                                                <li>Tes Akademik (Matematika dan IPA)</li>
                                                <li>Mengisi form surat Keterangan Sehat</li>
                                                <li>Wawancara Orang tua</li>
                                                <li>Wawancara Siswa</li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-SMA">SMAIT</td>
                                        <td>
                                            <ol class="biasa">
                                                <li>Psikotes</li>
                                                <li>Tes Akademik (Matematika, IPA, IPS, Bahasa Indonesia dan Bahasa Inggris)</li>
                                                <li>Menyerahkan Surat Keterangan Bebas Narkoba</li>
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
                                <li>Psikotes (Observasi untuk unit TK) dilaksanakan secara offline (TK dan SD) atau online (SMP dan SMA) sesuai jadwal yang sudah ditentukan</li>
                                <li>Tes Akademik dilaksanakan secara Online sesuai dengan tanggal yang ditentukan, dengan mata pelajaran sebagai berikut :
                                    <br>
                                    <br>
                                    <table class="spesial">
                                        <tr>
                                            <th width="100px">Unit</th>
                                            <th>Mata Pelajaran</th>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center">SMP</td>
                                            <td>
                                                <ol class="biasa">
                                                    <li>Matematika</li>
                                                    <li>Ilmu Pengetahuan Alam</li>
                                                </ol>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center">SMA</td>
                                            <td>
                                                <ol class="biasa">
                                                    <li>Matematika</li>
                                                    <li>Ilmu Pengetahuan Alam</li>
                                                    <li>Ilmu Pengetahuan Sosial</li>
                                                    <li>Bahasa Indonesia</li>
                                                    <li>Bahasa Inggris</li>
                                                </ol>
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                </li>
                                <li>Wawancara Orang Tua Calon siswa dan Wawancara Calon Siswa dilaksanakan dalam satu hari tes secara langsung sesuai jadwal.</li>
                                <li>Peserta tes melakukan upload surat keterangan sehat dari dokter pada laman web sebelum pelaksanaan seleksi.</li>
                                <li>Untuk calon siswa SMP dan SMA melakukan input nilai rapor website, mata pelajaran sebagai berikut:
                                    <br>
                                    <br>
                                    <table class="spesial">
                                        <tr>
                                            <th width="100px">Unit</th>
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
                                            <td>Kelas 4 Semester ganjil dan Kelas 5 Semester ganjil</td>
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
