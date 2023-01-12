<?php $__env->startComponent('mail::message'); ?>
# Hello, <?php echo e(ucfirst($user->name)); ?>


<?php $__env->startComponent('mail::panel'); ?>
    Thank you for shopping with us. We have received your order#: <?php echo e($order->order_id); ?>.<br>
    You can check your order status by logging in your account. <?php if(Auth::user()): ?>
                                            						<a href="<?php echo e(url('/account')); ?>">Account</a>
                                        						<?php else: ?>
                                            						<a href="<?php echo e(url('/postLogin')); ?>">Login</a>
                                        						<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

<?php
    $images = json_decode($order->product_image);
    $items = json_decode($order->product_name);
    $price = json_decode($order->product_price);
    $qty = json_decode($order->product_qty);
?>

#Order Details

<?php $__env->startComponent('mail::table'); ?>
| Product       | Item          | Qty      | Price  | Delivery Charge |
| ------------- |:-------------:| --------:| ------:| ---------------:|
<?php for($i = 0; $i < count($items); $i++): ?>
| <img src="<?php echo e($images[$i]); ?>" alt="Product Image" style="width:40px;height:40px"> | <?php echo e(strlen($items[$i]) > 15 ?  substr($items[$i],0 , 13).'...' : $items[$i]); ?>      | <?php echo e($qty[$i]); ?>    | ₹<?php echo e(number_format($price[$i])); ?> | ₹60       | 
<?php endfor; ?>
<?php echo $__env->renderComponent(); ?>


Thanks,<br>
My Upavan
<?php echo $__env->renderComponent(); ?>

