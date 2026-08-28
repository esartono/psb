<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>Kategori</th>
        <th>No. Pendaftaran</th>
        <th>Nama Lengkap</th>
        <th>Jenis Kelamin</th>
        <th>Kelas Tujuan</th>
        <th>Kelas</th>
        <th>Semester</th>
        <th>IPA</th>
        <th>IPS</th>
        <th>MTK</th>
        <th>B.Inggris</th>
        <th>B.Indo</th>
        <th>PAI</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->unit }}</td>
            <td>{{ $calon->ck }}</td>
            <td>{{ $calon->uruts }}</td>
            <td>{{ $calon->name }}</td>
            <td>{{ $calon->jk == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>Kelas {{ $calon->kelas }}</td>
            @if($calon->dokumen == 'rapor4')<td> - </td>@endif
            @if($calon->dokumen == 'rapor41' || $calon->dokumen == 'rapor42')<td> Kelas 4 </td>@endif
            @if($calon->dokumen == 'rapor51' || $calon->dokumen == 'rapor52')<td> Kelas 5 </td>@endif
            @if($calon->dokumen == 'rapor71' || $calon->dokumen == 'rapor72')<td> Kelas 7 </td>@endif
            @if($calon->dokumen == 'rapor81' || $calon->dokumen == 'rapor82')<td> Kelas 8 </td>@endif
            @if($calon->dokumen == 'rapor41' || $calon->dokumen == 'rapor51' || $calon->dokumen == 'rapor71' || $calon->dokumen == 'rapor81')<td> 1 </td>@endif
            @if($calon->dokumen == 'rapor42' || $calon->dokumen == 'rapor52' || $calon->dokumen == 'rapor72' || $calon->dokumen == 'rapor82')<td> 2 </td>@endif
            @php
                $mp = str_replace('", "', ';' ,$calon->rapot);
                $mp = str_replace('{', '', $mp);
                $mp = str_replace('}', '', $mp);
                $mp = str_replace('": "', '', $mp);
                $mp = str_replace('"', '', $mp);
                $mp = explode(';', $mp);
                $ipa = str_replace('IPA', '', $mp[0]);
                $ips = '-';
                if (isset($mp[1])) {
                    $ips = str_replace('IPS', '', $mp[1]);
                }
                $mtk = '-';
                if (isset($mp[2])) {
                    $mtk = str_replace('Matematika', '', $mp[2]);
                }
                if($calon->kelas == '10') {
                    $ing = "-";
                    if (isset($mp[3])) {
                        $ing = str_replace('Bahasa Inggris', '', $mp[3]);
                    }
                    $indo = "-";
                    if (isset($mp[4])) {
                        $indo = str_replace('Bahasa Indonesia', '', $mp[4]);
                    }
                    $pai = "-";
                    if (isset($mp[5])) {
                        $pai = str_replace('Pendidikan Agama Islam', '', $mp[5]);
                    }
                } else {
                    $ing = '-';
                    $indo = "-";
                    if (isset($mp[3])) {
                        $indo = str_replace('Bahasa Indonesia', '', $mp[3]);
                    }
                    $pai = "-";
                    if (isset($mp[4])) {
                        $pai = str_replace('Pendidikan Agama Islam', '', $mp[4]);
                    }
                }
            @endphp
            <td>{{ $ipa }}</td>
            <td>{{ $ips }}</td>
            <td>{{ $mtk }}</td>
            <td>{{ $ing }}</td>
            <td>{{ $indo }}</td>
            <td>{{ $pai }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
