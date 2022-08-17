<?php $__env->startSection('content'); ?>
	<app-page-create
        :url="'/addresses'"
        :title="'Cadastrar Endereço'"
        :url_submit="'/api/addresses'"
        :inputs="[
            {
                placeholder: 'Rua',
                label: 'Rua',
                name: 'street',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Número',
                label: 'Número',
                name: 'number',
                required: true,
            },
            {
                placeholder: 'Complemento',
                label: 'Complemento',
                name: 'complement',
                maxLength: 100,
                required: false,
            }
            
        ]"
        :selects="[
            {
                label: 'Cidade',
                name: 'city_id',
                required: true,
                options: <?php echo e(json_encode($cities)); ?>

            }
        ]"
    >
    </app-page-create>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/addresses/create.blade.php ENDPATH**/ ?>