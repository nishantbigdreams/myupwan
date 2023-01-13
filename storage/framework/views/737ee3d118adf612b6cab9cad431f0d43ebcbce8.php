<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<style>
    .error {
        color: red !important;
    }

    .alert-danger {
        color: #ffffff !important;
    }

    .alert-success {
        color: #ffffff !important;
    }
 .field-icon {
    float: right;
    /* margin-left: 56px; */
    margin-top: -31px;
    position: relative;
    z-index: 2;
    margin-right: 13px;
}

.container{
  padding-top:50px;
  margin: auto;
}
</style>
<body>
<div class="page-wrapper">
    <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- End Header -->
    <main class="main">
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="<?php echo e(url('/')); ?>"><i class="d-icon-home"></i></a></li>
                    <li><a href="#">My Account</a></li>
                    <li>Login</li>
                </ul>
            </div>
        </nav>
        <div class="page-content mt-6 pb-2 mb-10">
            <div class="container">

                <div class="login-popup">
                    <div class="form-box">
                        <div class="tab tab-nav-simple tab-nav-boxed form-tab">

                            <?php if(Session::has('success')): ?>

                                <?php echo e(\Session::forget('success')); ?>

                            <?php endif; ?>
                            <?php if(Session::has('error')): ?>
                                <?php echo e(\Session::forget('error')); ?>

                            <?php endif; ?>
                            <div class="alert alert-success" style="display:none !important;">Registraion Successfully
                                Done.Please Login Now.
                            </div>

                            <div class="alert alert-danger" style="display:none"></div>

                            <ul class="nav nav-tabs nav-fill align-items-center border-no justify-content-center mb-5"
                                role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active border-no lh-1 ls-normal" href="#signin">Login</a>
                                </li>
                                <li class="delimiter">or</li>
                                <li class="nav-item">
                                    <a class="nav-link border-no lh-1 ls-normal" href="#register">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="signin">
                                    <form action="<?php echo e(route('login.with.otp')); ?>" method="POST" id="loginform">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>

                                        <div class="form-group mb-3">
                                            <input class="form-control" type="tel" id="phone" name="phone" minlength="10" maxlength="10" placeholder="Enter Phone no. *" required/>
                                        </div>

                                        <div class="form-group otpdiv1" style="display: none;">
                                            <input type="number" class="form-control" id="otp" name="otp" placeholder="Enter OTP *"/>
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-block btn-rounded submitotpbtn" id="otpsend" name="otpsend" >Send Otp</button>
                                        <button type="submit" class="btn btn-dark btn-block btn-rounded resendotpbtn" id="otpsend1" name="otpsend1" style="display: none;" >Resend Otp</button>
                                        <br>
                                      
                                        
                                        <div class="output-displaymerror custom-mobile-error"
                                             style="display: none;"></div>
                                        <div class="displaymerror1 custom-mobile-error"
                                             style="display: none;"></div>
                                        <center class="error text-info">
                                        </center>
                                    </form>
                                    <div class="gap gap-small"></div>

                                </div>
                                <div class="tab-pane" id="register">
                                    <form id="regform" method="POST" name="_token" value="<?php echo e(csrf_token()); ?>">
                                        <!-- <input type="hidden" /> -->

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Enter your full name *"/>
                                        </div>
                                        
                                        
                                        
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                   placeholder="Enter your mobile number *"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="email" name="email"
                                                   placeholder="Your Email address *"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password"
                                                   placeholder="Password *"/>
                      <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                   
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="confirm_password"
                                                   name="confirm_password" placeholder="Confirm password *"/>
                      <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                                     <!-- <input id="password-field" type="password" class="form-control" name="password" value="secret"> -->
                                        </div>
                                        
                                        <button class="btn btn-dark btn-block btn-rounded" id="create_account"
                                                type="submit">Create Account
                                        </button><br>

                                        <div class="form-choice text-center">
                                            <label class="ls-m">or Register With</label>
                                            <div class="social-links">
                                                <a href="#"
                                                   class="social-link social-google fab fa-google border-no"></a>
                                                <a href="#"
                                                   class="social-link social-facebook fab fa-facebook-f border-no"></a>

                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
</div>
<?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    $(document).on('blur', '#phone', function () {
/*
         document.getElementById('otpsend').disabled = true;
*/
        var mo = $(this).val();
        console.log(mo)

        //alert(email);
        $.ajax({
            url: "<?php echo e(route('mobilenocheck')); ?>",
            method: "get",
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            data: 'Mobile=' + mo,
            type: "POST",
            cache: false,
            success: function (response) {
                console.log(response.status);
                if (response.status == true) {
                    $('.displaymerror').show(response);
                    $('.displaymerror').append(response.message);
                    $(".displaymerror1").hide();
                    $('#otpsend').attr("disabled", false);
                }
                if (response.status == false) {
                    $('.displaymerror1').show(response);
                    $('.displaymerror1').append(response.message);
                    $(".displaymerror").hide();
                    $('#otpsend').attr("disabled", true);

                }

            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        loadalllist();
    });
    function loadalllist() {
        $('.alert-success').hide();

        $('.alert-danger').hide();

    }
</script>
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
        $("#regform").validate({
            rules: {
                name: {lettersonly: true, required: true},
                email: {required: true, email: true, emailvalidate: true},
                phone: {minlength: 10, maxlength: 10, number: true, required: true},
                password: {required: true, minlength: 6},
                confirm_password: {required: true, equalTo: "#password"}

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
                password: {required: "Please Enter Password."},
                confirm_password: {required: "Please Re-Enter New Password "}

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
        $("#loginform1").validate({
            rules: {
                phone: {minlength: 10, maxlength: 10, number: true, required: true},
                otp: {minlength: 4, maxlength: 4, number: true}

            },
            messages: {

                phone: {
                    minlength: "Please Enter valid 10 digit mobile number",
                    maxlength: "Please Enter valid 10 digit mobile number",
                    required: "Enter Phone Number."
                },
                otp: {

                    minlength: "Please Enter valid 4 digit",
                    maxlength: "Please Enter valid 4 digit",
                }

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
        /*
         $(".alert").fadeTo(10000, 500).slideUp(500, function () {
         $(".alert").slideUp(500);
         });*/
    });
</script>
<script type="text/javascript">

    //otp login
    $loginForm = $('#loginform');
    $error = $loginForm.find('.error');
    $submitBtn = $loginForm.find('button');
    let _status = false;
    $loginForm.submit(function (e) {
        e.preventDefault();
        $error.html("");
        if (!_status) {
            sendLoginOtp();
        } else {
            verifyLoginOtp();
        }
    });

    let verifyLoginOtp = () =>
    {
       // $submitBtn.html('<i class= "fa fa-spinner fa-spin" > </i> Verifying...');

        $.ajax({
            url: $loginForm.attr('action'),
            method: 'POST',
            data: $loginForm.serialize(),
        }).done(function (response, textStatus, jqXHR) {

            if (response.status) {
                window.location.replace("<?php echo e(route('account')); ?>");
                console.log(response.status);
            } else {
                $error.html(response.message);
                console.log(response.message);
                $(".otpdiv1").css('display', 'none');
                $(".submitotpbtn").css('display', 'none');
                $(".resendotpbtn").css('display', 'block');
                $submitBtn.html('Resend OTP');


            }
        })
                .error(function (request, textStatus, errorThrown) {
                    let retry_after = request.getResponseHeader('retry-after');
                    $error.html('<span class="text-danger">Too Many attempt, please try again after <strong>' + retry_after + '</strong> sec(s).</span>');
                    resetForm();
                });
    }

    let sendLoginOtp = () =>
    {
        $submitBtn.html('<i class= "fa fa-spinner fa-spin" > </i> Sending...');
        $.ajax({
            url: '<?php echo e(route("send.login.otp")); ?>',
            method: 'POST',
            data: {"_token": "<?php echo e(csrf_token()); ?>", phone: $loginForm.find('input[type=tel]').val()},
        }).done(function (response, textStatus, jqXHR) {
            if (response.status) {
                _status = true;
                $(".otpdiv1").css('display', 'block');
                $submitBtn.html('Verify & Login');
                $loginForm.find('input[name=otp]').attr('required', 'required');
            } else {
                resetForm();
            }
            $error.html(response.message);
        })
                .error(function (request, textStatus, errorThrown) {
                    let retry_after = request.getResponseHeader('retry-after');
                    $error.html('<span class="text-danger">Too Many attempt, please try again after <strong>' + retry_after + '</strong> sec(s).</span>');
                    resetForm();
                });
    }

    let resetForm = () =>
    {
        $loginForm.trigger('reset');
        $submitBtn.html('Sent Otp');
        $loginForm.find('input[name=otp]').removeAttr('required');
    }
    $('.resendotpbtn').on('click', function (e) {
        e.preventDefault();
        $('#otp').val(' ');

        var phone = $('#phone').val();
       console.log(phone)
        $.ajax({
            url: '<?php echo e(route("resend.login.otp")); ?>',
            method: 'POST',
            data: {"_token": "<?php echo e(csrf_token()); ?>", phone: $loginForm.find('input[type=tel]').val()},
        }).done(function (response, textStatus, jqXHR) {
            if (response.status) {
                _status = true;
                $(".otpdiv1").css('display', 'block');
                $(".submitotpbtn").css('display', 'block');
                $(".resendotpbtn").css('display', 'none');
                $submitBtn.html('Verify & Login');
                $loginForm.find('input[name=otp]').attr('required', 'required');
            } else {
                resetForm();
            }
            $error.html(response.message);
        })
                .error(function (request, textStatus, errorThrown) {
                    let retry_after = request.getResponseHeader('retry-after');
                    $error.html('<span class="text-danger">Too Many attempt, please try again after <strong>' + retry_after + '</strong> sec(s).</span>');
                    resetForm();
                });
    });
</script>

<script type="text/javascript">
    $('#create_account').on('click', function (e) {
        $("#regform").valid();
        e.preventDefault();
        var form_data = new FormData(document.getElementById("regform"));

        console.log(form_data);
        $.ajax({
            url: "<?php echo e(route('postRegistration')); ?>",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                // console.log(data.errors);

                if (data.success) {
                    console.log(data.success);
                    $('.alert-success').show();

                    var url1 = window.location.href;
                    /*
                     window.location.replace(url1);
                     */
                    window.location.replace("<?php echo e(route('account')); ?>");
                    /*      window.location.reload();*/
                }

                $(".alert-danger").empty();
                $.each(data.errors, function (key, value) {
                    console.log(data.errors);

                    $('.alert-danger').show();
                    $('.alert-danger').append('<p>' + data.errors + '</p>');
                });
            }

        });
    });

</script>

<script>
        $(".toggle-password").click(function() {
 
 $(this).toggleClass("fa-eye fa-eye-slash");
 var input = $($(this).attr("toggle"));
 if (input.attr("type") == "password") {
   input.attr("type", "text");
 } else {
   input.attr("type", "password");
 }
 });
      </script>


</body>
