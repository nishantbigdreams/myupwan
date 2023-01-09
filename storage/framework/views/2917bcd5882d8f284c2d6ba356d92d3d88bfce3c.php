<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<style type="text/css">
    .mb-4{
        text-align: center;
    }
    /*.icon-box-icon img{
        height: 75px!important;
    }*/
    /*.icon-box-icon{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }*/
    .card {
      text-align:center;
      background: #68b7231f;
      box-shadow: 1px 1px 1px grey;
      -webkit-transition:  box-shadow .6s ease-out;
         box-shadow: .8px .9px 6px grey;
      padding: 35px;
      border-radius: 30px;
    }
    .card:hover{ 
         box-shadow: 1px 8px 20px grey;
        -webkit-transition:  box-shadow .6s ease-in;
    }
    .contact-section h4{
        color: #68b723!important;
    }
</style>
<body class="contact-us">

    <div class="page-wrapper">
        <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- End Header -->
        <main class="main">
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="index.php"><i class="d-icon-home"></i></a></li>
                        <li>Subscription</li>
                    </ul>
                </div>
            </nav>
            <div class="page-header" style="background-image: url(/images/page-header/banner-subs.jpg)">
                <h1 class="page-title font-weight-bold text-capitalize ls-l">Plants Subscription</h1>
            </div>
            <div class="page-content mt-10">
                <section class="pt-2 pb-4">
                    <div class="container">
                        <h4 class="text-center" style="color: #68b723;">Hey plantaholic! On the road to buy more plants??</h4>
                        <p class="text-center">Sow today, nurture tomorrow and relish all your life! Our subscription plan is specially designed to glide you across whether you are a new or a seasoned plant parent. It is carefully mapped out with selected plants that thrive in a variety of conditions. You can never have too many plants, so…</p>
                        <h5 class="text-center">You and me – mint to be together!</h5>
                    </div>
                </section>
                <section class="contact-section">
                    <div class="container">
                        <div class="row" style="justify-content: center;">
                            <div class="col-lg-12 col-md-12 col-sm-12 ls-m mb-4">
                                <div class="d-flex align-items-center card">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <h4 class="mb-2 text-capitalize">Subscription Plan</h4>
                                        <img src="images/icons/icon5.png" style="width: 25%;">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">    
                                        <h4 class="mb-2 text-capitalize">Take Advantage</h4>
                                        <p>
                                            6 plants of your choice each month for two months. Totalling to a pleasure of 12 plants for you to care for.<br>
                                            Let the good plants roll! 
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">    
                                        <h4 class="mb-2 text-capitalize">₹ 3600</h4>
                                        <div class="row justify-content-center">   

                                            <?php if(Auth::user()): ?>
                                            <a href="<?php echo e(url('subs_checkout/3600')); ?>"  class="btn btn-success btn-shadow-lg btn-ellipse btn-block subs-btn">Buy Now</a>
                                            <?php else: ?>
                                            <a href="<?php echo e(url('/postLogin')); ?>" class="btn btn-success btn-shadow-lg btn-ellipse btn-block subs-btn">Buy Now</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="mb-10 pt-10">
                    <div class="container">
                        <h2 class="title title-center mb-10 title-underline justify-content-center text-center">How it works</h2>
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
                                        <img src="images/icons/icon1.png">
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Step One</h4>
                                        <p>Add the well-thought-out subscription plan to your cart</p>
                                    </div>
                                </div>
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <img src="images/icons/icon2.png">
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Step Two</h4>
                                        <p>Check-out and we will get your happiness delivered in a jiffy</p>
                                    </div>
                                </div>
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <img src="images/icons/icon3.png">
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Step Three</h4>
                                        <p>Buckleup to receive your bundles of joy, simply follow the care chart </p>
                                    </div>
                                </div>
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <img src="images/icons/icon4.png">
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Step Four</h4>
                                        <p>Sow – Nurture – Flaunt your own garden. </p>
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
