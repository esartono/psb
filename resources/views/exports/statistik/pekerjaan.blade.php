<p>Data Calon Siswa - Pekerjaan Orang Tua</p>
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
        <th>Pekerjaan Ayah</th>
        <th>Pekerjaan Ibu</th>
        <th>Pekerjaan Ayah</th>
        <th>Pekerjaan Ibu</th>
        <th>Pekerjaan Ayah</th>
        <th>Pekerjaan Ibu</th>
        <th>Pekerjaan Ayah</th>
        <th>Pekerjaan Ibu</th>
    </tr>
    </thead>
    <tbody>
    @for($i=1; $i <= count($pekerjaan['no']); $i++)
        <tr>
            <td>{{ $pekerjaan['no'][$i] }}</td>
            <td>{{ $pekerjaan['nama'][$i] }}</td>
            <td>{{ $pekerjaan['ayahTK'][$i] }}</td>
            <td>{{ $pekerjaan['ibuTK'][$i] }}</td>
            <td>{{ $pekerjaan['ayahSD'][$i] }}</td>
            <td>{{ $pekerjaan['ibuSD'][$i] }}</td>
            <td>{{ $pekerjaan['ayahSMP'][$i] }}</td>
            <td>{{ $pekerjaan['ibuSMP'][$i] }}</td>
            <td>{{ $pekerjaan['ayahSMA'][$i] }}</td>
            <td>{{ $pekerjaan['ibuSMA'][$i] }}</td>
        </tr>
    @endfor
    </tbody>
</table>
