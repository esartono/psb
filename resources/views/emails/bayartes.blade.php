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
    <p>Selanjutnya anda dapat memilih <strong>Jadwal Tes</strong></p>
    <p>Terima kasih.</p>
@endsection
