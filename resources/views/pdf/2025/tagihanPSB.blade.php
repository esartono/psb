@extends('pdf.template_keu')

@section('isi')
<style type="text/css">
    .roman li {
        list-style: upper-roman;
        display: list-item;
        font-weight: 800;
        color: #000;
        margin-bottom: 20px;
    }

    .biasa li {
        list-style: decimal;
        font-weight: 400;
        text-transform: none;
        padding: 0 0 0 10px;
        margin: 0 0 0 -30px;
    }

    .jarak1 {
        margin-top: 7mm;
    }
    .step1 {
        text-indent: 60px;
        padding-left: 20px;
        margin: -15 0px;
    }

    .step1 li {
        list-style: none;
    }

    .step2 {
        text-indent: -25px;
        padding-left: 70px;
        counter-reset: elementcounter;
    }

    .step2 li{
        list-style-type: none;
    }

    .step2>li:before {
        content: "(" counter(elementcounter) ").  ";
        counter-increment: elementcounter;
    }
    .step3 {
        text-indent: 0px;
        padding-left: 50px;
    }
    .step3 li {
        list-style: lower-roman;
    }
    .spp li {
        margin-bottom: 8px;
    }
    .spp_detail li {
        margin-top: 8px;
        list-style: lower-alpha;
    }

    .konsekuensi {
        margin: 5px 0 15px 0px;
    }

    .table {
        border-collapse: collapse;
        border-spacing: 0;
        border: 1px solid #000;
        margin: 10px 0px;
    }

    .table th {
        font-size: 14px;
        border: 1px solid #000;

    }

    .table td {
        font-size: 14px;
        padding: 5px;
        border: 1px solid #000;
        width: 18% !important;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .table td:nth-child(1) {
        width: 3% !important;
    }
    .table td:nth-child(2) {
        width: 11% !important;
    }

    table.spp tr td {font-size: 11px; }
    table.spp tr th { font-size: 11px; }
</style>
    <div class="main">
        <br>
        <table style="width: 100%; margin-top: 8mm;">
            <tr>
                <td style="text-align: center; font-size: 7mm; font-weight: bold">SURAT PERNYATAAN</td>
            </tr>
        </table>
        <table align="center" width="100%">
            <tr>
                <td colspan="4">Yang bertanda tangan di bawah ini :</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="width: 20%"> Nama Ayah </td>
                <td style="width: 2%"> : </td>
                <td style="width: 71%"> {{ Str::title($calon->ayah_nama) }} </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td> Nama Ibu </td>
                <td> : </td>
                <td> {{ Str::title($calon->ibu_nama) }} </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td> Alamat </td>
                <td> : </td>
                <td> {{ $calon->alamat }} RT. {{ $calon->rt }} / RW. {{ $calon->rw }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td></td>
                <td></td>
                <td>
                    Kelurahan {{ Str::title(App\Kelurahan::nama($calon->kelurahan)) }},
                    Kecamatan {{ Str::title(App\Kecamatan::nama($calon->kecamatan)) }}<br>
                    {{ Str::title(App\Kota::nama($calon->kota)) }}, {{ Str::title(App\Provinsi::nama($calon->provinsi)) }}
                </td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>Email</td>
                <td> : </td>
                <td>{{ App\User::email($calon->user_id) }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>Nomor Ponsel Ayah</td>
                <td> : </td>
                <td>{{ $calon->ayah_hp }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>Nomor Ponsel Ibu</td>
                <td> : </td>
                <td>{{ $calon->ibu_hp }}</td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 5mm">
            <tr>
                <td colspan="4">
                    Adalah orangtua / wali dari calon peserta didik <b>Kelas {{ App\Kelasnya::unit($calon->kelas_tujuan) }} Unit {{ App\Gelombang::unit($calon->gel_id) }} </b>:
                </td>
            </tr>
            <tr>
                <td width="7mm"></td>
                <td width="45mm"> Nama</td>
                <td width="1mm"> : </td>
                <td width="133mm" valign="top" align="left"> {{ Str::title($calon->name) }} </td>
            </tr>
            <tr>
                <td width="7mm"></td>
                <td> Nomor Pendaftaran </td>
                <td width="1mm"> : </td>
                <td width="115mm" valign="top" align="left" > {{ Str::title($calon->uruts) }} </td>
            </tr>
            <tr>
                <td width="7mm"></td>
                <td valign="top" align="left">Saudara Kandung di SIT Nurul Fikri </td>
                <td width="1mm" valign="top"> : </td>
                @if($ctg->saudara)
                    <td width="115mm" valign="top" align="left">{{ ucwords($ctg->saudara) }}</td>
                @else
                    <td width="115mm" valign="top" align="justify">_________________________ </td>
                @endif
            </tr>
            <tr>
                <td width="7mm"></td>
                <td> Nomor Ponsel (Informasi Sekolah) </td>
                <td width="1mm"> : </td>
                <td> _________________________ </td>
            </tr>
        </table>
        <table style="width: 100%">
            <tr>
                <td>
                    Dengan ini menyatakan dengan sebenarnya <strong>memahami dan menyetujui</strong> ketentuan administrasi Sekolah Islam Terpadu Nurul Fikri sebagai berikut:
                </td>
            </tr>
        </table>
        <br>
        <div style="width: 100%; font-size: 95%">
            @include('wawancara.'.substr(Auth::user()->tp_name,0,4).'.ketentuan')
        </div>
        <table style="width: 100%">
            <tr>
                <td>
                    Demikian pernyataan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
                </td>
            </tr>
        </table>
        <br>
        <table align="center" width="100%" style="font-size: 14px;">
            <tr>
                <td colspan="2" align="center"><u> Depok, {{ formatIndo($ctg->created_at->format('Y-m-d')) }} </u></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center" width="30%">Ayah</td>
                <td align="center" width="30%">Ibu</td>
                <td align="center" width="15%"></td>
                <td align="center" width="25%">Pewawancara</td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br><br>Materai<br><br></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center">{{ Str::title($calon->ayah_nama) }}</td>
                <td align="center">{{ Str::title($calon->ibu_nama) }}</td>
                <td></td>
                <td align="center">{{ Str::title(App\User::namaUser($ctg->pewawancara))}}</td>
            </tr>
        </table>
        <div class="page-break"></div>
        @include('pdf.'.(intval(substr(Auth::user()->tp_name,0,4)) - $calon->tahun_sekarang).'.rincianPSB.1')
        @if($calon->rencana_masuk == 7)
            <div class="page-break"></div>
            @include('pdf.'.substr(Auth::user()->tp_name,0,4).'.rincianPSB.potongan')
        @endif
        <div class="page-break"></div>
        {{-- @include('pdf.'.substr(Auth::user()->tp_name,0,4).'.rincianPSB.lembarpersetujuan') --}}
        {{-- <div class="page-break"></div> --}}
        @include('pdf.'.substr(Auth::user()->tp_name,0,4).'.rincianPSB.pernyataan')
        @if(App\Gelombang::unit($calon->gel_id) == 'SMPIT Nurul Fikri' || App\Gelombang::unit($calon->gel_id) == 'SMAIT Nurul Fikri')
            <div class="page-break"></div>
            @include('pdf.'.substr(Auth::user()->tp_name,0,4).'.rincianPSB.immersion')
        @endif
    </table>
@endsection
