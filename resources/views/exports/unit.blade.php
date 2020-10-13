<table>
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Unit</th>
        <th rowspan="2">Kategori</th>
        <th rowspan="2">No. Pendaftaran</th>
        <th rowspan="2">No. NIK</th>
        <th rowspan="2">No. NISN</th>
        <th rowspan="2">Nama Lengkap</th>
        <th rowspan="2">Panggilan</th>
        <th rowspan="2">JK</th>
        <th rowspan="2">Tempat, Tanggal Lahir</th>
        <th rowspan="2">Kelas Tujuan</th>
        <th rowspan="2">Jurusan</th>
        <th rowspan="2">Nama Ayah</th>
        <th rowspan="2">Pendidikan Ayah</th>
        <th rowspan="2">Pekerjaan Ayah</th>
        <th rowspan="2">Penghasilan Ayah</th>
        <th rowspan="2">Nama Ibu</th>
        <th rowspan="2">Pendidikan Ibu</th>
        <th rowspan="2">Pekerjaan Ibu</th>
        <th rowspan="2">Penghasilan Ibu</th>
        <th rowspan="2">Hp Ayah</th>
        <th rowspan="2">Hp Ibu</th>
        <th colspan="5">Alamat Tempat Tinggal</th>
        <th colspan="6">Asal Sekolah</th>
    </tr>
    <tr>
        <th>Alamat</th>
        <th>Kelurahan</th>
        <th>Kecamatan</th>
        <th>Kota/Kabupaten</th>
        <th>Provinsi</th>
        <th>Nama</th>
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
            <td>{{ $calon->lahir }}</td>
            <td>Kelas {{ $calon->kelasnya->name }}</td>
            <td>{{ $calon->jurusan }}</td>
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
            <td>{{ $calon->alamat }}</td>
            <td>{{ App\Kelurahan::nama($calon->kelurahan) }}</td>
            <td>{{ App\Kecamatan::nama($calon->kecamatan) }}</td>
            <td>{{ App\Kota::nama($calon->kota) }}</td>
            <td>{{ App\Provinsi::nama($calon->provinsi) }}</td>
            <td>{{ $calon->asal_sekolah }}</td>
            <td>{{ $calon->asal_alamat_sekolah }}</td>
            <td>{{ ($calon->asal_kelurahan_sekolah ? App\Kelurahan::nama($calon->asal_kelurahan_sekolah) : ' - ') }}</td>
            <td>{{ ($calon->asal_kecamatan_sekolah ? App\Kecamatan::nama($calon->asal_kecamatan_sekolah) : ' - ') }}</td>
            <td>{{ ($calon->asal_kota_sekolah ? App\Kota::nama($calon->asal_kota_sekolah) : ' - ') }}</td>
            <td>{{ ($calon->asal_propinsi_sekolah ? App\Provinsi::nama($calon->asal_propinsi_sekolah) : ' - ') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
