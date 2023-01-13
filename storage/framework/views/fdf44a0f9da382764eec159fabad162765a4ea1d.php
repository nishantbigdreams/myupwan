<?php
$total_price = 0.0;
$tot =0;
?>
<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- End Header -->
    <main class="main order">
        <div class="page-content pt-7 pb-10 mb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-simple title-step"><a href="<?php echo e(url('cartnew')); ?>">1. Shopping Cart</a></h3>

                <h3 class="title title-simple title-step"><a href="<?php echo e(url('checkout')); ?>">2. Checkout</a></h3>

                <h3 class="title title-simple title-step active"><a href="<?php echo e(url('ordercomplete')); ?>">3. Order Complete</a></h3>
            </div>
            <div class="container mt-8">
                <div class="order-message mr-auto ml-auto">
                    <div class="icon-box d-inline-flex align-items-center">
                        <div class="icon-box-icon mb-0">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"
                                 enable-background="new 0 0 50 50" xml:space="preserve">
									<g>
                                        <path fill="none" stroke-width="3" stroke-linecap="round"
                                              stroke-linejoin="bevel" stroke-miterlimit="10" d="
											M33.3,3.9c-2.7-1.1-5.6-1.8-8.7-1.8c-12.3,0-22.4,10-22.4,22.4c0,12.3,10,22.4,22.4,22.4c12.3,0,22.4-10,22.4-22.4
											c0-0.7,0-1.4-0.1-2.1"></path>
                                        <polyline fill="none" stroke-width="4" stroke-linecap="round"
                                                  stroke-linejoin="bevel" stroke-miterlimit="10" points="
											48,6.9 24.4,29.8 17.2,22.3 	"></polyline>
                                    </g>
								</svg>
                        </div>
                        <div class="icon-box-content text-left">
                            <h5 class="icon-box-title font-weight-bold lh-1 mb-1">Thank You!</h5>

                            <p class="lh-1 ls-m">Your order has been received</p>
                        </div>
                    </div>
                </div>
                <div class="order-results">
                    <div class="overview-item">
                        <span>Order number:</span>
                        <strong><?php echo e($order->order_id); ?></strong>
                    </div>
                    <div class="overview-item">
                        <span>Status:</span>
                        <strong>Processing</strong>
                    </div>
                    <div class="overview-item">
                        <span>Delivery Time:</span>
                        <strong><?php echo e($order->delivery_time); ?></strong>
                    </div>
                    <div class="overview-item">
                        <span>Email:</span>
                        <strong><?php echo e(auth::user()->email); ?></strong>
                    </div>
                    <?php
                    $product = json_decode($order->product_name);
                    $qty = json_decode($order->product_qty);
            $price = json_decode($order->product_price); 

                    $tot = 0;
                    ?>
                    <?php for($i=0; $i < count($product); $i++): ?>
                        <?php
                        $tot+=($qty[$i] ?? 1) * ($price[$i] ?? 1);
                        ?>
                    <?php endfor; ?>
                    <div class="overview-item">
                        <span>Total:</span>
                        <strong>₹ <?php echo e(number_format( $order->pay_amount)); ?></strong>
                    </div>
                    <div class="overview-item">
                        <span>Payment method:</span>
                        <?php
                        $paymenttype='';
                        if($order->payment->method == 'cod'){
                            $paymenttype= "Cash on delivery";
                        }
                        if($order->payment->method == 'online'){
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
                        $product = json_decode($order->product_name);
                        $qty = json_decode($order->product_qty);
                        $price = json_decode($order->product_price);
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
                                <h4 class="summary-subtitle">Delivery Charge(Free Delivery If order value more than 999)</h4>
                            </td>
                            <td class="summary-subtotal-price">₹ <?php echo e(number_format($order->delevery_charge)); ?></td>
                        </tr>
                        <tr class="summary-subtotal">
                            <td>
                                <h4 class="summary-subtitle">Payment method:</h4>
                            </td>
                            <td class="summary-subtotal-price"><?php echo e($order->payment->method); ?></td>
                        </tr>
                        <?php if($order->discount): ?>
                            <tr>
                                <td>1% Off on Neft Payment</td>
                                <td></td>
                                <td> - <i class="fa fa-inr"></i>
                                    <?php echo e(number_format($order->discount)); ?>

                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr class="summary-subtotal">
                            <td>
                                <h4 class="summary-subtitle">Total:</h4>
                            </td>
                            <td>
                                <!-- <p class="summary-total-price">₹ <?php echo e(number_format($tot + $order->delevery_charge)); ?></p> -->
                                <p class="summary-total-price">₹ <?php echo e(number_format($order->pay_amount)); ?></p>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <h2 class="title title-simple text-left pt-10 mb-2">Billing Address</h2>

                <div class="address-info pb-8 mb-6">
                    <p class="address-detail pb-2">
                        <?php echo e(auth::user()->name); ?><br>
                        <?php echo e($order->address_line_0); ?><br>
                        <?php echo e($order->address_line_1); ?><br>
                        <?php echo e($order->city); ?>,<?php echo e($order->state); ?><br>
                        <?php echo e($order->pincode); ?>

                    </p>

                    <p class="email">info@myupavan.com</p>
                </div>

                <a href="<?php echo e(url('cartnew')); ?>" class="btn btn-icon-left btn-dark btn-back btn-rounded btn-md mb-4"><i
                            class="d-icon-arrow-left"></i> Back to List</a>
            </div>
        </div>

    </main>
</div>
<!-- End Main -->
<?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
