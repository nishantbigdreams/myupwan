@extends('layouts.website_master')
@section('body_content')

<div class="global-wrapper clearfix" id="global-wrapper">
    <div class="gap"></div>
    <div class="container">
        <div class="payment-success-icon fa fa-check-circle-o"></div>
        <div class="payment-success-title-area">
            <h1 class="payment-success-title">Order has been placed.</h1>
            <p class="lead">
                you will receive order details shortly on your mail {{auth()->user()->email ?? ''}}.
            </p>
        </div>
        <div class="gap gap-small"></div>
        <div class="row row-col-gap">
            <div class="col-md-8">
                <h3 class="widget-title">Order Summary</h3>
                ORDER No.:{{$order->order_id}}
                <div class="box">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>QTY</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        @php
                        $product = json_decode($order->product_name);
                        $qty = json_decode($order->product_qty);
                        $price = json_decode($order->product_price);
                        @endphp
                        <tbody>
                            @for ($i=0; $i < count($product); $i++)
                            <tr>
                                <td>{{$product[$i]}}</td>
                                <td>{{$qty[$i]}}</td>
                                <td> <i class="fa fa-inr"></i> {{number_format($price[$i])}}</td>
                            </tr>
                            @endfor
                            <tr>
                                <td>Subtotal</td>
                                <td></td>
                                <td> <i class="fa fa-inr"></i> {{number_format($order->order_price)}} </td>
                            </tr>
                            <tr>
                                <td>Delivery Charge</td>
                                <td></td>
                                <td> <i class="fa fa-inr"></i> {{number_format($order->delevery_charge)}} </td>
                            </tr>
                            @if($order->bulk_purchase_discount)
                                <tr>
                                    <td>Bulk Purchase Discount</td>
                                    <td></td>
                                    <td> - <i class="fa fa-inr"></i> 
                                        {{number_format($order->bulk_purchase_discount)}}
                                    </td>
                                </tr>
                            @endif
                            @if($order->discount)
                                <tr>
                                    <td>1% Off on Neft Payment</td>
                                    <td></td>
                                    <td> - <i class="fa fa-inr"></i> 
                                        {{number_format($order->discount)}}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>
                                    Grand Total <br>
                                    <small>
                                        GST 18% Inclusive
                                    </small>
                                 </td>
                                <td></td>
                                <td><i class="fa fa-inr"></i> {{number_format($order->total + $order->delevery_charge)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <h3 class="widget-title" style="visibility: hidden;">.</h3>
                <div class="box">

                    <h4>
                        Manage Orders
                    </h4>

                    <a href="{{route('home')}}" class="btn btn-primary btn-block">
                        <i class="fa fa-list"></i> My Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="gap"></div>
</div>

@endsection
