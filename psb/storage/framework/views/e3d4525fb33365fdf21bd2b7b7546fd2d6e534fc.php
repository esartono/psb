<?php $__env->startSection('isi'); ?>
	<section class="banner-area relative">
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h2 class="text-white">Hasil Tes Seleksi</h2>
					<?php if($calons): ?>
						<?php $__currentLoopData = $calons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $calon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php echo $__env->make('front.hasiltes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<form action="/gethasil" class="mt-3" method="POST">
						<?php echo e(csrf_field()); ?> 
							<div class="mt-10">
								<input style="width: 30%; padding: 10px" type="text" name="id" placeholder="No. Pendaftaran" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukan No. Pendaftaran'" required>
							</div>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tik/psb/resources/views/front/hasil.blade.php ENDPATH**/ ?>