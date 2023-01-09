<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<link rel="icon" type="image/png" href="<?php echo e(asset('images/icons/favicon.png')); ?>">


<title>Admin Dashboard</title>

<!--Morris Chart CSS -->

<!-- Custom box css -->
<link href="<?php echo e(asset('plugins/custombox/css/custombox.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('plugins/dataTables/datatables.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('plugins/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')); ?>" rel="stylesheet">
<!-- App css -->
<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('css/core.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('css/components.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('css/icons.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('css/pages.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('css/menu.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('css/script2.css')); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo e(asset('js/script2.js')); ?>"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<style media="screen">
.toast-message{
    color:#fff;
}
.toast{
    background: #36404e;
    opacity: 1;
}
#toast-container{
    margin-top:48px;
}
</style>
<?php echo $__env->yieldContent('styles'); ?>
