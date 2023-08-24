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
        <h5 class="mb-3">Input Ukuran Seragam</h5>
        <a href='/uniform/{{ $calon->id }}' class="btn btn-success mb-2" style="color: white; text-decoration: none;"><i class="fas fa-tshirt"> </i> &nbsp;Pilih Ukuran Seragam</a>
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
    </div>
@endisset
