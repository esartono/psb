<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>No. Pendaftaran</th>
        <th>Nama Lengkap</th>
        <th>Jenis Kelamin</th>
        <th>Kelas Tujuan</th>
        <th>Pewawancara</th>
        <th>Instrumen</th>
        <th>SKOR/100</th>
    </tr>
    </thead>
    <tbody>
    @foreach($datas as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->unit }}</td>
            <td>{{ $data->uruts }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->jk == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>Kelas {{ $data->kelas }}</td>
            <td>{{ $data->pewawancara }}</td>
            <td>{{ $data->instrumen }}</td>
            <td>{{ $data->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
