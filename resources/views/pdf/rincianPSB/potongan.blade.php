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
  <h3>Potongan Pembiayaan PPDB SIT Nurul Fikri</h3>
      <table class="rincian">
          <tr>
              <th rowspan="3">No.</th>
              <th rowspan="3">Jenis Pembayaran</th>
              <th colspan="{{ $batas + 2 }}">Nominal (Rp.)</th>
          </tr>
          <tr>
            <th colspan="{{ $batas + 1 }}">Maksimal Tanggal Pembayaran</th>
            <th rowspan="2" width="{{ 68/($batas+2) }}%">Normal</th>
          </tr>
          <tr>
              @if($batas == 2)<th width="{{ 68/($batas+2) }}%">{{ $diskon[1]['tanggal'] }}</th>@endif
              <th width="{{ 68/($batas+2) }}%">{{ $pengumuman->isoFormat('D MMMM Y') }}</th>
              @if($batas >= 1)<th width="{{ 68/($batas+2) }}%">{{ $diskon[2]['tanggal'] }}</th>@endif
          </tr>
          @foreach($biayanya as $k=>$b)
          <tr>
            <td width="4%"> {{ $k+1 }} </td>
            <td width="28%"> {{ $b }} </td>
            @if($b == 'Dana Pengembangan')
              @php
                $d1 = 0;
                $d2 = 0;
                $n = $biaya1[$b];
                if($ctg->potongan > 0) {
                  $d1 = ($biaya1[$b]-$diskon[1]['diskon'])*($ctg->potongan/100);
                  $d2 = ($biaya1[$b]-$diskon[2]['diskon'])*($ctg->potongan/100);
                }

                if($calon->gel_id == 2 && $calon->asal_nf == 1) {
                    $d1 = 5000000;
                    $d2 = 5000000;
                }
              @endphp
              <td> {{ number_format($biaya1[$b]-$diskon[1]['diskon']-$d1) }} </td>
              <td> {{ number_format($biaya1[$b]-$diskon[2]['diskon']-$d2) }} </td>
              <td> {{ number_format($biaya1[$b]-$diskon[2]['diskon']) }} </td>
            @else
              <td> {{ number_format($biaya1[$b]) }} </td>
              <td> {{ number_format($biaya1[$b]) }} </td>
              <td> {{ number_format($biaya1[$b]) }} </td>
            @endif
            <td> {{ number_format($biaya1[$b]) }} </td>
          </tr>
          @endforeach
          <tr>
            <td width="5%"> 6 </td>
            <td>  Infaq SIT Nurul Fikri </td>
            <td> {{ number_format($ctg->infaq) }} </td>
            <td> {{ number_format($ctg->infaq) }} </td>
            <td> {{ number_format($ctg->infaq) }} </td>
            <td> {{ number_format($ctg->infaq) }} </td>
          </tr>
          <tr>
            <td width="5%"> 7 </td>
            <td>  Infaq NF Peduli </td>
            <td> {{ number_format($ctg->infaqnfpeduli) }} </td>
            <td> {{ number_format($ctg->infaqnfpeduli) }} </td>
            <td> {{ number_format($ctg->infaqnfpeduli) }} </td>
            <td> {{ number_format($ctg->infaqnfpeduli) }} </td>
          </tr>
          <tr>
            <td></td>
            <td align="center">  <b>TOTAL</b>  </td>
            <td> <strong>{{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli-($n-($n-$diskon[1]['diskon']-$d1))) }}</strong> </td>
            <td> <strong>{{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli-($n-($n-$diskon[2]['diskon']-$d2))) }}</strong> </td>
            <td> <strong>{{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli-($n-($n-$diskon[2]['diskon']))) }}</strong> </td>
            <td> <strong>{{ number_format($total1+$ctg->infaq+$ctg->infaqnfpeduli) }}</strong> </td>
          </tr>
          <tr>
            <td colspan="6" style="text-align: left !important">
              <b>Keterangan </b>:
              <ol>
                <li>*&nbsp;&nbsp;potongan Rp. 5,000,000 + potongan khusus dari dana pengembangan</li>
                <li>**&nbsp;potongan Rp. 2,500,000 + potongan khusus dari dana pengembangan</li>
                <li>***potongan Rp. 2,500,000 dana pengembangan</li>
                <li>Potongan khusus berlaku 30 hari setelah pengumuman hasil seleksi</li>
                <li>Potongan khusus sesuai dengan ketentuan yang telah ditentukan oleh panitia PPDB SIT Nurul Fikri</li>
              </ol>
            </td>
          </tr>
        </table>
          <br>
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
