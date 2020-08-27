<?php $__env->startSection('isi'); ?>
    <center>
        <h1>Reset Password</h1>
		<p>Email atau Username yang terdaftar adalah : <b><?php echo e($user['email']); ?></b></p>
		<p>Password yang baru : <b><?php echo e($newPass); ?></b></p>
		<p>Terima kasih.</p>
    </center>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tik/psb/resources/views/emails/resetPassword.blade.php ENDPATH**/ ?>