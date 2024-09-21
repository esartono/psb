@isset($calon->hasil['hasil'])
    <div class="text-center mt-4">
        <h5>Pengumuman</h5>
        <hr>
        <p>Berdasarkan keputusan panitia PPDB SIT Nurul Fikri menyatakan</p>
        <h3><b>
            @if($calon->hasil['hasil']->lulus == 1)
                Diterima
            @endif
            @if($calon->hasil['hasil']->lulus == 2)
                Cadangan
            @endif
            @if($calon->hasil['hasil']->lulus <> 1 && $calon->hasil['hasil']->lulus <> 2)
                Tidak Diterima
            @endif
        </b></h3>
	<b>{{ $calon->hasil['hasil']->catatan }}</b>
	<hr>
        {{-- <a href='biayatesPDF/{{ $calon->id }}' class="btn btn-success mt-3" target="_blank">Cetak Tata Cara Pembayaran</a> --}}
        @if($calon->hasil['hasil']->lulus == 1)
            <ul class="text-left">
                <li class="mb-3">Pembayaran dilakukan pada tanggal : <b>{{ $calon->jadwal->keterangan }}</b></li>
                <a href='/printTagihanPPDB/{{ $calon->id }}' class="btn btn-danger mb-3 col-md-12" target="_blank"><b>Cetak Form Wawancara Keuangan PPDB SIT Nurul Fikri</b></a>
                <li>Apabila sampai dengan batas waktu yang ditentukan belum melakukan pembayaran daftar ulang, maka siswa dianggap mengundurkan diri. </li>
                <li>Pembayaran melalui <strong>Rekening Virtual BJB Syariah </strong>:
                    <center><h3 class="mt-3 red"><u><b>888 276 {{ $calon->uruts }} 0</b></u></h3>
                    <p><strong>atas nama: {{ $calon->name }}</strong></p></center>
                </li>
            </ul>
        @endif
    </div>
@endisset

@empty($calon->hasil['hasil'])
<div class="text-center mt-4">
    <h3><b>BELUM TERSEDIA</b></h3>
    <hr>
    <p>Silahkan hubungi Panitia PPDB Online - SIT Nurul Fikri</p>
</div>
@endempty
