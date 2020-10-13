<table>
    <thead>
    <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>ALAMAT</th>
        <th>TANGGAL LAHIR</th>
        <th>JENIS KELAMIN</th>
        <th>NIK/NIP/NIS</th>
        <th>DEPARTEMENT</th>
        <th>TANGGAL JT</th>
        <th>GP</th>
        <th>NO REKENING</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->calonnya->name }}</td>
            <td>{{ $calon->calonnya->alamat }}</td>
            <td>{{ date('d/m/Y', strtotime($calon->calonnya->tgl_lahir)) }}</td>
            <td>{{ $calon->calonnya->jk }}</td>
            <td>{{ $calon->calonnya->uruts }}</td>
            <td>Kelas {{ $calon->calonnya->kelasnya->name }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
