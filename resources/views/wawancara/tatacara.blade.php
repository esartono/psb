<ol class="roman">
    <li>Ketentuan Umum
        <ol class="biasa">
            <li>Masing-masing pendaftar akan mendapatkan nomor pendaftaran.</li>
            <li>Biaya pendaftaran sebagaimana tertera pada bukti pendaftaran.</li>
            <li>Pembayaran biaya pendaftaran paling lambat 3 hari terhitung dari hari pendaftaran.</li>
            <li>Waktu pelaksanaan seleksi tertera pada laman web masing-masing pada menu <b>Seleksi</b></li>
        </ol>
    </li>
    <li>Alternatif cara pembayaran
        <table class="table table-bordered table-striped biaya">
            <tr>
                <th>1. Melalui Teller Bank Syariah Indonesia (BSI)</th>
            </tr>
            <tr>
                <td style="text-transform: none">
                    Melakukan Pembayaran jenis Maja dengan nama lembaga <b>Yayasan Pendidikan dan Pemberdayaan Umat Nurul Fikri</b> dengan nomor pembayaran menggunakan nomor pendaftaran <b>{{ $calonsnya->uruts ?? $kode }}</b> (Sesuai nomor pendaftaran)
                </td>
            </tr>
            <tr>
                <th>2. ATM Bank Syariah Indonesia (BSI)</th>
            </tr>
            <tr>
                <td>
                    <ol class="biasa">
                        <li>Masuk ke Menu Utama</li>
                        <li>Pilih Menu Pembayaran/Pembelian</li>
                        <li>Pilih Menu Akademik</li>
                        <li>Masukkan kode institusi, Yayasan Pendidikan dan Pemberdayaan Nurul Fikri - <b>3292</b> dan nomor pendaftar <b>{{ $calonsnya->uruts ?? $kode }}</b> (sesuai nomor pendaftaran).</li>
                        <li>Tampilan konfirmasi pembayaran, pilih <b>Benar</b></li>
                    </ol>
                </td>
            </tr>
            <tr>
                <th>3. Mobile Banking Bank Syariah Indonesia (BSI)</th>
            </tr>
            <tr>
                <td>
                    <ol class="biasa">
                        <li>Pilih Menu Pembayaran</li>
                        <li>Pilih Akademik</li>
                        <li>Pilih Nama Institusi, <b>3292 - Yayasan Pendidikan dan Pemberdayaan Nurul Fikri</b></li>
                        <li>Masukkan nomor pendaftar <b>{{ $calonsnya->uruts ?? $kode }}</b> (sesuai nomor pendaftaran).</li>
                        <li>Masukan PIN</li>
                        <li>Tampilan konfirmasi, pilih <b>Selanjutnya</b></li>
                    </ol>
                </td>
            </tr>
        </table>
        <div class="pisah"></div>
        <table class="table table-bordered table-striped biaya biaya_pisah">
            <tr>
                <th>4. Melalui Internet Banking Bank Syariah Indonesia (BSI)</th>
            </tr>
            <tr>
                <td>
                    <ol class="biasa">
                        <li>Masuk ke Menu Bayar</li>
                        <li>Pilih jenis pembayaran Akademik</li>
                        <li>Pilih Nama Lembaga Maja - <b>3292 - Yayasan Pendidikan dan Pemberdayaan Umat Nurul Fikri</b></li>
                        <li>Masukkan nomor pendaftar sebagai kode pembayaran <b>{{ $calonsnya->uruts ?? $kode }}</b> (sesuai nomor pendaftaran).</li>
                        <li>Konfirmasi pembayaran</li>
                        <li>Masukan TAN dan Password otorisasi untuk melanjutkan pembayaran</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <th>5. Melalui ATM Bersama/Prima</th>
            </tr>
            <tr>
                <td>
                    <ol class="biasa">
                        <li>Pilih Menu Transfer ke Bank Lain</li>
                        <li>Pilih Bank Tujuan : Bank Syariah Indonesia (kode : 451)</li>
                        <li>Masukan Nomor Rekening Tujuan
                            <ol class="step1">
                                <li>Kode Pembayaran Pendidikan : <b>900</b></li>
                                <li>Kode YPPU Nurul Fikri : <b>3292</b></li>
                                <li>
                                    Kode Pendaftaran : <b>{{ $calonsnya->uruts ?? $kode }} (sesuai nomor pendaftaran).</b><br>
                                    contoh : <b>900 3292 {{ $calonsnya->uruts ?? $kode }}</b>
                                </li>
                            </ol>
                        </li>
                        <li>Masukan nominal pembayaran, <b>harus sesuai dengan jumlah tagihan</b></li>
                        <li>Akan muncul konfirmasi transfer</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <th>6. Melalui Mobile Banking atau Net Banking Bank Lain</th>
            </tr>
            <tr>
                <td>
                    <ol class="biasa">
                        <li>Pilih Menu Transfer ke Bank Lain</li>
                        <li>Pilih Bank Tujuan : Bank Syariah Indonesia (kode : 451)</li>
                        <li>Pilih metode transfer antar bank (<b>Tidak menggunakan metode Bi Fast dan SKN</b>)</li>
                        <li>Masukan Nomor Rekening Tujuan
                            <ol class="step1">
                                <li>Kode Pembayaran Pendidikan : <b>900</b></li>
                                <li>Kode YPPU Nurul Fikri : <b>3292</b></li>
                                <li>
                                    Kode Pendaftaran : <b>{{ $calonsnya->uruts ?? $kode }} (sesuai nomor pendaftaran).</b><br>
                                    contoh : <b>900 3292 {{ $calonsnya->uruts ?? $kode }}</b>
                                </li>
                            </ol>
                        </li>
                        <li>Masukan nominal pembayaran, <b>harus sesuai dengan jumlah tagihan</b></li>
                        <li>Akan muncul konfirmasi transfer</li>
                    </ol>
                </td>
            </tr>
        </table>
    </li>
</ol>
