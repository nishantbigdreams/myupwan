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
                                    <img src="images/gift2.jpg" alt="intro-banner" width="1903"
                                        height="530" style="background-color: #f6f6f6;" />
                                </figure>
                                <div class="container">
                                    <div class="banner-content banner-content2 y-50">
                                        <h2 class="banner-title slide-animate"
                                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}" style="margin-bottom: 2.2rem!important; color: #fff!important;">
                                            Green gifts to let your bonds grow</h2>
                                            <h4 class="banner-subtitle mb-4 slide-animate fadeInRightShorter show-content" data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.2s'}" style="animation-duration: 1s; color: #fff; margin-bottom: 5rem!important">Let your love bloom with green gifts / Green Gifts - Let your love bloom</h4>
                                        <!-- <a href="product.php" class="btn btn-dark btn-rounded slide-animate"
                                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}">Shop
                                            Now<i class="d-icon-arrow-right"></i></a> -->
                                    </div>
                                </div>
                            </div>
                    </div>            
                </section>
            <div class="page-content mt-10 pt-7"> 
                <section class="customer-section pb-10 appear-animate" style="padding-top: 50px;">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7 mb-4">
                                <figure>
                                    <img src="images/corporate.jpg" alt="Happy Customer" width="580"
                                        height="507" class="banner-radius" style="background-color: #BDD0DE;" />
                                </figure>
                            </div>
                            <div class="col-md-5">
                                <h3 class="section-title lh-1 font-weight-bold">Corporate Gifting</h3>
                                <p class="section-desc text-grey">Plants are synonymous with growth and prosperity. Gift new employees a warm welcome, express appreciation to valued clients, or simply recognize your team’s hard work – with the gift that keeps on growing and reflects your trust. We have excellent curated options for all your corporate gifting requirements.</p>
                            </div>
                        </div>
                    </div>
                </section>  
                <section class="customer-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h3 class="section-title lh-1 font-weight-bold">Personalised Gifts</h3>
                                <p class="section-desc text-grey">Plants symbolize <b>emotions, ideas, and actions.</b> Every plant has its own meaning, from love to hope, from good Luck to new beginnings. Based on this symbolism, you can choose plants to gift and make the moment exclusive and special. You can also personalise plant gifts based on this symbolism. For example, hardy succulents are usually chosen as gifts for someone who’s trustworthy, and always there for you.</p>
                                <p>We have a plant for every lifestyle, every personality, and every expression - and we are here to deliver it safely to the doorstep you choose with the packaging of your choice.</p>
                            </div>
                            <div class="col-md-7 mb-4">
                                <figure>
                                    <img src="images/personalized.jpg" alt="Happy Customer" width="580"
                                        height="507" class="banner-radius" style="background-color: #BDD0DE;" />
                                </figure>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="customer-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7 mb-4">
                                <figure>
                                    <img src="images/happy-gift.jpg" alt="Happy Customer" width="580"
                                        height="507" class="banner-radius" style="background-color: #BDD0DE;" />
                                </figure>
                            </div>
                            <div class="col-md-5">
                                <h3 class="section-title lh-1 font-weight-bold">Happy Gift Ideas</h3>
                                <p class="section-desc text-grey">When you gift a plant, you are sending years of beauty, companionship, and care. Gifting plants is a wonderful way of expressing your emotions. Having these green beauties around the house reminds you to slow down, enjoy nature and stay positive. By gifting greens, we gift peace and tranquillity to our loved ones. They add life and freshness to our environment. Most indoor plants are air purifying and hence, make for healthy gifts too. Plants around the home or office are a treat to tired eyes and make for exquisite decor pieces.</p>
                                <p>Plants make excellent <b>anniversary gifts, housewarming gifts, wedding gifts, </b>and gifts for him and her.</p>
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