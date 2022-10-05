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
