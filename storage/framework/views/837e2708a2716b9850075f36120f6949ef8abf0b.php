<?php
$delevery_total = 0.0;
$total_price = 0.0;
$shipping = 0;
?>
<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- End Header -->
    <main class="main checkout">
        <div class="page-content pt-7 pb-10 mb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-simple title-step"><a href="<?php echo e(url('cartnew')); ?>">1. Shopping Cart</a></h3>

                <h3 class="title title-simple title-step active"><a href="<?php echo e(url('checkout')); ?>">2. Checkout</a></h3>

                <h3 class="title title-simple title-step"><a href="<?php echo e(url('ordercomplete')); ?>">3. Order Complete</a></h3>
            </div>
            <div class="container mt-7">

                <?php if(Auth::user()): ?>

                    <form action="<?php echo e(route('checkout_order')); ?>" method="post" id="checkoutForm">
                        <?php echo e(csrf_field()); ?>

                        <?php endif; ?>
                        <input type="hidden" name="rp_payment_id">
                        <input type="hidden" name="payment_method" value="cod">
                        <div class="row">
                            <div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4">
                                <h3 class="title title-simple text-left text-uppercase">Billing Details</h3>
                                <div id="billing_address_div" class="panel-collapse collapse1 in">
                                    <div class="panel-body">

                                        <?php $__env->startComponent('website.components.billing_address',['dropdownValue' => $between]); ?><?php echo $__env->renderComponent(); ?>
                                    </div>
                                </div>
                            </div>
                            <aside class="col-lg-5 sticky-sidebar-wrapper">
                                <div class="sticky-sidebar mt-1" data-sticky-options="{'bottom': 50}">
                                    <div class="summary pt-5">
                                        <h3 class="title title-simple text-left text-uppercase">Your Order</h3>
                                        <table class="order-table">
                                            <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = \Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php (

                                                $total_price =  $total_price + ($product->price) * ((int)$product->qty)
                                                ); ?>
                                                <tr>
                                                    <td class="product-name"><?php echo e($product->name); ?><span
                                                                class="product-quantity">×&nbsp;<?php echo e($product->qty); ?></span></td>
                                                    <td class="product-total text-body">₹ <?php echo e($product->price); ?>

                                                        <?php ($delevery_total += $product->options->delevery_charge); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <tr class="summary-subtotal">
                                                <td>
                                                    <h4 class="summary-subtitle">Subtotal </h4>
                                                </td>
                                                <td class="summary-subtotal-price pb-0 pt-0" id="subtotal_value">₹ <?php echo e(number_format($total_price)); ?>

                                                </td>
                                            </tr>
                                            <tr class="summary-subtotal">
                                                <td>
                                                    <h4 class="summary-subtitle">Delivery Charge </h4>
                                                </td>
                                                <td class="summary-subtotal-price pb-0 pt-0" id="subtotal_value">₹ 60
                                                </td>
                                            </tr>    
                                            <tr class="summary-subtotal">
                                                
                                                <td><input type="text" name="coupon_code" class="input-text form-control text-grey ls-m mb-4" id="coupon_code"  placeholder="Enter coupon code here..."></td>
                                                <td class="summary-subtotal-price pb-0 pt-0"><button type="button" class="btn btn-md btn-dark btn-rounded btn-outline" onclick="coupen_verify()">Apply Coupon</button><br><span style="color: red" id="success_message"></span></td>
                                            </tr>
                                            <?php

                                            $grand_total = $shipping + $total_price
                                            ?>
                                            
                                            <tr class="summary-total">
                                                <td class="pb-0">
                                                    <h4 class="summary-subtitle">Total</h4>
                                                </td>
                                                <td class=" pt-0 pb-0">
                                                    <input class="grand_total" type="hidden" name="grand_total" value="<?php echo e(cart_total() > 999 ?   cart_total() : cart_total()+60); ?>">

                                                    <p class="summary-total-price ls-s text-primary" id="grand_total">₹ <?php echo e(number_format($grand_total)); ?></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="payment accordion radio-type" >
                                            <h4 class="summary-subtitle ls-m pb-3">Payment Methods</h4>

                                            <div class="card" id="hide_online">
                                                <div class="card-header">
                                                    <a href="#ONLINE" id="paymentonline"
                                                       class="collapse text-body text-normal ls-m">Online payments
                                                    </a>
                                                </div>
                                                <div id="ONLINE" class="expanded" style="display: block;">
                                                    <div class="card-body ls-m">
                                                        <img src="<?php echo e(asset('website/img/payment/Razorpay.png')); ?>" alt="Razorpay Payment" title="PayPal" class="img-responsive" width="50%" style="padding-bottom: 20px" />
                                                        <p style="font-size: 14px !important;">
                                                            Note: You will be redirected to Razorpay to securely complete your payment.
                                                        </p>
                                                        <?php if(session('payment_error')): ?>
                                                            <div class="alert alert-danger alert-dismissible">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                <strong>Oops!</strong>
                                                                <?php echo session('payment_error'); ?>

                                                            </div>
                                                            <input type="hidden" name="retry_payment" value="retry_payment">
                                                            <input type="hidden" name="retry_order" value="<?php echo e(session('retry_order')); ?>">
                                                        <?php endif; ?>
                                                        <button name="payment_method" value="online" class="btn btn-primary proceed_btn" id="razorpaybtn">
                                                            Proceed
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                    <a href="#COD" id="paymentcache" class="expand text-body text-normal ls-m">Cash
                                                        on delivery</a>
                                                </div>
                                                <div id="COD" class="collapsed">
                                                    <div class="card-body ls-m">
                                                        Pay with cash upon delivery.

                                                        <div class="col-xs-12">
                                                            One time password will be sent to
                                                            ******<?php echo e(substr(auth()->user()->phone ?? "",6,10)); ?>

                                                        </div>

                                                        <?php if(!isset(auth()->user()->phone)): ?>


                                                            <input type="text" name="guest_phone_text" id="guest_phone_text" class="form-control " placeholder="Enter Mobile No for otp" value="" required>

                                                        <?php endif; ?>


                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-6 otp-div" style="">
                                                                <input type="text" name="otp" id="otp_text" class="form-control " placeholder="Enter OTP" required="">
                                                            </div>


                                                            <div class="col-xs-12 col-sm-6" style="">
                                                                <button type="button" name="button" class="btn btn-dark btn-rounded btn-order custom-otpbtn otpbtn" id="otp_btn">
                                                                    <!--   <i class="fa fa-paper-plane"></i> --> Send OTP
                                                                </button>

                                                                <div class="col-xs-6" id="resend_div"></div>

                                                            </div>
                                                            <div class="col-xs-12">
                                                                <center id="message" style="height:10px">
                                                                    <?php if(session('otp_error')): ?>
                                                                        <span class="text-danger"><?php echo e(session('otp_error')); ?></span>
                                                                    <?php endif; ?>
                                                                </center>
                                                            </div>
                                                        </div>

                                                        <br>

                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                   


                                </div>
                            </aside>
                        </div>
                    </form>
            </div>


        </div>
    </main>
</div>
<form id="thank_you_form" method="post" action="<?php echo e(route('thank_you_page')); ?>">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="order_id" value="">
</form>
<?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<script type="text/javascript">
    function openNav() {
        document.getElementById("mySidenav").style.display = "none";
    }

    $('#company').change(function () {
        $('#company_details').toggle('slow');
    });

    $('#ship_to_diff_add').change(function () {
        $('#ship_to_diff_add_div').toggle('slow');
    });

    if ("<?php echo e(old('ship_contact_person')); ?>" != '') {
        $('#ship_to_diff_add').prop('checked', true).change();
        $('#shipping').click();
    }

    $('#shipping').click(function () {
        if (!$('#shipping_address_div').hasClass('in')) { // shopping address div is visible
            $('#shipping_address_div input.req').each(function () {
                $(this).toggleAttr('required', 'required');
            });
        } else {
            $('#shipping_address_div input.req').each(function () {
                $(this).removeAttr('required');
            });
        }
    });

    var alterClass = function () {
        if (document.body.clientWidth < 768) {
            $('.nav-tabs').removeClass('nav-justified');
        }
    }();

    $('li[role=presentation]').click(function () {
        $('input[name=utr_no]').removeAttr('required');
        $('#otp_text').removeAttr('required');
        $tab = $(this).find('a');
        switch ($tab.attr('href')) {
            case '#NEFT':
                $('input[name=utr_no]').attr('required', 'required');
                break;
            case '#COD':
                $('#otp_text').attr('required', 'required');
                break;
            case '#ONLINE':
        }
    });

    let otp_sent = false;
    $otp_btn = $('#otp_btn');
    $message = $('#message');

    let sendOtp = () =>
    {

        var person_name = $('#contact_person').val();
        var contact_number = $('#contact_number').val();
        var address0 = $('#address_line_0').val();
        var address1 = $('#address_line_1').val();
        var address2 = $('#address_line_2').val();
        var pincode = $('#bill_pincode').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var timeslot = $('#timeslot').val();
        

        if (person_name == "" || contact_number == "" || address0 == "" || address1 == "" || address2 == "" || pincode == "" || city == "" || state == "" || timeslot == "") {
            alert("Please enter complete details");
        } else {
            otp_sent = false;

            var guest_phone_text = "";
            var pincode = $('#bill_pincode').val();
            <?php if(Auth::user() == null): ?>
                 guest_phone_text = $("#guest_phone_text").val();
                    <?php endif; ?>
                var ispincodeokay = 'not okay';
            <?php $__currentLoopData = $pincode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            if (<?php echo $p->pincode ?>==pincode
        )
            {
                ispincodeokay = 'okay';
            }
            ispincodeokay = 'okay';
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             if ("<?php echo Auth::user()->status; ?>" == 'Approved' && ispincodeokay == 'okay') {
                $otp_btn.html('<i class="fa fa-spinner fa-spin"></i> sending...');
                $.ajax({
                    url: "<?php echo e(route('send_otp')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        'guest_phone_text': guest_phone_text,
                    
                    },
                    method: "POST",
                    success: function (data, textStatus, request) {
                        if (data.status) {
                            $otp_btn.html('<i class="fa fa-check-circle"></i> Verify');
                            $message.html('<span class= "text-success"> <i class="fa fa-check" ></i> Please enter otp to continue </span>');
                            otp_sent = true;
                            resendOtpInit();
                        } else {
                            $otp_btn.html('<i class= "fa fa-paper-plane" > </i> Send OTP');
                            $message.html('<span class= "text-danger" > <i class= "fa fa-times"> </i> Something is not working, We are working on it. < br > Please try  again after some time. </span>');
                        }
                    },
                    error: function (request, textStatus, errorThrown) {
                        $otp_btn.html('<i class="fa fa-check-circle"></i> VERIFY');
                        let retry_after = request.getResponseHeader('retry-after');
                        $message.html('<span class= "text-danger" > Too Many attempt, please try again after <strong>' + retry_after + '</strong> sec(s). </span >');
                    }
                });
            }
            else {
                if (ispincodeokay == 'not okay') {
                    alert('Your Pincode is out of range');
                }
                else {
                    alert('Your Profile is not approved yet by Admin');
                }
            }
        }
    }

    let verifyOtp = () =>
    {
        $otp_btn.html('<i class="fa fa-spinner fa-spin"></i> verifying...');

        var guest_phone_text = "";
        var code = $("#coupon_code").val();
        console.log(code);
        

        <?php if(Auth::user() == null): ?>
             guest_phone_text = $("#guest_phone_text").val();
        <?php endif; ?>

        // alert($('#otp_text').val());

        // if($('input[name=otp]').val().length < 2){
        //     $message.html(`<span class="text-danger"> Enter valid OTP. </span>`);
        //     $otp_btn.html('<i class="fa fa-check-circle"></i> VERIFY');
        //     return;
        // }

        $.ajax({
            url: "<?php echo e(route('verify_otp')); ?>",
            method: "POST",
            data: {
                'otp': $('#otp_text').val(),
                "_token": "<?php echo e(csrf_token()); ?>",
                'guest_phone_text': guest_phone_text,
                    code: code
            },
            success: function (data, textStatus, request) {
                if (data == 'success') {
                    otp_sent = false;
                    $otp_btn.html('<i class="fa fa-check"></i> VERIFIED');
                    $message.html('<span class="text-success"><i class="fa fa-check"></i> Phone number verified.</span>');
                    // $('#cod_submit_btn').removeAttr('disabled');
                    // $('#cod_submit_btn').removeAttr('style');
                    $('#otp_btn').css('display', 'none');
                    $('#resend_div').css('display', 'none');

                    $('#addsome').html('<input type="hidden" name="payment_method" value="cod">');
                    $("#checkoutForm").submit();
                    // $("#checkoutForm").submit(function(e){
                    //            res =true;
                    //    $("input[type='text'],select,input[type='password']",this).each(function() {
                    //             if($(this).val().trim() == "") {
                    //                 res = false;
                    //             }
                    //         });

                    //    return res;
                    // });
                    /*alert('in user');*/
                } else {
                    $otp_btn.html('<i class="fa fa-check-circle"></i> VERIFY');
                    $message.html('<span class="text-danger"><i class="fa fa-times"></i> Invalid code try again.</span>');
                    $('#cod_submit_btn').attr('disabled', 'disabled');
                }
            },
            error: function (request, textStatus, errorThrown) {
                $otp_btn.html('<i class="fa fa-check-circle"></i> VERIFY');
                let retry_after = request.getResponseHeader('retry-after');
                $message.html('<span class="text-danger">Too Many attempt, please try again after <strong>' + retry_after + '</strong> sec(s).</span>');
            }
        });
    }

    let resendOtpInit = () =>
    {
        $div = $otp_btn.parents().eq(3).find('#resend_div');
        $div.html('');

        let timeleft = 60;
        var timer = setInterval(function () {
            timeleft--;
            if (timeleft) {
                $div.html(`<button class  = "btn btn-info btn-sm" > <i class= "fa fa-clock-o" > </i> 00 :${timeleft > 9 ? timeleft : '0'+timeleft}</button >`);
            } else {
                otp_sent = false;
                $div.html('<span class= "btn btn-danger btn-sm" id = "resend_otp_btn" > <i class="fa fa-refresh"> </i> RESEND </span >');
            }
            if (timeleft <= 0)
                clearInterval(timer);
        }, 1000);
    }


    $(document).on("click", "#otp_btn", function () {

        $message.html('');
        if (!otp_sent) {
            sendOtp();
        } else {
            verifyOtp();
        }
        return;
    });

    $(document).on('click', '#resend_otp_btn', function () {
        sendOtp();
    });

    if ("<?php echo e(session('otp_error')); ?>") {
        $('li[role=presentation]').find('a[href="#COD"]').click();
    }

    <?php if(isset($ship_pin_error)): ?>
               $('#ship_to_diff_add_div').toggle('slow');
    <?php endif; ?>

</script>

<script type="text/javascript">
    $(function(){
        $(document).on('change keyup', '.pincode', function(){
            if ($(this).val().length == 6) {
                $this = $(this);
                $loader = $this.parent().find('.pincode_loader');
                $input = $this.parent().parent().parent();
                $loader.html('<i class="fa fa-spinner fa-spin"></i>');
                $.ajax({
                    url: "<?php echo e(route('get_state_city')); ?>",
                    method: 'post',
                    data:{
                        "_token": "<?php echo e(csrf_token()); ?>",
                        pincode:$this.val()},
                }).done(function(data, textStatus, jqXHR) {
                    $loader.html('');
                    let state = '', city = '';
                    if(data['status']=="success")
                    {

                        city=data['city'];
                        state=data['state'];
                    }else
                    {
                        console.log(data);
                        $loader.html('<i class="fa fa-times text-danger">Shipping Not Available</i>');
                    }
                    // let response = JSON.parse(data);
                    // let state = '', city = '';
                    // if (!response.PostOffice || response.PostOffice.length < 0) {
                    //     $loader.html('<i class="fa fa-times text-danger">Invalid Pincode</i>');
                    // } else {
                    //     city = response.PostOffice[0].Region;
                    //     state = response.PostOffice[0].State;
                    // }
                    $input.find('input[name=city]').val(city);
                    $input.find('input[name=state]').val(state);
                    $.ajax({
                        method : 'post',
                        url : "<?php echo e(route('shipping_availability')); ?>",
                        data : {"_token": "<?php echo e(csrf_token()); ?>",pincode : $this.val()},

                        success : function(data){
                            $loader.html(data);
                            // city = response.PostOffice[0].Region;
                            // state = response.PostOffice[0].State;
                            if(data.includes("Cash on Delivery not Available"))
                            {
                                $("#cod_content").hide();
                                $("#cod_not_available").removeClass("hide");
                            }
                            else
                            {
                                $("#cod_content").show();
                                $("#cod_not_available").addClass("hide");
                            }
                        }
                    });
                });
            }
        });
    });
</script>



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

    // "key" : "rzp_live_0HN945385AwQNm";
    // "secret key" : "l8NwCZfbZbWI9qvcb1S6vVTT";
    var status = '';
    var grand_total = $('.grand_total').val() * 100;
    console.log(grand_total);
    // var amount = <?php echo e(cart_grand_total()); ?> * 100;
    // console.log(amount);
    var options = {
        "key": "rzp_live_0HN945385AwQNm",
        "amount": grand_total, // amount+grand_total 2000 paise = INR 20
        "name": "My Upavan",
        "description": "Purchase Description",
        "image": "<?php echo e(asset('images/logo.png')); ?>",
        "handler": function (response) {
            console.log("ok");
            console.log(response);
            $('input[name="rp_payment_id"]').val(response.razorpay_payment_id);
            $('input[type="hidden"][name="_token"]').prop('disabled', true);
            $('input[name="payment_method"]').val('neft');

            $.ajax({
                url: "<?php echo e(route('captureOrder')); ?>",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                },
                data: $('#checkoutForm').serialize(),
                success: function (data) {
                        console.log(data);
                    if (data.order) {
                        $('input[type="hidden"][name="_token"]').prop('disabled', false);

                        $('#thank_you_form input[name="order_id"]').val(data.order.id);
                        $('#thank_you_form').submit();
                    }

                }
            });
        },
        "prefill": {
            "email": "<?php echo e(auth::user()->email); ?>",
            "contact": "<?php echo e(auth::user()->phone); ?>",
        },
        "notes": {
            "address": ""
        },
        "theme": {
            "color": "#68b723"
        }
    };
    console.log(options);


    var rzp1 = new Razorpay(options);

    $(document).on("click", "#razorpaybtn", function (e) {
        // alert("Hii");

        var person_name = $('#contact_person').val();
        var contact_number = $('#contact_number').val();
        var address0 = $('#address_line_0').val();
        var address1 = $('#address_line_1').val();
        var address2 = $('#address_line_2').val();
        var pincode = $('#bill_pincode').val();
        var city = $('#city').val();
        var state = $('#state').val();

        if (person_name == "" || contact_number == "" || address0 == "" || address1 == "" || address2 == "" || pincode == "" || city == "" || state == "") {
            alert("Please enter complete details");
        }
        else {
            rzp1.open();
        }
        e.preventDefault();
    });


    function openNav() {
        document.getElementById("mySidenav").style.display = "none !important";
    }

</script>
<script type="text/javascript">
    var flag = 0;
    function coupen_verify(){
        var code = $("#coupon_code").val();
        

        if(code != "" && flag==0){
            $.ajax({
                url: "<?php echo e(route('verify_coupen')); ?>",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                },
                data: {code:code,grand_total:grand_total},
                success: function (data) {
                    //alert(data);
                    $response     =   JSON.parse(data);
                    

                    if($response.status == 1){
                        $("#flag_coupen").val("1");
                        $("#success_message").append('');
                        $("#success_message").append($response.message);
                        //$("#subtotal_value").append('');
                        //$("#subtotal_value").value();
                        $("#subtotal_value").text('₹'+0);
                        $('.grand_total').val($response.grand_total);
                        $('#grand_total').text('₹'+($response.grand_total));
                        //$('#grand_total').append('₹'+($response.grand_total));
                         grand_total   =   $response.grand_total; 


                         $("#hide_online").hide();
                         $("#coupen_id").val($response.coupen_id);

                         //$tab.attr('href').value('#COD');
                        

                    }else{
                        $("#success_message").append('');
                        $("#success_message").append($response.message);
                        $("#flag_coupen").val("0");
                        $("#coupen_id").val("0");

                    }
                    code = $("#coupon_code").val();
                    flag = 1;
                        
                    
                }
            });

        }

        

    }

</script>
</body>

