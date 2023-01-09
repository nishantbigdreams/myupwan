<?php $__env->startSection('styles'); ?>
<style media="screen">
    mark{background:#188ae2;color:#fff;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-content'); ?>
<div class="container-fluid">
    <div class="col-md-12">
    <h3>Add New Parent Category</h3>
        <form method="post" action="<?php echo e(route('admin.parent_category.store')); ?>" id="category_form">
            <?php echo e(csrf_field()); ?>

            <div class="col-md-6">
                <input type="tetx" name="name" class="form-control input-sm" placeholder="E.g Computer" required="" autocomplete="off">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-sm btn-block">
                    <i class="fa fa-check"></i> SAVE
                </button>
            </div>
        </form>
    </div>
    <br><br>
    <div class="col-md-12">
    <h3>Parent Categories List</h3>
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-bordered" id="category_table">
                    <thead>
                        <tr>
                            <th>Sr.No </th>
                            <th>Name </th>
                            <th>Listing Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page-script'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript">
    let table;
    $(function(){
        table = $('#category_table').DataTable({
            'language':{
                "loadingRecords": "&nbsp;",
                "processing": "Loading Categories..."
            },
            'mark':true,
            "ajax": {
                "url" : "<?php echo e(route('parent_category.datatable.index')); ?>",
                "type" : "POST",
                'data' : function(d){
                }
            },
            "processing": true,
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": [0]
            }]
        });
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();

        $(document).on('click','.delete', function(){
            let id = $(this).attr('id');
            swal({
                title: "Delete Category Permanently ?",
                text: "All Categories and product under this parent category may NOT VISIBLE unless new parent category is assigned",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Proceed',
            }, function () {
                $.ajax({
                    url: '/admin/parent_category/'+id,
                    type:'post',
                    method: 'delete',
                }).done(function(data, textStatus, jqXHR) {
                    if (data.status) {
                        swal("Success", "Category deleted Successfully", "success")
                        table.ajax.reload();
                    } else {
                        swal("Error", "Something Went Wrong", "error");
                    }
                });
            });
        });

        $('#category_form').submit(function(e){
            e.preventDefault();
            $this = $(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'post',
                data: $(this).serialize()
            }).done(function(response, textStatus, jqXHR) {
                console.log(response);
                if (response.status) {
                    table.ajax.reload();
                    $this.trigger('reset');
                } else {
                    swal("Error", "Something Went Wrong", "error");
                }
            });
        })

    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>