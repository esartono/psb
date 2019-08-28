<!DOCTYPE html>
<html>
<head>
    <title>Selamat Datang</title>
</head>
 
<body>
    <center>
        <img src="{{ $message->embed('img/logo.png')}}" alt="Logo NF" height="150" width="150"></img>
        <h1>Selamat Bergabung</h1>
		<p>Email atau Username yang terdaftar adalah : <b>{{$user['email']}}</b></p>
		<p>Selanjutnya silahkan mengisi form yang telah disediakan.</p>
		<p>Terima kasih.</p>
    </center>
</body>
 
</html>
