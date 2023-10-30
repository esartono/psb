@isset($calon->bayarppdb)
    @if($calon->bayarppdb['cpsb']->lunas == 0)
        <div class="callout callout-danger">
            <h5>Status Daftar Ulang : Belum Lunas</h5>
        </div>
    @endif
    @if($calon->bayarppdb['cpsb']->lunas == 1)
        <div class="callout callout-success">
            <h5>Status Daftar Ulang : Lunas</h5>
        </div>
    @endif
    @if($calon->bayarppdb['cpsb']->lunas == 0 && $calon->ck_id == 3)
        <div class="callout callout-danger">
            <h5 class="mb-3">Input Ukuran Seragam</h5>
            <p>Input Ukutan Seragam Mulai Januari 2024</p>
            {{-- <a href='/uniform/{{ $calon->id }}' class="btn btn-success mb-2" style="color: white; text-decoration: none;"><i class="fas fa-tshirt"> </i> &nbsp;Pilih Ukuran Seragam</a>
            <table class="table table-bordered">
                <tr>
                    <td style="width:70% !important">Ukuran Baju atau Blouse</td>
                    <th>
                        @if($calon->seragam['atas'] == '' || $calon->seragam['atas'] == '-')
                            Belum Input
                        @else
                            {{ $calon->seragam['atas'] }}
                        @endif
                    </th>
                </tr>
                <tr>
                    <td>Ukuran Celana atau Rok</td>
                    <th>
                        @if($calon->seragam['bawah'] == '' || $calon->seragam['bawah'] == '-')
                            Belum Input
                        @else
                            {{ $calon->seragam['bawah'] }}
                        @endif
                    </th>
                </tr>
            </table> --}}
        </div>
    @endif
    <br>
    <h5>Riwayat Pembayaran :</h5>
    <table class="table table-bordered">
        <tr>
            <th>No.</th>
            <th>Tanggal Pembayaran</th>
            <th>Pembayaran</th>
            <th>Keterangan</th>
        </tr>
        @php
            $no = 0;
        @endphp
        @foreach($calon->bayarppdb['bayarppdb'] as $bayar)
            <tr>
                <th>{{ $no+1 }}</th>
                <th>{{ Carbon\Carbon::parse($bayar->tgl_bayar)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}</th>
                <td class="text-right">Rp. {{ number_format($bayar->bayar) }}.-</td>
                <td>{{ $bayar->keterangan }}</td>
            </tr>
            @php
                $no++;
            @endphp
        @endforeach
        <tr>
            <th colspan="2">TOTAL PEMBAYARAN</th>
            <th class="text-right">Rp. {{ number_format($bayar->tagihan['bayar']) }}.-</th>
        </tr>
    </table>
    <a href='/buktiBayarPPDB/{{ $calon->id }}' class="btn btn-danger mb-3 col-md-12" target="_blank"><b>Cetak Bukti Pembayaran Daftar Ulang PPDB SIT Nurul Fikri</b></a>
@endisset

@empty($calon->bayarppdb)
    <h3><b>BELUM TERSEDIA</b></h3>
    <hr>
    <p>Silahkan hubungi Panitia PPDB Online - SIT Nurul Fikri</p>
@endempty
