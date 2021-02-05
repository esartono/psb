<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>No. Pendaftaran</th>
        <th>Nama Lengkap</th>
        <th>JK</th>
        <th>Baju/Blouse</th>
        <th>Celana/Rok</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->unit }}</td>
            <td>{{ $calon->uruts }}</td>
            <td>{{ $calon->name }}</td>
            <td>{{ $calon->kelamin }}</td>
            <td>{{ $calon->atas }}</td>
            <td>{{ $calon->bawah }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
