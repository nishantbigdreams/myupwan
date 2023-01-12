@extends('layouts.master')
@section('styles')
<style media="screen">
mark{background:#188ae2;color:#fff;}
</style>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" /> --}}
@endsection
@section('page-content')
<br/>

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="text-custom">Offer Pages</h1>
                </div>
                <div class="col-md-3 col-md-offset-3">
                    <a href="{{ route('admin.add_special_page') }}" class="btn btn-custom btn-block">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>
            </div>
            <hr/>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="lived_listing">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Page Name</th>
                            <th>Page URL</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Combo</td>
                            <td>...</td>
                            <td>
                                <a href="{{ route('admin.edit_special_page') }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" title="Delete" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- calculator modal content -->
{{-- @include('admin.components.calculator_modal') --}}
@endsection

{{-- @push('page-script')
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
            "url" : "{{route('admin.datatable.live.listing')}}",
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
            "url" : "{{route('admin.datatable.archive.listing')}}",
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
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
            url: '{{route("admin.product.archive")}}',
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
            url: '{{route("admin.product.unarchive")}}',
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
        title: "Delete Product Permantely",
        text: "You wont be able to recover this.",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonText: 'Proceed',
    }, function () {
        $.ajax({
            url: '{{route("admin.product.delete")}}',
            method: 'POST',
            data: {product:id},
        }).done(function(data, textStatus, jqXHR) {
            if (data) {
                swal("Success", "Product Deleted Successfully", "success")
                archive_list.ajax.reload();
            } else {
                swal("Error", "Something Went Wrong", "error");
            }
        });
    });
})

</script>
@endpush --}}
