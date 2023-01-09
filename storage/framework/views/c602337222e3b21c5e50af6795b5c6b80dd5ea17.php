<?php $__env->startSection('styles'); ?>
    <style media="screen">
    mark{background:#188ae2;color:#fff;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-content'); ?>
    <br/>
    <div class="row">
        <div class="col-md-3">
            <div class="card-box">
                <h4>Listing Filter</h4>
                <hr>
                <form class="" action="index.html" method="post" id="filter_listing">
                    <?php echo e(csrf_field()); ?>

                    <h5>Category</h5>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                            <input id="<?php echo e($category->id); ?>" type="checkbox" name="category" value="<?php echo e($category->name); ?>">
                            <label for="<?php echo e($category->id); ?>">
                                <?php echo e(strtoupper($category->name)); ?>

                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <hr>
                    <h5>Stock Level</h5>
                    <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                        <input id="out_of_stock" type="checkbox" name="stock_level" value="0">
                        <label for="out_of_stock">Out of Stock</label>
                    </div>
                    <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                        <input id="less" type="checkbox" name="stock_level" value="less_than_5">
                        <label for="less">Less Than 5</label>
                    </div>
                    <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                        <input id="more" type="checkbox" name="stock_level" value="more_than_5">
                        <label for="more">5 or More</label>
                    </div>
                    or, Enter Stock Count
                    <br/>
                    <div class="row">
                        <div class="">
                            <label class="col-md-2 control-label">from</label>
                            <div class="col-md-4">
                                <input type="number" class="form-control input-sm" min="0" placeholder="10" name="stock_from">
                            </div>
                            <label class="col-md-2 control-label">to</label>
                            <div class="col-md-4">
                                <input type="number" class="form-control input-sm" min="0" placeholder="90" name="stock_to">
                            </div>
                        </div>
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-block btn-sm">
                        <i class="fa fa-filter"></i> FILTER
                    </button>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#live" data-toggle="tab" aria-expanded="true" id="live_list_count">
                        Lived
                    </a>
                </li>
                <li class="">
                    <a href="#archived" data-toggle="tab" aria-expanded="false" id="archive_list_count">
                        Archived
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="live">
                    <div class="table-responsive">
                        <table class="table mails table-bordered table-hover" id="lived_listing">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Details</th>
                                    <th>Units in Stock</th>
                                    <th>Selling Price</th>
                                    <th style="width: 15%;">Action </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="archived">
                    <div class="table-responsive">
                        <table class="table mails table-bordered table-hover" id="archive_listing" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- calculator modal content -->
    <?php echo $__env->make('admin.components.calculator_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-script'); ?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <script type="text/javascript">

    var b = $(".dataTable");
        b.DataTable({
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>><'table-responsive'tr><'row'<'col-sm-12'p>>",
            language: {
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                },
                search: "_INPUT_",
                searchPlaceholder: "Search…"
            },
            pagingType: "full_numbers",
            // order: [
            //     [2, "desc"]
            // ]
        });
        
    let lived_list = $('#lived_listing').DataTable({
        'language':{
            "loadingRecords": "&nbsp;",
            "processing": "Loading Lived Listing"
        },
        'mark':true,
        "ajax": {
            "url" : "<?php echo e(url('admin/datatable/live/listing')); ?>",
            "type" : "POST",
            "data" : function(d){
                d.data = $('#filter_listing').serialize()
            }
        },
        "processing": true,
        "pageLength": 100,
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0,1]
        }]
    });
    lived_list.on( 'order.dt search.dt', function () {
        lived_list.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
    lived_list.on('draw.dt', function(){
        $('#live_list_count').html('Live (' + lived_list.page.info().recordsTotal +' )');
    });

    let archive_list = $('#archive_listing').DataTable({
        'language':{
            "loadingRecords": "&nbsp;",
            "processing": "Loading Archive Listing"
        },
        'mark':true,
        "ajax": {
            "url" : "<?php echo e(url('admin/datatable/archive/listing')); ?>",
            "type" : "POST",
            "data" : function(d){
                d.data = $('#filter_listing').serialize()
            }
        },
        "processing": true,
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0,1]
        }]
    });
    archive_list.on( 'order.dt search.dt', function () {
        archive_list.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
    archive_list.on('draw.dt', function(){
        $('#archive_list_count').html('Archive (' + archive_list.page.info().recordsTotal +' )');
    });
</script>

<script type="text/javascript">
$(document).on('click', '.edit', function(){
    $td = $(this).closest('td');
    let product = $(this).attr('id');
    let type = $(this).data('type');
    let old_value = $td.find('span').html();
    let update_stock_form =
    `<form method="post" action="/admin/update/product/${product}">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <input type="hidden" class="old" value="`+old_value+`">
    <input type="hidden" class="product" value="`+product+`">
    <input type="hidden" class="type" name="type" value="`+type+`">
    <input class="form-control input-sm" style="width:50%" placeholder="New Stock" value="`+old_value+`" name="value">
    <button type="submit" class="btn btn-success btn-xs submit">
    <i class="fa fa-check"></i>
    </button>
    <button type="button" class="btn btn-danger btn-xs reset">
    <i class="fa fa-times"></i>
    </button>
    </form>`;
    $td.html(update_stock_form);
});

$(document).on('click', '.reset', function(){
    let original_value = $(this).closest('form').find('.old').val();
    let product = $(this).closest('form').find('.product').val();
    let type = $(this).closest('form').find('.type').val();

    let td_str = `<span>`+original_value+`</span>
    <a href='javascript:;' class='text-primary edit' id='`+product+`' data-type="`+type+`">
    <i class='ti ti-pencil'></i>
    </a>`;
    $(this).closest('td').html(td_str);
});

$(document).on('click','.submit', function(e){
    e.preventDefault();
    $td = $(this).closest('td');
    $form = $(this).closest('form');
    let new_value = $form.find('[name=value]').val();
    let type = $form.find('[name=type]').val();
    let product = $form.find('.product').val();

    $.ajax({
        url: $form.attr('action'),
        method: 'POST',
        data: $form.serialize(),
        headers: {"Accept": "Application/json"},
    }).done(function(data, textStatus, jqXHR) {
        let td_str = `<span>`+new_value+`</span>
        <a href='javascript:;' class='text-primary edit' id='`+product+`' data-type="`+type+`">
        <i class='ti ti-pencil'></i>
        </a>`;
        $td.html(td_str);
    });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).on('click', '.archive', function(){
    let id = $(this).attr('id');
    swal({
        title: "Archive Product",
        text: "Product wont be visible to users",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonText: 'Proceed',
    }, function () {
        $.ajax({
            url: '<?php echo e(url("admin/archive/product")); ?>',
            method: 'POST',
            data: {product:id},
        }).done(function(data, textStatus, jqXHR) {
            if (data == 'success') {
                swal("Success", "Product Archive Successfully", "success")
                archive_list.ajax.reload();
                lived_list.ajax.reload();
            } else {
                swal("Error", "Something Went Wrong", "error");
            }
        });
    });
});
$(document).on('click', '.undo_archive', function(){
    let id = $(this).attr('id');
    swal({
        title: "Un Archive Product",
        text: "Are you sure?",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonText: 'Proceed',
    }, function () {
        $.ajax({
            url: '<?php echo e(url("admin/unarchive/product")); ?>',
            method: 'POST',
            data: {product:id},
        }).done(function(data, textStatus, jqXHR) {
            if (data == 'success') {
                swal("Success", "Product Un Archive Successfully", "success")
                archive_list.ajax.reload();
                lived_list.ajax.reload();
            } else {
                swal("Error", "Something Went Wrong", "error");
            }
        });
    });
});

$('#filter_listing').submit(function(e){
    e.preventDefault();
    lived_list.ajax.reload();
    // archive_list.ajax.reload();
});

$(document).on('click', '.delete', function(){
    let id = $(this).attr('id');
    swal({
        title: "Delete Product MasterAttribute Permantely",
        text: "You wont be able to recover this.",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonText: 'Proceed',
    }, function () {
        $.ajax({
            url: '<?php echo e(url("admin/product/delete")); ?>',
            method: 'POST',
            data: {product:id},
        }).done(function(data, textStatus, jqXHR) {
            if (data) {
                swal("Success", "Product MasterAttribute Deleted Successfully", "success")
                archive_list.ajax.reload();
            } else {
                swal("Error", "Something Went Wrong", "error");
            }
        });
    });
})

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>