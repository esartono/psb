<p>Data Calon Siswa - Alamat (Provinsi)</p>
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
    @for($i=1; $i <= count($provinsi['no']); $i++)
        <tr>
            <td>{{ $provinsi['no'][$i] }}</td>
            <td>{{ $provinsi['nama'][$i] }}</td>
            <td>{{ $provinsi['TK'][$i] }}</td>
            <td>{{ $provinsi['SD'][$i] }}</td>
            <td>{{ $provinsi['SMP'][$i] }}</td>
            <td>{{ $provinsi['SMA'][$i] }}</td>
        </tr>
    @endfor
    </tbody>
</table>
