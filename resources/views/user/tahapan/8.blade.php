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
    <div class="callout callout-success">
        <h5 class="mb-3">Surat Pengambilan Seragam</h5>
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
        </table>
        <a href='/AmbilSeragamPDF/{{ $calon->id }}' class="btn btn-success mb-2" style="color: white; text-decoration: none;"><i class="fas fa-print"> </i> &nbsp;Cetak Surat Pengambilan Seragam</a>
        @if($calon->tahap == 7.5)
            <a href='/AmbilBukuPDF/{{ $calon->id }}' class="btn btn-warning mb-2" style="text-decoration: none;"><i class="fas fa-print"> </i> &nbsp;Cetak Surat Pengambilan Media Pembelajaran</a>
        @endif
    </div>
@endisset
