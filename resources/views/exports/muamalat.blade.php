<table>
    <thead>
    <tr>
        <th>No</th>
        <th>VA</th>
        <th>Nama</th>
        <th>TOTAL Reguler 1 (sudah dgn infaq NF dan NF Peduli)</th>
        <th>TOTAL Reguler 2 (sudah dgn infaq NF dan NF Peduli)</th>
        <th>TOTAL Reguler 3 (sudah dgn infaq NF dan NF Peduli)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>'{{ $calon->va1 }}{{ $calon->calonnya->gel_id }}{{ $calon->calonnya->uruts }}</td>
            <td>{{ $calon->calonnya->name }}</td>
            <td>{{ $calon->tagihan[1]+$calon->infaq+$calon->infaqnfpeduli }}</td>
            <td>{{ $calon->tagihan[2]+$calon->infaq+$calon->infaqnfpeduli }}</td>
            <td>{{ $calon->tagihan[3]+$calon->infaq+$calon->infaqnfpeduli }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
