@extends('layouts.keu')

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
                                <small class="float-right">Tanggal: {{ date('d / M / Y')}}</small>
                            </h5>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row mt-3">
                        <div class="card col-8">
                            <div class="card-body" style="padding: 10px 0px 5px 0px">
                                <p class="card-title">Biodata Calon Siswa</p>
                                <a href="/editbio/{{ $calon->id }}" class="btn btn-danger float-right white"><i class="fas fa-user-edit"> </i><b> Edit Biodata </b></a>
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
                                        <td style="color: {{ $calon->pindahan > 0 ? 'red' : '' }}">{{ $calon->kelasnya->name }} {{ $calon->pindahan > 0 ? ' -- (Pindahan)' : '' }}</td>
                                    </tr>
                                    @if($calon->pindahan > 0)
                                        <tr>
                                            <td>Rencana Masuk</td>
                                            <td>:</td>
                                            <td style="color: red; font-weight: 800">{{ $calon->masuk }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Nama Ayah</td>
                                        <td>:</td>
                                        <td>{{ $calon->ayah_nama }} - ({{ $calon->ayah_hp }})</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Ibu</td>
                                        <td>:</td>
                                        <td>{{ $calon->ibu_nama }} - ({{ $calon->ibu_hp }})</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Tempat Tinggal</td>
                                        <td>:</td>
                                        <td>
                                            {{ $calon->alamat }} RT: {{ $calon->rt }} / RW: {{ $calon->rw }}<br>
                                            Kel. {{ App\Kelurahan::nama($calon->kelurahan) }}, Kec. {{ App\Kecamatan::nama($calon->kecamatan) }} <br>
                                            {{ App\Kota::nama($calon->kota) }}, {{ App\Provinsi::nama($calon->provinsi) }}
                                        </td>
                                    </tr>
                                </table>
                                <a href="/wawancara-keu" class="btn btn-success btn-block"> Dashboard Wawancara</a>
                            </div>
                        </div>
                        <div class="card col-4 justify-content-center"><router-view tglbatas="{{ $tglbatas }}"></router-view></div>
                    </div>
                </div>
                <!-- Modal Ketentuan-->
                <div
                    class="modal fade"
                    id="ketentuanModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="ketentuanModalLabel"
                    aria-hidden="true"
                >
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ketentuanModalLabel">Form Wawancara Keuangan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('wawancara.'.substr($tp,0,4).'.ketentuan')
                            @if((int)substr($tp,0,4) > 2024)
                            <ol class="roman" start="4">
                                <li>Pembiayaan Program Immersion</li>
                                @include('wawancara.'.substr($tp,0,4).'.program')
                            </ol>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
