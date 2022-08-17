<?php $__env->startSection('content'); ?>
	<app-page-create
        :url="'/users'"
        :title="'Cadastrar Usuário'"
        :url_submit="'/api/users'"
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
                placeholder: 'Email',
                label: 'Email',
                name: 'email',
                type: 'email',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Senha',
                label: 'Senha',
                name: 'password',
                type: 'password',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
        :selects="[
            {
                label: 'Endereço',
                name: 'address_id',
                required: true,
                options: <?php echo e(json_encode($addresses)); ?>

            }
        ]"
    >
    </app-page-create>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/users/create.blade.php ENDPATH**/ ?>