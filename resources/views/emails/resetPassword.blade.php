@extends('emails.template')

@section('isi')
    <center>
        <h1>Reset Password</h1>
		<p>Email atau Username yang terdaftar adalah : <b>{{$user['email']}}</b></p>
		<p>Password yang baru : <b>{{$newPass}}</b></p>
		<p>Terima kasih.</p>
    </center>
@endsection
