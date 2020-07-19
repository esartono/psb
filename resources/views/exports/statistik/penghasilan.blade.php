<p>Data Calon Siswa - Penghasilan Orang Tua</p>
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
        <th>Penghasilan Ayah</th>
        <th>Penghasilan Ibu</th>
        <th>Penghasilan Ayah</th>
        <th>Penghasilan Ibu</th>
        <th>Penghasilan Ayah</th>
        <th>Penghasilan Ibu</th>
        <th>Penghasilan Ayah</th>
        <th>Penghasilan Ibu</th>
    </tr>
    </thead>
    <tbody>
    @for($i=1; $i <= count($penghasilan['no']); $i++)
        <tr>
            <td>{{ $penghasilan['no'][$i] }}</td>
            <td>{{ $penghasilan['nama'][$i] }}</td>
            <td>{{ $penghasilan['ayahTK'][$i] }}</td>
            <td>{{ $penghasilan['ibuTK'][$i] }}</td>
            <td>{{ $penghasilan['ayahSD'][$i] }}</td>
            <td>{{ $penghasilan['ibuSD'][$i] }}</td>
            <td>{{ $penghasilan['ayahSMP'][$i] }}</td>
            <td>{{ $penghasilan['ibuSMP'][$i] }}</td>
            <td>{{ $penghasilan['ayahSMA'][$i] }}</td>
            <td>{{ $penghasilan['ibuSMA'][$i] }}</td>
        </tr>
    @endfor
    </tbody>
</table>
