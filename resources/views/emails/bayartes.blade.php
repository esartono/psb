@extends('emails.template')

@section('isi')
    <p>
    <b><i>Assalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
    Terimakasih <strong>Pembayaran Biaya Tes sudah Kami terima</strong>.

    <center>Nomor pendaftarannya adalah : </center>
    <table class="kotak">
        <tr>
            <td>{{ $calonsnya->uruts }}</td>
        </tr>
    </table>
    <p>biaya pendaftaran sejumlah: Rp. {{ number_format($calonsnya->biayates->biayanya->biaya) }},-,</p>
    <p>Selanjutnya Calon siswa dan Orang tua akan mendapatkan jadwal Tes seleksi yang tercantum di Kartu Seleksi.
     Kartu seleksi dapat di akses melalui website PPDB Online SIT Nurul Fikri</p>
    @if($calonsnya->gel_id == 3)
    <p> Tes Terdiri dari :</p>
    <ol>
        <li>Tes akademik siswa (<i>online</i>) pada pukul 07.00 - 08.15</li>
        <li>Tes psikologi (<i>online, menggunakan aplikasi zoom dan aplikasi psikotes)</i> pada pukul 08.30 - 12.00</li>
        <li>Wawancara orangtua calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
        <li>Wawancara administrasi sekolah (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
        <li>Wawancara calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 13.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
    </ol>
    @endif
    @if($calonsnya->gel_id == 4)
    <p> Tes Terdiri dari :</p>
    <ol>
        <li>Tes akademik siswa (<i>online</i>) pada pukul 07.00 - 08.30</li>
        <li>Tes psikologi (<i>online, menggunakan aplikasi zoom dan aplikasi psikotes)</i> pada pukul 08.45 - 12.00</li>
        <li>Wawancara orangtua calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
        <li>Wawancara administrasi sekolah (<i>online, menggunakan aplikasi zoom</i>) pada pukul 08.00 - 12.00 (perSesi 30 menit sesuai jadwal)</li>
        <li>Wawancara calon siswa (<i>online, menggunakan aplikasi zoom</i>) pada pukul 13.00 - 15.00 (perSesi 30 menit sesuai jadwal)</li>
    </ol>
    @endif
    <p>Terima kasih.</p>
@endsection
