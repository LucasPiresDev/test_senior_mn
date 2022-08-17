<?php $__env->startSection('content'); ?>
	<app-page-edit
        :url="'/states'"
        :title="'Editar Estado'"
        :url_submit="'/api/states/<?php echo e($state->id); ?>'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                minLength: 3,
                maxLength: 100,
                required: true,
                value: '<?php echo e($state->name); ?>',
            },
            {
                placeholder: 'Código',
                label: 'Código',
                name: 'code',
                minLength: 3,
                maxLength: 100,
                required: true,
                value: '<?php echo e($state->code); ?>',
            },
            {
                placeholder: 'País',
                label: 'País',
                name: 'country',
                minLength: 3,
                maxLength: 100,
                required: true,
                value: '<?php echo e($state->country); ?>',
            }
        ]"
    >
    </app-page-edit>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/states/edit.blade.php ENDPATH**/ ?>