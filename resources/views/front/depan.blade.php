
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="codepixer">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Site Title -->
	<title>App-PSB 3.0</title>

	<!--
			Google Font
			============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500i" rel="stylesheet">

	<!--
			CSS
			============================================= -->
	<link rel="stylesheet" href="/front/css/linearicons.css">
	<link rel="stylesheet" href="/front/css/font-awesome.min.css">
	<link rel="stylesheet" href="/front/css/bootstrap.css">
	<link rel="stylesheet" href="/front/css/magnific-popup.css">
	<link rel="stylesheet" href="/front/css/nice-select.css">
	<link rel="stylesheet" href="/front/css/animate.min.css">
	<link rel="stylesheet" href="/front/css/owl.carousel.css">
	<link rel="stylesheet" href="/front/css/main.css">
	<style>
	li {
		display: inline-block;
		font-size: 1em;
		list-style-type: none;
		padding: 0.5em;
		text-transform: uppercase;
		color: #024A81;
		}

		li span {
		display: block;
		font-size: 3em;
		}
	</style>
</head>

<body>
	<button type="button" id="mobile-nav-toggle">
		<i class="lnr lnr-menu"></i>
	</button>
	<!-- Start Header Area -->
	<header id="header">
		<div class="container">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
					<a href="index.html"><img src="img/logo.png" width="50" height="50" alt="Logo NF" title="Logo SIT Nurul Fikri" /></a>
				</div>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<li class="menu-active"><a href="#">Info PSB</a></li>
						<li><a href="file/Prosedur Pendaftaran PSB SIT NF.pdf" target="_blank">Alur Pendaftaran</a></li>
						<li><a href="biaya">Biaya Pendaftaran</a></li>
						<li><a href="file/Syarat dan Ketentuan Pendaftaran PSB SIT NF.pdf" target="_blank">Syarat dan Ketentuan</a></li>
						<li class="menu-has-children"><a href="">Jadwal Tes</a>
							<ul>
								<li><a href="">Agenda PSB</a></li>
								<li><a href="">Tes Kesehatan</a></li>
							</ul>
						</li>
						<li><a href="file/Tata Cara Pembayaran Menggunakan Edupay BSM.pdf" target="_blank">Tata Cara Pembayaran</a></li>
						<li><a href="">Download</a></li>
						<li><a href="">Hasil TES</a></li>
					</ul>
				</nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="home-banner-area relative">
		<div class="container">
			<div class="row fullscreen d-flex align-items-center justify-content-center">
				<div class="banner-content col-md-7">
					<h1 class="wow fadeIn" data-wow-duration="4s">Penerimaan Siswa Baru<br> SIT Nurul Fikri - Depok</h1>
					<hr>
					<p class="wow fadeIn text-white">
						Selamat Datang di Sistem Penerimaan Siswa Baru SIT Nurul Fikri Tahun Akademik {{ $tp->name }}.
						Perhatikan semua informasi mengenai pendaftaran Siswa Baru sebelum anda mulai mendaftar.
					</p>
					<div class="wow fadeIn card col-md-6 offset-md-3 border-warning countdown mt-4">
						<ul class="mt-4">
							<li><span id="days" class="mb-3"></span>hari</li>
							<li><span id="hours" class="mb-3"></span>jam</li>
							<li><span id="minutes" class="mb-3"></span>menit</li>
							<li><span id="seconds" class="mb-3"></span>detik</li>
						</ul>
					</div>
					<div class="courses pt-20 mt-4">
						@if (Route::has('login'))
							<div class="top-right links">
								@auth
									@if (auth()->user()->isAdmin())
										<a href="{{ url('/home') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-2 success circle mr-10 mb-10 wow fadeInDown">Home</a>
									@endif
									@if (auth()->user()->isUser())
										<a href="{{ url('/psb') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-2 success circle mr-10 mb-10 wow fadeInDown">Home</a>
									@endif
								@else
									<a href="{{ route('login') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 danger circle mr-10 mb-10 wow fadeInDown">Login</a>
									<a href="{{ route('register') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 success circle mr-10 mb-10 wow fadeInDown">Daftar Akun</a>
								@endauth
							</div>
						@endif
					</div>
				</div>
				<div class="col-md-5">
					<div class="card wow fadeIn border-info" data-wow-duration="4s">
						<div class="card-header bg-info text-white">Info PSB</div>
						<div class="card-body">
							@foreach($berita as $b)
								<h4 class="mb-2">{{ $b->judul }}</h4>
								{{ mb_strimwidth($b->berita, 0, 150, '...') }}
								<hr>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="rocket-img">
			<img src="img/rocket.png" alt="">
		</div>
	</section>
	<!-- End Banner Area -->

	<!-- Start Faculty Area -->
	<section class="faculty-area section-gap">
		<div class="container">
			<div class="row justify-content-center d-flex align-items-center">
				@foreach($units as $unit)
				<div class="col-lg-3 col-md-6 col-sm-12 single-faculty" style="color: #fff">
					<div class="meta-text text-center bg-{{ $unit->catnya->name }}">
						<img class="img-fluid" src="img/{{ $unit->catnya->name }}.png" alt="logo Unit" width="40%" style="margin-top: -50px">
						<hr>
						<h4 style="color: #fff">{{ $unit->name }}</h4>
						<hr>
						<div class="info wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
							<p style="font-size: 11px"> {{ $unit->address }} <br> Cimanggis, Kota Depok - Jawa Barat</p>
							<p class="designation">Telepon : {{ $unit->phone }}<br>Email : {{ $unit->email }}</p>
							<a href="https://{{ strtolower($unit->catnya->name) }}it.nurulfikri.sch.id"
							target="_blank" class="genric-btn info-border circle arrow"><b>{{ $unit->name }}</b></a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- End Faculty Area -->

	<!-- ####################### Start Scroll to Top Area ####################### -->
	<div id="back-top">
		<a title="Go to Top" href="#"></a>
	</div>
	<!-- ####################### End Scroll to Top Area ####################### -->

	<script src="/front/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="/front/js/vendor/bootstrap.min.js"></script>
	<script src="/front/js/easing.min.js"></script>
	<script src="/front/js/hoverIntent.js"></script>
	<script src="/front/js/superfish.min.js"></script>
	<script src="/front/js/jquery.ajaxchimp.min.js"></script>
	<script src="/front/js/jquery.magnific-popup.min.js"></script>
	<script src="/front/js/owl.carousel.min.js"></script>
	<script src="/front/js/owl-carousel-thumb.min.js"></script>
	<script src="/front/js/jquery.sticky.js"></script>
	<script src="/front/js/jquery.nice-select.min.js"></script>
	<script src="/front/js/parallax.min.js"></script>
	<script src="/front/js/waypoints.min.js"></script>
	<script src="/front/js/wow.min.js"></script>
	<script src="/front/js/jquery.counterup.min.js"></script>
	<script src="/front/js/mail-script.js"></script>
	<script src="/front/js/main.js"></script>
	<script>
		const second = 1000,
			minute = second * 60,
			hour = minute * 60,
			day = hour * 24;

		let countDown = new Date('{{ $start }}').getTime(),
			x = setInterval(function() {

			let now = new Date().getTime(),
				distance = countDown - now;

			document.getElementById('days').innerText = Math.floor(distance / (day)),
				document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
				document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
				document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

			//do something later when date is reached
			if (distance < 0) {
				$(".countdown").hide();
			}

			}, second)
	</script>
</body>

</html>
