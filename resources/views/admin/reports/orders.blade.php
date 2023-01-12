@extends('layouts.master')
@section('styles')
    <style media="screen">
    mark{background:#188ae2;color:#fff;}
    .panel{
        border: initial;
    }
    .panel-heading {
        padding: 5px;
    }
    .panel .panel-body {
        padding: 10px;
    }
</style>
@endsection
@section('page-content')

    <br>
    <br>

    <div class="col-md-8">
        <form id="filter_form">
            {{csrf_field()}}
            <div class="col-md-10">
                <div class="col-md-2">
                    Filter:
                </div>
                <div class="col-md-10">
                    <div class="col-md-4">
                        <input type="text" class="form-control input-sm date" name="start" placeholder="Start Date">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control input-sm date" name="end" placeholder="End Date">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control input-sm status_select" name="status">
                            <option value="" selected="">ALL</option>
                            <option value="processing">Processing</option>
                            <option value="packed">Packed</option>
                            <option value="in_transit">In Transit</option>
                            <option value="registered">Registered</option>
                            <option value="delivered">Delivered</option>
                            <option value="Redirected">Redirected</option>
                            <option value="Undelivered">Undelivered</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-block btn-sm">
                    <i class="fa fa-filter"></i> FILTER
                </button>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
    <br>
    <table class="table payments">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Invoice #</th>
                <th>Amount</th>
                <th>Order #</th>
                <th>Status</th>
            </tr>
        </thead>
        <tfoot>
            <td colspan="4"></td>
            <td></td>
            <td colspan="2"></td>
        </tfoot>
    </table>


@endsection

@section('page-scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.19/api/sum().js"> </script>
    <script type="text/javascript">
    let table;

    $(document).ready( function () {
        table =  $('.payments').DataTable({
            'language':{
                "loadingRecords": "&nbsp;",
                "processing": "Loading Report..."
            },
            "ajax": {
                "url": "{{route('admin.order.report.filter')}}",
                "type": 'post',
                "data": function(d){
                    d.start = $('input[name=start]').val()
                    d.end = $('input[name=end]').val()
                    d.status = $('.status_select').val()
                }
            },
            'mark':true,
            "processing": true,
            'dom': 'Bfrtip',
            'buttons': [
                {
                    className: 'btn btn-info',
                    title: 'Order Reports',
                    text: 'EXCEL',
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [1,2,3,4,5,6]
                    }
                }
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                    i : 0;
                };

                // Total over all pages
                total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Total over this page
                pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Update footer
                $( api.column( 4 ).footer() ).html(
                    '&#8377; '+pageTotal +' ( &#8377; '+ total +' total )'
                );
            }

        });
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });



    $('input[name=start]').datepicker({
        autoclose:true,
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
    }).datepicker("setDate",'now');

    $('input[name=end]').datepicker({
        autoclose:true,
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months"
    }).datepicker("setDate",'now');

    $('#filter_form').submit(function(e){
        e.preventDefault();
        table.ajax.reload();
    });
    </script>
@endsection
