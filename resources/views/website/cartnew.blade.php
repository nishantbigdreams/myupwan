<?php
$total_price = 0.0;
$totalg_price = 0.0;
?>
@include('_partials.website.header')
<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    @include('_partials.website.nav')
            <!-- End Header -->
    <main class="main cart">
        <div class="page-content pt-7 pb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-simple title-step active"><a href="{{url('/cartnew')}}">1. Shopping Cart</a></h3>
                @if(Auth::user())
                    <h3 class="title title-simple title-step"><a href="{{url('checkout')}}">2. Checkout</a></h3>
                @else
                    <h3 class="title title-simple title-step"><a href="{{url('postLogin')}}">2. Checkout</a></h3>
                @endif
                <h3 class="title title-simple title-step"><a href="{{url('ordercomplete')}}">3. Order Complete</a></h3>
            </div>
            @if(\Cart::count() == 0)
                <div class="text-center">
                    <i class="fa fa-cart-arrow-down empty-cart-icon"></i>

                    <p class="lead" style="margin-bottom: 20px !important;">Your cart is empty</p>
                    <a class="btn btn-primary btn-lg" href="/">Start Shopping
                        <!-- <i class="fa fa-long-arrow-right"></i> -->
                    </a>
                </div>
                <div class="gap"></div>
            @else
                <div class="container mt-7 mb-2">
                    <form method="post" action="{{route('update.cart')}}">
                        {{csrf_field()}}
                    <div class="row">

                            <div class="col-lg-8 col-md-12 pr-lg-4">
                                <table class="shop-table cart-table">
                                    <thead>
                                    <tr>
                                        <th><span>Product</span></th>
                                        <th></th>
                                        <th><span>Price</span></th>
                                        <th><span>quantity</span></th>
                                        <th>Subtotal</th>
                                    </tr>
                                    </thead>
                                    @php (
                                    $i=1
                                    )
                                    @foreach(\Cart::content() as $item)
                                        @php(

                                                $total_price = $item->price * ((int)$item->qty)
                                                )@php(

                                            $totalg_price =  $totalg_price + ($item->price) * ((int)$item->qty)
                                            )
                                        <tbody>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <figure>
                                                    <a href="#">
                                                        <img src="{{ $item->options->image }}" width="100" height="100" alt="product">

                                                    </a>
                                                </figure>
                                            </td>
                                            <td class="product-name">
                                                <div class="product-name-section">
                                                    <a href="#">{{ $item->name }}</a>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount">₹ {{ $item->price }}</span>
                                            </td>
                                            <td class="product-quantity">
                                                {{--
                                                                                            {{csrf_field()}}
                                                --}}
                                                <input type="hidden" name="id[]" value="{{ $item->id}}">

                                                <div class="input-group">
                                                    <button type="button" class="quantity-minus d-icon-minus"></button>
                                                    <input class="quantity form-control" name="quantity[]" type="number" min="1" max="1000000" value="{{$item->qty}}">
                                                    <button type="button" class="quantity-plus d-icon-plus"></button>
                                                </div>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">₹ {{number_format($total_price)}}</span>
                                            </td>
                                            <td class="product-close custom-text-center">
                                                {{-- <form class="" action="{{ route('update.remove') }}" method="post">
                                                     {{csrf_field()}}--}}
                                                <input type="hidden" name="rowId" id="rowId" class="prowId" value="{{$item->rowId}}">
                                                <a class="btn btn-link btn-close removecartdata"  data-id="{{$item->rowId}}"><i class="fas fa-times"></i><span class="sr-only">Close</span>
                                                </a>
                                                {{--
                                                                                            </form>
                                                --}}
                                            </td>
                                        </tr>
                                        </tbody>
                                        @php($i++)
                                    @endforeach

                                </table>
                                <div class="cart-actions mb-6 pt-4">
                                    <a href="{{url('/')}}" class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4"><i class="d-icon-arrow-left"></i>Continue Shopping</a>

                                    <button type="submit" class="btn btn-outline btn-dark btn-md btn-rounded ">Update Cart</button>

                                </div>
                                <!--<div class="cart-coupon-box mb-8">
                                    <h4 class="title coupon-title text-uppercase ls-m">Coupon Discount</h4>
                                    <input type="text" name="coupon_code"
                                           class="input-text form-control text-grey ls-m mb-4" id="coupon_code" value=""
                                           placeholder="Enter coupon code here...">
                                    <button type="submit" class="btn btn-md btn-dark btn-rounded btn-outline">Apply
                                        Coupon
                                    </button>
                                </div>-->
                            </div>

                        <aside class="col-lg-4 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
                                <div class="summary mb-4">
                                    <h3 class="summary-title text-left">Cart Totals</h3>
                                    <table class="shipping">
                                        <tr class="summary-subtotal">
                                            <td>
                                                <h4 class="summary-subtitle">Subtotal</h4>
                                            </td>
                                            <td>
                                                <p class="summary-subtotal-price">₹ {{number_format($totalg_price)}}</p>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="total">
                                        <tr class="summary-subtotal">
                                            <td>
                                                <h4 class="summary-subtitle">Total</h4>
                                            </td>
                                            <td>
                                                <p class="summary-total-price ls-s">₹ {{number_format($totalg_price)}}</p>
                                            </td>
                                        </tr>
                                    </table>


                                    @if(Auth::user())
                                        <a href="{{url('/checkout')}}" class="btn btn-dark btn-rounded btn-checkout">Proceed to checkout</a>
                                    @else
                                        <a href="{{url('/postLogin')}}" class="btn btn-dark btn-rounded btn-checkout">Proceed to checkout</a>
                                    @endif
                                </div>
                            </div>
                        </aside>



                </div>
                    </form>
                </div>
            @endif


        </div>

    </main>
</div>
<!-- End Main -->
@include('_partials.website.footer')
<script>
    $(document).on('click', '.removecartdata', function () {
        $.ajax({
            url: "{{route('update.remove')}}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "rowId": $(this).data('id')
            },
            success: function (data) {
                location.reload();
            },
            error: function (request, textStatus, errorThrown) {

            }
        });
    });
</script>
</body>
@push('page-script')

@endpush