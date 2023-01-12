@include('_partials.website.header')
<link rel="stylesheet" type="text/css" href="css/style.min.css">
<style type="text/css">
    .mb-4{
        text-align: center;
    }
    .banner-content2{
        left: 32%!important;
    }
    .row>*{
        position: relative;
        width: 100%;
        padding-right: 10px;
        padding-left: 10px;
    }
    .owl-item{
        width: 1349px!important;
        height: 500px!important;
    }
    @media (max-width: 600px){
      .banner-content2{
        left: 4%!important;
    }  
    }
</style>
<body class="contact-us">

    <div class="page-wrapper">
        @include('_partials.website.nav')
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
                                    <img src="images/offer2.jpg" alt="intro-banner" width="1903"
                                        height="530" style="background-color: #f6f6f6;" />
                                </figure>
                                <div class="container">
                                    <div class="banner-content banner-content2 y-50">
                                        <h2 class="banner-title slide-animate"
                                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}" style="margin-bottom: 11.2rem!important; color: #fff;">
                                            Our Special Offer</h2>
                                        <!-- <a href="product.php" class="btn btn-dark btn-rounded slide-animate"
                                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}">Shop
                                            Now<i class="d-icon-arrow-right"></i></a> -->
                                    </div>
                                </div>
                            </div>
                    </div>            
                </section>
            <div class="page-content mt-10 pt-7">
                <div class="container pt-4 mt-10 mb-10 appear-animate"
                    data-animation-options="{'name': 'fadeIn', 'delay': '.3s'}">
                    <h2 class="title title-underline text-center mb-7">Top Categories On Sale</h2>
                    <div class="row gutter-md category-grid">
                        <div class="height-x1">
                            <div class="category category-banner category-absolute overlay-light overlay-zoom text-white">
                                <a href="#">
                                    <figure class="category-media">
                                        <img src="images/categories/cate1.jpg" alt="category" width="280"
                                            height="250" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Low Maintenance</h4>
                                    <!-- <span class="category-count">
                                        <span>3</span> Products
                                    </span> -->
                                    <a href="{{url('/')}}/category/Low Maintenance" class="btn btn-underline btn-link btn-white">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="height-x1">
                            <div class="category category-banner category-absolute overlay-light overlay-zoom text-white">
                                <a href="#">
                                    <figure class="category-media">
                                        <img src="images/categories/cate2.jpg" alt="category" width="280"
                                            height="250" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Indoor Plants</h4>
                                    <a href="{{url('/')}}/category/Indoor Plants" class="btn btn-underline btn-link btn-white">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="height-x1">
                            <div class="category category-banner category-absolute overlay-light overlay-zoom text-white">
                                <a href="#">
                                    <figure class="category-media">
                                        <img src="images/categories/cate4.jpg" alt="category" width="280"
                                            height="250" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Cacti and Succulents</h4>
                                    <a href="{{url('/')}}/category/Flower Plants" class="btn btn-underline btn-link btn-white">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="height-x1">
                            <div class="category category-banner category-absolute overlay-light overlay-zoom text-white">
                                <a href="#">
                                    <figure class="category-media">
                                        <img src="images/categories/cate5.jpg" alt="category" width="280"
                                            height="250" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">Air Purifying</h4>
                                    <a href="{{url('/')}}/category/Air Purifier Plants" class="btn btn-underline btn-link btn-white">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <section class="customer-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h3 class="section-title lh-1 font-weight-bold">Exquisite Planters</h3>
                                <p class="section-desc text-grey">These planters speak volumes. Pick from a delicately chosen range of planters of concrete, ceramic and metallic planters.</p>
                            </div>
                            <div class="col-md-7 mb-4">
                                <figure>
                                    <img src="images/gift1.jpg" alt="Happy Customer" width="580"
                                        height="507" class="banner-radius" style="background-color: #BDD0DE;" />
                                </figure>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="customer-section pb-10 appear-animate" style="padding-top: 50px;">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7 mb-4">
                                <figure>
                                    <img src="images/offer.jpg" alt="Happy Customer" width="580"
                                        height="507" class="banner-radius" style="background-color: #BDD0DE;" />
                                </figure>
                            </div>
                            <div class="col-md-5">
                                <h3 class="section-title lh-1 font-weight-bold">Sensational Plants</h3>
                                <p class="section-desc text-grey">What better way to upgrade your lives? Live and feel better with our wide range of plants.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </main>
        <!-- End Main -->
        @include('_partials.website.footer')
</body>

</html>