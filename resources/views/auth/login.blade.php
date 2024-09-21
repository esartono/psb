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
@endsection
