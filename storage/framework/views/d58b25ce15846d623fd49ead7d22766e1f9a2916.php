<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('newcss/style.min.css')); ?>">
<body class="contact-us">

<div class="page-wrapper">
    <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- End Header -->
    <main class="main">
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="<?php echo e(url('/')); ?>"><i class="d-icon-home"></i></a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </nav>
        <div class="page-header" style="background-image: url(<?php echo e(asset('images/page-header/contact-us.jpg')); ?>)">
            <h1 class="page-title font-weight-bold text-capitalize ls-l">Contact Us</h1>
        </div>
        <div class="page-content mt-10 pt-7">
            <section class="contact-section">
                <div class="container">
                    <?php echo $__env->make('layouts.notification', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 ls-m mb-4">
                            <div class="grey-section d-flex align-items-center h-100">
                                <div>
                                    <h4 class="mb-2 text-capitalize">Headquarters</h4>

                                    <p>Arvind apartment, G/2 Ground floor, Lokmanya tilak road, opposite PNG jwellers Borivali(west) Mumbai, Maharashtra 400092.</p>

                                    <h4 class="mb-2 text-capitalize">Phone Number</h4>

                                    <p>
                                        <a href="tel:+919619049996">+91 961 904 9996</a>
                                    </p>

                                    <h4 class="mb-2 text-capitalize">Support</h4>

                                    <p class="mb-4">
                                        <a class="mt-8" href="mailto:myupavan@gmail.com">myupavan@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-8 col-sm-6 d-flex align-items-center mb-4">
                            <div class="w-100">
                                <!-- <form class="pl-lg-2" action="<?php echo e(url('contact')); ?>" method="post" id="contactform">
                                    <?php echo e(csrf_field()); ?>

                                    <h4 class="ls-m font-weight-bold">Let’s Connect</h4>

                                    <p>Your email address will not be published. Required fields are marked *</p>

                                    <div class="row mb-2">
                                        <div class="col-md-6 mb-4">
                                            <input class="form-control" type="text" name="name" id="name" placeholder="Name *" required>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone *" required>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Email *" required>
                                        </div>
                                        <div class="col-12 mb-4">
                                                <textarea class="form-control" name="message" id="message"  placeholder="Comment*" required></textarea>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="g-recaptcha" data-sitekey="6Lf2bzAiAAAAAO0QK56jVIaVfRtRJe3Udm25x_Jz" data-callback='onSubmit' data-action='submit'></div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark btn-rounded">Post Comment<i class="d-icon-arrow-right"></i></button>
                                </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End About Section-->

            <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
            <div class="grey-section google-map" id="googlemaps" style="height: 386px">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7534.650783364114!2d72.84867577262675!3d19.22464557858002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b0d6397aaaab%3A0xaa618f8f2a898c02!2sAnkita%20Pest%20Control%20Services!5e0!3m2!1sen!2sin!4v1654774141074!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <!-- End Map Section -->
        </div>

    </main>
</div>
<!-- End Main -->
<?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <script src="https://www.google.com/recaptcha/api.js"></script>
 <script>
     function onSubmit(token) {
         document.getElementById("contactform").submit();
       }
 </script>
<script src="<?php echo e(asset('https://maps.googleapis.com/maps/api/js?key=')); ?>"></script>
<script>

    /*
     Map Settings

     Find the Latitude and Longitude of your address:
     - https://www.latlong.net/
     - http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

     */

    // Map Markers
    var mapMarkers = [{
        address: "New York, NY 10017",
        html: "<strong>New York Office<\/strong><br>New York, NY 10017",
        popup: true
    }];

    // Map Initial Location
    var initLatitude = 40.75198;
    var initLongitude = -73.96978;

    // Map Extended Settings
    var mapSettings = {
        controls: {
            draggable: !window.Riode.isMobile,
            panControl: true,
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            streetViewControl: true,
            overviewMapControl: true
        },
        scrollwheel: false,
        markers: mapMarkers,
        latitude: initLatitude,
        longitude: initLongitude,
        zoom: 11
    };

    var map = $('#googlemaps').gMap(mapSettings);

    // Map text-center At
    var mapCenterAt = function (options, e) {
        e.preventDefault();
        $('#googlemaps').gMap("centerAt", options);
    }

</script>

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

    $(function () {

        $("#contactform").validate({
            rules: {
                name: {lettersonly: true, required: true},
                email: {required: true, email: true, emailvalidate: true},
                phone: {minlength: 10, maxlength: 10, number: true, required: true},
                message: {
                    required: true
                }
            },
            messages: {
                name: {required: "Name is required."},
                email: {
                    required: "Email is required.",
                    email: "Invalid formate.",
                    emailvalidate: "Invalid formate."
                },
                phone: {
                    minlength: "Please Enter valid 10 digit mobile number",
                    maxlength: "Please Enter valid 10 digit mobile number",
                    required: "Mobile number is required."
                },
                message: {required: "Message is required"},


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
