<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>Kategori</th>
        <th>No. Pendaftaran</th>
        <th>Nama Lengkap</th>
        <th>JK</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Kelas Tujuan</th>
        <th>Nama Ayah</th>
        <th>No. Telepon Ayah</th>
        <th>Nama Ibu</th>
        <th>No. Telepon Ibu</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->unit }}</td>
            <td>{{ $calon->ck }}</td>
            <td>{{ $calon->uruts }}</td>
            <td>{{ $calon->name }}</td>
            <td>{{ $calon->jk == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>{{ $calon->tempat_lahir }}</td>
            <td>{{ Carbon\Carbon::parse($calon->tgl_lahir)->translatedFormat('d F Y') }}</td>
            <td>Kelas {{ $calon->kelas }}</td>
            <td>{{ $calon->ayah_nama }}</td>
            <td>{{ $calon->ayah_hp }}</td>
            <td>{{ $calon->ibu_nama }}</td>
            <td>{{ $calon->ibu_hp }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
