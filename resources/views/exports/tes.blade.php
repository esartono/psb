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
            <td>{{ $calon->calonsnya->gelnya->unitnya->name }}</td>
            <td>{{ $calon->calonsnya->cknya->name }}</td>
            <td>{{ $calon->calonsnya->uruts }}</td>
            <td>{{ $calon->calonsnya->name }}</td>
            <td>{{ $calon->calonsnya->panggilan }}</td>
            <td>{{ $calon->calonsnya->kelamin }}</td>
            <td>{{ $calon->calonsnya->lahir }}</td>
            <td>{{ $calon->calonsnya->ayah_nama }}</td>
            <td>{{ $calon->calonsnya->ibu_nama }}</td>
            <td>{{ $calon->calonsnya->ayah_hp }}, {{ $calon->calonsnya->ibu_hp }}</td>
            <td>{{ $calon->calonsnya->asal_sekolah }}</td>
            <td>{{ $calon->calonsnya->alamat }}</td>
            <td>Kelas {{ $calon->calonsnya->kelasnya->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
