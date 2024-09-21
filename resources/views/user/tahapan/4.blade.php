<h5 class="timeline-header">Pengumuman Hasil Tes - Online </h5> <br>
<p>Pengumuman hasil akan dilaksanakan secara online pada tanggal : <br>
    <b>{{ ($calon->jadwal->seleksi) ? $calon->jadwal->pengumuman->isoFormat('D MMMM Y') : ""}}</b>
</p>
<hr>
<a href='/seleksiPDF/{{ $calon->id }}' class="btn btn-success mt-3 col-md-8" target="_blank"><b>Cetak Kartu Peserta</b></a>
<a href='/printTagihanPPDB/{{ $calon->id }}' class="btn btn-danger mt-3 col-md-8" target="_blank"><b>Cetak Form Wawancara Keuangan <br> PPDB SIT Nurul Fikri</b></a>
