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

    .step1 {
        text-indent: 60px;
        padding-left: 20px;
        margin: 0 0 0 0px;
    }

    .step1 li {
        list-style: none;
    }

    .step2 {
        text-indent: -30px;
        padding-left: 70px;
        counter-reset: elementcounter;
    }

    .step2 li{
        list-style-type: none;
    }

    .step2>li:before {
        content: "(" counter(elementcounter) "). ";
        counter-increment: elementcounter;
    }

    .step3 {
        text-indent: 0px;
        padding-left: 50px;
    }
    .step3 li {
        list-style: lower-roman;
    }

    .table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #000;
        margin: 10px 0px;
    }

    .table th {
        font-size: 14px;
        border: 1px solid #000;

    }

    .table td {
        font-size: 14px;
        padding: 8px;
        border: 1px solid #000;
        text-align: right;
        width: 18% !important;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .table td:nth-child(1) {
        text-align: center;
        width: 3% !important;
    }
    .table td:nth-child(2) {
        width: 11% !important;
        text-align: left
    }
</style>
    <div class="main">
        <br>
        <center><h3>SURAT PERNYATAAN</h3></center>
        <p>Yang bertanda tangan di bawah ini :</p>
        <br>
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
                <td> {{ $calon->alamat }} RT. {{ $calon->rt }} / RW. {{ $calon->rw }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td></td>
                <td></td>
                <td>
                    Kel. {{ Str::title(App\Kelurahan::nama($calon->kelurahan)) }}
                    Kec. {{ Str::title(App\Kecamatan::nama($calon->kecamatan)) }}<br>
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
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Saudara Kandung di SIT Nurul Fikri </td>
                <td> : </td>
                @if($ctg->saudara)
                    <td>{{ $ctg->saudara }}</td>
                @else
                    <td> _________________________ </td>
                @endif
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Nomor Ponsel (Informasi Sekolah) </td>
                <td> : </td>
                <td> _________________________ </td>
            </tr>
        </table>
        <p>Dengan ini menyatakan dengan sebenarnya <strong>memahami dan menyetujui</strong> ketentuan administrasi Sekolah Islam Terpadu Nurul Fikri sebagai berikut:</p>
        <br>
        @include('wawancara.'.substr(Auth::user()->tp_name,0,4).'.ketentuan')
        <p>Demikian pernyataan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>
        <br>
        <br>
        <br>
        <table align="center" width="100%">
            <tr>
                <td colspan="2" align="center"><u> Depok, {{ $ctg->created_at->isoFormat('D MMMM Y') }} </u></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center" width="25%">Ayah</td>
                <td align="center" width="25%">Ibu</td>
                <td align="center" width="20%"></td>
                <td align="center" width="30%">Pewawancara</td>
            </tr>
            <tr>
                <td><br><br><br><br></td>
                <td> Materai </td>
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
        @include('pdf.'.substr(Auth::user()->tp_name,0,4).'.rincianPSB.1')
        <div class="page-break"></div>
        @include('pdf.'.substr(Auth::user()->tp_name,0,4).'.rincianPSB.potongan')
    </div>
@endsection
