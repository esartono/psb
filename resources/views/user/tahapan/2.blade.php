<div class="mt-4">
    @if($calon->jadwal->seleksi_online === '-')
        <h5 style="font-size: large">Tes Seleksi ( <b>{{ $calon->jadwal->seleksi !== '-' ? $calon->jadwal->seleksi->isoFormat('D MMMM Y') : "Jadwal belum Tersedia"}}</b> )</h5>
        @if($calon->jadwal->akademik_link)
            <a target="_blank" class="btn btn-outline-success" href="{{ $calon->jadwal->akademik_link }}">Silahkan klik di sini untuk gabung ke Whatsapp Grup Tes </a>
        @endif
    @else
        <h5 style="font-size: large">Tes Seleksi - Offline ( <b>{{ $calon->jadwal->seleksi !== '-' ? $calon->jadwal->seleksi->isoFormat('D MMMM Y') : "Jadwal belum Tersedia"}}</b> )</h5>
        @if(is_null($calon->jadwal->seleksi_online))
            {{-- <h5 class="timeline-header">Tes Seleksi - Online ( <b>Jadwal belum Tersedia</b> )</h5> --}}
        @else
        <h5 style="font-size: large">Tes Seleksi - Online ( <b>{{ $calon->jadwal->seleksi_online->isoFormat('D MMMM Y')}}</b> )</h5>
        @endif
    @endif
    <hr>
    <h5 style="font-size: large">Kelengkapan Data dan Berkas</h5>
    <hr>
    <table class="table table-bordered table-striped">
        <tr>
            <th style="width: 30%">Keterangan</th>
            <th>Status</th>
            <th style="width: 40%">Aksi</th>
        </tr>
        <tr>
            <td style="font-weight: bold">Data Calon Siswa</td>
            @if($calon->lengkapdata[0] >= $calon->lengkapdata[1])
                <td>
                    Data sudah lengkap
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                    </div>
                </td>
            @else
                <td>
                    Data Belum Lengkap <br>
                    dibagian : <br>
                    {{ $calon->lengkapdata[2][$calon->lengkapdata[0]+1] }}
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="min-width: 2rem; width: {{ ($calon->lengkapdata[0]*100)/$calon->lengkapdata[1] }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ round(($calon->lengkapdata[0]*100)/$calon->lengkapdata[1],2) }}%</div>
                    </div>
                </td>
            @endif
            @if($calon->lengkapdata[0] >= $calon->lengkapdata[1])
                <td>
                    <a href="/editcalon/{{ $calon->id }}" class="btn btn-info btn-block text-white"><i class="fas fa-user-edit"> </i><b> Edit Data</b></a>
                </td>
            @else
                <td>
                    <a href="/editcalon/{{ $calon->id }}" class="btn btn-info btn-block text-white"><i class="fas fa-user-edit"> </i><b> Lengkapi Data</b></a>
                </td>
            @endif
        </tr>
        <tr>
            <td style="font-weight: bold">Dokumen</td>
            @if($calon->dokumen[0] >= $calon->dokumen[1])
            <td>
                Dokumen sudah Lengkap
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
            </td>
            @else
                <td>
                    Dokumen belum Lengkap <br>{{ $calon->dokumen[0] }} dari {{ $calon->dokumen[1] }} dokumen
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="min-width: 2rem; width: {{ ($calon->dokumen[0]*100)/$calon->dokumen[1] }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{ round(($calon->dokumen[0]*100)/$calon->dokumen[1],2) }}%</div>
                    </div>
                    <i>* Selambat-lambatnya 5 hari setelah pelunasan pembayaran tes seleksi.</i>
                </td>
            @endif
            <td><a href='/dokumen/{{ $calon->id }}' class="btn btn-danger btn-block "><i class="fa fa-book"> </i> &nbsp;Upload Dokumen</a></td>
        </tr>
    </table>
</div>
