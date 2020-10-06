<h3>Rekap Wawancara Keuangan - {{ date('d-m-Y', strtotime(now())) }}</h3>
<h3>TAGIHAN REGULER - {{ $judul }}</h3>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>No. Pendaftaran</th>
        <th>VA Muamalat</th>
        <th>Nama</th>
        <th>Dana Pengembangan</th>
        <th>Dana Pendidikan</th>
        <th>SPP</th>
        <th>Komite</th>
        <th>Seragam</th>
        <th>Infaq SIT NF</th>
        <th>Infaq NF Peduli</th>
        <th>Jumlah Tagihan</th>
        <th>Pewawancara</th>
        <th>Tanggal Wawancara</th>
        <th>Nama Ayah</th>
        <th>No. HP Ayah</th>
        <th>Nama Ibu</th>
        <th>No. HP Ibu</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->calonnya->gelnya->unitnya->name }}</td>
            <td>{{ $calon->calonnya->uruts }}</td>
            <td>{{ $calon->va1 }}{{ $calon->calonnya->gel_id }}{{ $calon->calonnya->uruts }}</td>
            <td>{{ $calon->calonnya->name }}</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['Dana Pengembangan'] }}</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['Dana Pendidikan'] }}</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['Iuran SPP Bulan Juli'] }}</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['Iuran Komite Sekolah / tahun'] }}</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['Seragam'] }}</td>
            <td>{{ $calon->infaq }}</td>
            <td>{{ $calon->infaqnfpeduli }}</td>
            <td>{{ $calon->tagihan[$judul]+$calon->infaq+$calon->infaqnfpeduli }}</td>
            <td>{{ $calon->wawancara }}</td>
            <td>{{ date('d-m-Y', strtotime($calon->created_at)) }}</td>
            <td>{{ $calon->calonnya->ayah_nama }}</td>
            <td>{{ $calon->calonnya->ayah_hp }}</td>
            <td>{{ $calon->calonnya->ibu_nama }}</td>
            <td>{{ $calon->calonnya->ibu_hp }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
