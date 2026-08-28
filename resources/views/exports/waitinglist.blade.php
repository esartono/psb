<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Asal Sekolah</th>
        <th>Tahun Ajaran</th>
        <th>No. Handphone</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($datas as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->asal_sekolah }}</td>
            <td>{{ $data->tpname }}</td>
            <td>{{ $data->wa }}</td>
            <td>{{ $data->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
