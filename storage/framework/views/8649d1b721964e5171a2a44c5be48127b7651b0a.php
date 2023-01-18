<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php
$qty ='';
$pro_price='';
?>

<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    
    <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- End Header -->
    <main class="main account">
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="<?php echo e(url('/')); ?>"><i class="d-icon-home"></i></a></li>
                    <li>Account</li>
                </ul>
            </div>
        </nav>
        <div class="page-content mt-4 mb-10 pb-6">
            <div class="container">
                <h2 class="title title-center mb-10">My Account</h2>
                <?php echo $__env->make('layouts.notification', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="tab tab-vertical gutter-lg">
                    <ul class="nav nav-tabs mb-4 col-lg-3 col-md-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#orders">Orders</a>
                        </li>
                        

                        <li class="nav-item">
                            <a class="nav-link" href="#account">Account details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#changepassword">Change password</a>
                        </li>
                        <li class="nav-item">
                            
                            <a href="<?php echo e(route('UserAuth.logout')); ?>" style="font-size: 16px;">Logout</a>

                        </li>
                    </ul>
                    <div class="tab-content col-lg-9 col-md-8">
                        <div class="tab-pane active" id="dashboard">
                            <p class="mb-0">
                                Redeem Point <span><?php echo e(auth::user()->redeem_point); ?></span>
                            </p>
                            <p class="mb-0">
                                Hello <span><?php echo e(auth::user()->name); ?></span>
                            </p>

                            <p class="mb-8">
                                From your account dashboard you can view your
                                <a href="#orders" class="link-to-tab text-primary">recent orders,<br>and edit your password and update profile</a>.
                            </p>
                            <a href="<?php echo e(url('/')); ?>" class="btn btn-dark btn-rounded">Go To Shop<i
                                        class="d-icon-arrow-right"></i></a>
                        </div>
                        <div class="tab-pane" id="orders">
                            <table class="order-table">
                                <thead>
                                <tr>
                                    <th class="pl-2">Order</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>

                                </tr>
                                </thead>
                                <tbody>


                                <?php $__currentLoopData = $orders->load('BdOrder'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $images = json_decode($order->product_image);
                                    $items = json_decode($order->product_name);
                                    $price = json_decode($order->product_price);
                                    $pay_amount = json_decode($order->pay_amount);
                                    $qty = json_decode($order->product_qty);
                                    $tot =0;
                                    ?>
                                    <tr>
                                        <td class="order-number"><a>#<?php echo e($order->order_id); ?></a></td>
                                        <td class="order-date"><span><?php echo e(date('D d M, Y', strtotime($order->created_at))); ?></span><?php if(!is_null($order->delivery_date)): ?><span><?php echo e(date('D d M, Y', strtotime($order->created_at))); ?></span><?php endif; ?></td>
                                        <td class="order-status"><span>  <?php echo e(str_replace('_',' ', $order->status)); ?></span></td>

                                        <td class="order-total">
                                            
                                            <?php for($i = 0; $i < count($items); $i++): ?>
                                                <?php //$pro_price = (number_format($price[$i])) * $qty[$i]?>
                                            <span>₹ <?php echo e($pay_amount); ?> <?php echo e($items[$i]); ?>  for <?php echo e($qty[$i]); ?> items</span>
                                            <?php endfor; ?>
                                        </td>


                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="account">
                            <form action="<?php echo e(route('UserAuth.profileupdate')); ?>" class="form" method="post" id="profileupdate">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="uid" id="uid" value="<?php echo e(auth::user()->id); ?>">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Full Name *</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo e(auth::user()->name); ?>">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo e(auth::user()->phone); ?>">

                                    </div>
                                    <div class="col-sm-6">
                                        <label>Email Address *</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo e(auth::user()->email); ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Landmark *</label>
                                        <input type="text" class="form-control" name="address_line_0" value="<?php echo e(auth::user()->address_line_0); ?>">

                                    </div>
                                    <div class="col-sm-6">
                                        <label>Street *</label>
                                        <input type="text" class="form-control" name="address_line_1" value="<?php echo e(auth::user()->address_line_1); ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>City *</label>
                                        <input type="text" class="form-control" name="city" value="<?php echo e(auth::user()->city); ?>">

                                    </div>
                                    <div class="col-sm-6">
                                        <label>Pincode *</label>
                                        <input type="text" class="form-control" name="pincode" value="<?php echo e(auth::user()->pincode); ?>">
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="changepassword">
                            <form action="<?php echo e(route(('UserAuth.passwordupdate'))); ?>" method="post" class="form" id="passwordupdte">
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Current password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>New password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">

                                    </div>
                                    <div class="col-sm-6">
                                        <label>Confirm new password</label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">

                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- End Main -->

<?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="../vendor/validation/jquery.validate.min.js"></script>
<script>
    $.validator.addMethod("emailvalidate", function (value, element) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,14}|[0-9]{1,3})(\]?)$/;
        return this.optional(element) || filter.test(value);
    });
    $.validator.addMethod("mobilenumber", function (value, element) {
        var check = false;
        return this.optional(element) || /^[1-9]|^0{0}$/.test(value);
    });
    $.validator.addMethod("number", function (value, element) {
        var check = false;
        return this.optional(element) || /^[1-9]|^0{0}$/.test(value);
    });

    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");

    $(document).ready(function () {
        $("#profileupdate").validate({


            rules: {
                name: {lettersonly: true, required: true},
                email: {required: true, email: true, emailvalidate: true},
                phone: {minlength: 10, maxlength: 10, number: true, required: true},
                pincode: {required: true, minlength: 6},
                city: {required: true}

            },
            messages: {
                name: {required: "Please Enter Your Name."},
                email: {
                    required: "Please Enter Your Email.",
                    email: "Please Enter Valid Email.",
                    emailvalidate: "Please Enter valid Email."
                },
                phone: {
                    minlength: "Please Enter valid 10 digit mobile number",
                    maxlength: "Please Enter valid 10 digit mobile number",
                    required: "Enter Phone Number."
                },
                pincode: {
                    required: "Please Enter Pincode",
                    minlength: "Please Enter valid 6 digit",
                    maxlength: "Please Enter valid 6 digit",
                },
                city: {required: "Please Enter City"}

            },
            errorPlacement: function (error, element) {
                if (element.hasClass('select2') && element.next('.select2-container').length) {
                    error.insertAfter(element.next('.select2-container'));
                } else if (element.parent('.aa').length) {
                    error.insertAfter(element.parent());
                }
                else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                    error.insertAfter(element.parent().parent());
                }
                else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                    error.appendTo(element.parent().parent());
                }
                else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
        $("#passwordupdte").validate({
            // Specify validation rules
            rules: {
                current_password: {required: true},
                new_password: {required: true, minlength: 6},
                new_password_confirmation: {required: true, equalTo: "#new_password"}
            },
            // Specify validation error messages
            messages: {
                current_password: {required: "Please Enter Old Password"},
                new_password: {required: "Please Enter New Password"},
                new_password_confirmation: {required: "Please Re-Enter New Password "}
            },
            errorPlacement: function (error, element) {
                if (element.hasClass('select2') && element.next('.select2-container').length) {
                    error.insertAfter(element.next('.select2-container'));
                } else if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                }
                else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                    error.insertAfter(element.parent().parent());
                }
                else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                    error.appendTo(element.parent().parent());
                }
                else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $(".alert").fadeTo(10000, 500).slideUp(500, function () {
            $(".alert").slideUp(500);
        });
    });
</script>
</body>
