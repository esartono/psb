@extends('pdf.template')

@section('isi')
    <style>
    th {
        text-align: left !important;
    }
    .jarak {
        margin-bottom: 10px;
    }
    .biaya {
        width: 100%;
    }
    .biaya_pisah {
        margin-top: 130px;
        margin-bottom: 50px;
    }
    .biaya, .biaya th, .biaya td {
        border: 1px solid black !important;
        border-collapse: collapse;
    }
    .biaya td {
        padding: 5px;
    }
    .biaya th {
        padding: 7px !important;
        background-color: aquamarine;
        font-weight: 800;
        color: black;
    }
    .roman li {
        list-style: upper-roman;
        display: list-item;
        font-weight: 800;
        color: #000;
        margin: 20px 0;
    }

    .biasa li {
        list-style: decimal;
        font-weight: 400;
        text-transform: none;
        padding: 0 0 0 0px;
        margin: 0 0 0 -15px;
    }

    .step1 li {
        list-style: lower-latin;
        font-weight: 400;
        text-transform: none;
    }
    </style>
    <div>
        <b><i>Assalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
        Terimakasih anda telah melakukan pendaftaran calon siswa baru SIT Nurul Fikri. Ini merupakan tahap awal dari Pendaftaran Penerimaan Siswa Baru SIT Nurul Fikri.
        Berikut data yang telah Anda isikan :
        </div>
        <table class="biodata">
            <tr>
                <th width="30%">Nama Lengkap</th>
                <td>{{ $calonsnya->name }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $calonsnya->kelamin }}</td>
            </tr>
            <tr>
                <th>Tempat, Tanggal Lahir</th>
                <td>{{ $calonsnya->tgl_lahir->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <th>Kelas Tujuan</th>
                <td>
                    {{ $calonsnya->kelasnya->name }}
                </td>
            </tr>
        </table>
        <br>
        <center>Nomor pendaftarannya adalah : </center>
        <table class="kotak">
            <tr>
                <td>{{ $calonsnya->uruts }}</td>
            </tr>
        </table>
        <p>Untuk melanjutkan proses pendaftaran, silakan melunasi biaya pendaftaran sejumlah:
            Rp. {{ number_format($calonsnya->biayates->biayanya->biaya) }},-, 
            batas waktu pembayaran sampai tanggal : <b>{{ date('d M Y', strtotime($calonsnya->biayates->expired)) }}</b></p>
    </div>
    @if(date("Y-m-d", strtotime($calonsnya->tgl_daftar)) > "2023-03-01")
        <p>Pembayaran Biaya Pendaftaran silahkan melalui rekening bank :</p>
        <p><b>BSI (Bank Syariah Indonesia) 7000326668</b> a.n. YAY PEND DAN PEMB NURUL FIKRI</p>
        <p>Jika sudah melakukan pembayaran, silakan konfirmasi dengan mengirimkan bukti transfer ke nomor Whatsapp <b>0822 1133 3434</b></p>
    @else
        <p style="page-break-after: always;">
            <div class="container">
                <div class="row" style="margin-top: 120px;">
                    @include('wawancara.tatacara')
                </div>
            </div>
        </p>
    @endif
@endsection