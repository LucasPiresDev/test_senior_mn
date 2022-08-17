<?php $__env->startSection('content'); ?>
	<app-page-edit
    :url="'/users'"
        :title="'Editar Usuário'"
        :url_submit="'/api/users/<?php echo e($user->id); ?>'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                value: '<?php echo e($user->name); ?>',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Email',
                label: 'Email',
                name: 'email',
                value: '<?php echo e($user->email); ?>',
                type: 'email',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
        :selects="[
            {
                label: 'Endereço',
                name: 'address_id',
                value: <?php echo e($user->address_id); ?>,
                required: true,
                options: <?php echo e(json_encode($addresses)); ?>

            }
        ]"
    >
    </app-page-edit>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/users/edit.blade.php ENDPATH**/ ?>