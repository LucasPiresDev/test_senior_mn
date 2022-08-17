<?php $__env->startSection('content'); ?>
    <app-dashboard
        :counts="{
            totalUsers: <?php echo e($totalUsers); ?>,
            totalStates: <?php echo e($totalStates); ?>,
            totalCities: <?php echo e($totalCities); ?>,
            totalAddresses: <?php echo e($totalAddresses); ?>,
        }"
        user-name="Lucas Pires"
        date="<?php echo e(\Carbon\Carbon::now()->isoFormat('dddd, DD [de] MMMM [de] YYYY')); ?>"
    ></app-dashboard>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/home.blade.php ENDPATH**/ ?>