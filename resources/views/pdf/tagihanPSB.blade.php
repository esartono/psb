@extends('pdf.template_keu')

@section('isi')
    <div class="main">
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
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td> Saudara Kandung di SIT Nurul Fikri </td>
                <td> : </td>
                <td> _________________________ </td>
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
        @include('front.ketentuan')
        <p>Demikian pernyataan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>
        <br>
        <br>
        <br>
        <table align="center" width="100%">
            <tr>
                <td align="center" colspan="2">Depok, {{ date("d F Y", strtotime($ctg->created_at)) }}</td>
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
        @include('pdf.rincianPSB.1')
        {{-- @include('pdf.rincianPSB.2')
        @include('pdf.rincianPSB.3') --}}
        @include('pdf.rincianPSB.refund')
    </div>
@endsection
