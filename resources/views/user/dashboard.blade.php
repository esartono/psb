@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-3 p-1 mt-4 mb-4">
            <a href="/tambahcalon" class="btn btn-success btn-lg"><i class="fas fa-user-plus"> </i><b> Tambah Calon Siswa </b></a>
        </div>
    </div>
    @foreach($calons as $calon)
    <div style="border-bottom: 2px solid grey" class="row justify-content-center mb-4">
        <div class="col-md-5 mb-3">
            <div class="card h-100">
                <div class="card-header white bg-{{ $calon->gelnya->unitnya->catnya->name }} card-{{ $calon->gelnya->unitnya->catnya->name }}-outline">
                    <h5>Data Calon Peserta - {{ $calon->gelnya->unitnya->name }}</h5>
                    <div class="card-tools" style="position: absolute; right: 1rem; top: 0.5rem">
                        <a href="/editcalon/{{ $calon->id }}" class="btn btn-sm btn-warning"><i class="fas fa-user-edit"> </i><b> Edit </b></a>
                    </div>
                </div>
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center text-uppercase">{{ $calon->name }}</h3>
                    <h4 class="text-muted text-center">{{ $calon->uruts }}</h4>
                    <ul class="list-group list-group-unbordered mb-2">
                        <li class="list-group-item">
                            <b>Tempat, Tanggal lahir</b> <a class="float-right">{{ $calon->tempat_lahir }}, {{ $calon->tgl_lahir->isoFormat('D MMMM Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Jenis Kelamin</b> <a class="float-right">{{ $calon->kelamin }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Kelas Tujuan</b> <a class="float-right">Kelas {{ $calon->kelasnya->name }} {{ $calon->gelnya->unitnya->catnya->name === 'SMA' ? '( Jurusan '.$calon->jurusan.' )' : '' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Daftar</b> <a class="float-right">{{ $calon->tgl_daftar->isoFormat('D MMMM Y') }}</a>
                        </li>
                    </ul>
                    <a href='/dokumen/{{ $calon->id }}' class="btn btn-danger"><i class="fa fa-book"> </i> &nbsp;Upload Dokumen</a>
                    <a href='/uniform/{{ $calon->id }}' class="btn btn-primary"><i class="fas fa-tshirt"> </i> &nbsp;Pilih Ukuran Seragam</a>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-3">
            <div class="card h-100">
                <div class="card-header white bg-{{ $calon->gelnya->unitnya->catnya->name }} card-{{ $calon->gelnya->unitnya->catnya->name }}-outline">
                    <h5>Status : {{ $calon->status == 0 ? 'Tidak Aktif' : 'Aktif' }}</h5>
                </div>
                <div class="card-body box-profile">
                    @include('user.tahapan.'.$calon->tahap)
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
