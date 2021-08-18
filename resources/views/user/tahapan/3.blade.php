@isset($calon->hasil['hasil'])
    <div class="text-center mt-4">
        <h3>Pengumuman</h3>
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
        <hr>
        {{-- <a href='biayatesPDF/{{ $calon->id }}' class="btn btn-success mt-3" target="_blank">Cetak Tata Cara Pembayaran</a> --}}
    </div>
@endisset

@empty($calon->hasil['hasil'])
<div class="text-center mt-4">
    <h3><b>BELUM TERSEDIA</b></h3>
    <hr>
    <p>Silahkan hubungi Panitia PPDB Online - SIT Nurul Fikri</p>
</div>
@endempty
