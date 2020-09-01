@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-user-edit"></i>
                        Form Upload Dokumen
                    </h3>
                    <div class="card-tools">
                        <a href="/psb" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>No. Pendaftaran</td>
                            <td style="width: 300px !important">{{ $calon->name }}</td>
                        </tr>
                        <tr>
                            <td>Nama Calon Siswa</td>
                            <td>{{ $calon->uruts }}</td>
                        </tr>
                    </table>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Jenis Dokumen</td>
                                <td>Status</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Akte Kelahiran</td>
                                <td></td>
                                <td>Upload</td>
                            </tr>
                            <tr>
                                <td>Kartu Keluarga</td>
                                <td></td>
                                <td>Upload</td>
                            </tr>
                            <tr>
                                <td>KTP Ayah</td>
                                <td></td>
                                <td>Upload</td>
                            </tr>
                            <tr>
                                <td>KTP Ibu</td>
                                <td></td>
                                <td>Upload</td>
                            </tr>
                            <tr>
                                <td>Rapot</td>
                                <td></td>
                                <td>Upload</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
