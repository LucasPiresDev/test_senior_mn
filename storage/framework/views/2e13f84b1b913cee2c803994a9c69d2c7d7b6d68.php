<?php $__env->startSection('content'); ?>
	<app-page-create
        :url="'/cities'"
        :title="'Cadastrar Cidade'"
        :url_submit="'/api/cities'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
        :selects="[
            {
                label: 'Estado',
                name: 'state_id',
                required: true,
                options: <?php echo e(json_encode($states)); ?>

            }
        ]"
    >
    </app-page-create>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/cities/create.blade.php ENDPATH**/ ?>