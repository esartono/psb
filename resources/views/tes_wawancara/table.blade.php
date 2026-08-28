<div class="container mt-5">
    <div class="card">
        <div class="card-body p-4">
            <table class="table table-sm align-middle">
                <thead class="align-middle text-center">
                    <tr>
                        <th rowspan="3">No.</th>
                        <th rowspan="3">No. Pendaftaran</th>
                        <th rowspan="3">Nama Calon Siswa</th>
                        <th colspan="8">Wawancara</th>
                    </tr>
                    <tr>
                        <th colspan="3">Orang Tua</th>
                        <th colspan="3">Siswa</th>
                        <th colspan="2">Observasi Siswa</th>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th>Skor</th>
                        <th>Edit</th>
                        <th>Tanggal</th>
                        <th>Skor</th>
                        <th>Edit</th>
                        <th>Tanggal</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($wawancara)
                        @foreach ($wawancara as $w)
                        <tr>
                            <td class="text-center">{{ $w['no'] }}</td>
                            <td class="text-center">{{ $w['no_pendaftaran'] }}</td>
                            <td>{{ $w['nama'] }}</td>
                            <th class="text-center">{{ $w['tgl_ortu'] }}</th>
                            <th class="text-center">{{ $w['skor_ortu'] }}</th>
                            <th class="text-center">
                                @if($w['skor_ortu'] !== '-')
                                    <a href="/teswawancara?wawancara=ortu&id_pendaftaran={{ $w['no_pendaftaran'] }}"
                                        class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                @else
                                    -
                                @endif
                            </th>
                            <th class="text-center">{{ $w['tgl_siswa'] }}</th>
                            <th class="text-center">{{ $w['skor_siswa'] }}</th>
                            <th class="text-center">
                                @if($w['skor_siswa'] !== '-')
                                    <a href="/teswawancara?wawancara=siswa&id_pendaftaran={{ $w['no_pendaftaran'] }}"
                                        class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                @else
                                    -
                                @endif
                            </th>
                            <th class="text-center">{{ $w['tgl_observasi'] }}</th>
                            <th class="text-center">
                                @if($w['tgl_observasi'] !== '-')
                                    <a href="/observasiPPDB?id={{ $w['id'] }}&editdulu=eko"
                                        class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                @else
                                    -
                                @endif
                            </th>
                        </tr>
                        @endforeach                    
                    @endisset
                    @empty($wawancara)
                        <tr>
                            <td colspan="3" class="text-center p-3"><h4> --- Belum ada Data --- </h4></td>
                        </tr>
                    @endempty
                </tbody>
            </table>   
        </div>
    </div>
</div>