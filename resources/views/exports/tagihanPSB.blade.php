<h3>Rekap Wawancara Keuangan - {{ date('d-m-Y', strtotime(now())) }}</h3>
<h3>REKAP TAGIHAN - Belum dihitung diskon</h3>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>No. Pendaftaran</th>
        <th>Nama</th>
        <th>Asal Sekolah</th>
        <th>Diskon</th>
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
        <th>Saudara</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->calonnya->gelnya->unitnya->name }}</td>
            <td>{{ $calon->calonnya->uruts }}</td>
            <td>{{ $calon->calonnya->name }}</td>
            <td>{{ $calon->calonnya->asal_sekolah }}</td>
            <td>{{ $calon->potongan }} %</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['Dana Pengembangan'] }}</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['Dana Pendidikan'] }}</td>
            <td>{{ App\TagihanPSB::sppnya($calon->calon_id) }}</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['Iuran Komite Sekolah / tahun'] }}</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['Seragam'] }}</td>
            <td>{{ $calon->infaq }}</td>
            <td>{{ $calon->infaqnfpeduli }}</td>
            <td>{{ App\TagihanPSB::biayanya($calon->calon_id)['tagihan']+$calon->infaq+$calon->infaqnfpeduli }}</td>
            <td>{{ $calon->wawancara }}</td>
            <td>{{ date('d-m-Y', strtotime($calon->created_at)) }}</td>
            <td>{{ $calon->calonnya->ayah_nama }}</td>
            <td>{{ $calon->calonnya->ayah_hp }}</td>
            <td>{{ $calon->calonnya->ibu_nama }}</td>
            <td>{{ $calon->calonnya->ibu_hp }}</td>
            <td>{{ $calon->saudara }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
