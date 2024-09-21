Lampiran 3
<center><h3>SURAT PERSETUJUAN ADMINISTRASI SEKOLAH</h3></center>
<p>Yang bertanda tangan di bawah ini :</p>
<br>
<table style="width: 100%">
    <tr>
        <td style="width: 7%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style="width: 22%"> Nama Ayah </td>
        <td style="width: 2%"> : </td>
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
        <td> {{ $calon->alamat }} RT. {{ $calon->rt }} / RW. {{ $calon->rw }}</td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td></td>
        <td></td>
        <td>
            Kel. {{ Str::title(App\Kelurahan::nama($calon->kelurahan)) }}
            Kec. {{ Str::title(App\Kecamatan::nama($calon->kecamatan)) }}<br>
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
<table style="width: 100%">
    <tr>
        <td style="width: 7%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style="width: 22%"> Nama </td>
        <td style="width: 2%"> : </td>
        <td> {{ Str::title($calon->name) }} </td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> Nomor Pendaftaran </td>
        <td> : </td>
        <td> {{ Str::title($calon->uruts) }} </td>
    </tr>
    {{-- <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> Saudara Kandung di SIT Nurul Fikri </td>
        <td> : </td>
        @if($ctg->saudara)
            <td>{{ $ctg->saudara }}</td>
        @else
            <td> _________________________ </td>
        @endif
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> Nomor Ponsel (Informasi Sekolah) </td>
        <td> : </td>
        <td> _________________________ </td>
    </tr> --}}
</table>
<p>Dengan ini menyatakan dengan sebenarnya <strong>memahami dan menyetujui</strong> ketentuan administrasi Sekolah Islam Terpadu Nurul Fikri sebagai berikut:</p>
<br>
<ol class="spp">
    <li>Pembayaran SPP dilakukan selambat-lambatnya tanggal 10 setiap bulannya sesuai dengan tata cara pembayaran yang sudah diberikan.</li>
    <li>Masa pembayaran SPP adalah satu tahun ajaran dimulai dari bulan <b>Juli sampai bulan Juni tahun berikutnya</b> atau <b>selama 12 (dua belas bulan)</b></li>
    <li>Bagi yang melanjutkan ke kelas berikutnya, maka WAJIB melakukan Registrasi Daftar Ulang dengan melunasi:
        <ol class="spp_detail">
            <li>seluruh kewajiban yang tertunggak di tahun ajaran sebelumnya</li>
            <li>SPP bulan Juli</li>
            <li>Dana Tahunan</li>
        </ol>
    </li>
    <li>Syarat pengambilan rapor, ijazah, SKHUN, dokumen kelulusan dan atau permohonan surat pindah (mutasi) adalah melunasi seluruh kewajiban administrasi sekolah.</li>
    <div class="page-break"></div>
    <li>Apabila SPP dan atau tagihan lainnya belum dibayarkan tepat pada waktunya, maka akan diberikan teguran dan pemberlakuan konsekuensi sebagai berikut :
        <ol class="spp_detail">
            <li>Konsekuensi Terlambat  selama 1 (satu) bulan atau lebih terjadi pada akhir semester adalah:
                <p class="konsekuensi"><b>Siswa/i tidak diberikan rapor /ijazah</b> sampai pelunasan dilakukan</p></li>
            <li>Konsekuensi terlambat  selama 2 (dua) bulan adalah:
                <p class="konsekuensi"><b>Siswa/i tidak diikutsertakan dalam ujian (UAS/UTS/UKK) dan tidak akan diberikan rapor/ijazah, dengan terlebih dahulu dikonfirmasi melalui surat teguran kepada orang tua Siswa/i</b></p></li>
            <li>Konsekuensi terlambat  selama 3 (tiga) bulan adalah:
                <p class="konsekuensi"><b>Siswa/i tidak diijinkan ikut dalam Kegiatan Belajar Mengajar (KBM), tidak di ikutsertakan dalam ujian baik UAS ataupun UN dan juga tidak akan diberikan rapor/ijazah, dengan terlebih dahulu akan dikonfirmasi melalui surat teguran kepada orang tua Siswa/i</b></p></li>
            <li>Konsekuensi terlambat selama 4 (empat) bulan atau lebih adalah:
                <p class="konsekuensi"><b>Siswa/i dikembalikan/dipulangkan sementara kepada orang tua, dengan terlebih dahulu akan dikonfirmasi melalui surat pemberitahuan kepada orang tua Siswa/i</b></p></li>
            <li>Konsekuensi tidak melakukan registrasi daftar ulang tahunan sesuai ketentuan dan melewati batas waktu yang telah ditentukan adalah:
                <p class="konsekuensi"><b>Siswa/i dianggap mengundurkan diri sebagai Siswa SIT Nurul Fikri</b></p></li>
        </ol>
    </li>
</ol>
<p>Demikian pernyataan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>
<br>
<br>
<table align="center" width="100%" style="font-size: 14px;">
    <tr>
      <td></td>
      <td colspan="2" align="center"><u> Depok, {{ formatIndo($ctg->created_at->format('Y-m-d')) }} </u></td>
      <td></td>
    </tr>
    <tr>
      <td width="23%"></td>  
      <td align="center" width="27%">Ayah</td>
      <td align="center" width="27%">Ibu</td>
      {{-- <td align="center" width="16%"></td> --}}
      <td align="center" width="23%"></td>
    </tr>
    <tr>
      <td></td> 
      <td colspan="2" align="center"><br><br>Materai<br><br></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td align="center">{{ Str::title($calon->ayah_nama) }}</td>
      <td align="center">{{ Str::title($calon->ibu_nama) }}</td>
      <td align="center"></td>
      </tr>
</table>