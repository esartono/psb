<table>
    <thead>
    <tr>
        <th>No</th>
        <th>VA</th>
        <th>Nama</th>
        <th>Reguler 1</th>
        <th>Reguler 2</th>
        <th>Reguler 3</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->calonnya->uruts }}</td>
            <td>{{ $calon->calonnya->name }}</td>
            <td>{{ $calon->tagihan[1]+$calon->infaq+$calon->infaqnfpeduli }}</td>
            <td>{{ $calon->tagihan[2]+$calon->infaq+$calon->infaqnfpeduli }}</td>
            <td>{{ $calon->tagihan[3]+$calon->infaq+$calon->infaqnfpeduli }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
