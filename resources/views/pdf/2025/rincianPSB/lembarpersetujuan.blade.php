<style type="text/css">
    .rincian {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
  
    .rincian, .rincian th, .rincian td {
        border: 1px solid black;
        padding: 5px;
    }
  
    .rincian td:nth-child(1) {
      text-align: center;
    }
  
    .rincian td:nth-child(n+3) {
      text-align: right;
  
    }
    </style>
    Lampiran 4
    <center>
        <h3 style="margin: 5px">SURAT PERSETUJUAN</h3>
        <h3 style="margin: 5px">KETENTUAN PPDB SIT NURUL FIKRI</h3>
    </center>
<p>Yang bertanda tangan di bawah ini :</p>
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
</table>
<p>Dengan ini menyatakan dengan sebenarnya <strong>memahami dan menyetujui</strong> ketentuan pelaksanaan PPDB Sekolah Islam Terpadu Nurul Fikri sebagai berikut:</p>
<br>
<ol class="spp">
    @foreach ( $agreement as $a)
        <li>{{ $a->agreement }}</li>        
    @endforeach
</ol>
<p>Demikian pernyataan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>
<br>
<table align="center" width="100%" style="font-size: 14px;">
    <tr>
      <td colspan="2" align="center"><u> Depok, {{ formatIndo($ctg->created_at->format('Y-m-d')) }} </u></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td align="center" width="27%">Ayah</td>
      <td align="center" width="27%">Ibu</td>
      <td align="center" width="16%"></td>
      <td align="center" width="30%">Pewawancara</td>
    </tr>
    <tr>
      <td><br><br><br><br></td>
      <td></td>
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