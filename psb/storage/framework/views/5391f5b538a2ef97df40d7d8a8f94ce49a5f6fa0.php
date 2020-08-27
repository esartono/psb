<?php $__env->startSection('content'); ?>
<h2 class="headline text-warning mt-5 mr-4"> 403</h2>
<div class="error-content mt-5">
    <br>
    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Error</h3>
    <p>
        <?php echo e($exception->getMessage()); ?>

    </p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tik/psb/resources/views/errors/403.blade.php ENDPATH**/ ?>