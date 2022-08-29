<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>Kategori</th>
        <th>No. Pendaftaran</th>
        <th>No. NIK</th>
        <th>No. NISN</th>
        <th>Nama Lengkap</th>
        <th>Panggilan</th>
        <th>JK</th>
        <th>Tempat, Tanggal Lahir</th>
        <th>Kelas Tujuan</th>
        <th>Jurusan</th>
        <th>Nama Ayah</th>
        <th>Pendidikan Ayah</th>
        <th>Pekerjaan Ayah</th>
        <th>Penghasilan Ayah</th>
        <th>Nama Ibu</th>
        <th>Pendidikan Ibu</th>
        <th>Pekerjaan Ibu</th>
        <th>Penghasilan Ibu</th>
        <th>Hp Ayah</th>
        <th>Hp Ibu</th>
        <th>Asal Sekolah</th>
        <th>Alamat</th>
        <th>Kelurahan</th>
        <th>Kecamatan</th>
        <th>Kota/Kabupaten</th>
        <th>Provinsi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->gelnya->unitnya->name }}</td>
            <td>{{ $calon->cknya->name }}</td>
            <td>{{ $calon->uruts }}</td>
            <td>'{{ $calon->nik }}</td>
            <td>'{{ $calon->nisn }}</td>
            <td>{{ $calon->name }}</td>
            <td>{{ $calon->panggilan }}</td>
            <td>{{ $calon->kelamin }}</td>
            <td>{{ $calon->tgl_lahir->isoFormat('D MMMM Y') }}</td>
            <td>Kelas {{ $calon->kelasnya->name }}</td>
            <td>{{ $calon->Jurusan }}</td>
            <td>{{ $calon->ayah_nama }}</td>
            <td>{{ App\Pendidikan::nama($calon->ayah_pendidikan) }}</td>
            <td>{{ App\Pekerjaan::nama($calon->ayah_pekerjaan) }}</td>
            <td>{{ App\Penghasilan::nama($calon->ayah_penghasilan) }}</td>
            <td>{{ $calon->ibu_nama }}</td>
            <td>{{ App\Pendidikan::nama($calon->ibu_pendidikan) }}</td>
            <td>{{ App\Pekerjaan::nama($calon->ibu_pekerjaan) }}</td>
            <td>{{ App\Penghasilan::nama($calon->ibu_penghasilan) }}</td>
            <td>{{ $calon->ayah_hp }}</td>
            <td>{{ $calon->ibu_hp }}</td>
            <td>{{ $calon->asal_sekolah }}</td>
            <td>{{ $calon->alamat }}</td>
            <td>{{ App\Kelurahan::nama($calon->kelurahan) }}</td>
            <td>{{ App\Kecamatan::nama($calon->kecamatan) }}</td>
            <td>{{ App\Kota::nama($calon->kota) }}</td>
            <td>{{ App\Provinsi::nama($calon->provinsi) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
