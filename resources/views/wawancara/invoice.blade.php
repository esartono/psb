@extends('layouts.keu')
<style>

table.table-invoice {
    width: 100%;
}
table.table-invoice th, table.table-invoice td {
    padding: 5px;
    font-size: 13px;
    border: 1px solid #dee2e6;
}
</style>

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-3">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h5>
                                <b>Detail Data Tagihan Siswa Baru SIT Nurul Fikri Cimanggis Depok {{ auth()->user()->tpname }}</b>
                                <small class="float-right">Tanggal: {{ date('d/m/Y')}}</small>
                            </h5>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row mt-3">
                        <div class="card col-5">
                            <div class="card-body" style="padding: 10px 0px 5px 0px">
                                <p class="card-title">Biodata Calon Siswa</p>
                                <table class="table table-sm table-striped">
                                    <tr>
                                        <td width="30%">Nama Lengkap</td>
                                        <td width="1%">:</td>
                                        <td>{{ $calon->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Asal Sekolah</td>
                                        <td>:</td>
                                        <td>{{ $calon->asal_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Pendaftaran</td>
                                        <td>:</td>
                                        <td>{{ $calon->uruts }}</td>
                                    </tr>
                                    <tr>
                                        <td>Unit</td>
                                        <td>:</td>
                                        <td>{{ $calon->gelnya->unitnya->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td>:</td>
                                        <td>{{ $calon->kelasnya->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Orang Tua</td>
                                        <td>:</td>
                                        <td>
                                            Ayah : {{ $calon->ayah_nama }} - ({{ $calon->ayah_hp }})<br>
                                            Ibu : {{ $calon->ibu_nama }} - ({{ $calon->ibu_hp }})
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Tempat Tinggal</td>
                                        <td>:</td>
                                        <td>
                                            {{ $calon->alamat }} <br>
                                            Kel. {{ App\Kelurahan::nama($calon->kelurahan) }}, Kec. {{ App\Kecamatan::nama($calon->kecamatan) }} <br>
                                            {{ App\Kota::nama($calon->kota) }}, {{ App\Provinsi::nama($calon->provinsi) }}
                                        </td>
                                    </tr>
                                </table>
                                <a href="/wawancara-keu" class="btn btn-success btn-block"> Dashboard Wawancara</a>
                            </div>
                        </div>
                        <div class="card col-7"><router-view></router-view></div>
                        <!-- @include('wawancara.ketentuan') -->
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
