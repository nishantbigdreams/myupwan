<!-- End of Main -->
<style>
    .error{
        color:red;
    }
    .sticky-icon-links li:nth-child(1) a:hover span{
        width: 80px!important;
    }
    .sticky-icon-links li a:hover span{
        width: 80px!important;
    }
</style>
<?php
$menuCatgPlant = \App\Category::select('name', 'id')->where('parent_category_id', '19')->orderBy('id', 'desc')->get();
$menuCatgSeed = \App\Category::select('name', 'id')->where('parent_category_id', '18')->orderBy('id', 'desc')->get();
$menuCatgPlantcare = \App\Category::select('name', 'id')->where('parent_category_id', '16')->orderBy('id', 'desc')->get();

 ?>
<footer class="footer" style="background-image: url('/images/f-bg.jpg')!important; background-size: cover!important;">
    <div class="container">
        <div class="footer-top">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <a href="<?php echo e(('/')); ?>" class="logo-footer">
                        <img src="<?php echo e(asset('/images/logo-footer.png')); ?>" alt="logo-footer" width="200" height="89"/>
                    </a>
                    <!-- End FooterLogo -->
                </div>
                <div class="col-lg-9">
                    <div class="widget widget-newsletter form-wrapper form-wrapper-inline">
                        <div class="newsletter-info mx-auto mr-lg-2 ml-lg-4">
                            <h4 class="widget-title">Subscribe to our Newsletter</h4>

                            <p>Get all the latest information, Sales and Offers.</p>
                        </div>
                        <form id="modalsubscription" method ="post" class="input-wrapper input-wrapper-inline" >
                            <input type="email" name="emailModal" id="emailModal" class="form-control" 
                                   placeholder="Email address here..." required/>
                            <button type="submit"  class="btn btn-primary btn-rounded btn-md ml-2 modalpop" >
                                subscribe<i class="d-icon-arrow-right"></i></button>

                        </form><br>
                        <div class="modal_message output-display-display-none1" style="display: none;color: red"></div>
                        <div class="modal_message2 output-display-display-none1" style="display: none;color:red"></div>    
                    </div>
                    <!-- End Newsletter -->
                </div>
            </div>
        </div>
        <div class="footer-middle">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="widget">
                        <h4 class="widget-title">About us</h4>

                        <div class="widget-body">
                            <p>We don’t just sell plants, we make your gardens thrive and solve all your gardening
                                issues, magically. We are a young company of 200 passionate individuals driven to leave
                                this world better and greener than we found it.
                            </p>
                        </div>
                    </div>
                    <!-- End Widget -->
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="widget">
                                <h4 class="widget-title">Customer Care</h4>
                                <ul class="widget-body">
                                    <li>
                                        <a href="<?php echo e(url('/about_us')); ?>">About Us</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/return_policy')); ?>">Shipping Policy</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/privacy_policy')); ?>">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/terms_condition')); ?>">Terms &amp; Condition</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/disclaimer')); ?>">Disclaimer</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Widget -->
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="widget">
                                <h4 class="widget-title">Quick Links</h4>
                                <ul class="widget-body">
                                    <li>
                                        <a href="<?php echo e(url('/category/popular-2022')); ?>">Trending 2022</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/gifting')); ?>">Gifting</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/subscription')); ?>">Subscription</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/offers')); ?>">Offers</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/own-grown')); ?>">Own Grown</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Widget -->
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="widget mb-0">
                                <h4 class="widget-title">My Account</h4>
                                <div class="widget-body">
                                    <li>
                                        <?php if(Auth::user()): ?>
                                            <a href="<?php echo e(url('/account')); ?>">Account</a>
                                        <?php else: ?>
                                            <a href="<?php echo e(url('/postLogin')); ?>">Sign in</a>
                                        <?php endif; ?>        
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/cartnew')); ?>">View Cart</a>
                                    </li>
                                    <li>
                                        <?php if(Auth::user()): ?>
                                            <a href="<?php echo e(url('/mywishlist')); ?>">My Wishlist</a>
                                        <?php else: ?>
                                            <a href="<?php echo e(url('/postLogin')); ?>">My Wishlist</a>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/contact')); ?>">Help</a>
                                    </li>
                                </div>
                            </div>
                            <!-- End Widget -->
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="widget">
                                <h4 class="widget-title">Contact Us</h4>
                                <div class="widget-body">
                                    <p><i class="d-icon-home"></i> <a href="mailto:myupavan@gmail.com">myupavan@gmail.com</a></p>
                                    <p><i class="d-icon-phone"></i> <a href="tel:9619049996">+91 961 904 9996</a></p>
                                    <a href="https://api.whatsapp.com/send?phone=919619049996" class="btn btn-primary btn-rounded btn-md ml-2" target="_blank">
                                Bulk orders<i class="d-icon-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Footer Middle -->
        <div class="footer-bottom">
            <div class="footer-left">
                <figure class="payment">
                    <img src="<?php echo e(asset('/images/payment.png')); ?>" alt="payment" width="300" height="29"/>
                </figure>
            </div>
            <div class="footer-center">
                <p class="copyright">My Upavan &copy; 2021. All Rights Reserved. Developed By <a
                            href="<?php echo e(url('https://bigdreams.in/')); ?>" target="_blank">BIG DREAMS</a></p>
            </div>
            <div class="footer-right">
                <div class="social-links">
                    <a href="https://www.facebook.com/Myupavan-104412385283041" title="social-link" class="social-link social-facebook fab fa-facebook-f" target="_blank"></a>
                    <a href="https://www.instagram.com/Myupavan/" title="social-link" class="social-link social-instagram fab fa-instagram" target="_blank"></a>
                    <a href="https://www.linkedin.com/company/my-upavan/" title="social-link" class="social-link social-linkedin fab fa-linkedin-in" target="_blank"></a>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Bottom -->
</footer>
<!-- End Footer -->
</div>

<!-- Scroll Top -->
<a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="d-icon-arrow-up"></i></a>

<!-- MobileMenu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay">
    </div>
    <!-- End of Overlay -->
    <a class="mobile-menu-close" href="#"><i class="d-icon-times"></i></a>
    <!-- End of CloseButton -->
    <div class="mobile-menu-container scrollable">
        <form action="#" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off"
                   placeholder="Search your keyword..." required/>
            <button class="btn btn-search" type="submit" title="submit-button">
                <i class="d-icon-search"></i>
            </button>
        </form>
        <!-- End of Search Form -->
        <ul class="mobile-menu mmenu-anim">
            <li>
                <a href="<?php echo e(url('/')); ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo e(url('/about_us')); ?>">About us</a>
            </li>
            <li>
                <a href="#">Plants</a>
                <ul>
                    <?php $__currentLoopData = $menuCatgPlant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mcatg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(url('/category/'.$mcatg->name)); ?>"><?php echo e($mcatg->name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!--<li><a href="#">Classic Filter</a></li>-->
                </ul>
            </li>
            <li>
                <a href="#">By Color</a>
                <ul>
                    <?php $__currentLoopData = $menuCatgSeed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seedcatg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(url('/category/'.$seedcatg->name)); ?>"><?php echo e($seedcatg->name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!--<li><a href="#">Classic Filter</a></li>-->
                </ul>
            </li>
            <li>
                <a href="<?php echo e(url('/category/popular-2022')); ?>">Trending 2022</a>
            </li>
            <li>
                <a href="<?php echo e(url('/gifting')); ?>">Gifting</a>
            </li>
            <li>
                <a href="<?php echo e(url('/subscription')); ?>">Subscription</a>
            </li>
            <li>
                <a href="<?php echo e(url('/contact')); ?>">Contact us</a>
            </li>
            <?php if(Auth::user()): ?>
                <li>
                    <a href="<?php echo e(url('/account')); ?>">Account</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
    <div class="newsletter-popup newsletter-pop1 mfp-hide" id="newsletter-popup"
        style="background-image: url(images/newsletter-popup1.jpg)">
        <div class="newsletter-content">
            <h4 class="text-uppercase text-dark">We will give you just </h4>
            <h4 class="font-weight-semi-bold">The right amount of <span class="text-primary">GreenLove!</span></h4>
            <p class="text-grey">Sign up now to receive exclusive offers everyday & <span class="text-primary font-weight-semi-bold" style="font-size: 1.6rem;">Get 15%</span> off on your 1st order...
                <br><span class="font-weight-semi-bold text-dark" style="font-size: 2rem;">Go Grab now</span></p>
            <form id="footersubscription" method="post" class="input-wrapper input-wrapper-inline input-wrapper-round">
                <input type="email" class="form-control email" name="email" id="email"
                    placeholder="Email address here..." required="">
                <button class="btn btn-primary subciptionbtn" type="submit">SUBMIT</button>
            </form>
            <div class="output-display1 output-display-display-none1" style="display: none;"></div>
            <div class="output-display11 output-display-display-none1" style="display: none;"></div>
            <div class="form-checkbox justify-content-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup"
                    required />
                <!-- <label for="hide-newsletter-popup">Don't show this popup again</label> -->
            </div>
        </div>
    </div>
    
    <!-- sticky icons-->
    <div class="sticky-icons-wrapper">
        <div class="sticky-icon-links">
            <ul>
                <li><a href="https://api.whatsapp.com/send?phone=919619049996" target="_blank"><i class="fab fa-whatsapp"></i><span>Whatsapp</span></a></li>
                <li><a href="https://www.facebook.com/Myupavan-104412385283041" target="_blank"><i class="fab fa-facebook"></i><span>Facebook</span></a>
                </li>
                <li><a href="https://www.instagram.com/Myupavan/" target="_blank"><i class="fab fa-instagram"></i><span>Instagram</span></a>
                </li>
            </ul>
        </div>
        <!-- <div class="demos-list">
            <div class="demos-overlay"></div>
            <a class="demos-close" href="#"><i class="close-icon"></i></a>
            <div class="demos-content scrollable scrollable-light">
                <h3 class="demos-title">Demos</h3>
                <div class="demos">
                </div>
            </div>
        </div> -->
    </div>
<!-- newsletter-popup type3 -->
<!--<div class="newsletter-popup newsletter-pop3 mfp-hide" id="newsletter-popup">
    <div class="newsletter-content">
        <h2 class="font-weight-bolder text-uppercase">Newsletter Sign up</h2>

        <p class="text-grey">Exclusive access to Our best sellers & Recent arrivals.
            Get latest updates & offers.</p>

        <form id="footersubscription" method="post" class="input-wrapper input-wrapper-inline input-wrapper-round subciption-form">
            <input type="email" class="form-control email" name="email" id="email" placeholder="Email address here..."
                   required="">
            <button class="btn btn-dark text-uppercase subciptionbtn" type="submit">Sign me up</button>
            <div class="output-display1 output-display-display-none1" style="display: none;"></div>
            <div class="output-display11 output-display-display-none1" style="display: none;"></div>

        </form>
        <div class="d-flex form-check">
            <div class="form-checkbox justify-content-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup"
                       name="hide-newsletter-popup" required/>
                <label for="hide-newsletter-popup">Don't show this popup again</label>
            </div>
            <a href="<?php echo e(url('/privacy_policy')); ?>" target="_blank" class="form-privacy">
                Privacy Policy
            </a>
        </div>
    </div>
</div>-->



<!-- Plugins JS File -->
<script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/parallax/parallax.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/isotope/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/imagesloaded/imagesloaded.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/elevatezoom/jquery.elevatezoom.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/magnific-popup/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/owl-carousel/owl.carousel.min.js')); ?>"></script>
<!-- Main JS File -->
<script src="<?php echo e(asset('newjs/main.js')); ?>"></script>
<script src="<?php echo e(asset('../vendor/validation/jquery.validate.min.js')); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script>
    $.validator.addMethod("emailvalidate", function (value, element) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,14}|[0-9]{1,3})(\]?)$/;
        return this.optional(element) || filter.test(value);
    });

    $(document).ready(function () {
        $("#footersubscription").validate({


            rules: {
                email: {required: true, email: true, emailvalidate: true},

            },
            messages: {
                email: {
                    required: "Please Enter Your Email.",
                    email: "Please Enter Valid Email.",
                    emailvalidate: "Please Enter valid Email."
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
        $("#modalsubscription").validate({


            rules: {
                emailModal: {required: true, email: true, emailvalidate: true},

            },
            messages: {
                emailModal: {
                    required: "Please Enter Your Email.",
                    email: "Please Enter Valid Email.",
                    emailvalidate: "Please Enter valid Email."
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
            /*submitHandler: function (form) {
                form.submit();
            }*/
        });
    });
</script>

<script>
   
    $('.subciptionbtn').on('click', function (e) {
        $("#footersubscription").valid();
        //alert("hello");
        e.preventDefault();
        var email = $("#email").val();
        alert(email);
        $.ajax({
            url: "<?php echo e(route('get_subcription')); ?>",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            data: 'email=' + email,
            cache: false,
            success: function (response) {
                console.log(response.status);
                if (response.status == true) {
                    $('.output-display1').show(response);
                    $('.output-display1').append(response.message);
                    $(".output-display11").hide();
                    //$('.mfp-inline-holder').remove();
                    $(".newsletter-popup").hide();


                }
                if (response.status == false) {
                    $('.output-display11').show(response);
                    $('.output-display11').append(response.message);
                    $(".output-display1").hide();
                }

            }

        });
    });

     $('.modalpop').on('click', function (e) {
        e.preventDefault();
        $("#modalsubscription").valid();
        
        var email = $("#emailModal").val();


        console.log(email);
        $.ajax({
            url: "<?php echo e(route('get_subcription')); ?>",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            data: 'email=' + email,
            cache: false,
            success: function (response) {
                console.log(response.status);
                if (response.status == true) {
                    $('.modal_message').show(response);
                    $('.modal_message').append(response.message);
                    $(".modal_message2").hide();

                }
                if (response.status == false) {
                    $('.modal_message2').show(response);
                    $('.modal_message2').append(response.message);
                    $(".modal_message").hide();
                }
            }
        });
    });  
</script>
