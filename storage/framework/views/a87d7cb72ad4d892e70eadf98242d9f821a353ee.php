<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <body class="app sidebar-mini rtl">
        <div class="bg-overlay">
            <img src="<?php echo e(asset('assets/img/loading.svg')); ?>">
        </div>
        <div id="app">
                <app-header title="<?php echo e(config('app.name')); ?>"></app-header>

                <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
                <div class="app-filter-sidebar__overlay" data-toggle="filter-sidebar"></div>

                <app-side v-bind:user="[]"></app-side>

                <main class="app-content">

            <?php echo $__env->yieldContent('content'); ?>

                </main>
                <app-footer
                    app-version="1.0"
                    current-year="<?php echo e(date('Y')); ?>"
                ></app-footer>
        </div>
    </body>
</html>
<?php /**PATH /Users/mac/Documents/projects/test-senior/resources/views/layouts/app.blade.php ENDPATH**/ ?>