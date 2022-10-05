@extends('pdf.template_keu')

@section('isi')
<style>
    .rincian {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
    }

    .rincian, .rincian th, .rincian td {
      border: 1px solid black;
      padding: 5px;
    }

    .lunas {
        width: 70%;
        opacity: 0.2;
        position: absolute;
        display: block;
        margin-left: 15%;
        margin-top: -230px; 
    }
</style>
<br>
<br>
<br>
<table style="width: 100%">
    <tr>
        <td style="width: 16%">No. Pendaftaran</td>
        <td style="width: 49%">: {{ $calon->uruts }}</td>
        <td style="width: 14%">Unit</td>
        <td>: {{ $calon->gelnya->unitnya->name }}</td>
    </tr>
    <tr>
        <td>Nama Lengkap</td>
        <td>: {{ $calon->name }}</td>
        <td>Kelas Tujuan</td>
        <td>: Kelas {{ $calon->kelasnya->name }}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: {{ $calon->kelamin }}</td>
    </tr>
</table>
<hr>
<h4>Rincian Pembayaran</h4>
<table class="rincian">
    <tr>
        <th style="width: 5%">No.</th>
        <th style="width: 30%">Tanggal Pembayaran</th>
        <th style="width: 25%">Pembayaran</th>
        <th style="width: 40%">Keterangan</th>
    </tr>
    @php
        $no = 0;
    @endphp
    @foreach($calon->bayarppdb['bayarppdb'] as $bayar)
        <tr>
            <th>{{ $no+1 }}</th>
            <th>{{ Carbon\Carbon::parse($bayar->tgl_bayar)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}</th>
            <td style="text-align: right">Rp. {{ number_format($bayar->bayar) }}.-</td>
            <td>{{ $bayar->keterangan }}</td>
        </tr>
        @php
            $no++;
        @endphp
    @endforeach
    <tr>
        <th colspan="2">TOTAL PEMBAYARAN</th>
        <th style="text-align: right">Rp. {{ number_format($bayar->tagihan['bayar']) }}.-</th>
        <td></td>
    </tr>
</table>
<table class="rincian">
    <tr>
        <td style="width: 60%">Status Pembayaran</td>
        <td style="width: 40%"><b>{{ $bayar->tagihan['lunas'] === 0 ? 'BELUM LUNAS' : 'LUNAS' }}</b></td>
    </tr>
</table>
@if ($bayar->tagihan['lunas'] === 0)
    <img class="lunas" src="img/belum_lunas.png" alt="Belum Lunas"></img>
@else
    <img class="lunas" src="img/lunas.png" alt="Lunas"></img>
@endif
@endsection
