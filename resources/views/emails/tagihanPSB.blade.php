@extends('emails.template')

@section('isi')
    <p>
    <b><i>Assalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
    Terimakasih <strong>Berikut ini terlampir hasil wawancara Administrasi Keuangan</strong>.

    <center>Nomor pendaftarannya adalah : </center>
    <table class="kotak">
        <tr>
            <td>{{ $calonsnya->uruts }}</td>
        </tr>
    </table>
    <p>Penyerahan form wawancara administrasi sekolah sesuai jadwal.</p>
    <p>Dokumen yang harus diserahkan terdiri dari :</p>
    <ol>
        <li>Surat Pernyataan</li>
        <li>Form Pembiayaan Reguler 1</li>
        <li>Form Pembiayaan Reguler 2</li>
        <li>Form Pembiayaan Reguler 3</li>
        <li>Form Pengembalian Dana</li>
    </ol>

    <p>Bagi yang ingin menyerahkan form melalui kurir mohon menginformasikan terlebih dahulu ke nomor admin keuangan</p>
    <ul>
        <li>admin SD 6285710688325</li>
        <li>admin SMP-SMA 6289678412132</li>
    </ul>
    <p>Terima kasih.</p>
@endsection
