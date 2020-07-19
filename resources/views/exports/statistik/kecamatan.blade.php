<p>Data Calon Siswa - Alamat (Kecamatan)</p>
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
    @for($i=1; $i <= count($kecamatan['no']); $i++)
        <tr>
            <td>{{ $kecamatan['no'][$i] }}</td>
            <td>{{ $kecamatan['nama'][$i] }}</td>
            <td>{{ $kecamatan['TK'][$i] }}</td>
            <td>{{ $kecamatan['SD'][$i] }}</td>
            <td>{{ $kecamatan['SMP'][$i] }}</td>
            <td>{{ $kecamatan['SMA'][$i] }}</td>
        </tr>
    @endfor
    </tbody>
</table>
