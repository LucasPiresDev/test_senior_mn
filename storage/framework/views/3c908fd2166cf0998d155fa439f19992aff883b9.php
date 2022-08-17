<?php $__env->startSection('content'); ?>
    <app-page-index
        :title="'Usuários'"
        :entity="'users'"
        :url="'users'"
        :columns="<?php echo e(json_encode($columns)); ?>"
    ></app-page-index>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/users/index.blade.php ENDPATH**/ ?>