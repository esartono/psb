@extends('pdf.template_keu')

@section('isi')
<style type="text/css">
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
        <td style="width: 16.2%">No. Pendaftaran</td>
        <td style="width: 48.8%">: {{ $calon->uruts }}</td>
        <td style="width: 13.5%">Unit</td>
        <td>: {{ $calon->unit }}</td>
    </tr>
    <tr>
        <td>Nama Lengkap</td>
        <td>: {{ $calon->name }}</td>
        <td>Kelas Tujuan</td>
        <td>: Kelas {{ $calon->kelas }}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: {{ $calon->jk == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
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
    <tr>
        <th>1</th>
        <th>{{ Carbon\Carbon::parse($calon->tgl_bayar)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}</th>
        <td style="text-align: right">Rp. {{ number_format($calon->bayar) }}.-</td>
        <td>SPP Juli {{ substr(auth()->user()->tpname, 0, 4) }}</td>
    </tr>
    {{-- <tr>
        <th colspan="2">TOTAL PEMBAYARAN</th>
        <th style="text-align: right">Rp. {{ number_format($bayar->tagihan['bayar']) }}.-</th>
        <td></td>
    </tr> --}}
</table>
<table class="rincian">
    <tr>
        <td style="width: 60%">Status Pembayaran</td>
        <td style="width: 40%"><b>{{ $calon->lunas === 0 ? 'BELUM LUNAS' : 'LUNAS' }}</b></td>
    </tr>
</table>
@if ($calon->lunas === 0)
    <img class="lunas" src="img/belum_lunas.png" alt="Belum Lunas"></img>
@else
    <img class="lunas" src="img/lunas.png" alt="Lunas"></img>
@endif
@endsection
