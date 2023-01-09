
<?php $__env->startSection('styles'); ?>
    <style media="screen">
        mark {
            background: #188ae2;
            color: #fff;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-content'); ?>
    <div class="container-fluid">
        <h3> Categories</h3>

        <div class="col-md-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-bordered" id="product_attribute">
                        <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>product Name</th>
                            <th>product Attribute</th>
                            <th>Text</th>
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
    $(function () {
        table = $('#product_attribute').DataTable({
            'language': {
                "loadingRecords": "&nbsp;",
                "processing": "Loading Categories..."
            },
            'mark': true,
            "ajax": {
                "url": "<?php echo e(route('datatable.productattribute.index')); ?>",
                "type": "POST",
                'data': function (d) {
                }
            },
            "processing": true,
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": [0]
            }]
        });
        table.on('order.dt search.dt', function () {
            table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $(document).on('click', '.delete', function () {
            let id = $(this).attr('id');
            console.log(id);

            swal({
                title: "Delete Product attribute Permantely",
                text: "You wont be able to recover this.",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Proceed',
            }, function () {
                $.ajax({
                    url: '<?php echo e(route("productattribute.delete")); ?>',
                    method: 'POST',
                    data: {id: id},
                }).done(function (data, textStatus, jqXHR) {
                    console.log(data);
                    if (data) {
                        swal("Success", "Product attribute Deleted Successfully", "success")

                        location.reload();


                    } else {
                        swal("Error", "Something Went Wrong", "error");
                        location.reload();

                    }
                });
            });
        })
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>