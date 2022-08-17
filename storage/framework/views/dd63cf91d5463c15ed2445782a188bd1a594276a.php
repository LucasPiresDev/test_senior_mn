<?php $__env->startSection('content'); ?>
	<app-page-edit
    :url="'/cities'"
        :title="'Editar Cidade'"
        :url_submit="'/api/cities/<?php echo e($city->id); ?>'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                value: '<?php echo e($city->name); ?>',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
        :selects="[
            {
                label: 'Estado',
                name: 'state_id',
                value: <?php echo e($city->state_id); ?>,
                required: true,
                options: <?php echo e(json_encode($states)); ?>,
            }
        ]"
    >
    </app-page-edit>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/cities/edit.blade.php ENDPATH**/ ?>