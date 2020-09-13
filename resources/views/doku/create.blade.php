@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-upload"></i>
                        Form Upload Dokumen
                    </h3>
                    <div class="card-tools">
                        <a href="/dokumen/{{ $calon }}" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        File yang diupload hanya file dalam bentuk <strong>PDF atau Gambar</strong>.
                    </div>
                <form role="form" method="POST" action="{{ route('doku.update', $calon) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Jenis Dokumen</label>
                        <div class="col-sm-8">
                            <input name="calon" type="hidden" class="form-control" value="{{ $calon }}" required readonly>
                            <input name="jdoku" type="hidden" class="form-control" value="{{ $jd->code }}" required readonly>
                            <input type="text" class="form-control" value="{{ $jd->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-sm-4 col-form-label">Upload Dokumen</label>
                        <div class="col-sm-8">
                            <input name="file" type="file" class="form-control" required accept="application/pdf, image/*">
                        </div>
                    </div>
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
