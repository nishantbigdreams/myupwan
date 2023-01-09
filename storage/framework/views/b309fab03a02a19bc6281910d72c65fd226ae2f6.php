<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- End Header -->
    <main class="main order">
        <div class="page-content pt-7 pb-10 mb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-simple title-step "><a href="<?php echo e(url('/cartnew')); ?>">1. Shopping Cart</a></h3>
                <?php if(Auth::user()): ?>
                    <h3 class="title title-simple title-step"><a href="<?php echo e(url('checkout')); ?>">2. Checkout</a></h3>
                <?php else: ?>
                    <h3 class="title title-simple title-step"><a href="<?php echo e(url('postLogin')); ?>">2. Checkout</a></h3>
                <?php endif; ?>
                <h3 class="title title-simple title-step active"><a href="<?php echo e(url('ordercomplete')); ?>">3. Order
                        Complete</a></h3>
            </div>
            <?php if(sizeof($orderdetail) == 0): ?>
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
            <?php else: ?>
                <div class="container mt-8">
                    <div class="order-results">
                        <div class="overview-item">
                            <span>Order number:</span>
                            <strong><?php echo e($orderdetail[0]->order_id); ?></strong>
                        </div>
                        <div class="overview-item">
                            <span>Status:</span>
                            <strong><?php echo e($orderdetail[0]->status); ?></strong>
                        </div>
                        <div class="overview-item">
                            <span>Delivery Time:</span>
                            <strong><?php echo e($orderdetail[0]->delivery_time); ?></strong>
                        </div>
                        <div class="overview-item">
                            <span>Email:</span>
                            <strong><?php echo e(auth::user()->email); ?></strong>
                        </div>
                        <?php
                        $product = json_decode($orderdetail[0]->product_name);
                        $qty = json_decode($orderdetail[0]->product_qty);
                        $price = json_decode($orderdetail[0]->product_price);
                        $tot = 0;
                        ?>
                        <?php for($i=0; $i < count($product); $i++): ?>
                            <?php
                            $tot+=($qty[$i] ?? 1) * ($price[$i] ?? 1);
                            ?>
                        <?php endfor; ?>
                        <div class="overview-item">
                            <span>Total:</span>
                            <strong>₹ <?php echo e(number_format($tot + $orderdetail[0]->delevery_charge)); ?></strong>
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
                            <strong><?php echo e($paymenttype); ?></strong>
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
                            <?php
                            $product = json_decode($orderdetail[0]->product_name);
                            $qty = json_decode($orderdetail[0]->product_qty);
                            $price = json_decode($orderdetail[0]->product_price);
                            $tot = 0;

                            ?>
                            <?php for($i=0; $i < count($product); $i++): ?>
                                <?php
                                $tot+=($qty[$i] ?? 1) * ($price[$i] ?? 1);
                                ?>
                                <tr>
                                    <td class="product-name"><?php echo e($product[$i]); ?><span> <i class="fas fa-times"></i>
                                            <?php echo e($qty[$i]); ?></span></td>
                                    <td class="product-price">₹ <?php echo e(number_format($price[$i])); ?></td>
                                </tr>
                            <?php endfor; ?>


                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Subtotal:</h4>
                                </td>
                                <td class="summary-subtotal-price">₹ <?php echo e(number_format($tot)); ?></td>
                            </tr>
                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Delivery Charge(Free Delivery If order value more than
                                        499)</h4>
                                </td>
                                <td class="summary-subtotal-price">
                                    ₹ <?php echo e(number_format($orderdetail[0]->delevery_charge)); ?></td>
                            </tr>
                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Payment method:</h4>
                                </td>
                                <td class="summary-subtotal-price"><?php echo e($orderdetail[0]->payment->method); ?></td>
                            </tr>
                            <?php if($orderdetail[0]->discount): ?>
                                <tr>
                                    <td>1% Off on Neft Payment</td>
                                    <td></td>
                                    <td> - <i class="fa fa-inr"></i>
                                        <?php echo e(number_format($orderdetail[0]->discount)); ?>

                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Total:</h4>
                                </td>
                                <td>
                                    <p class="summary-total-price">
                                        ₹ <?php echo e(number_format($tot + $orderdetail[0]->delevery_charge)); ?></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h2 class="title title-simple text-left pt-10 mb-2">Billing Address</h2>

                    <div class="address-info pb-8 mb-6">
                        <p class="address-detail pb-2">
                            <?php echo e(auth::user()->name); ?><br>
                            <?php echo e($orderdetail[0]->address_line_0); ?><br>
                            <?php echo e($orderdetail[0]->address_line_1); ?><br>
                            <?php echo e($orderdetail[0]->city); ?>,<?php echo e($orderdetail[0]->state); ?><br>
                            <?php echo e($orderdetail[0]->pincode); ?>

                        </p>

                        <p class="email">info@myupavan.com</p>
                    </div>

                    <a href="<?php echo e(url('cartnew')); ?>" class="btn btn-icon-left btn-dark btn-back btn-rounded btn-md mb-4"><i
                                class="d-icon-arrow-left"></i> Back to List</a>
                </div>
            <?php endif; ?>

        </div>

    </main>
</div>
<!-- End Main -->
<?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
