@extends('layouts.master')
@section('page-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
@endsection
@section('page-content')
<br>
<div class="row">
    <div class="col-md-3 hidden">
        <div class="card-box">
            <h4>Filter</h4>
            <hr>
            <h5>FULFILMENT TYPE</h5>
            <select class="form-control">
                <option>All</option>
                <option>Satandard</option>
                <option>Self Ship</option>
                <option>Smart Fullfilment</option>
            </select>

            <hr>
            <h5>PRE CANCELLATION STATUS</h5>
            <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                <input id="action-checkbox" type="checkbox">
                <label for="action-checkbox">Packed</label>
            </div>
            <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                <input id="action-checkbox" type="checkbox">
                <label for="action-checkbox">Ready to Dispatched</label>
            </div>
            <hr>
            <h5>CANCELLETION TYPE</h5>
            <select class="form-control">
                <option>All</option>
                <option>Cancelled by buyer</option>
                <option>Cancelled by seller</option>
                <option>Cancelled by market place</option>
            </select>
            <hr>
            <h5>SELLER CANCELLATION</h5>
            <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                <input id="action-checkbox" type="checkbox">
                <label for="action-checkbox">Self</label>
            </div>
            <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                <input id="action-checkbox" type="checkbox">
                <label for="action-checkbox">RTS breach</label>
            </div>
            <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                <input id="action-checkbox" type="checkbox">
                <label for="action-checkbox">Reattempt Breach</label>
            </div>
            <hr>
            <h5>ORDER CANCELLATION</h5>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="" name="dates">
            </div>
            <hr>
            <h5>ORDER APPROVAL</h5>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="" name="dates">
            </div>
            <hr>
            <h5>SPECIAL FILTERS</h5>
            <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                <input id="action-checkbox" type="checkbox">
                <label for="action-checkbox">Courier Returns</label>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card-box">
            @if(count($orders) == 0)
                <span class="text-info">No orders Found.</span>
            @endif
            @foreach ($orders as $key => $order)
            @php
            $products_img = json_decode($order->product_image);
            $products_name = json_decode($order->product_name);
            $products_qty = json_decode($order->product_qty);
            $products_sku = json_decode($order->product_sku);
            @endphp
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            Order Placed on:
                            <strong>{{date('M d, Y', strtotime($order->created_at))}}</strong>
                        </div>
                        <div class="col-md-6 text-capitalize">
                            <!-- Buyer -->
                   Restaurant Name: Buyer : {{$order->user->name ?? $order->contact_person}}, {{$order->user->phone ?? $order->contact_number}}<br>

                            Payment Id : {{isset($order->payment)? $order->payment->rp_payment_id:''}}

                        </div>
                        <div class="col-md-12">
                            @if($order->status == 'cancelled')
                                Cancel Reason: {{$order->cancelled_reason}}
                            @elseif($order->status == 'delivered')
                                Delivered on: {{date('M d, Y', strtotime($order->delivery_date))}}
                            @endif
                        </div>
                    </div>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered" border="0">
                            <tr>
                                <th colspan="2">ORDER DETAIL # {{$order->id}}</th>
                                <th colspan="2">PRICE & QTY</th>
                            </tr>

                            @for ($index = 0; $index < count($products_sku); $index++)
                            <tr>
                                <td>Item Name</td>
                                <td>{{$products_name[$index] ?? ''}}</td>
                                <td>Quantity</td>
                                <td>{{$products_qty[$index] ?? ''}} Unit</td>
                            </tr>

                            <tr>
                                <td>SKU</td>
                                <td>{{$products_sku[$index] ?? ''}}</td>
                            </tr>
                            @endfor

                        </table>
                    </div>
                    <div class="btn-group m-b-10">
                        <a href="{{route('admin.order.show', $order)}}" class="btn btn-custom w-lg">
                         <i class="fa fa-eye"></i> View Details
                     </a>
                 </div>
                 @if($order->status == 'cancelled' && isset($order->payment) && $order->payment->method == 'online')

                 <div class="btn-group m-b-10">
                        <a href="javascript:;" class="btn btn-custom w-lg refund" data-id="{{$order->id}}">
                         <i class="fa fa-money"></i> Refund
                     </a>
             </div>
             @endif
             @if($order->status == 'refund')
                    <label class="text-success">Refunded</label>
             @endif

         </div>
         <hr/>
         @endforeach
     </div>
 </div>
</div>

@endsection

@section('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript">

    $('input[name="dates"]').daterangepicker();

            $(document).on('click','.refund', function(){
            let id = $(this).attr('data-id');
            swal({
                title: "Refund Payment?",
                text: "Payment will be refunded within 5/7 days",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Proceed',
            }, function () {
                $.ajax({
                    url: '/admin/refund_on_cancel/'+id,
                    type:'post',
                   
                }).done(function(data, textStatus, jqXHR) {
                    if (data.success) {
                        swal("Success", "Payment Successfully Refunded within 5/7 days", "success")
                        table.ajax.reload();
                    } else {
                        swal("Error", "Something Went Wrong", "error");
                    }
                });
            });
        });


</script>
@endsection
