<h3>Rekap Pembayaran Tagihan PSB - {{ date('d-m-Y', strtotime(now())) }}</h3>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>No. Pendaftaran</th>
        <th>VA Muamalat</th>
        <th>Nama</th>
        <th>Tanggal Bayar</th>
        <th>Bayar</th>
        <th>Keterangan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->calonnya->gelnya->unitnya->name }}</td>
            <td>{{ $calon->calonnya->uruts }}</td>
            <td>'860001{{ $calon->calonnya->gel_id }}{{ $calon->calonnya->uruts }}</td>
            <td>{{ $calon->calonnya->name }}</td>
            <td>{{ date('d-m-Y', strtotime($calon->tgl_bayar)) }}</td>
            <td>{{ $calon->bayar }}</td>
            <td>{{ $calon->keterangan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
