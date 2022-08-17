<?php $__env->startSection('content'); ?>
    <app-page-index
        :title="'Estados'"
        :entity="'states'"
        :url="'states'"
        :columns="<?php echo e(json_encode($columns)); ?>"
        :filters="[
            {
                name: 'date',
                type: 'range',
                index: 4,
                value: 'dt',
            }
        ]"
    ></app-page-index>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/states/index.blade.php ENDPATH**/ ?>