<p>Data Calon Siswa - Alamat (Kelurahan)</p>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Keterangan</th>
        <th>TK</th>
        <th>SD</th>
        <th>SMP</th>
        <th>SMA</th>
    </tr>
    </thead>
    <tbody>
    @for($i=1; $i <= count($kelurahan['no']); $i++)
        <tr>
            <td>{{ $kelurahan['no'][$i] }}</td>
            <td>{{ $kelurahan['nama'][$i] }}</td>
            <td>{{ $kelurahan['TK'][$i] }}</td>
            <td>{{ $kelurahan['SD'][$i] }}</td>
            <td>{{ $kelurahan['SMP'][$i] }}</td>
            <td>{{ $kelurahan['SMA'][$i] }}</td>
        </tr>
    @endfor
    </tbody>
</table>
