<div class="req-sv-wrap" style="padding-left: 0px;
    padding-right: 0px;">
    <img src="/website/img/restaurant.jpg" style="width:100%; height:150px;">
                <span class="car">             
                </span>
</div>
<?php
$cart_price = [];
$cartArrayRevese = Cart::instance('cart')->content();

foreach ($cartArrayRevese as $key => $cart) {
    $combo_qty = $cart->options->combo_qty ?? [0];
    $combo_dis = $cart->options->combo_discount ?? [0];

    $discount_rate = combo_discount($combo_qty, $combo_dis, $cart->qty);

    $price = $cart->price * $cart->qty - $cart->price * $cart->qty * ($discount_rate / 100);
    array_push($cart_price, round($price));
}
session(['user.cart.total' => array_sum($cart_price)]);
$noOfItems = Cart::instance('cart')->content()->count();
$total_price = 0;
?>
<button title="Close (Esc)" type="button" class="mfp-close" style="color: #000;">×</button>
@if(\Cart::instance('cart')->count() == 0)
    <div class="text-center">
        <i class="fa fa-cart-arrow-down empty-cart-icon"></i>

        <p class="lead" style="margin-bottom: 20px !important;">Your cart is empty</p>
        <a class="btn btn-primary btn-lg" href="/">Start Shopping
        </a>
    </div>
@else

    <div class="cd-cart-items">

        @foreach(\Cart::instance('cart')->content() as $product)
            <?php
            $total_price += $product->price * $product->qty;
            ?>
            <div class="cardmain">
                <div class="col-xs-2 col-md-2">
        <span class="cd-qty">
          <img src="{{ $product->options->image }}" alt="{{$product->name}}" title="{{$product->name}}"/>
        </span>
                </div>
                <div class="col-xs-8 col-md-8" style="text-align: center;">
                    <span class="pname">{{$product->name}}</span>

                    <div class="pt12">
                        <div class="value-button " id="decrease-{{$product->id}}" data="{{$product->id}}" value="Decrease Value">-</div>
                        <input type="number" id="number" class="number number-{{$product->id}} qty" name="quantity" min="1" max="100" value="{{$product->qty}}" data-rowId="{{$product->rowId}}" readonly="">

                        <div class="value-button " id="increase-{{$product->id}}" data="{{$product->id}}" value="Increase Value">+</div>
                        <ul class="Editarde">
                            <li class="fa fa-trash table-shopping-remove remove hide " href="javascript:void(0);" deleteid="{{$product->id}}" data-rowId="{{$product->rowId}}"> Delete</li>
                            <li id="itemedit-{{$product->id}}" data="{{$product->id}}" class="hide"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</li>
                        </ul>


                    </div>
                </div>
                <div class="col-xs-2 col-md-2">
                    <input type="hidden" name="per-product" id="per-product-{{$product->id}}" value="{{$product->price}}">

                    <div class="cd-price"><i class="fa fa-inr" aria-hidden="true"></i> <span id="item-price-{{$product->id}}">{{$product->price * $product->qty}}</span></div>

                </div>
            </div> <!-- cd-cart-items -->
        @endforeach
    </div>
    <div class="col-md-12 cardmain1">

        <div class="cd-cart-total">
            <p>Total Products <span id="totalcountproduct">{{\Cart::instance('cart')->content()->count()}}</span></p>
        </div>
        <!-- cd-cart-total -->

        <div class="cd-cart-total">
            {{--$total_price--}}
            <p>Total <span id="cart-total">{{cart_grand_total()}}</span></p>
        </div>
        <!-- cd-cart-total -->

        @if(Auth::user())
            <a class="btn btn-success checkout-btn" href="{{route('confirm_order')}}">
                Checkout
            </a>
        @else
            <a href="javascript:void(0);" id="login-dialog-checkout" onclick="open_login()" class="btn mobby popup-text checkout-btn">
                Checkout
            </a>
            @endif
                    <!-- <p class="cd-go-to-cart"><a href="#0">Continue Shopping</a></p> -->
        @endif
    </div>