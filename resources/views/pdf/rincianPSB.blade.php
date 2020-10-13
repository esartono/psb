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
Lampiran 1 : <b>Pembiayaan Reguler 1</b>
<h3>Daftar Pembiayaan SIT Nurul Fikri</h3>
<table width="100%">
<tr>
<td valign="top" width="47%">

<h5>A. Pembiayaan Peserta Didik Baru TA 2021 - 2022</h5>
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
          <td align="right"> <strong>{{ number_format($total1) }}</strong> </td>
        </tr>
      </table>
      <br>
      <table>
        <tr>
          <td>Total pembiayaan selama di<br>
          SIT Nurul Fikri<br><h3><strong>{{ number_format($totalTahunan[1]) }}</strong></h3></td>
        </tr>
      </table>
</td>
<td>
<h5>B. Pembiayaan selama bersekolah di SIT Nurul Fikri</h5>
<table class="global">
@foreach($kelass as $k=>$b)
        <tr>
          <td colspan="2"> <strong>Kelas {{ $b->name }}</strong> </td>
        </tr>
        <tr>
          <td width="75%">{{ $kelas[$b->name]['ket'] }}{{ $kelas[$b->name]['spp'] }} <br></td>
          <td>{{ $kelas[$b->name]['total'] }}</td>
        </tr>
        @if(isset($kelas[$b->name]['daul']))
        <tr>
          <td> Dana Tahunan</td>
          <td>{{ $kelas[$b->name]['daul'] }}</td>
        </tr>
        @endif
@endforeach
</table>
</td>
</tr>
</table>
      <p>Depok, {{ date("d M Y", strtotime($ctg->created_at)) }}</p>
        <br>
        <table align="center" width="100%">
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
                <td align="center">_______________</td>
                <td align="center">_______________</td>
                <td></td>
                <td align="center">_______________</td>
            </tr>
        </table>
        <div class="page-break"></div>
