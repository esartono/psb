<p>Data Calon Siswa - Pendidikan Orang Tua</p>
<table>
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Keterangan</th>
        <th colspan="2">TK</th>
        <th colspan="2">SD</th>
        <th colspan="2">SMP</th>
        <th colspan="2">SMA</th>
    </tr>
    <tr>
        <th>Pendidikan Ayah</th>
        <th>Pendidikan Ibu</th>
        <th>Pendidikan Ayah</th>
        <th>Pendidikan Ibu</th>
        <th>Pendidikan Ayah</th>
        <th>Pendidikan Ibu</th>
        <th>Pendidikan Ayah</th>
        <th>Pendidikan Ibu</th>
    </tr>
    </thead>
    <tbody>
    @for($i=1; $i <= count($pendidikan['no']); $i++)
        <tr>
            <td>{{ $pendidikan['no'][$i] }}</td>
            <td>{{ $pendidikan['nama'][$i] }}</td>
            <td>{{ $pendidikan['ayahTK'][$i] }}</td>
            <td>{{ $pendidikan['ibuTK'][$i] }}</td>
            <td>{{ $pendidikan['ayahSD'][$i] }}</td>
            <td>{{ $pendidikan['ibuSD'][$i] }}</td>
            <td>{{ $pendidikan['ayahSMP'][$i] }}</td>
            <td>{{ $pendidikan['ibuSMP'][$i] }}</td>
            <td>{{ $pendidikan['ayahSMA'][$i] }}</td>
            <td>{{ $pendidikan['ibuSMA'][$i] }}</td>
        </tr>
    @endfor
    </tbody>
</table>
