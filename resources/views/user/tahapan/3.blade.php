<div class="mt-4">
    <h5 style="font-size: large">Edit Dokumen &nbsp; : &nbsp;&nbsp;&nbsp;
        <a href='/dokumen/{{ $calon->id }}' class="btn btn-sm btn-danger btn-block "><i class="fa fa-book"> </i> &nbsp;Edit Dokumen</a>
    </h5>
    
    <hr>
    @if($calon->jadwal->seleksi_online === '-')
        <h5>Tes Seleksi ( <b>{{ $calon->jadwal->seleksi !== '-' ? $calon->jadwal->seleksi->isoFormat('D MMMM Y') : "Jadwal belum Tersedia"}}</b> )</h5>
    @else
        <h5 class="timeline-header">Tes Seleksi - Offline ( <b>{{ $calon->jadwal->seleksi !== '-' ? $calon->jadwal->seleksi->isoFormat('D MMMM Y') : "Jadwal belum Tersedia"}}</b> )</h5>
        @isset($calon->jadwal->akademik_link)
            <a target="_blank" class="btn btn-outline-success" href="{{ $calon->jadwal->akademik_link }}">Silahkan klik di sini untuk gabung ke Whatsapp Grup Tes </a>
        @endisset
        @if(is_null($calon->jadwal->seleksi_online))
            {{-- <h5 class="timeline-header">Tes Seleksi - Online ( <b>Jadwal belum Tersedia</b> )</h5> --}}
        @else
            <h5 class="timeline-header">Tes Seleksi - Online ( <b>{{ $calon->jadwal->seleksi_online->isoFormat('D MMMM Y')}}</b> )</h5>
        @endif
    @endif
    <hr>
    <p>
        Tahapan Tes terdiri dari :
        <ol style="margin-left: 20px;">
            @if($calon->gelnya->unitnya->catnya->name == 'TK')
                {{-- <li>mendownload formulir screening awal <a href='/dokumen_ppdb/Lembar Screening Awal Tumbuh Kembang Anak SDIT NF (2025) - Diisi Ortu.pdf' class="btn btn-info btn-sm mb-2" target="_blank">Lembar Screening Awal</a></li>
                <li>Mengupload dokumen formulir screening awal <a href='/dokumen/{{ $calon->id }}' class="btn btn-sm btn-danger btn-block mb-2">Upload Dokumen</a></li> --}}
                <li>Tes Psikologi</li>
                <li>Wawancara Orangtua</li>
                <li>Wawancara administrasi sekolah</li>
            @endif
            @if($calon->gelnya->unitnya->catnya->name == 'SD')
                <li>mendownload formulir screening awal <a href='/dokumen_ppdb/Lembar Screening Awal Tumbuh Kembang Anak SDIT NF (2025) - Diisi Ortu.pdf' class="btn btn-info btn-sm mb-2" target="_blank">Lembar Screening Awal</a></li>
                <li>Mengupload dokumen formulir screening awal <a href='/dokumen/{{ $calon->id }}' class="btn btn-sm btn-danger btn-block mb-2">Upload Dokumen</a></li>
                <li>Tes Psikologi</li>
                <li>Wawancara Orangtua</li>
                <li>Wawancara administrasi sekolah</li>
            @endif
            @if($calon->gelnya->unitnya->catnya->name == 'SMP')
                @if($calon->asal_nf == 0)
                    <li>Tes Potensi Akademik (<i>Offline</i>) pada pukul 07.00 - 08.15</li>
                @endif
                <li>Mengisi <a href='/kelengkapanData/{{ $calon->id }}' class="btn btn-sm btn-warning mt-3" >Formulir kelengkapan seleksi</a></li>
                <li>Tes psikologi (<i>Offline</i>) pada pukul 08.30 - 12.00</li>
                <li>Wawancara administrasi sekolah (<i>Offline</i>) pada pukul 08.00 - 12.00 (perSesi <u>+</u>30 menit sesuai jadwal)</li>
                <li>Wawancara untuk orangtua calon siswa (<i>Offline</i>) pada pukul 08.00 - 15.00 (perSesi <u>+</u>30 menit sesuai jadwal)</li>
                <li>Wawancara calon siswa (<i>Offline</i>) pada pukul 08.00 - 15.00 (perSesi <u>+</u>30 menit sesuai jadwal)</li>
            @endif
            @if($calon->gelnya->unitnya->catnya->name == 'SMA')
                @if($calon->asal_nf == 0)
                    <li>Tes Potensi Akademik (<i>Offline</i>) pada pukul 07.00 - 08.15 (<b>Calon Siswa diwajibkan membawa laptop</b>)</li>
                @endif
                <li>Mengisi <a href='/kelengkapanData/{{ $calon->id }}' class="btn btn-sm btn-warning mt-3" >Formulir kelengkapan seleksi</a></li>
                <li>Tes psikologi (<i>Offline</i>) pada pukul 08.30 - 12.00</li> (<b>Calon Siswa diwajibkan membawa laptop</b>)</li>
                <li>Wawancara administrasi sekolah (<i>Offline</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
                <li>Wawancara orangtua calon siswa (<i>Offline</i>) pada pukul 08.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
                <li>Wawancara calon siswa (<i>Offline</i>) pada pukul 08.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
            @endif
        </ol>
    </p>
    <hr>
    @if($calon->gelnya->unitnya->catnya->name == 'SD' || $calon->gelnya->unitnya->catnya->name == 'TK')
        <a class="btn btn-warning mt-3" href="{{ route('praWawancara.create', ['calon' => $calon->id]) }}">Form Kelengkapan seleksi Orang Tua</a>
        {{-- <a href='/kelengkapanData/{{ $calon->id }}' class="btn btn-warning mt-3">Lihat Formulir kelengkapan seleksi</a> --}}
    @endif
    @if($calon->gelnya->unitnya->catnya->name == 'SMP' || $calon->gelnya->unitnya->catnya->name == 'SMA')
        <a href='/kelengkapanData/{{ $calon->id }}' class="btn btn-warning mt-3">Lihat Formulir kelengkapan seleksi</a>
    @endif
    <a href='/seleksiPDF/{{ $calon->id }}' class="btn btn-success mt-3" target="_blank">Cetak Kartu Peserta</a>
    <hr>
    <h5 class="timeline-header">Pengumuman - Online ( <b>{{ $calon->jadwal->seleksi !== '-'  ? $calon->jadwal->pengumuman->isoFormat('D MMMM Y') : "Silahkan hubungi Panitia"}}</b> )</h5>
</div>
