@isset($calon->bt['biayanya']->biaya)
    <div class="mt-4">
        <h3>Biaya Pendaftaran PPDB : &nbsp; <b>Rp. {{ number_format($calon->bt['biayanya']->biaya) }}</b></h3>
        <hr>
        <p>Dibayarkan melalui rekening Virtual Account Bank Syariah Indonesia (BSI):</p>
        <h3><b>{{ $calon->uruts }}</b></h3>
        Paling lambat pembayaran dilakukan pada tanggal : <span style="font-size: 1.35rem; font-weight: bold">{{ $calon->bt['biayates']->expired->isoFormat("D MMMM Y") }}</span>
        <hr>
        <a href='biayatesPDF/{{ $calon->id }}' class="btn btn-primary mt-3 white" target="_blank">Cetak Tata Cara Pembayaran</a>
    </div>
@endisset

@empty($calon->bt['biayanya']->biaya)
<div class="text-center mt-4">
    <h3><b>BELUM TERSEDIA</b></h3>
    <hr>
    <p>Silahkan hubungi Panitia PPDB Online - SIT Nurul Fikri</p>
</div>
@endempty
