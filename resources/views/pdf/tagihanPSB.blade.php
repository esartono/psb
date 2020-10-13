@extends('pdf.template_keu')

@section('isi')
    <div class="main">
        <center><h3>SURAT PERNYATAAN</h3></center>
        <p>Yang bertanda tangan di bawah ini :</p>
        <table>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Nama Ayah </td>
                <td> : </td>
                <td> {{ Str::title($calon->ayah_nama) }} </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Nama Ibu </td>
                <td> : </td>
                <td> {{ Str::title($calon->ibu_nama) }} </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Alamat </td>
                <td> : </td>
                <td> {{ $calon->alamat }} </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td></td>
                <td></td>
                <td>
                    Kel. {{ Str::title(App\Kelurahan::nama($calon->kelurahan)) }}
                    Kec. {{ Str::title(App\Kecamatan::nama($calon->kecamatan)) }}
                    {{ Str::title(App\Kota::nama($calon->kota)) }}, {{ Str::title(App\Provinsi::nama($calon->provinsi)) }}
                </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>Email</td>
                <td> : </td>
                <td>{{ App\User::email($calon->user_id) }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>Nomor Ponsel Ayah</td>
                <td> : </td>
                <td>{{ $calon->ayah_hp }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>Nomor Ponsel Ibu</td>
                <td> : </td>
                <td>{{ $calon->ibu_hp }}</td>
            </tr>
        </table>
        <p>Adalah orangtua / wali dari calon peserta didik <b>Kelas {{ App\Kelasnya::unit($calon->kelas_tujuan) }} Unit {{ App\Gelombang::unit($calon->gel_id) }} </b>:</p>
        <table>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Nama </td>
                <td> : </td>
                <td> {{ Str::title($calon->name) }} </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Nomor Pendaftaran </td>
                <td> : </td>
                <td> {{ Str::title($calon->uruts) }} </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Saudara Kandung di SIT Nurul Fikri </td>
                <td> : </td>
                <td> _________________________ </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Nomor Ponsel (Informasi Sekolah) </td>
                <td> : </td>
                <td> _________________________ </td>
            </tr>
        </table>
        <p>Dengan ini menyatakan dengan sebenarnya <strong>memahami dan menyetujui</strong> ketentuan administrasi Sekolah Islam Terpadu Nurul Fikri sebagai berikut:</p>
        <br>
        <strong>A. Ketentuan Umum Pembiayaan PPDB</strong>
        <ol type="1">
            <li><strong>Peserta Didik</strong> adalah calon peserta didik yang sudah dinyatakan diterima dan melunasi biaya daftar ulang PPDB sesuai ketentuan.</li>
            <li><strong>Daftar Ulang PPDB</strong> adalah pembayaran biaya pendidikan sesuai dengan ketentuan, setelah calon peserta didik baru yang sudah dinyatakan <strong>diterima</strong> pada proses seleksi PPDB.</li>
            <li><strong>Pelunasan</strong> adalah <strong>pembayaran semua biaya</strong> pendidikan sesuai ketentuan biaya calon peserta didik baru SIT Nurul Fikri.</li>
            <li>Skema pembayaran PPDB SIT NF yang berlaku adalah regular 1, regular 2 dan regular 3.</li>
            <li>
                Calon peserta didik dinyatakan <strong>mengundurkan diri</strong> jika :
                <ol type="a">
                    <li>Belum melakukan daftar ulang sesuai dengan ketentuan.</li>
                    <li>Belum melakukan pelunasan sampai dengan <strong>batas waktu yang ditentukan</strong>.</li>
                    <li>Mengajukan pengunduran diri atas kemauan sendiri</li>
                </ol>
            </li>
            <li><strong>Sumbangan Pokok Pendidikan (SPP)</strong> adalah biaya yang dibayarkan <strong>setiap bulan</strong> selama peserta didik menempuh pendidikan di SIT Nurul Fikri.</li>
            <li><strong>Dana Tahunan</strong> adalah biaya yang dibayarkan <strong>setiap tahun</strong> (termasuk biaya buku paket pada tahun berjalan) selama peserta didik menempuh pendidikan di SIT Nurul Fikri.</li>
            <div class="page-break"></div>
            <li><strong>Iuran Komite Sekolah</strong> adalah biaya yang dikelola oleh komite sekolah (perwakilan orangtua peserta didik), yang dibayarkan <strong>setiap tahun</strong> selama peserta didik menempuh pendidikan di SIT Nurul Fikri</li>
        </ol>
        <br>
        <strong>B. Ketentuan Pembayaran Biaya Daftar Ulang PPDB tahun Pelajaran 2021/2022</strong>
        <ol type="1">
            <li><strong>Calon peserta didik melakukan Daftar Ulang PPDB</strong> dengan melakukan pembayaran biaya pendidikan <strong>minimal 50%</strong> dari total biaya daftar ulang peserta didik baru, sesuai dengan tanggal yang sudah ditentukan.</li>
            <li><strong>Skema Reguler 1</strong> berlaku bagi calon peserta didik yang melakukan <strong>pelunasan</strong> biaya daftar ulang <strong>selambat-lambatnya 31 Oktober 2020</strong>. Jika calon peserta didik belum melakukan pelunasan sampai dengan 31 Oktober 2020, maka berlaku ketentuan no 3.</li>
            <li><strong>Skema Reguler 2</strong> berlaku bagi calon peserta didik yang melakukan <strong>pelunasan</strong> biaya daftar ulang <strong>selambat-lambatnya 30 November 2020</strong>. Jika calon peserta didik belum melakukan pelunasan sampai dengan 30 November 2020, maka berlaku ketentuan no 4.</li>
            <li><strong>Skema Reguler 3</strong> berlaku bagi calon peserta didik yang melakukan <strong>pelunasan</strong> biaya daftar ulang <strong>setelah 30 November 2020.</li>
            <li>Calon peserta didik diharuskan melakukan <strong>pelunasan biaya daftar ulang</strong> selambat-lambatnya <strong>31 Januari 2021</strong>. Apabila sampai dengan batas waktu yang ditentukan <strong>belum melakukan Pelunasan</strong> biaya daftar ulang PPDB, maka dianggap <strong>mengundurkan diri</strong> sebagai calon peserta didik baru SIT Nurul Fikri tahun pelajaran 2021/2022.</li>
            <li>Calon Peserta Didik yang mengundurkan diri <strong>setelah melakukan Daftar Ulang</strong> maka <strong>seluruh Biaya yang sudah dibayarkan tidak dapat dikembalikan</strong>.</li>
        </ol>
        <br>
        <strong>C. Ketentuan Dana Pendidikan selama bersekolah</strong>
        <ol type="1">
            <li>SPP dibayarkan setiap bulannya selama 12 bulan dalam satu tahun ajaran sesuai dengan tarif yang sudah ditentukan.</li>
            <li>Dana Tahunan dibayarkan setiap bulan Juli pada tahun berjalan.</li>
            <li>Iuran Komite Sekolah dibayarkan setiap tahun pada bulan Juli di awal tahun ajaran.</li>
            <li>Penyesuaian/kenaikan SPP akan diberlakukan sesuai ketentuan.</li>
            <li>Biaya Pendidikan dan Dana Tahunan sudah termasuk biaya Buku Paket pada tahun berjalan.</li>
        </ol>
        <br>
        <strong>D. Ketentuan Administrasi Sekolah</strong>
        <ol type="1">
            <li>Pembayaran SPP dilakukan selambat-lambatnya tanggal 10 setiap bulannya sesuai dengan tata cara pembayaran yang sudah diberikan.</li>
            <li>Masa pembayaran SPP adalah satu tahun ajaran dimulai dari bulan Juli sampai bulan Juni tahun berikutnya atau selama 12 (dua belas bulan).</li>
            <li>
                Bagi yang melanjutkan ke kelas berikutnya, maka WAJIB melakukan Registrasi Daftar Ulang dengan melunasi:
                <ol type="a">
                    <li>seluruh kewajiban yang tertunggak di tahun ajaran sebelumnya</li>
                    <li>SPP bulan Juli</li>
                    <li>Dana Tahunan</li>
                </ol>
            </li>
            <div class="page-break"></div>
            <li>Syarat pengambilan rapor, ijazah, SKHUN, dokumen kelulusan dan atau permohonan surat pindah (mutasi) adalah melunasi seluruh kewajiban administrasi sekolah.</li>
            <li>
                Apabila SPP dan atau tagihan lainnya belum dibayarkan tepat pada waktunya , maka akan diberikan teguran dan pemberlakuan konsekuensi sebagai berikut :
                <ol type="a">
                    <li>
                        Konsekuensi Terlambat  selama 1 (satu) bulan atau lebih terjadi pada akhir semester adalah:<br>
                        <strong><i>Siswa/i tidak diberikan rapor /ijazah</i></strong> sampai pelunasan dilakukan
                    </li>
                    <li>
                        Konsekuensi terlambat  selama 2 (dua) bulan adalah:<br>
                        <strong><i>Siswa/i tidak diikutsertakan dalam ujian (UAS/UTS/UKK) dan tidak akan diberikan rapor/ijazah, dengan terlebih dahulu dikonfirmasi melalui surat teguran kepada orang tua Siswa/i</i></strong>
                    </li>
                    <li>
                        Konsekuensi terlambat  selama 3 (tiga) bulan adalah:<br>
                        <strong><i>Siswa/i tidak diijinkan ikut dalam Kegiatan Belajar Mengajar (KBM), tidak di ikutsertakan dalam ujian baik UAS ataupun UN dan juga tidak akan diberikan rapor/ijazah, dengan terlebih dahulu akan dikonfirmasi melalui surat teguran kepada orang tua Siswa/i</i></strong>
                    </li>
                    <li>
                        Konsekuensi terlambat selama 4 (empat) bulan atau lebih adalah:<br>
                        <strong><i>Siswa/i dikembalikan/dipulangkan sementara kepada orang tua, dengan terlebih dahulu akan dikonfirmasi melalui surat pemberitahuan kepada orang tua Siswa/i</i></strong>
                    </li>
                    <li>
                        Konsekuensi tidak melakukan registrasi daftar ulang tahunan sesuai ketentuan dan melewati batas waktu yang telah ditentukan adalah:<br>
                        <strong><i>Siswa/i dianggap mengundurkan diri sebagai Siswa SIT Nurul Fikri</i></strong>
                    </li>
                </ol>
            </li>
        </ol>
        <p>Demikian pernyataan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>
        <br>
        <br>
        <br>
        <table align="center" width="100%">
            <tr>
                <td align="center" colspan="2">Depok, {{ date("d F Y", strtotime($ctg->created_at)) }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center" width="25%">Ayah</td>
                <td align="center" width="25%">Ibu</td>
                <td align="center" width="20%"></td>
                <td align="center" width="30%">Pewawancara</td>
            </tr>
            <tr>
                <td><br><br><br><br></td>
                <td> Materai </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center">{{ Str::title($calon->ayah_nama) }}</td>
                <td align="center">{{ Str::title($calon->ibu_nama) }}</td>
                <td></td>
                <td align="center">{{ Str::title(App\User::namaUser($ctg->pewawancara))}}</td>
            </tr>
        </table>
        <div class="page-break"></div>
        @include('pdf.rincianPSB.1')
        @include('pdf.rincianPSB.2')
        @include('pdf.rincianPSB.3')
        @include('pdf.rincianPSB.refund')
    </div>
@endsection
