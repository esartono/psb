<style>
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
  Lampiran 2
  <h4>Potongan Pembiayaan PPDB SIT Nurul Fikri</h4>
        <table class="rincian">
          <tr>
              <th>No.</th>
              <th>Jenis Pembayaran</th>
              <th>Nominal (Rp.)</th>
          </tr>
          @foreach($biayanya as $k=>$b)
          <tr>
            <td width="10%"> {{ $k+1 }} </td>
            <td> {{ ($calon->pindahan == 1 && $b == 'SPP bulan Juli' ? 'SPP bulan Januari' : $b) }} </td>
            @php
              if($b == 'Dana Pengembangan') {
                $d1 = 0;
                $d2 = 0;
                $d3 = 0;
                $n = $biaya1[$b];
                if($ctg->potongan > 0) {
                  if($batas == 2) {
                    $d1 = ($biaya1[$b]-$diskon[1]['diskon'])*($ctg->potongan/100);
                    $d2 = ($biaya1[$b]-$diskon[2]['diskon'])*($ctg->potongan/100);
                  }
                  if($batas == 1) {
                    $d2 = ($biaya1[$b]-$diskon[2]['diskon'])*($ctg->potongan/100);
                    $d3 = $biaya1[$b]*($ctg->potongan/100);
                  }
                }
                if($calon->gel_id == 2 && $calon->asal_nf == 1) {
                  $d1 = 5000000;
                  $d2 = 5000000;
                }
              }
              if($b == 'Dana Pendidikan') {
                if($ctg->potongan > 0) {
                  if($batas == 2) {
                    $d1 = $d1 + (($biaya1[$b]-$diskon[1]['diskon'])*($ctg->potongan/100));
                    $d2 = $d2 + (($biaya1[$b]-$diskon[2]['diskon'])*($ctg->potongan/100));
                  }
                  if($batas == 1) {
                    $d2 = $d2 + (($biaya1[$b]-$diskon[2]['diskon'])*($ctg->potongan/100));
                    $d3 = $d3 + ($biaya1[$b]*($ctg->potongan/100));
                  }
                }
              }
            @endphp
            <td> {{ number_format($biaya1[$b]) }} </td>
          </tr>
          @endforeach
          <tr>
            <td> 6 </td>
            <td>  Infaq SIT Nurul Fikri </td>
            <td> {{ number_format($ctg->infaq) }} </td>
          </tr>
          <tr>
            <td> 7 </td>
            <td width="60%">  Infaq NF Peduli </td>
            <td> {{ number_format($ctg->infaqnfpeduli) }} </td>
          </tr>
          <tr>
            <td></td>
            <td align="center">  <b>TOTAL</b></td>
            <td> <strong>{{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli) }}</strong> </td>
          </tr>
        </table>
        <h4>Diskon Pembiayaan PPDB SIT Nurul Fikri</h4>
        <table class="rincian">
          <tr>
            <th width="4%">No.</th>
            <th width="66%">Keterangan Diskon</th>
            <th width="15%">Diskon</th>
            <th width="15%">Pembayaran</th>
          </tr>
          <tr>
            <td>1</td>
            <td>Diskon Pelunasan untuk pembayaran sebelum tanggal <b>{{ $diskon[1]['tanggal'] }}</b><br>*<i style="font-size: 75%">Diskon khusus : {{ $ctg->keterangan }}</i></td>
            <td> {{ number_format($diskon[1]['diskon']+$d1) }} </td>
            <td> {{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli-($diskon[1]['diskon']+$d1)) }} </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Diskon Pelunasan untuk pembayaran sebelum tanggal <b>{{ $pengumuman->isoFormat('D MMMM Y') }}</b><br>*<i style="font-size: 75%">Diskon khusus : {{ $ctg->keterangan }}</i></td>
            <td> {{ number_format($diskon[2]['diskon']+$d2) }} </td>
            <td> {{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli-($diskon[2]['diskon']+$d2)) }} </td>
          </tr>
          <tr>
            <td>3</td>
            <td>Diskon Pelunasan untuk pembayaran sebelum tanggal <b>{{ $diskon[2]['tanggal'] }}</b><br>*<i style="font-size: 75%">Diskon khusus : {{ $ctg->keterangan }}</i></td>
            <td> {{ number_format($diskon[2]['diskon']) }} </td>
            <td> {{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli-($diskon[2]['diskon'])) }} </td>
          </tr>
          <tr>
            <td colspan="4" style="text-align: left !important">
              <b>Keterangan </b>:
              <ul>
                <li>Potongan sesuai dengan ketentuan yang telah berlaku</li>
              </ul>
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
