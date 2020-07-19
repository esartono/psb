<p>Data Calon Siswa - Alamat (Kota/Kabupaten)</p>
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
    @for($i=1; $i <= count($kota['no']); $i++)
        <tr>
            <td>{{ $kota['no'][$i] }}</td>
            <td>{{ $kota['nama'][$i] }}</td>
            <td>{{ $kota['TK'][$i] }}</td>
            <td>{{ $kota['SD'][$i] }}</td>
            <td>{{ $kota['SMP'][$i] }}</td>
            <td>{{ $kota['SMA'][$i] }}</td>
        </tr>
    @endfor
    </tbody>
</table>
