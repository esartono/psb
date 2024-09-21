@extends('layouts.login')

@section('content')
<p class="login-box-msg" style="color: red">
    <span><i class="fas fa-shield-alt fa-5x"></i></span><br>
    Khusus PANITIA<br>
</p>
<form method="POST" action="{{ route('login') }}">
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
        <button type="submit" class="col-5 offset-1 btn btn-primary btn-flat">{{ __('Login') }}</button>
        <a href="{{ url('login') }}" type="cancel" class="btn col-5 btn-secondary btn-flat">Cancel</a>
    </div>

</form>
@endsection
