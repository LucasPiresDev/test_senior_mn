<?php $__env->startSection('content'); ?>
    <app-page-index
        :title="'Cidades'"
        :entity="'cities'"
        :url="'cities'"
        :columns="<?php echo e(json_encode($columns)); ?>"
    ></app-page-index>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/cities/index.blade.php ENDPATH**/ ?>