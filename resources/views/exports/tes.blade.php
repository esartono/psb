<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>Kategori</th>
        <th>No. Pendaftaran</th>
        <th>Nama Lengkap</th>
        <th>Panggilan</th>
        <th>JK</th>
        <th>Tempat, Tanggal Lahir</th>
        <th>Nama Ayah</th>
        <th>Nama Ibu</th>
        <th>No. Telepon</th>
        <th>Asal Sekolah</th>
        <th>Alamat</th>
        <th>Kelas Tujuan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->calonnya->gelnya->unitnya->name }}</td>
            <td>{{ $calon->calonnya->cknya->name }}</td>
            <td>{{ $calon->calonnya->uruts }}</td>
            <td>{{ $calon->calonnya->name }}</td>
            <td>{{ $calon->calonnya->panggilan }}</td>
            <td>{{ $calon->calonnya->kelamin }}</td>
            <td>{{ $calon->calonnya->lahir }}</td>
            <td>{{ $calon->calonnya->ayah_nama }}</td>
            <td>{{ $calon->calonnya->ibu_nama }}</td>
            <td>{{ $calon->calonnya->ayah_hp }}, {{ $calon->calonnya->ibu_hp }}</td>
            <td>{{ $calon->calonnya->asal_sekolah }}</td>
            <td>{{ $calon->calonnya->alamat }}</td>
            <td>Kelas {{ $calon->calonnya->kelasnya->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
