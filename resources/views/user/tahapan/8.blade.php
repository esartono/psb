@isset($calon->bayarppdb)
    @if($calon->bayarppdb['cpsb']->lunas == 0)
        <div class="callout callout-danger">
            <h5>Status Daftar Ulang : Belum Lunas</h5>
        </div>
    @endif
    @if($calon->bayarppdb['cpsb']->lunas == 1)
        <div class="callout callout-success">
            <h5>Status Daftar Ulang : Lunas</h5>
            <a href='/buktiBayarPPDB/{{ $calon->id }}' class="btn btn-danger" style="color: white; text-decoration: none;" target="_blank"><b>Cetak Bukti Pembayaran <br>Daftar Ulang PPDB SIT Nurul Fikri</br></a>
        </div>
    @endif
    <hr>
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
                    @if($calon->tahap == 7.5)
                        <a href='/AmbilBukuPDF/{{ $calon->id }}' class="btn btn-warning mb-2" style="text-decoration: none;"><i class="fas fa-print"> </i> &nbsp;Cetak Surat Pengambilan Media Pembelajaran</a>
                    @endif
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
    <div class="callout callout-warning">
        <a href='/file/017-Eks-PPDB-SITNF-V-2024, Surat Edaran Info Pembayaran SPP Peserta Didik Baru TP 2024-2025.pdf' class="btn btn-danger mb-3" style="color: white; text-decoration: none;" target="_blank"><b>Surat Edaran informasi SPP SIT Nurul Fikri</b></a>
        @if($bayarspp == 'Belum')
            <a href='/bayarSPP/{{ $calon->id }}' class="btn btn-success mb-2" style="color: white; text-decoration: none;"><i class="fas fa-paper-plane"> </i> &nbsp;Kirim Bukti Bayar SPP</a>
            <h5 class="mt-2">Ketentuan Pengambilan Media Pembelajaran</h5>
            <ul>
                <li>Sudah melunasi SPP Juli 2024 sebesar : <b>Rp. {{ number_format($spp) }}</b></li>
                <li>Pembayaran dapat dilakukan mulai tanggal : 5 Juni 2024</li>
                <li>Pembayaran melalui <strong>Rekening Virtual BJB Syariah </strong>:
                    <h4 class="mt-3 red"><u><b>888 276 {{ $calon->uruts }} 0</b></u></h4>
                    <p><strong>atas nama: {{ $calon->name }}</strong></p>
                </li>
            </ul>    
        @endif
        @if((int)date('m') > 5 && (int)date('m') < 9)
            @if($bayarspp == 'Sudah')
                {{-- <a class="btn btn-success mb-2" style="color: white; text-decoration: none;"><i class="fas fa-paper-plane"> </i> &nbsp;Menunggu Verifikasi panitia</a> --}}
                @isset($cekbayarspp)
                    <table class="table table-bordered">
                        <tr>
                            <th width="25%">Tanggal Bayar</th>
                            <th width="25%">Jumlah Bayar</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>{{ $cekbayarspp->tanggal_bayar }}</td>
                            <td>{{ number_format($cekbayarspp->jumlahbayar) }}</td>
                            <th>
                                @if($cekbayarspp->verifikasi == 1)
                                    Pembayaran SPP telah di verifikasi
                                @endif
                                @if($cekbayarspp->verifikasi == 0)
                                    Pembayaran SPP belum di verifikasi
                                @endif
                            </th>
                        </tr>
                    </table>
                @endisset
            @endif
        @endif        
    </div>
@endisset
