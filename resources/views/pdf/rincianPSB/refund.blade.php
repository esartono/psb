<style>
    .refund {
        width: 95%;
        border-collapse: separate;
        border-spacing: 10px;
    }

    .form_refund {
        font-size: 14px;
    }
</style>
<center>FORMULIR PERMOHONAN PENGEMBALIAN DANA</center>
<div class="form_refund">
<p>Yang bertanda tangan di bawah ini :</p>
<table width="100%">
    <tr>
        <td width="2%"></td>
        <td width="14%"> Nama Ayah </td>
        <td width="1%"> : </td>
        <td width="30%"> {{ Str::title($calon->ayah_nama) }} </td>
        <td width="14%"> Nama Ibu </td>
        <td width="1%"> : </td>
        <td> {{ Str::title($calon->ibu_nama) }} </td>
    </tr>
    <tr>
        <td valign="top"></td>
        <td valign="top"> Alamat </td>
        <td valign="top"> : </td>
        <td valign="top" colspan="4"> {{ $calon->alamat }} <br>
            Kel. {{ Str::title(App\Kelurahan::nama($calon->kelurahan)) }}
            Kec. {{ Str::title(App\Kecamatan::nama($calon->kecamatan)) }}
            {{ Str::title(App\Kota::nama($calon->kota)) }}, {{ Str::title(App\Provinsi::nama($calon->provinsi)) }}
        </td>
    </tr>
</table>
<p>Adalah orangtua / wali dari calon peserta didik <b>Kelas {{ App\Kelasnya::unit($calon->kelas_tujuan) }} Unit {{ App\Gelombang::unit($calon->gel_id) }} </b>:</p>
<table width="100%">
    <tr>
        <td valign="top" width="2%"></td>
        <td width="14%"> Nama </td>
        <td width="1%"> : </td>
        <td width="30%"> {{ Str::title($calon->name) }} </td>
        <td width="16%"> No. Pendaftaran </td>
        <td width="1%"> : </td>
        <td> {{ Str::title($calon->uruts) }} </td>
    </tr>
</table>
<p>Mengajukan permohonan <i>cashback</i> PPDB 2021/2022 atas potongan biaya dikarenakan sebagai berikut: </p>
<i>*centang salah satu</i>
<table class="refund">
    <tr>
        <td width="5%" style="border: 1px solid black"></td>
        <td>Memiliki Saudara kandung, <strong>5% dari Dana Pengembangan</strong></td>
    </tr>
    <tr>
        <td width="5%" style="border: 1px solid black"></td>
        <td>Asal sekolah SIT Nurul Fikri, <strong>10% dari Dana Pengembangan</strong></td>
    </tr>
    <tr>
        <td width="5%" style="border: 1px solid black"></td>
        <td>Undangan khusus dari SIT Nurul Fikri dan NFBS Bogor, <strong>25% dari Dana Pengembangan</strong></td>
    </tr>
    <tr>
        <td width="5%" style="border: 1px solid black"></td>
        <td>Pemenang Lomba tingkat Nasional (Bertingkat) 1 & 2, <strong>50% dari Dana Pengembangan</strong></td>
    </tr>
    <tr>
        <td width="5%" style="border: 1px solid black"></td>
        <td>Hafalan minimal 15 Juz, <strong>25% dari Dana Pengembangan</strong></td>
    </tr>
</table>

<b><i>(ketentuan potongan biaya tidak berlaku akumulatif)</i></b>
<p>Metode Pengembalian dana melalui transfer ke rekening sebagai berikut :</p>
<table width="100%">
<tr>
    <td width="2%">1. </td>
    <td colspan="3"><strong>Ditransfer ke rekening sebagai berikut :</strong></td>
</tr>
<tr>
    <td></td>
    <td width="35%">Nama Bank</td>
    <td width="1%">:</td>
    <td>___________________________________________</td>
</tr>
<tr>
    <td></td>
    <td>Nama Lengkap Pemilik Rekening</td>
    <td>:</td>
    <td>___________________________________________</td>
</tr>
<tr>
    <td></td>
    <td>Nomor Rekening</td>
    <td>:</td>
    <td>___________________________________________</td>
</tr>
<tr>
    <td>2. </td>
    <td colspan="3"><strong>Dialokasikan untuk pembayaran SPP siswa di SIT Nurul Fikri sebagai berikut :</strong></td>
</tr>
<tr>
    <td></td>
    <td>Nama Peserta Didik</td>
    <td>:</td>
    <td>___________________________________________</td>
</tr>
<tr>
    <td></td>
    <td>Kelas</td>
    <td>:</td>
    <td>___________________________________________</td>
</tr>
<tr>
    <td></td>
    <td>Untuk SPP</td>
    <td>:</td>
    <td>bulan :_________________   tahun:_______________</td>
</tr>
<tr>
    <td>3. </td>
    <td colspan="3"><strong>Dialokasikan untuk :</strong></td>
</tr>
<tr>
    <td></td>
    <td>Infaq SIT Nurul Fikri</td>
    <td>:</td>
    <td>___________________________________________</td>
</tr>
<tr>
    <td></td>
    <td>Infaq NF Peduli</td>
    <td>:</td>
    <td>___________________________________________</td>
</tr>
</table>
<br>
<table align="center" width="100%">
            <tr>
                <td></td>
                <td colspan="2" align="center"><u> Depok, ____________________ </u></td>
                <td></td>
            </tr>
            <tr>
                <td align="center" width="30%"></td>
                <td align="center" width="20%">Ayah</td>
                <td align="center" width="20%">Ibu</td>
                <td align="center" width="30%"></td>
            </tr>
            <tr>
                <td><br><br><br><br></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td align="center">{{ Str::title($calon->ayah_nama) }}</td>
                <td align="center">{{ Str::title($calon->ibu_nama) }}</td>
                <td></td>
            </tr>
        </table>
</div>
