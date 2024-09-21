@isset($calon->bayarppdb)
    @if($calon->bayarppdb['cpsb']->lunas == 0)
        <div class="callout callout-danger">
            <h5>Status Daftar Ulang : Belum Lunas</h5>
        </div>
    @endif
    @if($calon->bayarppdb['cpsb']->lunas == 1)
        <div class="callout callout-success">
            <h5>Status Daftar Ulang : Lunas</h5>
            <a href='/buktiBayarPPDB/{{ $calon->id }}' class="btn btn-danger" style="color: white; text-decoration: none;" target="_blank"><b>Cetak Bukti Pembayaran Daftar Ulang PPDB SIT Nurul Fikri</b></a>
        </div>
    @endif
    <hr>
    @if($calon->seragam['sudah'])
    <div class="callout callout-success">
        <table class="table table-sm table-bordered">
            <tr>
                <th>Keterangan</th>
                <th>Ukuran</th>
                <td></td>
            </tr>
            <tr>
                <td>Ukuran Baju atau Blouse</td>
                <th>
                    @if($calon->seragam['atas'] == '' || $calon->seragam['atas'] == '-')
                        Belum Input
                    @else
                        {{ $calon->seragam['atas'] }}
                    @endif
                </th>
                <td rowspan="2">
                    <a href='/AmbilSeragamPDF/{{ $calon->id }}' class="btn btn-success mb-2" style="color: white; text-decoration: none;"><i class="fas fa-print"> </i> &nbsp;Cetak Surat Pengambilan Seragam</a>
                </td>
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
        </table>
    </div>
    @endif
    <div class="callout callout-success">
        <h5 class="mb-3">Surat Pengambilan Media Pembelajaran</h5>
        {{-- @if($calon->tahap == 8.5) --}}
            <a href='/AmbilBukuPDF/{{ $calon->id }}' class="btn btn-success mb-2" style="text-decoration: none;"><i class="fas fa-print"> </i> &nbsp;Cetak Surat Pengambilan Media Pembelajaran</a>
        {{-- @else
            <a class="btn btn-info mb-2" style="text-decoration: none;"><i class="fas fa-print"></i> Belum Tersedia</a> --}}
        {{-- @endif --}}
    </div>
@endisset
