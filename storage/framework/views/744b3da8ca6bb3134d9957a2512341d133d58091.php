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
<?php echo e(cacheflush()); ?>

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
                        <?php if(auth::user()): ?>

                            <?php $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlishdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="products scrollable">
                                    <div class="product product-wishlist">
                                        <figure class="product-media">
                                            <a href="#">
                                                <img src="<?php echo e(url('/').'/'.$wishlishdata->url); ?>" width="100" height="100"
                                                     alt="product"/>
                                            </a>

                                            <form action="<?php echo e(route('destroyWishlist',$wishlishdata->id)); ?>">
                                                <?php echo e(csrf_field()); ?>

                                                <button type="submit" class="btn btn-link btn-close">
                                                    <i class="fas fa-times"></i><span class="sr-only">Close</span>
                                                </button>
                                            </form>
                                        </figure>
                                        <div class="product-detail">
                                            <a href="#" class="product-name"><?php echo e($wishlishdata->name); ?></a>

                                            <div class="price-box">
                                                <span class="product-quantity">1</span>

                                                <span class="product-price">₹ <?php echo e(number_format($wishlishdata->sell_price)); ?></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="products scrollable">
                                <div class="product product-wishlist">
                                    <h3>Your wish list is empty</h3>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(Auth::user()): ?>
                            <a href="<?php echo e(url('/mywishlist')); ?>"
                               class="btn btn-dark wishlist-btn mt-4"><span>Go To Wishlist</span></a>
                        <?php else: ?>
                            <a href="<?php echo e(url('/postLogin')); ?>"
                               class="btn btn-dark wishlist-btn mt-4"><span>Go To Wishlist</span></a>

                        <?php endif; ?>

                                    <!-- End of Products  -->
                    </div>
                    <!-- End Dropdown Box -->
                </div>
                <?php if(Auth::user()): ?>
                    <a href="<?php echo e(url('/account')); ?>" class=""><i class="d-icon-user"></i>&nbsp; Account</a>
                <?php else: ?>
                    <a href="<?php echo e(url('/postLogin')); ?>" class=""><i class="d-icon-user"></i>&nbsp; Login</a>
                <?php endif; ?>

                <div class="dropdown cart-dropdown off-canvas type3 ml-2">
                    <a href="#" class="cart-toggle">
                        <i class="d-icon-bag"></i>
                        My Cart <?php echo e(\Cart::count()); ?>

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
                            <?php $__currentLoopData = \Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $total_price += $product->price * $product->qty;
                                ?>
                                <div class="product product-cart">
                                    <figure class="product-media">
                                        <a href="#">
                                            <img src="<?php echo e($product->options->image); ?>" alt="product" width="80"
                                                 height="88"/>
                                        </a>

                                        <form class="" action="<?php echo e(route('update.remove')); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="rowId" value="<?php echo e($product->rowId); ?>">
                                            <button type="submit" class="btn btn-link btn-close">
                                                <i class="fas fa-times"></i><span class="sr-only">Close</span>
                                            </button>
                                        </form>
                                    </figure>
                                    <div class="product-detail">
                                        <a href="#" class="product-name"><?php echo e($product->name); ?></a>

                                        <div class="price-box">
                                            <span class="product-quantity"
                                                  data-rowId="<?php echo e($product->rowId); ?>"><?php echo e($product->qty); ?></span>
                                            <span class="product-price">₹<?php echo e($product->price); ?></span>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>


                        <!-- End of Products  -->
                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">₹<?php echo e(number_format($total_price)); ?></span>
                        </div>
                        <!-- End of Cart Total -->
                        <div class="cart-action">
                            <a href="<?php echo e(url('/cartnew')); ?>" class="btn btn-dark btn-link">View Cart</a>
                            <?php if(Auth::user()): ?>
                                <a href="<?php echo e(route('confirm_order')); ?>"
                                   class="btn btn-dark"><span>Go To Checkout</span></a>
                            <?php else: ?>
                                <a href="<?php echo e(url('/postLogin')); ?>" class="btn btn-dark"><span>Go To Checkout</span></a>

                            <?php endif; ?>
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
                <a href="<?php echo e(url('/')); ?>" class="logo d-none d-lg-block">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="logo" width="200" height="53"/>
                </a>
                <!-- End Logo -->
            </div>
            <div class="header-center d-flex justify-content-center">
                <a href="<?php echo e(url('/')); ?>" class="logo d-block d-lg-none">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="logo" width="154" height="43"/>
                </a>
                <!-- End Logo -->
            </div>
            <div class="header-right">
                <nav class="main-nav mr-4">
                    <ul class="menu menu-active-underline">
                        <li>
                            <a href="<?php echo e(url('/')); ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/about_us')); ?>">About us</a>
                        </li>
                        <li>
                            <a>Plants</a>

                            <div class="megamenu">
                                <div class="row">
                                    <?php (
                                    $i=0
                                    ); ?>
                                    <?php $__currentLoopData = $menuCatgPlant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mcatg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($i==0): ?>
                                            <div class="col-6 col-sm-3 col-md-3 col-lg-3">
                                                <ul>
                                                    <?php endif; ?>
                                           <?php if($mcatg->name == 'Popular 2022'): ?>
                                                    <li>
                                                        <a href="<?php echo e(url('/category/'.$mcatg->name)); ?>">Trending 2022</a>
                                                    </li>
                                                   <?php else: ?>
                                                    <li>
                                                        <a href="<?php echo e(url('/category/'.$mcatg->name)); ?>"><?php echo e($mcatg->name); ?></a>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php ($i++); ?>
                                                    <?php if($i==3): ?>
                                                </ul>
                                            </div>
                                            <?php ($i=0); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <!-- End Megamenu -->
                                </div>
                            </div>
                        </li>
                        <li>
                            <!--<a>Seeds</a>

                            <div class="megamenu">
                                <div class="row">
                                    <?php (
                                    $i=0
                                    ); ?>
                                    <?php $__currentLoopData = $menuCatgSeed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seedcatg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($i==0): ?>
                                            <div class="col-6 col-sm-3 col-md-3 col-lg-3">
                                                <ul>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a href="<?php echo e(url('/category/'.$seedcatg->name)); ?>"><?php echo e($seedcatg->name); ?></a>
                                                    </li>
                                                    <?php ($i++); ?>
                                                    <?php if($i==3): ?>
                                                </ul>
                                            </div>
                                            <?php ($i=0); ?>
                                            <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                    <!-- End Megamenu -->
                                <!--</div>-->
                                <a>By Color</a>
                                <div class="megamenu">
                                    <div class="row">
                                    <?php (
                                    $i=0
                                    ); ?>
                                    <?php $__currentLoopData = $menuCatgSeed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seedcatg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($i==0): ?>
                                            <div class="col-6 col-sm-3 col-md-3 col-lg-3">
                                                <ul>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a href="<?php echo e(url('/category/'.$seedcatg->name)); ?>"><?php echo e($seedcatg->name); ?></a>
                                                    </li>
                                                    <?php ($i++); ?>
                                                    <?php if($i==3): ?>
                                                </ul>
                                            </div>
                                            <?php ($i=0); ?>
                                            <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                    <!-- End Megamenu -->
                                    </div>
                                </div>
                            <!--</div>-->
                        </li>
                        <li>
                            <a href="<?php echo e(url('/category/popular-2022')); ?>">Trending 2022</a>
                            
                        </li>
                        <li>
                            <a href="<?php echo e(url('/subscription')); ?>">Subscription</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/gifting')); ?>">Gifting</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/contact')); ?>">Contact us</a>
                        </li>
                    </ul>
                </nav>

                <span class="divider mr-4"></span>

                <div class="header-search hs-toggle d-block">
                    <a href="#" class="search-toggle d-flex align-items-center" title="search">
                        <i class="d-icon-search"></i>
                    </a>

                    <form action="<?php echo e(route('search')); ?>" method="post" class="input-wrapper">
                        <?php echo e(csrf_field()); ?>

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