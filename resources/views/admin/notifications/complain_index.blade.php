@extends('layouts.master')
@section('styles')
<style media="screen">
    mark{background:#188ae2;color:#fff;}
</style>
@endsection
@section('page-content')
    <div class="card-box">
        <h4>Notifications</h4>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="complain_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Order No</th>
                        <th>Invoice #</th>
                        <th>Order Status</th>
                        <th>Complain Type</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div id="message" class="modal fade calculator" tabindex="-1" role="dialog" aria-labelledby="message" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-uppercase" id="message_title">Message</h4>
                </div>
                <div class="modal-body">
                    <p id="complain_message">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                        <i class="fa fa-times"></i> CLOSE
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <script type="text/javascript">
    let table;
    $(function(){
        table = $('#complain_table').DataTable({
            'language':{
                "loadingRecords": "&nbsp;",
                "processing": "Loading Complains..."
            },
            'mark':true,
            "ajax": {
                "url" : "{{route('admin.datatable.complains.index')}}",
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

        $message = $('#complain_message');
        $title = $('#message_title');
        $(document).on('click', '.view-message', function(){
            $title.html($(this).data('title'));
            if ($(this).data('message')) {
                $message.html($(this).data('message'));
            } else {
                $message.html("No Complain Message");
            }
        });

        $(document).on('click', '.status', function(){
            let id = $(this).attr('id');
            $(this).prepend('<i class="fa fa-spinner fa-spin"></i>')
            $.ajax({
                url : '{{route("admin.complain.status.update")}}',
                method : 'POST',
                data : {complain : id},
                success : function(data){
                    console.log(data);
                    if (data) {
                        table.ajax.reload();
                    }
                }
            })
        });
    });
    </script>
@endpush
