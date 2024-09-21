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

    {{-- Lampiran 3 --}}
    <center>
        <h3 style="margin: 5px">FORM KESEDIAAN MENGIKUTI</h3>
        <h3 style="margin: 5px">IMMERSION PROGRAM NURUL FIKRI (IMPRUF)</h3>
    </center>
    <table align="center" width="100%" style="margin-top: 30px">
        <tr>
            <td colspan="4">Yang bertanda tangan di bawah ini :</td>
        </tr>
        <tr>
            <td style="width: 5%"></td>
            <td style="width: 20%"> Nama Ayah </td>
            <td style="width: 2%"> : </td>
            <td style="width: 71%"> {{ Str::title($calon->ayah_nama) }} </td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td> Nama Ibu </td>
            <td> : </td>
            <td> {{ Str::title($calon->ibu_nama) }} </td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td> Alamat </td>
            <td> : </td>
            <td> {{ $calon->alamat }} RT. {{ $calon->rt }} / RW. {{ $calon->rw }}</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td></td>
            <td></td>
            <td>
                Kelurahan {{ Str::title(App\Kelurahan::nama($calon->kelurahan)) }},
                Kecamatan {{ Str::title(App\Kecamatan::nama($calon->kecamatan)) }}<br>
                {{ Str::title(App\Kota::nama($calon->kota)) }}, {{ Str::title(App\Provinsi::nama($calon->provinsi)) }}
            </td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>Email</td>
            <td> : </td>
            <td>{{ App\User::email($calon->user_id) }}</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>Nomor Ponsel Ayah</td>
            <td> : </td>
            <td>{{ $calon->ayah_hp }}</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;</td>
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
</table>
<p>Dengan ini menyatakan bahwa:</p>
<br>
<table>
    <tr>
        <td>
            @if($ctg->lain['program'] == 'belum')
                <td><img src="img/boxwithchecklist.jpg" style="width: 20px; height: auto"></td>
            @else
                <td><img src="img/box.png" style="width: 25px; height: auto"></td>
            @endif    
        </td>
        <td> Belum bersedia mengikuti</td>
    </tr>
    <tr>
        <td>
            @if($ctg->lain['program'] == 'bulanan' || $ctg->lain['program'] == 'tahunan')
                <td><img src="img/boxwithchecklist.jpg" style="width: 20px; height: auto"></td>
            @else
                <td><img src="img/box.png" style="width: 25px; height: auto"></td>
            @endif    
        </td>
        <td> Bersedia mengikuti, dengan skema pembayaran sebagai berikut :</td>
    </tr>
</table>
<br>
    <h4 style="margin: 15px 0px">Rencana Pembiayaan {{ $ketProgramNF }}</h4>
    <ol>
        <li>Untuk pembayaran setiap bulan digabungkan dengan pembayaran SPP (SPP + {{ $ketProgramNF }}).</li>
        <li>Bagian keuangan akan mengingatkan proses pembayaran program ini setiap bulannya.</li>
        <li>Tabel pembiayaan {{ $ketProgramNF }}
            <table class="rincian">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Kegiatan</th>
                    <th rowspan="2">Biaya (Rp.)</th>
                    @php
                        $kolom = count($programNF['tahunan']);
                    @endphp
                    <th colspan="{{ $kolom }}">Teknis Pembayaran</th>
                </tr>
                <tr>
                    @for ($i = 1; $i <= $kolom; $i++)
                        <td style="text-align: center">{{ $i }}</td>
                    @endfor
                </tr>
                <tr>
                    <td style="text-align: center"> 1 </td>
                    <td>{{ $ketProgramNF }}</td>
                    <td style="text-align: center">{{ number_format($biayaProgramNF) }}</td>
                @for ($i = 1; $i <= $kolom; $i++)
                    <td style="text-align: center">
                        {{ number_format($programNF['tahunan'][$i]) }} / tahun <br>
                        atau <br>
                        {{ number_format($programNF['bulanan'][$i]) }} / bulan
                    </td>
                @endfor
                </tr>
            </table>
        </li>
        <div class="page-break"></div>
        <li>Orang tua menetapkan model pilihan pembiayaan {{ $ketProgramNF }}
            <table width="100%" style="margin-top: 20px;">
                <tr>
                    @if($ctg->lain['program'] == 'tahunan')
                        <td><img src="img/boxwithchecklist.jpg" style="width: 20px; height: auto"></td>
                    @else
                        <td><img src="img/box.png" style="width: 25px; height: auto"></td>
                    @endif
                    {{-- <td style="text-align: right">a.</td> --}}
                    <td>Bayar pertahun</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <ol>
                            @php
                                $ta = (int)taAktif();
                            @endphp
                            @for ($i = 1; $i <= $kolom; $i++)
                                <li style="margin-bottom: 8px">Term. {{ $i }} : Rp. {{ number_format($programNF['tahunan'][$i]) }} ( tgl .......................... maksimal tanggal 30 Juni {{ $ta + $i - 1 }})</li>
                            @endfor
                        </ol>
                        <span style="font-size: 80%; font-style:italic">Apabila sampai dengan batas pembayaran belum terbayar, maka akan di masukan ke tagihan SPP per bulan pada tahun berjalan.</span>
                        <br>
                        <br>
                    </td>
                </tr>
                <tr>
                    {{-- <td style="text-align: right">b.</td> --}}
                    @if($ctg->lain['program'] == 'bulanan')
                        <td style="width: 10px;"><img src="img/boxwithchecklist.jpg" style="width: 20px; height: auto"></td>
                    @else
                        <td style="width: 10px;"><img src="img/box.png" style="width: 25px; height: auto"></td>
                    @endif
                    <td>Bayar perbulan</td>
                </tr>
                @php
                    $i = 1;
                @endphp
                    <tr>
                        <td></td>
                        <td>
                            <ol>
                            @foreach($kelass as $k=>$b)
                                @if($i <= $kolom)
                                    <li style="margin-bottom: 7px">SPP Kelas {{ $b->name }} + {{ $ketProgramNF }} : <br>
                                        Rp. {{ number_format($kelas[$b->name]['spp'][$k]) }} + Rp. {{ number_format($programNF['bulanan'][$i]) }} = <b>Rp. {{ number_format($kelas[$b->name]['spp'][$k] + $programNF['bulanan'][$i]) }}</b>
                                    </li>
                                @endif
                            @php
                                $i++;
                            @endphp
                            @endforeach
                            </ol>
                        </td>
                    </tr>
                    
            </table>
        </li>
    </ol>
    <br>
    <br>
          <table align="center" width="100%" style="font-size: 15px;">
            <tr>
              <td></td>
              <td colspan="2" align="center"><u> Depok, {{ formatIndo($ctg->created_at->format('Y-m-d')) }} </u></td>
              {{-- <td></td> --}}
              <td></td>
            </tr>
            <tr>
              <td align="center" width="23%"></td>
              <td align="center" width="27%">Ayah</td>
              <td align="center" width="27%">Ibu</td>
              <td align="center" width="23%"></td>
              {{-- <td align="center" width="30%">Pewawancara</td> --}}
            </tr>
            <tr>
              <td><br><br><br><br></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td align="center">{{ Str::title($calon->ayah_nama) }}</td>
              <td align="center">{{ Str::title($calon->ibu_nama) }}</td>
              <td></td>
              {{-- <td align="center">{{ Str::title(App\User::namaUser($ctg->pewawancara))}}</td> --}}
              </tr>
          </table>
  