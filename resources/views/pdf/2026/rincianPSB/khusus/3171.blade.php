<style type="text/css">
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
    
    <h5 style="margin-top: -5px">A. Pembiayaan Peserta Didik Baru TA {{ $tp_awal }} - {{ $tp_akhir }}</h5>
        <table class="rincian">
            <tr>
                <th>No.</th>
                <th>Jenis Pembayaran</th>
                <th>Nominal (Rp.)</th>
            </tr>
            @php
              $DPengembangan = 7480000;
              $DPendidikan = 5600000;
              $SPP = 1000000;
              $total1 = 16280000;
              $sppAll = 0;
              $daul = 0;

              foreach($kelass as $k=>$b) {
                if($b->name == "2" || $b->name == "7" || $b->name == "10") {
                  $totalSPP = $SPP * 11;
                } else {
                  $totalSPP = $SPP * 12;
                }
                if(isset($kelas[$b->name]['daul'][$k])) {
                  $daul = intval($kelas[$b->name]['daul'][$k]);
                }
                $sppAll = $sppAll + intval($kelas[$b->name]['total'][$k]) + $daul - $totalSPP;
              }
              $totalAll[1] = $sppAll;
            @endphp
            @foreach($biayanya as $k=>$b)
            <tr>
              @php
                if($b == "Dana Pengembangan") {
                  $biaya1[$b] = $DPengembangan;
                }
                if($b == "Dana Pendidikan") {
                  $biaya1[$b] = $DPendidikan;
                }
                if($b == "SPP bulan Juli") {
                  $biaya1[$b] = $biaya1[$b] - $SPP;
                }
              @endphp
              <td width="5%"> {{ $k+1 }} </td>
              <td width="50%"> {{ ($b == 'SPP bulan Juli' ? $bulanmasuk : $b) }} </td>
              <td align="right"> {{ number_format($biaya1[$b]) }} </td>
            </tr>
            @endforeach
            <tr>
              <td width="5%"> 6 </td>
              <td>  Infaq SIT Nurul Fikri </td>
              <td align="right"> {{ number_format($ctg->infaq) }} </td>
            </tr>
            <tr>
              <td width="5%"> 7 </td>
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
    
            </tr>
          </table>
    </td>
    <td valign="top" >
    <h5  style="margin-top: -5px">B. Pembiayaan selama bersekolah di SIT Nurul Fikri </h5>
      <p style="font-size: 14px">&nbsp;&nbsp;&nbsp;Total pembiayaan selama di SIT Nurul Fikri
        <strong>Rp. {{ number_format($totalAll[1]+$total1+$ctg->infaq+$ctg->infaqnfpeduli) }}</strong><br>
        &nbsp;&nbsp;&nbsp;dengan rincian sebagai berikut :
      </p>
    <table class="global">
      <tr>
        <td><b>Total biaya PPDB SIT Nurul Fikri</b></td>
        <td align="right"> <strong>Rp. {{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli) }}</strong> </td>
      </tr>
    @foreach($kelass as $k=>$b)
      <tr>
        <td colspan="2"> <strong>Kelas {{ $b->name }}</strong> </td>
      </tr>
      <tr>
        <td width="75%">{{ $kelas[$b->name]['ket'][$k] }} @ Rp. {{ number_format($kelas[$b->name]['spp'][$k] - $SPP) }} <br></td>
        @if($b->name == "1" || $b->name == "7" || $b->name == "10")
          <td align="right">Rp. {{ number_format(intval($kelas[$b->name]['total'][$k]) - ($SPP * 11)) }}</td>
        @else
          <td align="right">Rp. {{ number_format(intval($kelas[$b->name]['total'][$k]) - ($SPP * 12)) }}</td>
        @endif
      </tr>
      @if(isset($kelas[$b->name]['daul'][$k]))
      <tr>
        <td> Dana Tahunan</td>
        <td align="right">Rp. {{ number_format(intval($kelas[$b->name]['daul'][$k])) }}</td>
      </tr>
      @endif
    @endforeach
    </table>
    </td>
    </tr>
    </table>
            <br>
            <table align="center" width="100%" style="font-size: 14px;">
                <tr>
                    <td colspan="2" align="center"><u> Depok, {{ $ctg->created_at->isoFormat('D MMMM Y') }} </u></td>
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
