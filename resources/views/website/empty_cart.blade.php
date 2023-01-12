<?php
$delevery_total = 0.0;
$total_price = 0.0;
$shipping = 0;
?>
@include('_partials.website.header')
<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    @include('_partials.website.nav')
            <!-- End Header -->
    <main class="main checkout">
        <div class="page-content pt-7 pb-10 mb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-simple title-step"><a href="{{url('cartnew')}}">1. Shopping Cart</a></h3>

                <h3 class="title title-simple title-step active"><a href="{{url('checkout')}}">2. Checkout</a></h3>

                <h3 class="title title-simple title-step"><a href="{{url('ordercomplete')}}">3. Order Complete</a></h3>
            </div>
            <div class="container mt-7">
                <div class="text-center">
                    <i class="fa fa-cart-arrow-down empty-cart-icon"></i>

                    <p class="lead" style="margin-bottom: 20px !important;">Your cart is empty</p>
                    <a class="btn btn-primary btn-lg" href="/">Start Shopping
                        <!-- <i class="fa fa-long-arrow-right"></i> -->
                    </a>
                </div>
                <div class="gap"></div>
            </div>


        </div>
    </main>
</div>

@include('_partials.website.footer')



