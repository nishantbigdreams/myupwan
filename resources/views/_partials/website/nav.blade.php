<?php
$total_price = 0;
$cid = '';
if (auth::user()) {
    $cid = auth::user()->id;
} else {
    $cid = 0;
}

$wishlists = \App\Product::selectRaw('products.id ,products.sell_price,products.name,products.sku,products.model,products.category ,products.product_weight,media.product_id,media.url,tbl_wishlist.cust_id')->
leftjoin('tbl_wishlist', 'tbl_wishlist.p_id', '=', 'products.id')->
leftjoin('media', 'media.product_id', '=', 'products.id')->
where('tbl_wishlist.cust_id', $cid)->
groupBy('products.id')->
orderBy('products.id', 'desc')->get();
$menuCatgPlant = \App\Category::select('name', 'id')->where('parent_category_id', '19')->orderBy('id', 'desc')->get();
// dd($menuCatgPlant);
$menuCatgSeed = \App\Category::select('name', 'id')->where('parent_category_id', '18')->orderBy('id', 'desc')->get();
$menuCatgPlantcare = \App\Category::select('name', 'id')->where('parent_category_id', '16')->orderBy('id', 'desc')->get();
// dd($menuCatgPlant);

?>
{{cacheflush()}}
<header class="header header-border">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="welcome-msg">
                    <!-- <a href="https://g.page/ankita-pest-control-services-187?share" class="contact" target="_blank"><i class="d-icon-map"></i>Find
                        Store</a> -->
                    <a href="#" class="help"><i class="d-icon-info"></i>Free Standard Shipping Above ₹999</a>
                </div>
            </div>
            <div class="header-right">
                <a class="call" href="tel:+91 961 904 9996">
                    <i class="d-icon-phone"></i>
                    <span>Call us: </span><b>+91 961 904 9996</b>
                </a>

                <div class="dropdown wishlist wishlist-dropdown off-canvas">
                    <a href="#" class="wishlist-toggle">
                        <i class="d-icon-heart"></i><span>Wishlist</span>
                    </a>

                    <div class="canvas-overlay"></div>
                    <!-- End Wishlist Toggle -->
                    <div class="dropdown-box scrollable">
                        <div class="canvas-header">
                            <h4 class="canvas-title">wishlist</h4>
                            <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">close<i
                                        class="d-icon-arrow-right"></i><span class="sr-only">wishlist</span></a>
                        </div>
                        @if(auth::user())

                            @foreach($wishlists as $wishlishdata)
                                <div class="products scrollable">
                                    <div class="product product-wishlist">
                                        <figure class="product-media">
                                            <a href="#">
                                                <img src="{{url('/').'/'.$wishlishdata->url}}" width="100" height="100"
                                                     alt="product"/>
                                            </a>

                                            <form action="{{route('destroyWishlist',$wishlishdata->id)}}">
                                                {{csrf_field()}}
                                                <button type="submit" class="btn btn-link btn-close">
                                                    <i class="fas fa-times"></i><span class="sr-only">Close</span>
                                                </button>
                                            </form>
                                        </figure>
                                        <div class="product-detail">
                                            <a href="#" class="product-name">{{$wishlishdata->name}}</a>

                                            <div class="price-box">
                                                <span class="product-quantity">1</span>

                                                <span class="product-price">₹ {{number_format($wishlishdata->sell_price)}}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="products scrollable">
                                <div class="product product-wishlist">
                                    <h3>Your wish list is empty</h3>
                                </div>
                            </div>
                        @endif

                        @if(Auth::user())
                            <a href="{{url('/mywishlist')}}"
                               class="btn btn-dark wishlist-btn mt-4"><span>Go To Wishlist</span></a>
                        @else
                            <a href="{{url('/postLogin')}}"
                               class="btn btn-dark wishlist-btn mt-4"><span>Go To Wishlist</span></a>

                        @endif

                                    <!-- End of Products  -->
                    </div>
                    <!-- End Dropdown Box -->
                </div>
                @if(Auth::user())
                    <a href="{{url('/account') }}" class=""><i class="d-icon-user"></i>&nbsp; Account</a>
                @else
                    <a href="{{ url('/postLogin') }}" class=""><i class="d-icon-user"></i>&nbsp; Login</a>
                @endif

                <div class="dropdown cart-dropdown off-canvas type3 ml-2">
                    <a href="#" class="cart-toggle">
                        <i class="d-icon-bag"></i>
                        My Cart {{\Cart::count()}}
                    </a>

                    <div class="canvas-overlay"></div>
                    <!-- End Cart Toggle -->
                    <div class="dropdown-box">
                        <div class="canvas-header">
                            <h4 class="canvas-title">Shopping Cart</h4>
                            <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">close<i
                                        class="d-icon-arrow-right"></i><span class="sr-only">Cart</span></a>
                        </div>

                        <div class="products scrollable">
                            @foreach(\Cart::content() as $product)
                                <?php
                                $total_price += $product->price * $product->qty;
                                ?>
                                <div class="product product-cart">
                                    <figure class="product-media">
                                        <a href="#">
                                            <img src="{{$product->options->image}}" alt="product" width="80"
                                                 height="88"/>
                                        </a>

                                        <form class="" action="{{ route('update.remove') }}" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="rowId" value="{{$product->rowId}}">
                                            <button type="submit" class="btn btn-link btn-close">
                                                <i class="fas fa-times"></i><span class="sr-only">Close</span>
                                            </button>
                                        </form>
                                    </figure>
                                    <div class="product-detail">
                                        <a href="#" class="product-name">{{$product->name}}</a>

                                        <div class="price-box">
                                            <span class="product-quantity"
                                                  data-rowId="{{$product->rowId}}">{{$product->qty}}</span>
                                            <span class="product-price">₹{{$product->price}}</span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>


                        <!-- End of Products  -->
                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">₹{{number_format($total_price)}}</span>
                        </div>
                        <!-- End of Cart Total -->
                        <div class="cart-action">
                            <a href="{{url('/cartnew') }}" class="btn btn-dark btn-link">View Cart</a>
                            @if(Auth::user())
                                <a href="{{route('confirm_order')}}"
                                   class="btn btn-dark"><span>Go To Checkout</span></a>
                            @else
                                <a href="{{ url('/postLogin') }}" class="btn btn-dark"><span>Go To Checkout</span></a>

                            @endif
                        </div>
                        <!-- End of Cart Action -->
                    </div>
                    <!-- End Dropdown Box -->
                </div>
            </div>
        </div>
    </div>
    <!-- End HeaderTop -->
    <div class="header-middle sticky-header fix-top sticky-content">
        <div class="container">
            <div class="header-left">
                <a href="#" class="mobile-menu-toggle mr-0">
                    <i class="d-icon-bars2"></i>
                </a>
                <a href="{{url('/') }}" class="logo d-none d-lg-block">
                    <img src="{{ asset('images/logo.png')}}" alt="logo" width="200" height="53"/>
                </a>
                <!-- End Logo -->
            </div>
            <div class="header-center d-flex justify-content-center">
                <a href="{{url('/') }}" class="logo d-block d-lg-none">
                    <img src="{{ asset('images/logo.png')}}" alt="logo" width="154" height="43"/>
                </a>
                <!-- End Logo -->
            </div>
            <div class="header-right">
                <nav class="main-nav mr-4">
                    <ul class="menu menu-active-underline">
                        <li>
                            <a href="{{url('/') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{url('/about_us') }}">About us</a>
                        </li>
                        <li>
                            <a>Plants</a>

                            <div class="megamenu">
                                <div class="row">
                                    @php(
                                    $i=0
                                    )
                                    @foreach($menuCatgPlant as $mcatg)
                                        @if($i==0)
                                            <div class="col-6 col-sm-3 col-md-3 col-lg-3">
                                                <ul>
                                                    @endif
                                           @if ($mcatg->name == 'Popular 2022')
                                                    <li>
                                                        <a href="{{ url('/category/'.$mcatg->name)}}">Trending 2022</a>
                                                    </li>
                                                   @else
                                                    <li>
                                                        <a href="{{ url('/category/'.$mcatg->name)}}">{{$mcatg->name}}</a>
                                                    </li>
                                                    @endif
                                                    @php($i++)
                                                    @if($i==3)
                                                </ul>
                                            </div>
                                            @php($i=0)
                                        @endif
                                    @endforeach
                                    <!-- End Megamenu -->
                                </div>
                            </div>
                        </li>
                        <li>
                            <!--<a>Seeds</a>

                            <div class="megamenu">
                                <div class="row">
                                    @php(
                                    $i=0
                                    )
                                    @foreach($menuCatgSeed as $seedcatg)
                                        @if($i==0)
                                            <div class="col-6 col-sm-3 col-md-3 col-lg-3">
                                                <ul>
                                                    @endif
                                                    <li>
                                                        <a href="{{ url('/category/'.$seedcatg->name)}}">{{$seedcatg->name}}</a>
                                                    </li>
                                                    @php($i++)
                                                    @if($i==3)
                                                </ul>
                                            </div>
                                            @php($i=0)
                                            @endif

                                            @endforeach


                                                    <!-- End Megamenu -->
                                <!--</div>-->
                                <a>By Color</a>
                                <div class="megamenu">
                                    <div class="row">
                                    @php(
                                    $i=0
                                    )
                                    @foreach($menuCatgSeed as $seedcatg)
                                        @if($i==0)
                                            <div class="col-6 col-sm-3 col-md-3 col-lg-3">
                                                <ul>
                                                    @endif
                                                    <li>
                                                        <a href="{{ url('/category/'.$seedcatg->name)}}">{{$seedcatg->name}}</a>
                                                    </li>
                                                    @php($i++)
                                                    @if($i==3)
                                                </ul>
                                            </div>
                                            @php($i=0)
                                            @endif

                                            @endforeach


                                                    <!-- End Megamenu -->
                                    </div>
                                </div>
                            <!--</div>-->
                        </li>
                        <li>
                            <a href="{{ url('/category/popular-2022')}}">Trending 2022</a>
                            
                        </li>
                        <li>
                            <a href="{{url('/subscription') }}">Subscription</a>
                        </li>
                        <li>
                            <a href="{{url('/gifting') }}">Gifting</a>
                        </li>
                        <li>
                            <a href="{{url('/contact') }}">Contact us</a>
                        </li>
                    </ul>
                </nav>

                <span class="divider mr-4"></span>

                <div class="header-search hs-toggle d-block">
                    <a href="#" class="search-toggle d-flex align-items-center" title="search">
                        <i class="d-icon-search"></i>
                    </a>

                    <form action="{{route('search')}}" method="post" class="input-wrapper">
                        {{csrf_field()}}
                        <input type="text" class="form-control" name="search" autocomplete="off"
                               placeholder="Search your keyword..." required/>
                        <button class="btn btn-search" type="submit" title="submit-button">
                            <i class="d-icon-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>