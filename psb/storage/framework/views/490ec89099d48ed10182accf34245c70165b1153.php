<?php $__env->startSection('isi'); ?>
	<!-- Start Banner Area -->
	<section class="home-banner-area relative">
		<div class="container">
			<div class="row fullscreen d-flex align-items-center justify-content-center">
				<div class="banner-content col-md-7">
					<h1 class="wow fadeIn" data-wow-duration="4s">PPDB Online<br> SIT Nurul Fikri - Depok</h1>
					<hr>
					<p class="wow fadeIn text-white">
						Selamat Datang di Sistem PPDB Online SIT Nurul Fikri Tahun Akademik <?php echo e($tp->name); ?>.
						Perhatikan semua informasi mengenai Peserta Didik Baru sebelum anda mulai mendaftar.
						Apabila Anda belum mempunyai akun, silahkan melakukan proses Daftar Akun.</p>
					<div class="wow fadeIn card col-md-6 offset-md-3 border-warning countdown mt-4">
						<ul class="mt-4">
							<li><span id="days" class="mb-3"></span>hari</li>
							<li><span id="hours" class="mb-3"></span>jam</li>
							<li><span id="minutes" class="mb-3"></span>menit</li>
							<li><span id="seconds" class="mb-3"></span>detik</li>
						</ul>
					</div>
					<div class="courses pt-20 mt-4">
						<?php if(Route::has('login')): ?>
							<div class="top-right links">
								<?php if(auth()->guard()->check()): ?>
									<?php if(auth()->user()->isAdmin() || auth()->user()->isAdminUnit()): ?>
										<a href="<?php echo e(url('/home')); ?>" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 success circle mr-10 mb-10 wow fadeInDown">Home</a>
									<?php endif; ?>
									<?php if(auth()->user()->isUser()): ?>
										<a href="<?php echo e(url('/psb')); ?>" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 success circle mr-10 mb-10 wow fadeInDown">Home</a>
									<?php endif; ?>
								<?php else: ?>
									<a href="<?php echo e(route('login')); ?>" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 danger circle mr-10 mb-10 wow fadeInDown">Login</a>
									<a href="<?php echo e(route('register')); ?>" data-wow-duration="1s" data-wow-delay=".3s" class="genric-btn col-md-4 success circle mr-10 mb-10 wow fadeInDown">Daftar Akun</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-5">
					<div class="card wow fadeIn border-info" data-wow-duration="4s">
						<div class="card-header bg-info text-white">Informasi Penerimaan Peserta Didik Baru</div>
						<div class="card-body">
							<?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<h5><?php echo e($b->judul); ?></h5>
								<?php echo e(mb_strimwidth($b->berita, 0, 150, '...')); ?>

								<hr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
				<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-lg-3 col-md-6 col-sm-12 single-faculty" style="color: #fff">
					<div class="meta-text text-center bg-<?php echo e($unit->catnya->name); ?>">
						<img class="img-fluid" src="img/<?php echo e($unit->catnya->name); ?>.png" alt="logo Unit" width="40%" style="margin-top: -50px">
						<hr>
						<h4 style="color: #fff"><?php echo e($unit->name); ?></h4>
						<hr>
						<div class="info wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
							<p style="font-size: 11px"> <?php echo e($unit->address); ?> <br> Cimanggis, Kota Depok - Jawa Barat</p>
							<p class="designation">Telepon : <?php echo e($unit->phone); ?><br>Email : <?php echo e($unit->email); ?></p>
							<a style="font-size: 0.8em" href="https://<?php echo e(strtolower($unit->catnya->name)); ?>it.nurulfikri.sch.id"
							target="_blank" class="genric-btn info-border circle arrow"><b><?php echo e($unit->name); ?></b></a>
						</div>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

		let countDown = new Date('<?php echo e($start); ?>').getTime(),
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tik/psb/resources/views/front/depan.blade.php ENDPATH**/ ?>