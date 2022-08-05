
@extends('front.template1')

@section('isi')
	<!-- Start Banner Area -->
	<section class="home-banner-area relative">
		<div class="container">
			<div class="row fullscreen d-flex align-items-center justify-content-center">
				<div class="banner-content col-md-7">
					<h1 class="wow fadeIn" data-wow-duration="4s">PPDB Online<br> SIT Nurul Fikri</h1>
					<hr>
					<p class="wow fadeIn text-white">
						Selamat Datang di Sistem PPDB Online SIT Nurul Fikri Tahun Akademik {{ $tp->name }}.
						Perhatikan semua informasi mengenai Peserta Didik Baru sebelum anda mulai mendaftar.
						Apabila Anda belum mempunyai akun, silahkan melakukan proses Daftar Akun.</p>
					<div class="wow fadeIn card col-md-8 offset-md-2 border-warning countdown mt-4">
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
									@if (auth()->user()->isAdmin() || auth()->user()->isAdminUnit())
										<a href="{{ url('/home') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 success circle mr-10 mb-10 wow fadeInDown">Home</a>
									@endif
									@if (auth()->user()->isUser())
										<a href="{{ url('/ppdb') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 success circle mr-10 mb-10 wow fadeInDown">Home</a>
									@endif
								@else
									<a href="{{ route('login') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 danger circle mr-10 mb-10 wow fadeInDown">Login</a>
									<a href="{{ route('login') }}" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 success circle mr-10 mb-10 wow fadeInDown">Daftar Akun</a>
								@endauth
							</div>
						@endif
					</div>
				</div>
				<div class="col-md-5">
					<div class="card wow fadeIn border-info" data-wow-duration="4s">
						<div class="card-header bg-info text-white">Informasi PPDB Online</div>
						<div class="card-body">
							@foreach($berita as $b)
								<h5>{{ $b->judul }}</h5>
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
				<div class="col single-faculty" style="color: #fff;padding: 5px !important;">
					<div class="meta-text text-center bg-{{ $unit->catnya->name }}">
						<img class="img-fluid" src="img/{{ $unit->catnya->name }}.png" alt="logo Unit" width="40%" style="margin-top: -50px">
						<br>
						<h5 style="color: #fff">{{ $unit->name }}</h5>
						<hr>
						<div class="info wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
							<p style="font-size: 12px"> {{ $unit->address }} Cimanggis, Kota Depok - Jawa Barat</p>
							<p style="font-size: 12px" class="designation">Telepon : {{ $unit->phone }}<br>Email : {{ $unit->email }}</p>
							<a 
								style="position:absolute; justify-content:center; left:10px; right:10px; bottom:20px;"
								href="https://{{ strtolower($unit->catnya->name) }}it.nurulfikri.sch.id"
								target="_blank" class="genric-btn info-border circle arrow">
								<b>{{ $unit->name }}</b>
							</a>
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
@endsection
