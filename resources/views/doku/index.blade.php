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
                            <td style="width: 300px !important">{{ $calon->uruts }}</td>
                        </tr>
                        <tr>
                            <td>Nama Calon Siswa</td>
                            <td>{{ $calon->name }}</td>
                        </tr>
                    </table>
                    <hr>
                    <a class="btn btn-warning mb-3" href="{{ route('doku.show', $calon->id) }}">
                        <i class="fas fa-upload"></i> Upload Dokumen
                    </a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Jenis Dokumen</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\JDoku::orderBy('id', 'asc')->get() as $j)
                                <tr>
                                    <td>{{ $j->name }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>Rapot</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
