<!-- jQuery  -->
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/detect.js')); ?>"></script>
<script src="<?php echo e(asset('js/fastclick.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.blockUI.js')); ?>"></script>
<script src="<?php echo e(asset('js/waves.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.scrollTo.min.js')); ?>"></script>

<!-- Counter js  -->
<script src="<?php echo e(asset('plugins/waypoints/jquery.waypoints.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/counterup/jquery.counterup.min.js')); ?>"></script>

<!--Morris Chart-->



<!-- Modal-Effect -->
<script src="<?php echo e(asset('plugins/custombox/js/custombox.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/custombox/js/legacy.min.js')); ?>"></script>

<!-- App js -->
<script src="<?php echo e(asset('js/jquery.core.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.app.js')); ?>"></script>
<script src="<?php echo e(asset('js/script2.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')); ?>"></script>

<!-- App js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="<?php echo e(asset('plugins/dataTables/datatables.min.js')); ?>"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> -->

  <!-- table filter -->
  <script type="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>



<script type="text/javascript">
$('[tip]').tooltip();
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
if ("<?php echo e(session('status')); ?>") {
	toastr.options.closeDuration = 50000;
	toastr.info("<?php echo session('status'); ?>");
}
</script>
<?php echo $__env->yieldPushContent('page-script'); ?>
