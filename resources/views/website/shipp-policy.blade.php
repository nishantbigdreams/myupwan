@include('_partials.website.header')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.min.css')}}">
<body class="about-us">

    <div class="page-wrapper">
        @include('_partials.website.nav')
        <!-- End Header -->
        <main class="main">
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/') }}"><i class="d-icon-home"></i></a></li>
                        <li>Shipping Policy</li>
                    </ul>
                </div>
            </nav>
            <div class="page-header pl-4 pr-4" style="background-image: url(images/page-header/about-us.jpg)">
                <h1 class="page-title font-weight-bold lh-1 text-white text-capitalize">Shipping & Return Policy</h1>
            </div>
            <div class="page-content mt-10 pt-10">
                <section class="about-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 mb-10 mb-lg-4">
                                <h5 class="section-subtitle lh-2 ls-md font-weight-normal">All orders are dispatched within 7- 8 working days. Most orders are delivered within 9-10 working days from the date of placing the order. </h5>
                                <h3 class="section-title lh-1 font-weight-bold mt-10">Return Policy</h3>
                                <p class="section-desc">My Upavan does not accept returns as this could lead to the plant getting damaged in the two-way transit process. However, we promise to deliver healthy, well-looked after, and great-looking plants. They may look a little worn out due to the transit but a few days in the sunshine and appropriate waterings will restore them to their original glory.</p>
                                <p>If at any time, you have questions regarding your plant health, you can count on us for support.</p>
                                <p class="section-desc">If you are worried about the plant health, we have your back. Just contact our support team:</p>
                                <ul>
                                	<li>Email Us: <a href="mail:myupavan@gmail.com">myupavan@gmail.com</a></li>
                                	<li>Call our team at: <a href="tel:9619049996"> +91 961 904 9996</a></li>
                                </ul>
                                <h3 class="section-title lh-1 font-weight-bold mt-10">Easy refunds or replacement</h3>
                                <p class="section-desc">Refunds or replacements are possible if you receive the plant in a damaged condition, or receive the wrong product. Within 3 days of the delivery, the customer needs to write to us at myupavan@gmail.com or reach us at 9619049996.</p>
                                <h3 class="section-title lh-1 font-weight-bold mt-10">Return of non-plant products</h3>
                                <p class="section-desc">You can return non-plant products within 1 week if they reach you in a damaged state or if you happen to receive the wrong product, conditional to the product being unused or unopened.</p>
                                <h3 class="section-title lh-1 font-weight-bold mt-10">Review/feedback section</h3>
                                <p class="section-desc">Our customers are at the centre of everything we do and we welcome feedback as it helps us improve. However, once sent by you, we hold the discretion to share the feedback/review on our website or any other digital platform.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End About Section-->
            </div>
        </main>
        <!-- End Main -->
        @include('_partials.website.footer')
        <script src="{{asset('vendor/jquery.count-to/jquery-numerator.min.js')}}"></script>
</body>

</html>