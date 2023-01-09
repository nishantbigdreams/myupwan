<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <?php echo $__env->make('_partials.links', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('page-style'); ?>
    
</head>
<body>
    <?php echo $__env->make('_partials.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="wrapper">
        <div class="container-fluid">
            <?php echo $__env->yieldContent('page-content'); ?>
            
            
            <?php echo $__env->yieldContent('page-modal'); ?>
        </div>
    </div>
    <?php echo $__env->make('_partials.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('page-scripts'); ?>
</body>
</html>
