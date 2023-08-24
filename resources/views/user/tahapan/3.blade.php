<div class="mt-4">
    @if($calon->jadwal->seleksi_online === '-')
        <h5 class="timeline-header">Tes Seleksi ( <b>{{ $calon->jadwal->seleksi !== '-' ? $calon->jadwal->seleksi->isoFormat('D MMMM Y') : "Jadwal belum Tersedia"}}</b> )</h5>
    @else
        <h5 class="timeline-header">Tes Seleksi - Offline ( <b>{{ $calon->jadwal->seleksi !== '-' ? $calon->jadwal->seleksi->isoFormat('D MMMM Y') : "Jadwal belum Tersedia"}}</b> )</h5>
        @if(is_null($calon->jadwal->seleksi_online))
            <h5 class="timeline-header">Tes Seleksi - Online ( <b>Jadwal belum Tersedia</b> )</h5>
        @else
            <h5 class="timeline-header">Tes Seleksi - Online ( <b>{{ $calon->jadwal->seleksi_online->isoFormat('D MMMM Y')}}</b> )</h5>
        @endif
    @endif
    <hr>
    <p>
        Tahapan Tes terdiri dari :
        <ol>
            @if($calon->gelnya->unitnya->catnya->name == 'TK' || $calon->gelnya->unitnya->catnya->name == 'SD')
                <li>Tes Psikologi</li>
                <li>Wawancara Orangtua</li>
                <li>Wawancara administrasi sekolah</li>
            @endif
            @if($calon->gelnya->unitnya->catnya->name == 'SMP')
                <li>Tes akademik siswa (<i>Online</i>) pada pukul 07.00 - 08.15</li>
                <li>Tes psikologi (<i>Online</i>) pada pukul 08.30 - 12.00</li>
                <li class="mb-3">Wawancara administrasi sekolah (<i>Online</i>) pada pukul 08.00 - 12.00 (perSesi <u>+</u>30 menit sesuai jadwal)</li>
                <li>Wawancara untuk orangtua calon siswa (<i>Offline</i>) pada pukul 08.00 - 15.00 (perSesi <u>+</u>30 menit sesuai jadwal)</li>
                <li>Wawancara calon siswa (<i>Offline</i>) pada pukul 08.00 - 15.00 (perSesi <u>+</u>30 menit sesuai jadwal)</li>
            @endif
            @if($calon->gelnya->unitnya->catnya->name == 'SMA')
                <li>Tes akademik siswa (<i>Online</i>) pada pukul 07.00 - 08.30</li>
                <li>Tes psikologi (<i>Online</i>) pada pukul 08.45 - 12.00</li>
                <li class="mb-3">Wawancara administrasi sekolah (<i>Online</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                <li>Wawancara orangtua calon siswa (<i>Offline</i>) pada pukul 08.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
                <li>Wawancara calon siswa (<i>Offline</i>) pada pukul 08.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
            @endif
        </ol>
    </p>
    <hr>
    <h5 class="timeline-header">Pengumuman - Online ( <b>{{ $calon->jadwal->seleksi !== '-'  ? $calon->jadwal->pengumuman->isoFormat('D MMMM Y') : "Silahkan hubungi Panitia"}}</b> )</h5>
    <a href='/seleksiPDF/{{ $calon->id }}' class="btn btn-success mt-3" target="_blank">Cetak Kartu Peserta</a>
</div>
