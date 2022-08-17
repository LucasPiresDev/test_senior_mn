<?php $__env->startSection('content'); ?>
	<app-page-edit
    :url="'/addresses'"
        :title="'Editar Endereço'"
        :url_submit="'/api/addresses/<?php echo e($address->id); ?>'"
        :inputs="[
            {
                placeholder: 'Rua',
                label: 'Rua',
                name: 'street',
                value: '<?php echo e($address->street); ?>',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Número',
                value: <?php echo e($address->number); ?>,
                label: 'Número',
                name: 'number',
                required: true,
            },
            {
                placeholder: 'Complemento',
                label: 'Complemento',
                name: 'complement',
                value: '<?php echo e($address->complement); ?>',
                maxLength: 100,
                required: false,
            }
            
        ]"
        :selects="[
            {
                label: 'Cidade',
                name: 'city_id',
                value: <?php echo e($address->city_id); ?>,
                required: true,
                options: <?php echo e(json_encode($cities)); ?>

            }
        ]"
    >
    </app-page-edit>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/addresses/edit.blade.php ENDPATH**/ ?>