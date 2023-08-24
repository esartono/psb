<div class="mt-4">
    <h4>Kelengkapan Data dan Berkas</h4>
    <hr>
    <table class="table table-bordered table-striped">
        <tr>
            <th style="width: 30%">Keterangan</th>
            <th>Status</th>
            <th style="width: 40%">Aksi</th>
        </tr>
        <tr>
            <td style="font-weight: bold">Data Calon Siswa</td>
            <td>
                Data Belum Lengkap
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="min-width: 2rem; width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>
            </td>
            <td><a href="/editcalon/{{ $calon->id }}" class="btn btn-info btn-block text-white"><i class="fas fa-user-edit"> </i><b> Lengkapi Data</b></a></td>
        </tr>
        <tr>
            <td style="font-weight: bold">Dokumen</td>
            @if($calon->dokumen[0] >= $calon->dokumen[1])
            <td>
                Dokumen sudah Lengkap
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
            </td>
            @else
                <td>
                    Dokumen belum Lengkap <br>{{ $calon->dokumen[0] }} dari {{ $calon->dokumen[1] }} dokumen
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="min-width: 2rem; width: {{ ($calon->dokumen[0]*100)/$calon->dokumen[1] }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{ ($calon->dokumen[0]*100)/$calon->dokumen[1] }}%</div>
                    </div>
                </td>
                Belum Lengkap hanya {{ $calon->dokumen[0] }} dari {{ $calon->dokumen[1] }} dokumen
            @endif
            <td><a href='/dokumen/{{ $calon->id }}' class="btn btn-danger btn-block "><i class="fa fa-book"> </i> &nbsp;Upload Dokumen</a></td>
        </tr>
    </table>
</div>
