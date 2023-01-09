<?php
$total_price = 0.0;
$totalg_price = 0.0;
?>
<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- End Header -->
    <main class="main cart">
        <div class="page-content pt-7 pb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-simple title-step active"><a href="<?php echo e(url('/cartnew')); ?>">1. Shopping Cart</a></h3>
                <?php if(Auth::user()): ?>
                    <h3 class="title title-simple title-step"><a href="<?php echo e(url('checkout')); ?>">2. Checkout</a></h3>
                <?php else: ?>
                    <h3 class="title title-simple title-step"><a href="<?php echo e(url('postLogin')); ?>">2. Checkout</a></h3>
                <?php endif; ?>
                <h3 class="title title-simple title-step"><a href="<?php echo e(url('ordercomplete')); ?>">3. Order Complete</a></h3>
            </div>
            <?php if(\Cart::count() == 0): ?>
                <div class="text-center">
                    <i class="fa fa-cart-arrow-down empty-cart-icon"></i>

                    <p class="lead" style="margin-bottom: 20px !important;">Your cart is empty</p>
                    <a class="btn btn-primary btn-lg" href="/">Start Shopping
                        <!-- <i class="fa fa-long-arrow-right"></i> -->
                    </a>
                </div>
                <div class="gap"></div>
            <?php else: ?>
                <div class="container mt-7 mb-2">
                    <form method="post" action="<?php echo e(route('update.cart')); ?>">
                        <?php echo e(csrf_field()); ?>

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
                                    <?php (
                                    $i=1
                                    ); ?>
                                    <?php $__currentLoopData = \Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php (

                                                $total_price = $item->price * ((int)$item->qty)
                                                ); ?><?php (

                                            $totalg_price =  $totalg_price + ($item->price) * ((int)$item->qty)
                                            ); ?>
                                        <tbody>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <figure>
                                                    <a href="#">
                                                        <img src="<?php echo e($item->options->image); ?>" width="100" height="100" alt="product">

                                                    </a>
                                                </figure>
                                            </td>
                                            <td class="product-name">
                                                <div class="product-name-section">
                                                    <a href="#"><?php echo e($item->name); ?></a>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount">₹ <?php echo e($item->price); ?></span>
                                            </td>
                                            <td class="product-quantity">
                                                
                                                <input type="hidden" name="id[]" value="<?php echo e($item->id); ?>">

                                                <div class="input-group">
                                                    <button type="button" class="quantity-minus d-icon-minus"></button>
                                                    <input class="quantity form-control" name="quantity[]" type="number" min="1" max="1000000" value="<?php echo e($item->qty); ?>">
                                                    <button type="button" class="quantity-plus d-icon-plus"></button>
                                                </div>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">₹ <?php echo e(number_format($total_price)); ?></span>
                                            </td>
                                            <td class="product-close custom-text-center">
                                                
                                                <input type="hidden" name="rowId" id="rowId" class="prowId" value="<?php echo e($item->rowId); ?>">
                                                <a class="btn btn-link btn-close removecartdata"  data-id="<?php echo e($item->rowId); ?>"><i class="fas fa-times"></i><span class="sr-only">Close</span>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        </tbody>
                                        <?php ($i++); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>
                                <div class="cart-actions mb-6 pt-4">
                                    <a href="<?php echo e(url('/')); ?>" class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4"><i class="d-icon-arrow-left"></i>Continue Shopping</a>

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
                                                <p class="summary-subtotal-price">₹ <?php echo e(number_format($totalg_price)); ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="total">
                                        <tr class="summary-subtotal">
                                            <td>
                                                <h4 class="summary-subtitle">Total</h4>
                                            </td>
                                            <td>
                                                <p class="summary-total-price ls-s">₹ <?php echo e(number_format($totalg_price)); ?></p>
                                            </td>
                                        </tr>
                                    </table>


                                    <?php if(Auth::user()): ?>
                                        <a href="<?php echo e(url('/checkout')); ?>" class="btn btn-dark btn-rounded btn-checkout">Proceed to checkout</a>
                                    <?php else: ?>
                                        <a href="<?php echo e(url('/postLogin')); ?>" class="btn btn-dark btn-rounded btn-checkout">Proceed to checkout</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </aside>



                </div>
                    </form>
                </div>
            <?php endif; ?>


        </div>

    </main>
</div>
<!-- End Main -->
<?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    $(document).on('click', '.removecartdata', function () {
        $.ajax({
            url: "<?php echo e(route('update.remove')); ?>",
            method: "POST",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
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
<?php $__env->startPush('page-script'); ?>

<?php $__env->stopPush(); ?>