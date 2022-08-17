<?php $__env->startSection('content'); ?>
	<app-page-create
        :url="'/states'"
        :title="'Cadastrar Estado'"
        :url_submit="'/api/states'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Código',
                label: 'Código',
                name: 'code',
                minLength: 2,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'País',
                label: 'País',
                name: 'country',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
    >
    </app-page-create>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/states/create.blade.php ENDPATH**/ ?>