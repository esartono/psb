
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

	<link rel="icon" href="{{ URL::asset('/img/favicon.ico') }}" type="image/x-icon"/>
	<!--
			Google Font
			============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,600" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500i" rel="stylesheet" type="text/css">

	<!--
			CSS
			============================================= -->
	<link rel="stylesheet" href="/front/css/linearicons.css" type="text/css">
	<link rel="stylesheet" href="/front/css/font-awesome.min.css" type="text/css">
	{{-- <link rel="stylesheet" href="/front/css/bootstrap.css"> --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel="stylesheet" href="/front/css/magnific-popup.css" type="text/css">
	<link rel="stylesheet" href="/front/css/nice-select.css" type="text/css">
	<link rel="stylesheet" href="/front/css/animate.min.css" type="text/css">
	<link rel="stylesheet" href="/front/css/owl.carousel.css" type="text/css">
	<link rel="stylesheet" href="/front/css/main.css" type="text/css">
	<style type="text/css">

		.nav-menu > li {
			display: inline-block;
			font-size: 1em;
			list-style-type: none;
			padding: 0.12em;
			text-transform: uppercase;
			color: #024A81;
			height: 50px;
    		line-height: 50px;
			margin-left: 0; 
		}

		.nav-menu li span {
			display: block;
			font-size: 3em;
		}

		.countdown ul {
			color: #024A81;
			display: inline;
		}
		.countdown ul li {
			margin: 0px 5px;
			display: inline-block;
			width: 100px;
			border: #024A81 2px solid;
			background-color: #fff;
			padding: 15px 20px;
			border-radius: 15px;
		}
		.countdown ul li span {
			font-size: 40px;
		}
		.countdown ul li span::after {
			content: "\a";
			white-space: pre;
		}

		@media only screen and (max-width: 800px) {
			.countdown ul li {
				width: 80px;
				font-size: 1em;
				padding: 0.25em 1em;
				margin: 0 0.25em;
				border-radius: 0.5em;
			}

			.countdown ul li span {
				font-size: 2em;
			}
		}
		@media only screen and (max-width: 450px) {
			.countdown ul li {
				width: 50px;
				font-size: 0.75em;
				padding: 0.1em 0.5em;
				margin: 0 0.25em;
				border-radius: 0.25em;
			}

			.countdown ul li span {
				font-size: 2em;
			}
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
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<li id="logo"><a href="/"><img src="/img/logo.png" width="50" height="50" alt="Logo NF" title="Logo SIT Nurul Fikri" /></a></li>
						<li class="{{ Request::path() ==  '/' ? 'menu-active' : '' }}"><a href="/">Depan</a></li>
						<li class="{{ Request::path() ==  'alur' ? 'menu-active' : '' }}"><a href="/alur">Alur Pendaftaran</a></li>
						<li class="menu-has-children {{ (Request::path() == 'biayapendaftaran' || Request::path() == 'biaya' || Request::path() == 'daftarulang') ? 'menu-active' : '' }}">
							<a>Biaya Pendidikan</a>
							<ul>
								<li><a href="/biaya">Biaya Pendidikan</a></li>
								<li><a href="/daftarulang">Daftar Ulang</a></li>
								<li><a href="/tatacara">Tata Cara Bayar Pendaftaran</a></li>
							</ul>
						</li>
						{{-- <li><a href="file/Syarat dan Ketentuan Pendaftaran PSB SIT NF.pdf" target="_blank">Syarat dan Ketentuan</a></li> --}}
						<li class="{{ Request::path() ==  'syarat' ? 'menu-active' : '' }}"><a href="/syarat">Syarat dan Ketentuan</a></li>
						<li class="{{ Request::path() ==  'jadwal' ? 'menu-active' : '' }}"><a href="/jadwal">Jadwal</a></li>
						<li class="{{ Request::path() ==  'download' ? 'menu-active' : '' }}"><a href="download">Download</a></li>
						<li><a href="qna" class="genric-btn warning circle" style="padding: 0 15px; color: blue">Q & A</a></li>
						<li><a href="hasil" class="genric-btn danger circle" style="padding: 0 15px;">Hasil TES</a></li>
					</ul>
				</nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	@yield('isi')

	{{-- <script src="/front/js/vendor/jquery-2.2.4.min.js"></script> --}}
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	{{-- <script src="/front/js/vendor/bootstrap.min.js"></script> --}}
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
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
	{{-- <script src="/front/js/waypoints.min.js"></script> --}}
	<script src="/front/js/wow.min.js"></script>
	<script src="/front/js/jquery.counterup.min.js"></script>
	<script src="/front/js/mail-script.js"></script>
	<script src="/front/js/main.js"></script>
	<script type="text/javascript">
		$(".input").focus(function() {
			$(this).parent().addClass("focus");
		})
		$(".input").focusout(function() {
			cek = $(this).val();
			if(cek == "") {
				$(this).parent().removeClass("focus");
			}
		})
	</script>
	
</body>

</html>
