@extends('layouts.master')
@section('styles')
<style media="screen">
    mark{background:#188ae2;color:#fff;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
@endsection
@section('page-content')
<div class="container-fluid">
    <h3> Categories</h3>
    <div class="col-md-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-bordered" id="category_table">
                    <thead>
                        <tr>
                            <th>Sr.No </th>
                            <th>Name </th>
                            <th>SKU</th>
                            <th>products</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-script')
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
                "url" : "{{route('datatable.category.index')}}",
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
                text: "Product under this category might not be visible until new category is assigned.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Proceed',
            }, function () {
                $.ajax({
                    url: '/admin/category/'+id,
                    method: 'delete',
                }).done(function(data, textStatus, jqXHR) {
                    if (data) {
                        console.log(data);
                        swal("Success", "Category deleted Successfully", "success")
                        table.ajax.reload();
                    } else {
                        swal("Error", "Something Went Wrong", "error");
                    }
                });
            });
        });
    });
</script>
@endpush
