@include('_partials.website.header')
<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    @include('_partials.website.nav')
            <!-- End Header -->
    <main class="main order">
        <div class="page-content pt-7 pb-10 mb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-simple title-step "><a href="{{url('/cartnew')}}">1. Shopping Cart</a></h3>
                @if(Auth::user())
                    <h3 class="title title-simple title-step"><a href="{{url('checkout')}}">2. Checkout</a></h3>
                @else
                    <h3 class="title title-simple title-step"><a href="{{url('postLogin')}}">2. Checkout</a></h3>
                @endif
                <h3 class="title title-simple title-step active"><a href="{{url('ordercomplete')}}">3. Order
                        Complete</a></h3>
            </div>
            @if(sizeof($orderdetail) == 0)
            <div class="container mt-8">
                <div class="text-center">
                    <i class="fa fa-cart-arrow-down empty-cart-icon"></i>

                    <p class="lead" style="margin-bottom: 20px !important;">No Order Exist</p>
                    <a class="btn btn-primary btn-lg" href="/">Start Shopping
                        <!-- <i class="fa fa-long-arrow-right"></i> -->
                    </a>
                </div>
                <div class="gap"></div>
            </div>
            @else
                <div class="container mt-8">
                    <div class="order-results">
                        <div class="overview-item">
                            <span>Order number:</span>
                            <strong>{{$orderdetail[0]->order_id}}</strong>
                        </div>
                        <div class="overview-item">
                            <span>Status:</span>
                            <strong>{{$orderdetail[0]->status}}</strong>
                        </div>
                        <div class="overview-item">
                            <span>Delivery Time:</span>
                            <strong>{{$orderdetail[0]->delivery_time}}</strong>
                        </div>
                        <div class="overview-item">
                            <span>Email:</span>
                            <strong>{{auth::user()->email}}</strong>
                        </div>
                        @php
                        $product = json_decode($orderdetail[0]->product_name);
                        $qty = json_decode($orderdetail[0]->product_qty);
                        $price = json_decode($orderdetail[0]->product_price);
                        $tot = 0;
                        @endphp
                        @for ($i=0; $i < count($product); $i++)
                            @php
                            $tot+=($qty[$i] ?? 1) * ($price[$i] ?? 1);
                            @endphp
                        @endfor
                        <div class="overview-item">
                            <span>Total:</span>
                            <strong>₹ {{number_format($tot + $orderdetail[0]->delevery_charge)}}</strong>
                        </div>
                        <div class="overview-item">
                            <span>Payment method:</span>
                            <?php
                            $paymenttype='';
                            if($orderdetail[0]->payment->method == 'cod'){
                                $paymenttype= "Cash on delivery";
                            }
                            if($orderdetail[0]->payment->method == 'online'){
                                $paymenttype= "Online mode";
                            }
                            ?>
                            <strong>{{$paymenttype}}</strong>
                        </div>
                    </div>

                    <h2 class="title title-simple text-left pt-4 font-weight-bold text-uppercase">Order Details</h2>

                    <div class="order-details">
                        <table class="order-details-table">
                            <thead>
                            <tr class="summary-subtotal">
                                <td>
                                    <h3 class="summary-subtitle">Product</h3>
                                </td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $product = json_decode($orderdetail[0]->product_name);
                            $qty = json_decode($orderdetail[0]->product_qty);
                            $price = json_decode($orderdetail[0]->product_price);
                            $tot = 0;

                            @endphp
                            @for ($i=0; $i < count($product); $i++)
                                @php
                                $tot+=($qty[$i] ?? 1) * ($price[$i] ?? 1);
                                @endphp
                                <tr>
                                    <td class="product-name">{{$product[$i]}}<span> <i class="fas fa-times"></i>
                                            {{$qty[$i]}}</span></td>
                                    <td class="product-price">₹ {{number_format($price[$i])}}</td>
                                </tr>
                            @endfor


                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Subtotal:</h4>
                                </td>
                                <td class="summary-subtotal-price">₹ {{number_format($tot)}}</td>
                            </tr>
                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Delivery Charge(Free Delivery If order value more than
                                        499)</h4>
                                </td>
                                <td class="summary-subtotal-price">
                                    ₹ {{number_format($orderdetail[0]->delevery_charge)}}</td>
                            </tr>
                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Payment method:</h4>
                                </td>
                                <td class="summary-subtotal-price">{{$orderdetail[0]->payment->method}}</td>
                            </tr>
                            @if($orderdetail[0]->discount)
                                <tr>
                                    <td>1% Off on Neft Payment</td>
                                    <td></td>
                                    <td> - <i class="fa fa-inr"></i>
                                        {{number_format($orderdetail[0]->discount)}}
                                    </td>
                                </tr>
                            @endif
                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Total:</h4>
                                </td>
                                <td>
                                    <p class="summary-total-price">
                                        ₹ {{number_format($tot + $orderdetail[0]->delevery_charge)}}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h2 class="title title-simple text-left pt-10 mb-2">Billing Address</h2>

                    <div class="address-info pb-8 mb-6">
                        <p class="address-detail pb-2">
                            {{auth::user()->name}}<br>
                            {{$orderdetail[0]->address_line_0}}<br>
                            {{$orderdetail[0]->address_line_1}}<br>
                            {{$orderdetail[0]->city}},{{$orderdetail[0]->state}}<br>
                            {{$orderdetail[0]->pincode}}
                        </p>

                        <p class="email">info@myupavan.com</p>
                    </div>

                    <a href="{{url('cartnew')}}" class="btn btn-icon-left btn-dark btn-back btn-rounded btn-md mb-4"><i
                                class="d-icon-arrow-left"></i> Back to List</a>
                </div>
            @endif

        </div>

    </main>
</div>
<!-- End Main -->
@include('_partials.website.footer')
</body>
