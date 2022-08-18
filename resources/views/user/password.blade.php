@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-5 p-1 mt-4 mb-4">
            <div class="card-header bg-danger">
                Silahkan masukan Password
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ route('edit.password') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Password</label>
                        <div class="col-md-7">
                            <input type="password" name="password" class="form-control" required autocomplete="new-password"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Password Konfirmasi</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"/>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-blue float-right">
                        Ganti Password
                        <i class="fa fa-chevron-circle-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
