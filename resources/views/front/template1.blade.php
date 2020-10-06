
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<meta name="author" content="codepixer">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<meta name="google-site-verification" content="ahsQV3SIJO8s_X36obceluCkT-rIBmFN1PHUf6kkrf8" />
	<!-- meta character set -->
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Site Title -->
	<title>PPDB Online - SIT Nurul Fikri</title>

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
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E2EXL2S2X8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-E2EXL2S2X8');
</script>

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
						<li class="menu-active"><a href="/">Depan</a></li>
						<li><a href="file/Alur PPDB NF.jpg" target="_blank">Alur Pendaftaran</a></li>
						<li><a href="biaya">Biaya Pendidikan</a></li>
						<li><a href="file/Syarat dan Ketentuan Pendaftaran PSB SIT NF.pdf" target="_blank">Syarat dan Ketentuan</a></li>
						<!-- <li class="menu-has-children"><a href="jadwal">Jadwal</a> -->
						<li><a href="file/Jadwal PSB.pdf" target="_blank">Jadwal</a>
							<!-- <ul>
								<li><a href="jadwal">Proses PPDB</a></li>
								<li><a href="jadwalkesehatan">Tes Kesehatan</a></li>
							</ul> -->
						</li>
						<li class="menu-has-children"><a href="">Tata Cara Pembayaran</a>
							<ul>
								<li><a href="file/Tata Cara Pembayaran Menggunakan Edupay BSM.pdf" target="_blank">Biaya Pendaftaran</a></li>
								<li><a href="file/Panduan VA PPDB SIT NURUL FIKRI.pdf" target="_blank">Daftar Ulang</a></li>
							</ul>
						</li>
						<li><a href="download">Download</a></li>
						<li style="margin-top: -7px"><a href="hasil" class="genric-btn success circle">Hasil TES</a></li>
					</ul>
				</nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	@yield('isi')

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
</body>

</html>
