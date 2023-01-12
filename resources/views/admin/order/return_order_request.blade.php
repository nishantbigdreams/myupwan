@extends('layouts.master')
@section('styles')
<style media="screen">
mark{background:#188ae2;color:#fff;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
@endsection
@section('page-content')
<div class="container-fluid">
    <h3> Requests For Cancel Order</h3>
    <div class="col-md-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-bordered" id="category_table">
                    <thead>
                        <tr>
                            <th>Sr.No </th>
                            <th>Customer Name </th>
                            <th>Order Amount</th>
                            <th>Reason</th>
                            <th>Bank</th>
                            <th>Account No</th>
                            <th>IFSC Code</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Is Product Received</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
<div id="returnOrderModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-custom">Return Order</h4>
    </div>
    <form action="" method="post" id="returnOrderForm">
        {{csrf_field()}}
        <input type="hidden" name="order_id" value="">
        <div class="modal-body">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" for="pickup_date">Pickup Date </label>
                        <input type="text" id="pickup_date" name="pickup_date" class="form-control input-sm pickup-date" placeholder="Pickup Date" required value="{{date('d-m-Y')}}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                       <label class="control-label" for="pickup_time">Pickup Time</label>
                       <input type="text" id="pickup_time" name="pickup_time" class="form-control input-sm pickup-time" placeholder="Pickup Time" required>
                   </div>
               </div>
           </div>

           <div class="form-group">
            <label class="control-label" for="Remark">Remark</label>
            <textarea name="remark" id="Remark" class="form-control" placeholder="Remark if any"></textarea>
        </div>
        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-custom">Register Return Order</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>
</div>

</div>
</div>

<div id="productReceivedModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-custom">Product Received</h4>
    </div>
    <form action="" method="post" id="product_received_form">
        {{csrf_field()}}
        <input type="hidden" name="received_order_id" value="">
        <div class="modal-body">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" for="pickup_date">Received Date </label>
                        <input type="text" id="pickup_date" name="received_date" class="form-control input-sm pickup-date" placeholder="Product Received date" required value="{{date('d-m-Y')}}">
                    </div>
                </div>
                
           </div>

           <div class="form-group">
            <label class="control-label" for="Remark">Remark</label>
            <textarea name="receive_remark" id="Remark" class="form-control" placeholder="Remark if any" required="required"></textarea>
        </div>
        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-custom">submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>
</div>

</div>
</div>

<div id="refundModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-custom">Refund Details</h4>
    </div>
    <form action="" method="post" id="refund_form">
        {{csrf_field()}}
        <input type="hidden" name="refund_order_id" value="">
        <div class="modal-body">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" for="refund_date">Refund Date </label>
                        <input type="text" id="pickup_date" name="refund_date" class="form-control input-sm pickup-date" placeholder="Refund date" required value="{{date('d-m-Y')}}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"  for="refund_mode">Refund mode</label>
                        <input type="text" name="refund_mode" class="form-control input-sm" placeholder="eg. cash,check,online" required="required">
                    </div>
                </div>
                
           </div>
           <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"  for="refund_amount">Refund amount</label>
                        <input type="number" name="refund_amount" class="form-control input-sm" placeholder="Refund Amount" required="required">
                    </div>
            </div>
            <div class="col-sm-6">
                
               <div class="form-group">
                <label class="control-label" for="Remark">Remark</label>
                <textarea name="refund_remark" id="Remark" class="form-control" placeholder="Remark if any" required="required"></textarea>
                </div>
            </div>
        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-custom">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>
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
                "processing": "Loading Return Orders..."
            },
            'mark':true,
            "ajax": {
                "url" : "{{route('admin.datatable.return_order_request.index')}}",
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

        // $(document).on('click','.delete', function(){
        //     let id = $(this).attr('id');
        //     swal({
        //         title: "Delete Order?",
        //         text: "These Order Deleted Permantly.",
        //         type: "info",
        //         showCancelButton: true,
        //         closeOnConfirm: false,
        //         showLoaderOnConfirm: true,
        //         confirmButtonText: 'Proceed',
        //     }, function () {
        //         $.ajax({
        //             url: '/admin/category/'+id,
        //             method: 'delete',
        //         }).done(function(data, textStatus, jqXHR) {
        //             if (data) {
        //                 console.log(data);
        //                 swal("Success", "Category deleted Successfully", "success")
        //                 table.ajax.reload();
        //             } else {
        //                 swal("Error", "Something Went Wrong", "error");
        //             }
        //         });
        //     });
        // });

        $(document).on('click','.return_order', function(){   
            let id = $(this).attr('data-id');
            $('input[type="hidden"][name="order_id"]').val(id);
            $('#returnOrderModal').modal('show');

        });

        $('#returnOrderForm').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '/admin/returnOrderRequest/'+$('input[name="order_id"]').val(),
                method: 'post',
                data : $("#returnOrderForm").serialize()
            }).done(function(data, textStatus, jqXHR) {
                if (data) {
                    $('#returnOrderModal').modal('hide');
                    $("#returnOrderForm").trigger( "reset" );
                    swal("Success", "Register Return Order Pickup  Successfully", "success")
                        table.ajax.reload();
                    } else {
                        swal("Error", "Something Went Wrong", "error");
                    }
                });    
        })
    });

    $('.pickup-date').datepicker({
        autoclose:true,
        todayHighlight:true,
        daysOfWeekDisabled: [0],
        startDate: new Date(),
        format: 'dd-mm-yyyy'
    });

    $('.pickup-time').timepicker({
        showMeridian:false,
        minuteStep:15,
        defaultTime:'15:00',
        maxHours: 18,
    }).on('changeTime.timepicker', function(e) {
        var h= e.time.hours;
        var m= e.time.minutes;
        // var mer= e.time.meridian;
        //convert hours into minutes
        m+=h*60;
        //10:15 = 9h*60m  = 540 min
        if(m<540)
            $('.pickup-time').timepicker('setTime', '15:00');
    });

$(document).on('click','.is_product_received', function(){   
            let id = $(this).attr('data-id');
            $('input[type="hidden"][name="received_order_id"]').val(id);
            $('#productReceivedModal').modal('show');

        });

        $('#product_received_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '/admin/product_received/'+$('input[name="received_order_id"]').val(),
                method: 'post',
                data : $("#product_received_form").serialize()
            }).done(function(data, textStatus, jqXHR) {
                if (data) {
                    $('#productReceivedModal').modal('hide');
                    $("#product_received_form").trigger( "reset" );
                    swal("Success", "Register Return Order Pickup  Successfully", "success")
                        table.ajax.reload();
                    } else {
                        swal("Error", "Something Went Wrong", "error");
                    }
                });    
        })


        $(document).on('click','.refund', function(){   
            let id = $(this).attr('data-id');
            $('input[type="hidden"][name="refund_order_id"]').val(id);
            $('#refundModal').modal('show');

        });

        $('#refund_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '/admin/refund/'+$('input[name="refund_order_id"]').val(),
                type: 'post',
                data : $("#refund_form").serialize()
            }).done(function(data, textStatus, jqXHR) {
                console.log(data);
                if (data) {
                    $('#refundModal').modal('hide');
                    $("#refund_form").trigger( "reset" );
                    swal("Success", "Refund Registered  Successfully", "success")
                        table.ajax.reload();
                    } else {
                        swal("Error", "Something Went Wrong", "error");
                    }
                });    
        })


</script>
@endpush
