@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-lg-6 col-md-6 col-sm-12" style="margin-bottom: 125px;">
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary">
                    <h5 class="card-title text-white">
                        <i class="fas fa-upload"></i>
                        Form Upload Dokumen
                        <a href="/dokumen/{{ $calon->id }}" type="button" class="btn bg-secondary btn-sm text-white float-end">
                            <i class="fas fa-times"></i>
                        </a>
                    </h5>
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
                    <div class="alert alert-danger">
                        File yang diupload hanya file dalam bentuk <strong>PDF atau Gambar</strong>.
                    </div>
                <form role="form" method="POST" action="{{ route('doku.update', $calon) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                    <div class="form-group row">
                        <label for="name" class="col-lg-4 col-md-4 col-form-label">Jenis Dokumen</label>
                        <div class="col-lg-8 col-md-8 mb-3">
                            <input name="calon" type="hidden" class="form-control" value="{{ $calon->id }}" required readonly>
                            <input name="jdoku" type="hidden" class="form-control" value="{{ $jd->code }}" required readonly>
                            <input type="text" class="form-control" value="{{ $jd->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-lg-4 col-md-4 col-form-label">Upload Dokumen</label>
                        <div class="col-lg-8 col-md-8 mb-3">
                            <input name="file" type="file" class="form-control" required accept="application/pdf, image/*">
                        </div>
                    </div>
                    @if($jd->semester > 0)
                        <hr>
                        <div class="form-group row">
                            <label for="semester" class="col-lg-4 col-md-4 col-form-label">Semester</label>
                            <div class="col-lg-2 col-md-2 col-sm-6 mb-3">
                                <input name="semester" type="text" class="form-control" value="{{ $jd->semester }}" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="semester" class="col-lg-4 col-md-4 col-form-label"></label>
                            <label for="semester" class="col-lg-2 col-md-2 col-sm-6 mb-3 col-form-label">Nilai Pengetahuan</label>
                        </div>
                        @foreach ( mataPelajaran($jd->unit) as $m)
                            <div class="form-group row">
                                <label for="semester" class="col-lg-4 col-md-4 col-form-label">{{ $m }}</label>
                                <div class="col-lg-2 col-md-2 col-sm-6 mb-3">
                                    <input name="rapot[{{ $m }}]" type="text" class="form-control" required>
                                </div>
                            </div>   
                        @endforeach
                    @endif
                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <button type="submit" class="col btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
