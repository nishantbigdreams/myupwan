@include('_partials.website.header')
<body>

    <div class="page-wrapper">
        @include('_partials.website.navbar')
        <!-- End Header -->
        <main class="main">
            <div class="page-header"
                style="background-image: url('images/page-header/about-us.jpg'); background-color: #3C63A4;">
                <h1 class="page-title">Plants Care</h1>
                <ul class="breadcrumb">
                    <li><a href="{{url('/') }}"><i class="d-icon-home"></i></a></li>
                    <li class="delimiter">/</li>
                    <li>Plants Care</li>
                </ul>
            </div>
            <!-- End PageHeader -->
            <div class="page-content">
                <div class="container">
                    <section class="mt-10 pt-8">
                        <h2 class="title title-center">Category 1</h2>
                        <div class="code-template">
                            <div class="row product-wrapper">
                                <div class="col-md-3 col-6">
                                    @foreach($freshproducts as $vegetable)
                                    <div class="product shadow-media code-content">
                                        <figure class="product-media">
                                            <a href="#">
                                                <img src="{{ featuredImage($vegetable) }}" alt="product" width="300"
                                                height="338">
                                                <img src="images/product/indoor1-1.jpg" alt="product" width="300"
                                                height="338">
                                            </a>
                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-cart" title="Select Options">
                                                    <i class="d-icon-bag"></i>
                                                </a>
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                                                    class="d-icon-heart"></i></a>
                                                </div>
                                                <div class="product-action">
                                                    <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                                    View</a>
                                                </div>
                                        </figure>
                                        <div class="product-details">
                                            <a href="#" class="btn-wishlist" title="Add to wishlist"><i
                                                class="d-icon-heart"></i></a>
                                                <h3 class="product-name">
                                                    <a href="#">{{$vegetable->name}}</a>
                                                </h3>
                                                <div class="product-price">
                                                    <ins class="new-price">₹{{$vegetable->sell_price}}</ins>
                                                    <del class="old-price">₹{{$vegetable->base_price}}</del>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width:40%"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="#" class="rating-reviews">( 3 reviews )</a>
                                                </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="mt-8">
                        <h2 class="title title-center">Category 2</h2>
                        <div class="code-template">
                            <div class="row product-wrapper">
                                <div class="col-md-3 col-6">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="#">
                                                <img src="images/product/indoor1.jpg" alt="product" width="300"
                                                height="338">
                                                <img src="images/product/indoor1-1.jpg" alt="product" width="300"
                                                height="338">
                                            </a>
                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-cart" title="Select Options">
                                                    <i class="d-icon-bag"></i>
                                                </a>
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                                                    class="d-icon-heart"></i></a>
                                                </div>
                                                <div class="product-action">
                                                    <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                                    View</a>
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-name">
                                                    <a href="#">Home Decor Plants</a>
                                                </h3>
                                                <div class="product-price">
                                                    <span class="price">₹499.00</span>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width:40%"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="#" class="rating-reviews">( 3 reviews )</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <section class="customer-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7 mb-4">
                                <figure>
                                    <img src="{{asset('images/subpages/customer.jpg')}}" alt="Happy Customer" width="580"
                                        height="507" class="banner-radius" style="background-color: #BDD0DE;" />
                                </figure>
                            </div>
                            <div class="col-md-5 mb-4">
                                <!-- <h5 class="section-subtitle lh-2 ls-md font-weight-normal">01. Happy Customer</h5> -->
                                <h3 class="section-title lh-1 font-weight-bold">01. What We Do</h3>
                                <p class="section-desc text-grey">We create green spaces, both indoors and outdoors. We are here to make the concrete jungle, we call home, a greener and more sustainable space through customized gardening solutions. Through our Own Grown Farms initiative we convert open urban spaces into food gardens to lower food miles and promote community gardening values. In the last five years we have worked towards neutralizing over 400 tonnes of carbon.</p>
                                <a href="#" class="btn btn-dark btn-link btn-underline ls-m">Visit Our Store<i
                                        class="d-icon-arrow-right"></i></a>
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