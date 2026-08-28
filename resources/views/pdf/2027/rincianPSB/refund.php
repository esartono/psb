<center><h3>SURAT PERNYATAAN</h3></center>
<p>Yang bertanda tangan di bawah ini :</p>
<table>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> Nama Ayah </td>
        <td> : </td>
        <td> {{ Str::title($calon->ayah_nama) }} </td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> Nama Ibu </td>
        <td> : </td>
        <td> {{ Str::title($calon->ibu_nama) }} </td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> Alamat </td>
        <td> : </td>
        <td> {{ $calon->alamat }} </td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td></td>
        <td></td>
        <td>
            Kel. {{ Str::title(App\Kelurahan::nama($calon->kelurahan)) }}
            Kec. {{ Str::title(App\Kecamatan::nama($calon->kecamatan)) }}
            {{ Str::title(App\Kota::nama($calon->kota)) }}, {{ Str::title(App\Provinsi::nama($calon->provinsi)) }}
        </td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>Email</td>
        <td> : </td>
        <td>{{ App\User::email($calon->user_id) }}</td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>Nomor Ponsel Ayah</td>
        <td> : </td>
        <td>{{ $calon->ayah_hp }}</td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>Nomor Ponsel Ibu</td>
        <td> : </td>
        <td>{{ $calon->ibu_hp }}</td>
    </tr>
</table>
<p>Adalah orangtua / wali dari calon peserta didik <b>Kelas {{ App\Kelasnya::unit($calon->kelas_tujuan) }} Unit {{ App\Gelombang::unit($calon->gel_id) }} </b>:</p>
<table>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> Nama </td>
        <td> : </td>
        <td> {{ Str::title($calon->name) }} </td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> Nomor Pendaftaran </td>
        <td> : </td>
        <td> {{ Str::title($calon->uruts) }} </td>
    </tr>
</table>
