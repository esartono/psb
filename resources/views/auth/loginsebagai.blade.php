@extends('layouts.login')

@section('content')
<p class="login-box-msg">Masukan Email dan Password Anda</p>
<form method="POST" action="{{ route('login_as') }}">
    @csrf
    <div class="input-group mb-3">
        <input id="daftar" type="text" placeholder="No. Pendaftaran" name="daftar" required autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="col-xs-4">
        <button tdaype="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
    </div>
</form>
@endsection
