<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>Kategori</th>
        <th>No. Pendaftaran</th>
        <th>Nama Lengkap</th>
        <th>Jenis Kelamin</th>
        <th>Kelas Tujuan</th>
        {{-- <th>Sudah Daftar Ulang</th> --}}
        <th>Ikut Program</th>
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
            <td>Kelas {{ $calon->kelas }}</td>
            {{-- <td>{{ $calon->daul == 1 ? 'Sudah' : ' -- ' }}</td> --}}
            @if($calon->lain == '{"program": null}')<td> -- </td>@endif
            @if($calon->lain == '{"program": "belum"}')<td>Belum</td>@endif
            @if($calon->lain == '{"program": "bulanan"}')<td>Bulanan</td>@endif
            @if($calon->lain == '{"program": "tahunan"}')<td>Tahunan</td>@endif
        </tr>
    @endforeach
    </tbody>
</table>
