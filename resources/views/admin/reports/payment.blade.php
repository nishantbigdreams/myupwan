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

    <div class="col-md-6">
        <form id="filter_form">
            {{csrf_field()}}
            <div class="col-md-3">
                Filter Payments:
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control input-sm" name="date" placeholder="Select Date" required="" id="date">
            </div>
            <div class="col-md-4">
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
                <th>Invoice No</th>
                <th>Payment Date</th>
                <th>NEFT No</th>
                <th>Type</th>
                <th>Payment Amount</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>


@endsection

@section('page-scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript">
    let table;
    $(document).ready( function () {
        table =  $('.payments').DataTable({
            'language':{
                "loadingRecords": "&nbsp;",
                "processing": "Loading Payments..."
            },
            "ajax": {
                "url": "{{route('admin.payment.report.filter')}}",
                "type": 'post',
                // 'dataSrc':"",
            },
            'mark':true,
            "processing": true,
            'dom': 'Bfrtip',
            'buttons': [
                {
                    className: 'btn btn-info',
                    title: 'Payment Reports',
                    text: 'EXCEL',
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
            ]
        });
    });

    $('#date').datepicker({
        autoclose:true,
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months"
    }).datepicker("setDate",'now');

    $('#filter_form').submit(function(e){
        e.preventDefault();
        table.ajax.url("{{route('admin.payment.report.filter')}}/"+$('#date').val()).load();
    });
</script>
@endsection
