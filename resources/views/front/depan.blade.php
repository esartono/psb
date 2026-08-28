
@extends('front.template1')

@push('style')
<style>
	.countdown {
	  margin-bottom: 40px;
	  padding: 10px 35px;
	  display: flex;
	  flex-direction: row;
	  justify-content: flex-start;
	  /* color: var(--primary); */
	  color: white;
	}

	@media only screen and (max-width: 1024px) {
	  .countdown {
		justify-content: center;
	  }
	}

	.countdown .time {
	  display: flex;
	  flex-direction: column;
	  justify-content: start;
	}

	.countdown .time:not(:last-child) {
	  margin-right: 16px;
	}

	.countdown .time #days,
	.countdown .time #hours,
	.countdown .time #minutes,
	.countdown .time #seconds,
	.countdown .time .semicolon {
	  font-family: Samsung Sharp Sans;
	  font-style: normal;
	  font-weight: bold;
	  letter-spacing: 0.3px;
	}

	@media only screen and (min-width: 1024px) {

	  .countdown .time #days,
	  .countdown .time #hours,
	  .countdown .time #minutes,
	  .countdown .time #seconds,
	  .countdown .time .semicolon {
		font-size: 72px;
		line-height: 91px;
	  }
	}

	@media only screen and (max-width: 1024px) {

	  .countdown .time #days,
	  .countdown .time #hours,
	  .countdown .time #minutes,
	  .countdown .time #seconds,
	  .countdown .time .semicolon {
		font-size: 40px;
		line-height: 50px;
		text-align: center;
	  }
	}

	.countdown .time span {
	  font-family: Samsung Sharp Sans;
	  font-style: normal;
	  font-weight: normal;
	  line-height: 15px;
	  text-align: center;
	  letter-spacing: 0.3px;
	  align-self: center;
	}

	.countdown .semicolon {
	  margin-right: 16px;
	  display: flex;
	  flex-direction: column;
	  justify-content: flex-start;
	  font-family: Samsung Sharp Sans;
	  font-style: normal;
	  font-weight: bold;
	  letter-spacing: 0.3px;
	}

	@media only screen and (min-width: 1024px) {
	  .countdown .semicolon {
		font-size: 72px;
		line-height: 91px;
	  }
	}

	@media only screen and (max-width: 1024px) {
	  .countdown .semicolon {
		font-size: 40px;
		line-height: 50px;
		text-align: center;
	  }
	}
  </style>
@endpush
@section('isi')

<!-- Pricing Start -->
<div class="container-xxl py-5">
	<div class="container px-lg-5">
		<div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
			<h1 class="mb-3">{{ __('Academic Programs') }}</h1>
			<p class="mb-1">{{ __('Kurikulum') }}</p>
		</div>
		<div class="row gy-5 gx-4 justify-content-center">
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
				<div class="position-relative shadow rounded border-top border-5 border-kb">
					<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-kb rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
						<i class="fa-solid fa-school text-white"></i>
					</div>
					<div class="text-center border-bottom p-4 pt-5">
						<h4 class="fw-bold color-kb">Children Care and Education Center (CCEC)</h4>
						<p class="mb-0">Jalan Haji Rijin No. 100</p>
						<p class="mb-0">Tugu, Cimanggis, Depok</p>
						<p class="mb-2">Jawa Barat</p>
					</div>
					<div class="p-3">
						<p class="border-bottom pb-3"><i class="fa-solid fa-phone color-kb me-3"></i><a href="#" class="color-kb">021-870 8919</a></p>
						<p class="border-bottom pb-3"><i class="fa-solid fa-envelope color-kb me-3"></i><a class="color-kb" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to=ccec@nurulfikri.sch.id" target="_blank">ccec@nurulfikri.sch.id</a></p>
						<p class="border-bottom pb-3"><i class="fa-brands fa-instagram color-kb me-3"></i><a class="color-kb" href="https://www.instagram.com/ccecnf" target="_blank">@ccecnf_</a></p>
						<p class="mb-0"><i class="fa-solid fa-globe color-kb me-3"></i><a class="color-kb" href="https://tkit.nurulfikri.sch.id" target="_blank">tkit.nurulfikri.sch.id</a></p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
				<div class="position-relative shadow rounded border-top border-5 border-tk">
					<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-tk rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
						<i class="fa-solid fa-school text-white"></i>
					</div>
					<div class="text-center border-bottom p-4 pt-5">
						<h4 class="fw-bold color-tk"><br>{{ __('Kindergarten') }}</h4>
						<br>
						<p class="mb-0">Jalan Haji Rijin No. 100</p>
						<p class="mb-0">Tugu, Cimanggis, Depok</p>
						<p class="mb-2">Jawa Barat</p>
					</div>
					<div class="p-3">
						<p class="border-bottom pb-3"><i class="fa-solid fa-phone color-tk me-3"></i><a href="#" class="color-tk">021-870 8919</a></p>
						<p class="border-bottom pb-3"><i class="fa-solid fa-envelope color-tk me-3"></i><a class="color-tk" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to=tkit@nurulfikri.sch.id" target="_blank">tkit@nurulfikri.sch.id</a></p>
						<p class="border-bottom pb-3"><i class="fa-brands fa-instagram color-tk me-3"></i><a class="color-tk" href="https://www.instagram.com/tkitnf_" target="_blank">@tkitnf_</a></p>
						<p class="mb-0"><i class="fa-solid fa-globe color-tk me-3"></i><a class="color-tk" href="https://tkit.nurulfikri.sch.id" target="_blank">tkit.nurulfikri.sch.id</a></p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
				<div class="position-relative shadow rounded border-top border-5 border-sd">
					<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-sd rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
						<i class="fa-solid fa-school text-white"></i>
					</div>
					<div class="text-center border-bottom p-4 pt-5">
						<h4 class="fw-bold color-sd"><br>{{ __('Elementary') }}</h4>
						<br>
						<p class="mb-0">Jalan Tugu Raya No. 61</p>
						<p class="mb-0">Tugu, Cimanggis, Depok</p>
						<p class="mb-2">Jawa Barat</p>
					</div>
					<div class="p-3">
						<p class="border-bottom pb-3"><i class="fa-solid fa-phone color-sd me-3"></i><a class="color-sd" href="#">021-872 0647</a></p>
						<p class="border-bottom pb-3"><i class="fa-solid fa-envelope color-sd me-3"></i><a class="color-sd" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to=sdit@nurulfikri.sch.id" target="_blank">sdit@nurulfikri.sch.id</a></p>
						<p class="border-bottom pb-3"><i class="fa-brands fa-instagram color-sd me-3"></i><a class="color-sd" href="https://www.instagram.com/sditnf_" target="_blank">@sditnf_</a></p>
						<p class="mb-0"><i class="fa-solid fa-globe color-sd me-3"></i><a class="color-sd" href="https://sdit.nurulfikri.sch.id" target="_blank">sdit.nurulfikri.sch.id</a></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row gy-5 gx-4 justify-content-center mt-4">
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
				<div class="position-relative shadow rounded border-top border-5 border-smp">
					<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-smp rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
						<i class="fa-solid fa-school text-white"></i>
					</div>
					<div class="text-center border-bottom p-4 pt-5">
						<h4 class="fw-bold color-smp"><br>{{ __('Middle School') }}</h4>
						<br>
						<p class="mb-0">Jalan Tugu Raya No. 61</p>
						<p class="mb-0">Tugu, Cimanggis, Depok</p>
						<p class="mb-2">Jawa Barat</p>
					</div>
					<div class="p-3">
						<p class="border-bottom pb-3"><i class="fa-solid fa-phone color-smp me-3"></i><a class="color-smp" href="#">021-872 0646</a></p>
						<p class="border-bottom pb-3"><i class="fa-solid fa-envelope color-smp me-3"></i><a class="color-smp" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to=smpit@nurulfikri.sch.id" target="_blank">smpit@nurulfikri.sch.id</a></p>
						<p class="border-bottom pb-3"><i class="fa-brands fa-instagram color-smp me-3"></i><a class="color-smp" href="https://www.instagram.com/smpitnf" target="_blank">@smpitnf</a></p>
						<p class="mb-0"><i class="fa-solid fa-globe color-smp me-3"></i><a class="color-smp" href="https://smpit.nurulfikri.sch.id" target="_blank">smpit.nurulfikri.sch.id</a></p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
				<div class="position-relative shadow rounded border-top border-5 border-sma">
					<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-sma rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
						<i class="fa-solid fa-school text-white"></i>
					</div>
					<div class="text-center border-bottom p-4 pt-5">
						<h4 class="fw-bold color-sma"><br>{{ __('High School') }}</h4>
						<br>
						<p class="mb-0">Jalan H. Sairi No. 145</p>
						<p class="mb-0">Tugu, Cimanggis, Depok</p>
						<p class="mb-2">Jawa Barat</p>
					</div>
					<div class="p-3">
						<p class="border-bottom pb-3"><i class="fa-solid fa-phone color-sma me-3"></i><a class="color-sma" href="#">021-872 2070</a></p>
						<p class="border-bottom pb-3"><i class="fa-solid fa-envelope color-sma me-3"></i><a class="color-sma" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to=smait@nurulfikri.sch.id" target="_blank">smait@nurulfikri.sch.id</a></p>
						<p class="border-bottom pb-3"><i class="fa-brands fa-instagram color-sma me-3"></i><a class="color-sma" href="https://www.instagram.com/smaitnf" target="_blank">@smaitnf</a></p>
						<p class="mb-0"><i class="fa-solid fa-globe color-sma me-3"></i><a class="color-sma" href="https://smait.nurulfikri.sch.id" target="_blank">smait.nurulfikri.sch.id</a></p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
				<div class="position-relative shadow rounded border-top border-5 border-smp">
					<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-smp rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
						<i class="fa-solid fa-school text-white"></i>
					</div>
					<div class="text-center border-bottom p-4 pt-5">
						<h4 class="fw-bold color-smp">Nurul Fikri Boarding School - BOGOR</h4>
						<p class="mb-0">Jalan Jami, Sukaluyu</p>
						<p class="mb-0">Tamansari, Bogor</p>
						<p class="mb-2">Jawa Barat</p>
					</div>
					<div class="p-2">
						<p class="border-bottom pb-3"><i class="fa-solid fa-phone color-smp me-3"></i><a class="color-smp" href="#">+62 857 7979 8040</a></p>
						<p class="border-bottom pb-3"><i class="fa-solid fa-envelope color-smp me-3"></i><a class="color-smp" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to=humas.nfbsbogor@gmail.com" target="_blank">humas.nfbsbogor@gmail.com</a></p>
						<p class="border-bottom pb-3"><i class="fa-brands fa-instagram color-smp me-3"></i><a class="color-smp" href="https://www.instagram.com/nfbsbogorofficial/" target="_blank">@nfbsbogorofficial</a></p>
						<p class="mb-0"><i class="fa-solid fa-globe color-smp me-3"></i><a class="color-smp" href="https://nfbs-bogor.sch.id" target="_blank">nfbs-bogor.sch.id</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Testimonial Start -->
{{-- <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container px-lg-5">
		<div class="owl-carousel testimonial-carousel">
			<div class="testimonial-item position-relative bg-light border-top border-5 border-primary rounded p-4 my-4">
				<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 ms-5 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
					<i class="fa fa-quote-left text-white"></i>
				</div>
				<p class="mt-3">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
				<div class="d-flex align-items-center">
					<img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-1.jpg" style="width: 50px; height: 50px;">
					<div class="ps-3">
						<h6 class="fw-bold mb-1">Client Name</h6>
						<small>Profession</small>
					</div>
				</div>
			</div>
			<div class="testimonial-item position-relative bg-light border-top border-5 border-primary rounded p-4 my-4">
				<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 ms-5 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
					<i class="fa fa-quote-left text-white"></i>
				</div>
				<p class="mt-3">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
				<div class="d-flex align-items-center">
					<img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-2.jpg" style="width: 50px; height: 50px;">
					<div class="ps-3">
						<h6 class="fw-bold mb-1">Client Name</h6>
						<small>Profession</small>
					</div>
				</div>
			</div>
			<div class="testimonial-item position-relative bg-light border-top border-5 border-primary rounded p-4 my-4">
				<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 ms-5 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
					<i class="fa fa-quote-left text-white"></i>
				</div>
				<p class="mt-3">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
				<div class="d-flex align-items-center">
					<img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-3.jpg" style="width: 50px; height: 50px;">
					<div class="ps-3">
						<h6 class="fw-bold mb-1">Client Name</h6>
						<small>Profession</small>
					</div>
				</div>
			</div>
			<div class="testimonial-item position-relative bg-light border-top border-5 border-primary rounded p-4 mt-4">
				<div class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 ms-5 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
					<i class="fa fa-quote-left text-white"></i>
				</div>
				<p class="mt-3">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
				<div class="d-flex align-items-center">
					<img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-4.jpg" style="width: 50px; height: 50px;">
					<div class="ps-3">
						<h6 class="fw-bold mb-1">Client Name</h6>
						<small>Profession</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> --}}
<!-- Testimonial End -->
{{-- <div class="modal modal-lg fade" id="modalTutupUnit" role="dialog" arialabelledby="modalLabel" area-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<img src="img/smaTutup.jpeg" width="auto" height="450px" alt="...">
				<img src="img/smpTutup.jpeg" width="auto" height="450px" alt="...">
            </div>
        </div>
    </div>
</div> --}}
@endsection

@push('java')
<script>
	// var myModal = new bootstrap.Modal(document.getElementById("modalTutupUnit"), {});
	// document.onreadystatechange = function () {
	// 	myModal.show();
	// };

	// function getCounter() {
	// 	var countDownDate = new Date("Aug 10, 2025 08:00:00").getTime();

	// 	var x = setInterval(function () {
	// 		var now = new Date().getTime();

	// 		var distance = countDownDate - now;

	// 		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	// 		var hours = Math.floor(
	// 		(distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
	// 		);
	// 		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	// 		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	// 		var textDays = document.getElementById("days");
	// 		var textHours = document.getElementById("hours");
	// 		var textMinutes = document.getElementById("minutes");
	// 		var textSeconds = document.getElementById("seconds");

	// 		textDays.innerHTML = days < 10 ? "0" + days : days;
	// 		textHours.innerHTML = hours < 10 ? "0" + hours : hours;
	// 		textMinutes.innerHTML = minutes < 10 ? "0" + minutes : minutes;
	// 		textSeconds.innerHTML = seconds < 10 ? "0" + seconds : seconds;

	// 		if (distance < 0) {
	// 		clearInterval(x);
	// 		}
	// 	}, 1000);
	// }
	// getCounter();
</script>
@endpush