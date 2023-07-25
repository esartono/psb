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
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        File yang diupload hanya file dalam bentuk <strong>Gambar</strong>.
                    </div>
                <form role="form" method="POST" action="{{ route('postpp') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                        <label for="file" class="col-sm-4 col-form-label">Pas Photo</label>
                        <div class="col-sm-8">
                            <input name="id" type="hidden" value="{{ $calon->uruts }}">
                            <input name="file" type="file" class="form-control" required accept="image/*">
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
