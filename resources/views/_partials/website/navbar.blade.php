<?php
  use Gloudemans\Shoppingcart\Facades\Cart;
?>
<style type="text/css">     
  .active-pink-2 input[type=text]:focus:not([readonly]) {
    border-bottom: 1px solid #f48fb1;
    box-shadow: 0 1px 0 0 #f48fb1;
  }

  .fa-heart-o:before
  {
    content: "\f08a";
    font-size: 20px !important;
  }

  .maintime p{
    text-align: center;
    font-size: 15px;
    margin-top: 10px;
    color: #000;
    font-weight: bold;
  }
  .sign p{
    text-align: center; 
    font-size: 16px;
    margin-top: 10px;
    color:#84c225;
    font-weight: bold;
    text-transform: uppercase;
  }

  .logo img{
    margin-top: 7px;width: 185px;margin-left: 59px; text-align: center;
  }

  .Searchmain{
    margin:8px 0px 0px 10px;
  }

@media screen and (max-width: 599px) {
  .Searchmain{
      display: none !important;
    }

 }


 @media screen and (min-width: 767px) {
  .Searchmain1{
      display: none;
    }

 }

   @media screen and (min-width: 0px) and (max-width: 677px) {
     .Searchmain1{
      margin:30px 0px 0px 0px;
    }
  }

  @media screen and (min-width: 0px) and (max-width: 466px) {
    .logo img{
      margin-top: 11px;
      width:110px;
      height: auto;
      margin-left: 23px;
      padding: 3px 0px 0px 0px;
      text-align: center;
    }
    .Searchmain{
      display: none;
    }
     .Searchmain1{
      margin:30px 0px 0px 0px;
    }
  }

  @media screen and (min-width: 481px) and (max-width: 480px){
    .logo img{
      margin-top: 25px;
      width:80%;
      height: auto;
      margin-left:50px;
      text-align: center;
    }
    .maintime{
      display: none!important;
      visibility: hidden;
      text-align: center;

    }

    .Searchmain{
    display: none;
    }


  }

 @media screen and (min-width: 599px) and (max-width: 787px){
    .Searchmain{
      margin:5px 0px 0px 222px;
    }
   
  }

  @media screen and (min-width: 786px) and (max-width: 991px){
    .Searchmain{
      margin:5px 0px 0px 222px;
    }
   
  }

  @media screen and (max-width: 320px) and (min-width: 991px){
    .Searchmain{
      margin:5px 0px 0px 247px;
    }
    .form-control{
      width: 252px;
    }
    .men{
  padding-left: 30px!important;
} 
  }

  .nav-bar{
    background-color: #fff !important;
    padding-bottom: 5px !important;
    position: fixed !important;
    /*z-index: 3 !important;*/
    z-index: 2 !important;
    box-shadow: 0px 0px 10px 0px #504f4f;
  }

  .btn-dark{
    color:#fff;
    background-color: #84c225 !important;
  }

  .card{
    color:#84c225!important;
    margin-top: 14px;
    border-radius: 12px;
    height: 20px;
  }

  /*css by Nandu for cartside bar*/
  .modal.left .modal-dialog,
  .modal.right .modal-dialog {
    position: fixed;
    margin: auto;
    width: 320px;
    height: 100%;
    -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
         -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
  }

  .modal.left .modal-content,
  .modal.right .modal-content {
    height: 100%;
    overflow-y: auto;
  }
  
  .modal.left .modal-body,
  .modal.right .modal-body {
    padding: 15px 15px 80px;
  }

/*Left*/
  .modal.left.fade .modal-dialog{
    left: -320px;
    -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
       -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
         -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
  }
  
  .modal.left.fade.in .modal-dialog{
    left: 0;
  }
        
/*Right*/
  .modal.right.fade .modal-dialog {
    right: -320px;
    -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
       -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
         -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
  }
  
  .modal.right.fade.in .modal-dialog {
    right: 0;
  }

/* ----- MODAL STYLE ----- */
  .modal-content {
    border-radius: 0;
    border: none;
  }

  .modal-header {
    border-bottom-color: #EEEEEE;
    background-color: #FAFAFA;
  }

/* ----- v CAN BE DELETED v ----- */


.demo {
  padding-top: 60px;
  padding-bottom: 110px;
}

.btn-demo {
  margin: 15px;
  padding: 10px 15px;
  border-radius: 0;
  font-size: 16px;
  background-color: #FFFFFF;
}

.btn-demo:focus {
  outline: 0;
}

.demo-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  padding: 15px;
  background-color: #212121;
  text-align: center;
}

.demo-footer > a {
  text-decoration: none;
  font-weight: bold;
  font-size: 16px;
  color: #fff;
}
.men{
  padding-left: 30px;
}


 
 

</style>
<nav class="nav-bar col-sm-12 col-xs-12 col-lg-12">
  <div class="col-xs-1 col-sm-1  col-md-3 col-lg-3 logo">
    <a href="https://farmercart.in/"> <img src="https://farmercart.in//website/img/logo.png" alt="Farmercart" title="Farmercart LOGO" ></a>
  </div>




  <div class="hidden-xs hidden-sm col-md-4 col-lg-4 maintime">
   <!--  <p class="color-text-flow">If you need your order by tomorrow, place it before 8:00 PM</p>
     -->
  </div>

<div class="hidden-xs col-md-2 col-sm-4  Searchmain" style="text-align: center;"> 
    <div class="md-form active-pink active-pink-2 mb-3 mt-0">
      <input class="form-control " type="text" placeholder="Search" id="search" aria-label="Search"  style="border-radius: 19px;    padding-left: 9px;">
    </div>
  </div>

<div class="col-xs-6 col-sm-2 col-md-2 card men" style="font-size: 15px;float: right;margin-top: 6px;">
  <div style="display: inline-block;margin-right:5px;font-size: 20px;">
    <!-- <a href="{{route('user.cart')}}"> -->
    <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal2"> -->
      <div id="cd-cart-trigger">
      <a class="cd-img-replace" href="#0">
      <i class="fa fa-shopping-cart" aria-hidden="true"> 
@if(Cart::instance('cart')->content()->count() != 0)
{{ Cart::instance('cart')->content()->count()}}
@endif()
      </i>  
    </a></div>


    <!-- My cart value -->
   

    <div id="cd-shadow-layer"></div>

<div id="cd-cart">
  
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

            $discount_rate = combo_discount($combo_qty,$combo_dis, $cart->qty);

            $price = $cart->price * $cart->qty - $cart->price * $cart->qty * ($discount_rate/100);
            array_push($cart_price, round($price));
        }
        session(['user.cart.total' => array_sum($cart_price)]);
        $noOfItems=Cart::instance('cart')->content()->count();
        $total_price=0;
    ?>
<button title="Close (Esc)" type="button" class="mfp-close" style="color: #000;">×</button>
      @if(\Cart::instance('cart')->count() == 0)
<div class="text-center">
<i class="fa fa-cart-arrow-down empty-cart-icon"></i>
<p class="lead" style="margin-bottom: 20px !important;">Your cart is empty</p>
<!-- <a class="btn btn-primary btn-lg" href="/">Start Shopping -->
<a class="btn btn-primary btn-big" href="/">Start Shopping
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
          <img src="{{ $product->options->image }}" alt="{{$product->name}}" title="{{$product->name}}" />
        </span> 
      </div>
      <div class="col-xs-8 col-md-8" style="text-align: center;">
        <span class="pname">{{$product->name}}</span>
      
          <div class="pt12">                                      
            <div class="value-button " id="decrease-{{$product->id}}" data="{{$product->id}}" value="Decrease Value">-</div>
              <input type="number" id="number" class="number number-{{$product->id}} qty" name="quantity" min="1" max="100" value="{{$product->qty}}" data-rowId="{{$product->rowId}}" readonly="">
            <div class="value-button " id="increase-{{$product->id}}" data="{{$product->id}}" value="Increase Value">+</div>  
            <ul class="Editarde">
            <li class="fa fa-trash table-shopping-remove remove hide" href="javascript:void(0);" deleteid="{{$product->id}}" data-rowId="{{$product->rowId}}"> Delete</li>
            <li id="itemedit-{{$product->id}}" data="{{$product->id}}" class="hide"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</li>
            </ul>
             
             

         </div>
       </div>
       <div class="col-xs-2 col-md-2">
         <input type="hidden" name="per-product" id="per-product-{{$product->id}}" value="{{$product->price}}">

        <div class="cd-price" ><i class="fa fa-inr" aria-hidden="true"></i> <span id="item-price-{{$product->id}}">{{$product->price * $product->qty}}</span></div>
      
      </div>
    </div> <!-- cd-cart-items -->
    @endforeach
</div>
<div class="col-md-12 cardmain1">

    <div class="cd-cart-total" >
      <p>Total Products <span id="totalcountproduct">{{\Cart::instance('cart')->content()->count()}}</span></p>
    </div> <!-- cd-cart-total -->

    <div class="cd-cart-total">
      <p>Total <span id="cart-total">{{cart_grand_total()}}</span></p>
    </div> <!-- cd-cart-total -->

    @if(Auth::user())
    <a class="btn btn-success checkout-btn" href="{{route('confirm_order')}}">
    Checkout 
    </a>
    @else
     <a href="#nav-login-dialog-checkout" data-effect="mfp-move-from-top" id="nav-login-dialog-checkout" class="btn mobby popup-text checkout-btn"  >
    Checkout
    </a>
    @endif    
    <!-- <p class="cd-go-to-cart"><a href="#0">Continue Shopping</a></p> -->
    @endif
  </div>
</div> <!-- cd-cart -->
<!--  </div>
<div class="text-center" style="display: inline-block;font-size: 20px;">
--><!-- <a href="http://workfarmtoresto.bigdreams.in/cart" data-effect="mfp-move-from-top" class="popup-text" style="font-style: normal!important;position: absolute;"></a>
-->@if(Auth::user())

&nbsp;
<span class="icon">
  <a href="{{ route('home') }}">
    <i class="fa fa-user" aria-hidden="true" style="font-size: 20px;
    margin-top: 7px;"></i>
  </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-effect="mfp-move-from-top" class="popup-text men" ><i class="fa fa-sign-out" aria-hidden="true"  style="font-size: 20px;
    margin-top: 7px;"></i></a>
</span>

<!-- <span class="icon">
  <a  href="/my_wishist" >
    <i class="fa animated text-danger fa-heart-o jello" aria-hidden="true"></i>
  </a>
</span> -->

@else
<span class="icon">
  <!-- <a href="#nav-login-dialog" data-effect="mfp-move-from-top" class="popup-text" ><i class="fa fa-user" aria-hidden="true" style="padding-left: 10px;"></i></a> -->
  <a href="#nav-login-dialog" data-effect="mfp-move-from-top" class="popup-text men" ><i class="fa fa-user" aria-hidden="true"  style="font-size: 20px;
    margin-top: 7px;"></i></a>

    <!-- <a href="{{ route('logout') }}">fa-sign-out</a> -->
</span>
@endif
</div>

<!-- <div class="text-center">
    <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
      Right 
    </button>
  </div> -->
<!--  <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" alt="Avatar" class="image" style="width: 40px;
  height: 50px;" > -->
</div>
<!--  <div class="col-xs-3 col-md-1 card" style="text-align: center;font-size: 15px;">
  <p class="text-center"><i class="fa fa-user" aria-hidden="true"></i></p> -->
  <!--   <p class="text-center"><button type="button" class="btn btn-dark" style="padding: 3px;">SIGN</button><br/></p> -->
  <!--   </div> -->
</nav>
</br>


<!--  <div class="col-xs-12 Searchmain1" style="text-align: center;"> 
 
      <input class="form-control" type="text" placeholder="Search" id="search" aria-label="Search"  style="border-radius: 19px;    padding-left: 9px;">
 
  </div> -->
  <div class="global-wrapper clearfix" id="global-wrapper"></div>
<div class="clear"></div>
 

<script type="text/javascript">


  $('.textee').html(function(i, html) {
  var chars = $.trim(html).split("");

  return '<span>' + chars.join('</span><span>') + '</span>';
});

</script>
 