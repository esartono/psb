@extends('pdf.template')

@section('isi')
    <style>
        .biodata th {
            text-align: left;
        }
    </style>
    <div>
        <b><i>Assalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
        Terimakasih Ananda telah mengikuti tes seleksi yang dilaksanakan dalam rangkaian proses PPDB SIT Nurul Fikri tahun pelajaran 2022/2023. Berdasarkan hasil seleksi, maka Ananda:
        </div>
        <table class="biodata">
            <tr>
                <th width="30%">No. Pendaftaran</th>
                <td>{{ $calonsnya->uruts }}</td>
            </tr>
            <tr>
                <th width="30%">Nama Calon Siswa</th>
                <td>{{ $calonsnya->name }}</td>
            </tr>
            <tr>
                <th>Asal Sekolah</th>
                <td>{{ $calonsnya->asal_sekolah }}</td>
            </tr>
            <tr>
                <th>Tujuan Level</th>
                <td>{{ $calonsnya->gelnya->unitnya->name }}</td>
            </tr>
            <tr>
                <th>Kelas Tujuan</th>
                <td>Kelas {{ $calonsnya->kelasnya->name }}</td>
            </tr>
            <tr>
                <th>Dinyatakan</th>
                <td><b>"DITERIMA"</b></td>
            </tr>
        </table>
        Pernyataan hasil seleksi ini adalah dan dapat digunakan sebagaimana mestinya.
        <br>
        <br>
        Demikian, mohon menjadi perhatian. Terimakasih
        <br>
        <b><i>Wassalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
        <br>
        <p>Tertanda</p>
        <br>
        <br>
        <br>
        <b>Panitia PPDB SIT Nurul Fikri</b>
    </div>
@endsection
