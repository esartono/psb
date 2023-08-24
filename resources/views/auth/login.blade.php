@extends('layouts.login')

@section('content')

<a href="{{ url('auth/google') }}" class="btn btn-primary btn-block sign-in" style="margin-top: 1em">
    <img src="https://www.google.com/favicon.ico">
    PENDAFTAR/CALON SISWA
</a>
<hr>
<a href=" {{ url('login/admin') }}" class="btn btn-block btn-outline-primary" style="">
    <span><i class="fas fa-user-shield"></i></span> Panitia
</a>
{{-- <p class="login-box-msg">atau Login dengan :<br>Email dan Password</p> --}}
{{-- <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="input-group mb-3">
        <input id="email" type="email" placeholder="E-Mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('email')
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
        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
    </div>
    {{-- @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif --}}
{{-- </form> --}}
@endsection
