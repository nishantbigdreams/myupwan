<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="css/style.min.css">
<style type="text/css">
    .mb-4{
        text-align: center;
    }
    .banner-content2{
        left: 32%!important;
    }
    @media (max-width: 600px){
      .banner-content2{
        left: 4%!important;
    }  
    }
</style>
<body class="contact-us">

    <div class="page-wrapper">
        <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- End Header -->
        <main class="main">
                <section class="intro-section">
                    <div class="owl-carousel owl-theme row owl-nav-fade intro-slider animation-slider cols-1 gutter-no"
                            data-owl-options="{
                            'nav': false,
                            'dots': false,
                            'loop': false,
                            'items': 1,
                            'autoplay': false,
                            'autoplayTimeout': 8000,
                            'responsive': {
                                '992': {
                                    'nav': true
                                }
                            }
                        }">
                            <div class="intro-slide1 banner banner-fixed" style="background-color: #f6f6f6;">
                                <figure>
                                    <img src="images/banner3.jpg" alt="intro-banner" width="1903"
                                        height="530" style="background-color: #f6f6f6;" />
                                </figure>
                                <div class="container">
                                    <div class="banner-content banner-content2 y-50">
                                        <h2 class="banner-title slide-animate"
                                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}">
                                            Own Grown Farms</h2>
                                        <!-- <a href="product.php" class="btn btn-dark btn-rounded slide-animate"
                                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}">Shop
                                            Now<i class="d-icon-arrow-right"></i></a> -->
                                    </div>
                                </div>
                            </div>
                    </div>
                </section>
            <div class="page-content pt-7">  
                <section class="customer-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <h3 class="section-title lh-1 font-weight-bold">Why Own Grown</h3>
                                <p class="section-desc text-grey">Own Grown is an initiative of My Upavan. to promote urban farming and establish sustainability as an integral part of city life. A team of highly driven young professionals who are dedicated to promoting green living and in all aspects of life be it food or home. We are always on the lookout for better practices, technologies, and ways to improve our knowledge base to make the experience better for you. The aim is to normalize growing our own food and make gainful use of every square meter of unused real estate for better taste and health, reducing the carbon footprint of food transportation and reducing the growing strain on the global food network.</p>
                            </div>
                        </div>
                    </div>
                </section>  
                <section class="customer-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h3 class="section-title lh-1 font-weight-bold">Local, Organic, and Fresh</h3>
                                <p class="section-desc text-grey">We have embarked on a journey to promote healthier and more sustainable urban living with our state-of-the-art urban farms. Our organic farms are set up in both residential and commercial spaces and cared for by farming experts to ensure plentiful produce of the best quality. The produce is harvested when you place the order and reaches your doorstep in the least time - thus preserving the freshness and nutrient value of your food – a true farm to fork experience.</p>
                            </div>
                            <div class="col-md-7 mb-4">
                                <figure>
                                    <img src="images/subpages/customer.jpg" alt="Happy Customer" width="580"
                                        height="507" class="banner-radius" style="background-color: #BDD0DE;" />
                                </figure>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="banner parallax mt-10 appear-animate" style="background-color: #1d1e20"
                    data-parallax-options="{'speed':2.5,'parallaxHeight':'150%','offset':-30}"
                    data-image-src="images/banner2.jpg">
                    <div class="container">
                        <div class="banner-content appear-animate" data-animation-options="{
                            'name': 'blurIn'
                        }">
                            <h4 class="banner-subtitle text-uppercase text-primary slide-animate"
                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.2s'}">
                                Flash 50% Off
                            </h4>
                            <h2 class="banner-title slide-animate font-weight-bold"
                                data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}">
                                Buy Fresh & Organic</h2>
                                <p>Order now to get freshly harvested veggies right at your doorstep</p>
                            <a href="product.php"
                                class="btn btn-white btn-icon-right btn-rounded slide-animate"
                                data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}">Shop
                                Now<i class="d-icon-arrow-right"></i></a>
                        </div>
                    </div>
                </section>
                <section class="mt-10 pt-4 mb-10 pb-4">
                    <div class="container">
                        <h2 class="title title-center mb-5">Why buy our produce</h2>
                        <div class="code-template">
                            <div class="owl-carousel owl-theme row cols-lg-4 cols-md-3 cols-sm-2 cols-1"
                                data-owl-options="{
                                'nav': false,
                                'dots': true,
                                'loop': false,
                                'margin': 20,
                                'responsive': {
                                    '0': {
                                        'items': 1
                                    },
                                    '576': {
                                        'items': 2
                                    },
                                    '768': {
                                        'items': 3
                                    },
                                    '992': {
                                        'items': 4,
                                        'dots': false
                                    }
                                }
                            }">
                                <div class="icon-box text-center code-content">
                                    <span class="icon-box-icon">
                                        <i class="d-icon-layer"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Fresh and Healthy</h4>
                                        <p>Freshly harvested and packed with the best nutrients</p>
                                    </div>
                                </div>
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <i class="d-icon-database"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Guaranteed Quality</h4>
                                        <p>Premium quality seeds and the best growing medium</p>
                                    </div>
                                </div>
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <i class="d-icon-alert"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">100% Organic</h4>
                                        <p>Organic fertilizers that ensure a healthier yield</p>
                                    </div>
                                </div>
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <i class="d-icon-shoppingbag"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Professional Care</h4>
                                        <p>Produce is grown and harvested by local experts</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </main>
        <!-- End Main -->
        <?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>

</html>