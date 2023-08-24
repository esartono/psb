@isset($calon->bt['biayanya']->biaya)
    <div class="mt-4">
        <h3>Biaya Pendaftaran PPDB : &nbsp; <b>Rp. {{ number_format($calon->bt['biayanya']->biaya) }}</b></h3>
        <hr>
        <p>Dibayarkan melalui rekening Virtual Account Bank Syariah Indonesia (BSI):</p>
        <h3><b>{{ $calon->uruts }}</b></h3>
        Paling lambat pembayaran dilakukan pada tanggal : 
        <br><span style="font-size: 1.35rem; font-weight: bold">{{ $calon->bt['biayates']->expired->isoFormat("D MMMM Y") }}</span> <br>
        @php
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $startDate = date('Y-m-d', strtotime("01/03/2023"));
            $endDate = date('Y-m-d', strtotime("20/08/2023"));
        @endphp
        @if (($currentDate >= $startDate) && ($currentDate <= $endDate))
            <p>Pembayaran Biaya Pendaftaran silahkan melalui rekening bank :</p>
                <b>BSI (Bank Syariah Indonesia) 7000326668</b><br> a.n. YAY PEND DAN PEMB NURUL FIKRI<br>
            </p>
            <p>Jika sudah melakukan pembayaran, silakan konfirmasi dengan mengirimkan bukti transfer ke nomor Whatsapp <b>0822 1133 3434</b></p>
        @else
            <i>Verifikasi pembayaran akan dilakukan secara otomatis oleh system dan memerlukan waktu 5 - 10 menit setelah pembayaran</i>
            <hr>
            Tata cara pembayaran melalui Mobile Banking atau Net Banking Bank selain Bank Syariah Indonesia (BSI)
            <ol>
                <li>Pilih Menu Transfer ke Bank Lain</li>
                <li>Pilih Bank Tujuan : Bank Syariah Indonesia (kode : 451)</li>
                <li>Masukan Nomor Rekening Tujuan
                    <ul>
                        <li>Kode Pembayaran Pendidikan : <b>900</b></li>
                        <li>Kode YPPU Nurul Fikri : <b>3292</b></li>
                        <li>
                            Kode Pendaftaran : <b>{{ $calon->uruts ?? '24253xxxx' }} (sesuai nomor pendaftaran).</b><br>
                            contoh : <b>900 3292 {{ $calon->uruts ?? '24253xxxx'  }}</b>
                        </li>
                    </ul>
                </li>
                <li>Masukan nominal pembayaran, <b>harus sesuai dengan jumlah tagihan</b></li>
                <li>Pilih jenis Rekening Tujuan - <b>GIRO</b></li>
                <li>Akan muncul konfirmasi transfer</li>
            </ol>
            <a href='biayatesPDF/{{ $calon->id }}' class="btn btn-primary mt-3 white" target="_blank">Tata Cara Pembayaran</a>
        @endif
    </div>
@endisset

@empty($calon->bt['biayanya']->biaya)
<div class="text-center mt-4">
    <h3><b>BELUM TERSEDIA</b></h3>
    <hr>
    <p>Silahkan hubungi Panitia PPDB Online - SIT Nurul Fikri</p>
</div>
@endempty
