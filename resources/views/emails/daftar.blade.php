@extends('emails.template')

@section('isi')
    <center>
        <h1>Selamat Bergabung</h1>
		<p>Email atau Username yang terdaftar adalah : <b>{{$user['email']}}</b></p>
		<p>Selanjutnya silahkan mengisi form yang telah disediakan.</p>
		<p>Terima kasih.</p>
    </center>
@endsection
