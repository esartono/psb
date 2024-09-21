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
        margin: 4px 0 8px 0;
        color: #000;
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

</style>
<section class="banner-area relative">
    <div class="container">
        <div class="section-top-border justify-content-center">
            <h3 class="mt-60 mb-2 text-white">Tata Cara Pembayaran SPP Siswa SIT Nurul Fikri</h3>
            <h4 class="mb-20 text-white">Tahun Ajaran {{ $tp }}</h4>
            <h5 class="mb-20 text-white">Menggunakan Virtual Account (VA) Bank Jabar Banten Syariah (BJB Syariah)</h5>
            <div class="progress-table-wrap">
                <div class="progress-table" style="padding: 30px 75px 30px 75px">
                    <ol class="roman">
                        <li>Menggunakan Aplikasi Setoran/Transfer di Bank</li>
                        <ol class="biasa">
                            <li>Mengisi form Aplikasi Setoran/Transfer yang sudah disediakan Bank</li>
                            <li>Pada kolom penerima/nama rekening tujuan masukkan nama siswa</li>
                            <li>Pada kolom nomor rekening penerima/pemilik di isi dengan no virtual account</li>
                            <li>Pada kolom sirim/penyetor masukkan nama siswa atau nama orang tua siswa</li>
                            <li>Masukkan nilai nominal setor/transfer dengan nominal SPP</li>
                        </ol>
                        <li>Melalui ATM Bank Jabar Banten Syariah</li>
                        <ol class="biasa">
                            <li>Masukkan kartu ATM anda</li>
                            <li>Masukkan PIN anda</li>
                            <li>Pilih transfer pada menu ATM</li>
                            <li>Pilih transfer ke BJB Syariah</li>
                            <li>Masukkan no rekening tujuan yaitu virtual account (VA)</li>
                            <li>Masukkan nominal SPP</li>
                            <li>Dilayar selanjutnya akan tampil permintaan nomor referensi, bisa diisi dengan no bulan bayar atau no HP atau dapat juga dikosongkan dan memilih Benar</li>
                            <li>Lakukan konfirmasi transaksi transfer setelah nomor rekenig dan nama pemilik rekening muncul di layar, apabila data sudah benar maka pilih Ya</li>
                            <li>Mesin ATM akan mengeluarkan struk ATM sebagai bukti transaksi</li>
                            <li>Simpan struk ATM sebagai bukti pembayaran</li>
                        </ol>
                        <li>Melalui ATM Bersama/Prima/ATM Bank Lain</li>
                        <ol class="biasa">
                            <li>Masukkan kartu ATM anda</li>
                            <li>Masukkan PIN anda</li>
                            <li>Pilih transfer pada menu ATM</li>
                            <li>Pilih transfer ke bank lain atau transfer ke bank ATM Bersama</li>
                            <li>Masukkan kode tujuan dan nomor rekening penerima
                                <ol class="step1">
                                    <li>kode bank tujuan adalah 425 (Bank Jabar Banten Syariah)</li>
                                    <li>kode bank BJBS + nomor rekening (VA)</li>
                                </ol>
                            </li>
                            <li>Masukkan jumlah uang yang akan ditansfer</li>
                            <li>Dilayar selanjutnya akan tampil permintaan nomor referensi, bisa diisi dengan no bulan bayar atau no HP atau dapat juga dikosongkan dan memilih Benar</li>
                            <li>Lakukan konfirmasi transaksi transfer setelah nomor rekenig dan nama pemilik rekening muncul di layar, apabila data sudah benar maka pilih Ya</li>
                            <li>Mesin ATM akan mengeluarkan struk ATM sebagai bukti transaksi</li>
                            <li>Simpan struk ATM sebagai bukti pembayaran</li>    
                        </ol>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
