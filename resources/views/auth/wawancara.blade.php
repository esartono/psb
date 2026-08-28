@extends('layouts.login')

@section('content')
<p class="login-box-msg" style="color: red">
    <span><i class="fas fa-clipboard-check fa-5x mb-3"></i></span><br>
    Khusus PEWAWANCARA<br>
</p>
<form method="POST" action="{{ route('loginWawancara') }}">
    @csrf
    <div class="input-group mb-3">
        <input id="nip" type="text" placeholder="No. Induk Pegawai" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('nip')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-xs-4">
        <button type="submit" class="col-5 offset-1 btn btn-primary btn-flat">{{ __('Login') }}</button>
        <a href="{{ url('login') }}" type="cancel" class="btn col-5 btn-secondary btn-flat">Cancel</a>
    </div>

</form>
@endsection
