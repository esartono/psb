<div class="container mt-5">
    <div class="card">
        <div class="card-body p-4">
            <table class="table table-sm align-middle">
                <thead class="align-middle text-center">
                    <tr>
                        <th>No.</th>
                        <th>No. Pendaftaran</th>
                        <th>Nama Calon Siswa</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($data)
                        @foreach ($data as $w)
                        <tr>
                            <td class="text-center"></td>
                            <td class="text-center">{{ $w['pendaftaran'] }}</td>
                            <td>{{ $w['nama'] }}</td>
                            <th class="text-center">{{ $w['pertanyaan'] }}</th>
                            <th class="text-center">{{ $w['jawaban'] }}</th>
                            <th class="text-center">{{ $w['catatan'] }}</th>
                        </tr>
                        @endforeach                    
                    @endisset
                    @empty($data)
                        <tr>
                            <td colspan="3" class="text-center p-3"><h4> --- Belum ada Data --- </h4></td>
                        </tr>
                    @endempty
                </tbody>
            </table>   
        </div>
    </div>
</div>