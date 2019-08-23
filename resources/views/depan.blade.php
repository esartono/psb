
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
		padding: 1em;
		text-transform: uppercase;
		color: #024A81;
		}

		li span {
		display: block;
		font-size: 3.5rem;
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
						<li class="menu-has-children"><a href="">Alur PSB</a>
							<ul>
								<li><a href="#">Alur Pendaftaran</a></li>
								<li><a href="#">Prosedur Pendaftaran</a></li>
							</ul>
						</li>
						<li><a href="#">Biaya Pendaftaran</a></li>
						<li><a href="#">Syarat dan Ketentuan</a></li>
						<li class="menu-has-children"><a href="">Jadwal Tes</a>
							<ul>
								<li><a href="">Agenda PSB</a></li>
								<li><a href="">Tes Kesehatan</a></li>
							</ul>
						</li>
						<li class="menu-has-children"><a href="">Tata Cara Pembayaran</a>
							<ul>
								<li><a href="">PSB NF Depok</a></li>
								<li><a href="">PSB SDIT NF Aceh</a></li>
							</ul>
						</li>
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
				<div class="banner-content col-lg-8 col-md-12">
					<h1 class="wow fadeIn" data-wow-duration="4s">Penerimaan Siswa Baru<br> SIT Nurul Fikri - Depok</h1>
					<hr>
					<p class="text-white mb-3" style="font-weight:bolder; font-size:20pt; text-decoration: underline;">
						SELAMAT DATANG
					</p>
					<p class="text-white">
						di Sistem Penerimaan Siswa Baru SIT Nurul Fikri Tahun Akademik {{ $tp->name }}.
						Perhatikan semua informasi mengenai pendaftaran Siswa Baru sebelum anda mulai mendaftar.
					</p>
					<div class="card col-md-8 offset-md-2 border-warning countdown mt-4">
						<ul class="mt-4">
							<li><span id="days" class="mb-3"></span>days</li>
							<li><span id="hours" class="mb-3"></span>Hours</li>
							<li><span id="minutes" class="mb-3"></span>Minutes</li>
							<li><span id="seconds" class="mb-3"></span>Seconds</li>
						</ul>
					</div>
					<div class="courses pt-20 mt-4">
						@if (Route::has('login'))
							<div class="top-right links">
								@auth
									@if (auth()->user()->isAdmin())
										<a href="{{ url('/home') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn success circle mr-10 mb-10 wow fadeInDown">Home</a>
									@endif
									@if (auth()->user()->isUser())
										<a href="{{ url('/psb') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn success circle mr-10 mb-10 wow fadeInDown">Home</a>
									@endif
								@else
									<a href="{{ route('login') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn danger circle mr-10 mb-10 wow fadeInDown">Login</a>
									<a href="{{ route('register') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn success circle mr-10 mb-10 wow fadeInDown">Daftar Akun</a>
								@endauth
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="rocket-img">
			<img src="img/rocket.png" alt="">
		</div>
	</section>
	<!-- End Banner Area -->


	<!-- Start About Area -->
	<section class="about-area section-gap">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-5 col-md-6 about-left">
					<img class="img-fluid" src="img/about.jpg" alt="">
				</div>
				<div class="offset-lg-1 col-lg-6 offset-md-0 col-md-12 about-right">
					<h1>
						Over 2500 Courses <br> from 5 Platform
					</h1>
					<div class="wow fadeIn" data-wow-duration="1s">
						<p>
							There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think
							about setting up your own viewing station. In the life of any aspiring astronomer that it is time to buy that first
							telescope. It’s exciting to think about setting up your own viewing station.
						</p>
					</div>
					<a href="courses.html" class="primary-btn">Explore Courses</a>
				</div>
			</div>
		</div>
	</section>
	<!-- End About Area -->


	<!-- Start Courses Area -->
	<section class="courses-area section-gap">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5 about-right">
					<h1>
						This is Why <br> We have Solid Idea
					</h1>
					<div class="wow fadeIn" data-wow-duration="1s">
						<p>
							There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think
							about setting up your own viewing station. In the life of any aspiring astronomer that it is time to buy that first
							telescope. It’s exciting to think about setting up your own viewing station.
						</p>
					</div>
					<a href="courses.html" class="primary-btn white">Explore Courses</a>
				</div>
				<div class="offset-lg-1 col-lg-6">
					<div class="courses-right">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<ul class="courses-list">
									<li>
										<a class="wow fadeInLeft" href="courses.html" data-wow-duration="1s" data-wow-delay=".1s">
											<i class="fa fa-book"></i> Development
										</a>
									</li>
									<li>
										<a class="wow fadeInLeft" href="courses.html" data-wow-duration="1s" data-wow-delay=".3s">
											<i class="fas fa-book"></i> IT & Software
										</a>
									</li>
									<li>
										<a class="wow fadeInLeft" href="courses.html" data-wow-duration="1s" data-wow-delay=".5s">
											<i class="fa fa-book"></i> Photography
										</a>
									</li>
									<li>
										<a class="wow fadeInLeft" href="courses.html" data-wow-duration="1s" data-wow-delay=".7s">
											<i class="fa fa-book"></i> Language
										</a>
									</li>
									<li>
										<a class="wow fadeInLeft" href="courses.html" data-wow-duration="1s" data-wow-delay=".9s">
											<i class="fa fa-book"></i> Life Science
										</a>
									</li>
									<li>
										<a class="wow fadeInLeft" href="courses.html" data-wow-duration="1s" data-wow-delay="1.1s">
											<i class="fa fa-book"></i> Business
										</a>
									</li>
									<li>
										<a class="wow fadeInLeft" href="courses.html" data-wow-duration="1s" data-wow-delay="1.3s">
											<i class="fa fa-book"></i> Socoal Science
										</a>
									</li>
								</ul>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<ul class="courses-list">
									<li>
										<a class="wow fadeInRight" href="courses.html" data-wow-duration="1s" data-wow-delay="1.3s">
											<i class="fa fa-book"></i> Data Science
										</a>
									</li>
									<li>
										<a class="wow fadeInRight" href="courses.html" data-wow-duration="1s" data-wow-delay="1.1s">
											<i class="fa fa-book"></i> Design
										</a>
									</li>
									<li>
										<a class="wow fadeInRight" href="courses.html" data-wow-duration="1s" data-wow-delay=".9s">
											<i class="fa fa-book"></i> Training
										</a>
									</li>
									<li>
										<a class="wow fadeInRight" href="courses.html" data-wow-duration="1s" data-wow-delay=".7s">
											<i class="fa fa-book"></i> Humanities
										</a>
									</li>
									<li>
										<a class="wow fadeInRight" href="courses.html" data-wow-duration="1s" data-wow-delay=".5s">
											<i class="fa fa-book"></i> Marketing
										</a>
									</li>
									<li>
										<a class="wow fadeInRight" href="courses.html" data-wow-duration="1s" data-wow-delay=".3s">
											<i class="fa fa-book"></i> Economics
										</a>
									</li>
									<li>
										<a class="wow fadeInRight" href="courses.html" data-wow-duration="1s" data-wow-delay=".1s">
											<i class="fa fa-book"></i> Personal Dev
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Courses Area -->


	<!--Start Feature Area -->
	<section class="feature-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="section-title text-center">
						<h1>Features That Make Us Hero</h1>
						<p>
							If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for
							as low as $.17 each.
						</p>
					</div>
				</div>
			</div>
			<div class="feature-inner row">
				<div class="col-lg-4 col-md-6">
					<div class="feature-item">
						<i class="ti-crown"></i>
						<h4>Architecture</h4>
						<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
							<p>
								Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt labore.
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="feature-item">
						<i class="ti-briefcase"></i>
						<h4>Interior Design</h4>
						<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
							<p>
								Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt labore.
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="feature-item">
						<i class="ti-medall-alt"></i>
						<h4>Concept Design</h4>
						<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".5s">
							<p>
								Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt labore.
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="feature-item">
						<i class="ti-key"></i>
						<h4>Lifetime Access</h4>
						<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
							<p>
								Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt labore.
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="feature-item">
						<i class="ti-files"></i>
						<h4>Source File Included</h4>
						<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
							<p>
								Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt labore.
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="feature-item">
						<i class="ti-headphone-alt"></i>
						<h4>Live Support</h4>
						<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".5s">
							<p>
								Lorem ipsum dolor sit amet consec tetur adipisicing elit, sed do eiusmod tempor incididunt labore.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Feature Area -->


	<!-- Start Faculty Area -->
	<section class="faculty-area section-gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="section-title text-center">
						<h1>Faculty Members</h1>
						<p>
							If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for
							as low as $.17 each.
						</p>
					</div>
				</div>
			</div>
			<div class="row justify-content-center d-flex align-items-center">
				<div class="col-lg-3 col-md-6 col-sm-12 single-faculty">
					<div class="thumb d-flex justify-content-center">
						<img class="img-fluid" src="img/faculty/f1.jpg" alt="">
					</div>
					<div class="meta-text text-center">
						<h4>Ethel Davis</h4>
						<p class="designation">Sr. Faculty Data Science</p>
						<div class="info wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
							<p>
								If you are looking at blank cassettes on the web, you may be very confused at the difference in price.
							</p>
						</div>
						<div class="align-items-center justify-content-center d-flex">
							<a href="#"><i class="fab fa-facebook"></i></a>
							<a href="#"><i class="fab fa-twitter"></i></a>
							<a href="#"><i class="fab fa-linkedin"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 single-faculty">
					<div class="thumb d-flex justify-content-center">
						<img class="img-fluid" src="img/faculty/f2.jpg" alt="">
					</div>
					<div class="meta-text text-center">
						<h4>Rodney Cooper</h4>
						<p class="designation">Sr. Faculty Data Science</p>
						<div class="info wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
							<p>
								If you are looking at blank cassettes on the web, you may be very confused at the difference in price.
							</p>
						</div>
						<div class="align-items-center justify-content-center d-flex">
							<a href="#"><i class="fab fa-facebook"></i></a>
							<a href="#"><i class="fab fa-twitter"></i></a>
							<a href="#"><i class="fab fa-linkedin"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 single-faculty">
					<div class="thumb d-flex justify-content-center">
						<img class="img-fluid" src="img/faculty/f3.jpg" alt="">
					</div>
					<div class="meta-text text-center">
						<h4>Dora Walker</h4>
						<p class="designation">Sr. Faculty Data Science</p>
						<div class="info wow fadeIn" data-wow-duration="1s" data-wow-delay=".5s">
							<p>
								If you are looking at blank cassettes on the web, you may be very confused at the difference in price.
							</p>
						</div>
						<div class="align-items-center justify-content-center d-flex">
							<a href="#"><i class="fab fa-facebook"></i></a>
							<a href="#"><i class="fab fa-twitter"></i></a>
							<a href="#"><i class="fab fa-linkedin"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 single-faculty">
					<div class="thumb d-flex justify-content-center">
						<img class="img-fluid" src="img/faculty/f4.jpg" alt="">
					</div>
					<div class="meta-text text-center">
						<h4>Lena Keller</h4>
						<p class="designation">Sr. Faculty Data Science</p>
						<div class="info wow fadeIn" data-wow-duration="1s" data-wow-delay=".7s">
							<p>
								If you are looking at blank cassettes on the web, you may be very confused at the difference in price.
							</p>
						</div>
						<div class="align-items-center justify-content-center d-flex">
							<a href="#"><i class="fab fa-facebook"></i></a>
							<a href="#"><i class="fab fa-twitter"></i></a>
							<a href="#"><i class="fab fa-linkedin"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Faculty Area -->


	<!-- Start Testimonials Area -->
	<section class="testimonials-area section-gap">
		<div class="container">
			<div class="testi-slider owl-carousel" data-slider-id="1">
				<div class="item">
					<div class="testi-item">
						<img src="img/quote.png" alt="">
						<h4>Fanny Spencer</h4>
						<ul class="list">
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
						</ul>
						<div class="wow fadeIn" data-wow-duration="1s">
							<p>
								As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel
								across her face <br> and She is the host to your journey.
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="testi-item">
						<img src="img/quote.png" alt="">
						<h4>Fanny Spencer</h4>
						<ul class="list">
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
						</ul>
						<div class="wow fadeIn" data-wow-duration="1s">
							<p>
								As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel
								across her face <br> and She is the host to your journey.
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="testi-item">
						<img src="img/quote.png" alt="">
						<h4>Fanny Spencer</h4>
						<ul class="list">
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
						</ul>
						<div class="wow fadeIn" data-wow-duration="1s">
							<p>
								As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel
								across her face <br> and She is the host to your journey.
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="testi-item">
						<img src="img/quote.png" alt="">
						<h4>Fanny Spencer</h4>
						<ul class="list">
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
						</ul>
						<div class="wow fadeIn" data-wow-duration="1s">
							<p>
								As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel
								across her face <br> and She is the host to your journey.
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
				<div class="owl-thumb-item">
					<div>
						<img class="img-fluid" src="img/testimonial/t1.jpg" alt="">
					</div>
					<div class="overlay overlay-grad"></div>
				</div>
				<div class="owl-thumb-item">
					<div>
						<img class="img-fluid" src="img/testimonial/t2.jpg" alt="">
					</div>
					<div class="overlay overlay-grad"></div>
				</div>
				<div class="owl-thumb-item">
					<div>
						<img class="img-fluid" src="img/testimonial/t3.jpg" alt="">
					</div>
					<div class="overlay overlay-grad"></div>
				</div>
				<div class="owl-thumb-item">
					<div>
						<img class="img-fluid" src="img/testimonial/t4.jpg" alt="">
					</div>
					<div class="overlay overlay-grad"></div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Testimonials Area -->


	<!-- Start Footer Area -->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Top Products</h4>
					<ul>
						<li><a href="#">Managed Website</a></li>
						<li><a href="#">Manage Reputation</a></li>
						<li><a href="#">Power Tools</a></li>
						<li><a href="#">Marketing Service</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Quick Links</h4>
					<ul>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Brand Assets</a></li>
						<li><a href="#">Investor Relations</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Features</h4>
					<ul>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Brand Assets</a></li>
						<li><a href="#">Investor Relations</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Resources</h4>
					<ul>
						<li><a href="#">Guides</a></li>
						<li><a href="#">Research</a></li>
						<li><a href="#">Experts</a></li>
						<li><a href="#">Agencies</a></li>
					</ul>
				</div>
				<div class="col-lg-4 col-md-6 single-footer-widget">
					<h4>Newsletter</h4>
					<p>You can trust us. we only send promo offers,</p>
					<div class="form-wrap" id="mc_embed_signup">
						<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							method="get" class="form-inline">
							<input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '"
								required="" type="email">
							<button class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>
							<div style="position: absolute; left: -5000px;">
								<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
							</div>

							<div class="info"></div>
						</form>
					</div>
				</div>
			</div>
			<div class="footer-bottom row align-items-center">
				<p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				<div class="col-lg-4 col-md-12 footer-social">
					<a href="#"><i class="fab fa-facebook"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fa fa-dribbble"></i></a>
					<a href="#"><i class="fa fa-behance"></i></a>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer Area -->

	<!-- ####################### Start Scroll to Top Area ####################### -->
	<div id="back-top">
		<a title="Go to Top" href="#"></a>
	</div>
	<!-- ####################### End Scroll to Top Area ####################### -->

	<script src="/front/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper./js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="/front/js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
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
