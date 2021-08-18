<div class="mt-4">
    <h4 class="timeline-header">Tes Seleksi - Online ( <b>{{ $calon->jadwal->seleksi->isoFormat('D MMMM Y') }}</b> )</h4>
    <p>
        Tahapan Tes terdiri dari :
        <ol>
            @if($calon->gelnya->unitnya->catnya->name == 'TK' || $calon->gelnya->unitnya->catnya->name == 'SD')
                <li>Tes Psikologi</li>
                <li>Wawancara Orangtua</li>
                <li>Wawancara administrasi sekolah</li>
            @endif
            @if($calon->gelnya->unitnya->catnya->name == 'SMP')
                <li>Tes akademik siswa (<i>online</i>) pada pukul 07.00 - 08.15</li>
                <li>Tes psikologi (<i>online, menggunakan aplikasi zoom dan aplikasi psikotes)</i> pada pukul 08.30 - 12.00</li>
                <li>Wawancara orangtua calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                <li>Wawancara administrasi sekolah (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                <li>Wawancara calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 13.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
            @endif
            @if($calon->gelnya->unitnya->catnya->name == 'SMA')
                <li>Tes akademik siswa (<i>online</i>) pada pukul 07.00 - 08.30</li>
                <li>Tes psikologi (<i>online, menggunakan aplikasi zoom dan aplikasi psikotes)</i> pada pukul 08.45 - 12.00</li>
                <li>Wawancara orangtua calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                <li>Wawancara administrasi sekolah (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                <li>Wawancara calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 13.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
            @endif
        </ol>
    </p>
    <hr>
    <h4 class="timeline-header">Pengumuman - Online ( <b>{{ $calon->jadwal->pengumuman->isoFormat('D MMMM Y') }}</b> )</h4>
    <a href='/seleksiPDF/{{ $calon->id }}' class="btn btn-success mt-3" target="_blank">Cetak Kartu Peserta</a>
</div>
