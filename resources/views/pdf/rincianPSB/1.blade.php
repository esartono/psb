<style>
.global {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
}

.global, .global th, .global td {
    border: 1px solid black;
    padding: 5px;
}

.rincian {
    width: 90%;
    border-collapse: collapse;
    font-size: 12px;
}

.rincian, .rincian th, .rincian td {
    border: 1px solid black;
    padding: 5px;
}
</style>
Lampiran 1
<h3>Daftar Pembiayaan SIT Nurul Fikri</h3>
<table width="100%">
<tr>
<td valign="top" width="47%">

<h5>A. Pembiayaan Peserta Didik Baru TA {{ $tp_awal }} - {{ $tp_akhir }}</h5>
    <table class="rincian">
        <tr>
            <th>No.</th>
            <th>Jenis Pembayaran</th>
            <th>Nominal (Rp.)</th>
        </tr>
        @foreach($biayanya as $k=>$b)
        <tr>
          <td width="5%"> {{ $k+1 }} </td>
          <td width="50%"> {{ $b }} </td>
          <td align="right"> {{ number_format($biaya1[$b]) }} </td>
        </tr>
        @endforeach
        <tr>
          <td width="5%"> 5 </td>
          <td>  Infaq SIT Nurul Fikri </td>
          <td align="right"> {{ number_format($ctg->infaq) }} </td>
        </tr>
        <tr>
          <td width="5%"> 6 </td>
          <td>  Infaq NF Peduli </td>
          <td align="right"> {{ number_format($ctg->infaqnfpeduli) }} </td>
        </tr>
        <tr>
          <td colspan="2" align="right">  <b>TOTAL</b>  </td>
          <td align="right"> <strong>{{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli) }}</strong> </td>
        </tr>
      </table>
      <br>
      <table>
        <tr>
          <td>Total pembiayaan selama di<br>
          SIT Nurul Fikri<br><h3><strong>Rp. {{ number_format($totalAll[1]+$total1+$ctg->infaq+$ctg->infaqnfpeduli) }}</strong></h3></td>
        </tr>
      </table>
</td>
<td valign="top" >
<h5>B. Pembiayaan selama bersekolah di SIT Nurul Fikri</h5>
<table class="global">
@foreach($kelass as $k=>$b)
        <tr>
          <td colspan="2"> <strong>Kelas {{ $b->name }}</strong> </td>
        </tr>
        <tr>
          <td width="75%">{{ $kelas[$b->name]['ket1'] }} @ Rp. {{ number_format($kelas[$b->name]['spp1']) }} <br></td>
          <td align="right">Rp. {{ number_format($kelas[$b->name]['total1']) }}</td>
        </tr>
        @if(isset($kelas[$b->name]['daul1']))
        <tr>
          <td> Dana Tahunan</td>
          <td align="right">Rp. {{ number_format($kelas[$b->name]['daul1']) }}</td>
        </tr>
        @endif
@endforeach
</table>
</td>
</tr>
</table>
        <br>
        <br>
        <table align="center" width="100%" style="font-size: 14px;">
            <tr>
                <td colspan="2" align="center"><u> Depok, {{ date("d F Y", strtotime($ctg->created_at)) }} </u></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center" width="20%">Ayah</td>
                <td align="center" width="20%">Ibu</td>
                <td align="center" width="30%"></td>
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
        <div class="page-break"></div>
