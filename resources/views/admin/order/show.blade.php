@extends('layouts.master')

@section('page-content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="pull-left text-uppercase">
                            <h3>{{$order->user->name ?? $order->contact_person}} </h3>
                        </div>
                        <div class="pull-right">
                            <a href="{{route('admin.invoice.pdf', $order)}}" target="_blank" class="btn-primary btn btn-sm">
                                <i class="fa fa-file-pdf-o"></i> Print Pdf
                            </a>
                            <h4 class="text-uppercase">Invoice # {{$order->payment->invoice_no}} <br>
                                {{-- <strong>{{date('d M, Y', strtotime($order->created_at))}}</strong> --}}
                            </h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left m-t-30">
                                <address>
                                    <strong>Delivery Address,</strong><br>
                                    {{$order->address_line_0}},<br>
                                    {{$order->address_line_1}},<br>
                                    @if($order->address_line_2)
                                        {{$order->address_line_2}},<br>
                                    @endif
                                    {{$order->city}}, {{$order->pincode}},<br>
                                    {{$order->state}}<br>
                                </address>
                            </div>
                            <div class="pull-right m-t-30">
                                <p><strong>Order Date: </strong> {{date('M d, Y', strtotime($order->created_at))}}</p>

                                <p><strong>Delivery Time: </strong> {{$order->delivery_time}}</p>

                                <p><strong>Order Status: </strong>
                                <span class="label label-danger text-uppercase">
                                    {{str_replace('_',' ', $order->status)}}
                                </span>
                                </p>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="m-h-50"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table m-t-30">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Unit Cost</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $products = json_decode($order->product_name);
                                    $qty = json_decode($order->product_qty);
                                    $price = json_decode($order->product_price);
                                    $tot = 0;
                                    ?>

                                    @for($i = 0; $i < count($products); $i++)
                                        @php
                                        $tot+=($qty[$i] ?? 1) * ($price[$i] ?? 1);
                                        @endphp
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{$products[$i]}}</td>
                                            <td>{{$qty[$i] ?? 1}}</td>
                                            <td>&#8377; {{$price[$i] ?? ''}}</td>
                                            <td>&#8377; {{ ($qty[$i] ?? 1) * ($price[$i] ?? 1) }}</td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="clearfix m-t-40">
                                <h5 class="small text-inverse font-600">PAYMENT METHOD </h5>
                                <small class="text-uppercase">
                                    {{$order->payment->method}}
                                    @if($order->payment->method == 'neft')
                                        -UTR NO. {{$order->payment->utr_no}}
                                    @endif
                                </small>
                                <p class="text-success">
                                    <b>GST (18%) is included:</b>
                                    <!--  &#8377; -->
                                    {{-- number_format($order->gstAmount())--}}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                            <p class="text-right">
                                <b>
                                 @if($order->coupen_apply==1)

@else
                                SUB-TOTAL:

@endif
                            </b> 
                                 @if($order->coupen_apply==1)
                                 @else

                              &#8377;  {{number_format($tot)}}
                                @endif
                            </p>

                            <p class="text-right">
                                <b>
 @if($order->coupen_apply==1)
                             Coupon Code Applied
                            @else

                                    Delivery Charge:


                            @endif




                                </b> &#8377;

                                 @if($order->coupen_apply==1)
                                  {{$order->coupon_value}}
                            @else

                                {{number_format($order->delevery_charge)}}


                            @endif

                            </p>

                            @if($order->bulk_purchase_discount)
                                <p class="text-right">
                                    <b>Bulk Purchase Discount:</b> &#8377;
                                    - {{number_format($order->bulk_purchase_discount)}}
                                </p>
                            @endif
                            @if($order->discount)
                                <p class="text-right">1% Off on NEFT Payment: &#8377;
                                    {{$order->discount}}</p>
                                <hr>
                            @endif
                            <h4 class="text-right">
                                Grand Total: &#8377; 
                                                        @if($order->coupen_apply==1)

                                                        {{0}}
                            @else

                                {{number_format($tot + $order->delevery_charge)}}
                                                            @endif

                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
