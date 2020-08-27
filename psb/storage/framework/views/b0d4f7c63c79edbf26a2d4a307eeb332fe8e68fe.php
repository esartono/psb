<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header card-warning card-outline bg-red white"><?php echo e(__('Verifikasi Email Anda')); ?></div>

                <div class="card-body">
                    <?php if(session('resent')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(__('Link verifikasi yang baru telah dikirim ke email Anda')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo e(__('Sebelum melanjutkan, silahkan cek email Anda untuk melanjutkan')); ?>

                    <?php echo e(__('Jika anda belum menerima Email dari Kami')); ?>, <a href="<?php echo e(route('verification.resend')); ?>"><?php echo e(__('silahkan klik di sini')); ?></a>.
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tik/psb/resources/views/auth/verify.blade.php ENDPATH**/ ?>