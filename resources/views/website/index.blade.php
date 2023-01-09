@include('_partials.website.header')
<body class="home">

    <div class="page-wrapper">
        <h1 class="d-none">Welcome to My Upavan website</h1>
        @include('_partials.website.nav')
        <!-- End Header -->
        <main class="main">
            <div class="page-content">
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
                    <?php $i=1; ?>
                    @foreach($slider as $sliderdata)

                    <?php if($i%2 == 0){ ?>
                        <div class="intro-slide1 banner banner-fixed" style="background-color: #f6f6f6;">
                            <figure>
                                <img src="{{url('public/sliderimg/'.$sliderdata->image)}}" alt="intro-banner"
                                width="1903"
                                height="530" style="background-color: #f6f6f6; height: 530px; width: 1903px"/>
                            </figure>
                            <div class="container">
                                <div class="banner-content y-50">
                                    <h4 class="banner-subtitle mb-4 slide-animate"
                                    data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.2s'}">
                                    {{$sliderdata->text_1}}
                                </h4>

                                <h2 class="banner-title slide-animate"
                                data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}">
                                {{$sliderdata->text_2}}</h2>
                                <a href="{{url('/')}}/category/Popular 2022" class="btn btn-dark btn-rounded slide-animate"
                                data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}">Shop
                                Now<i class="d-icon-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php } else{ ?>
                    <div class="banner banner-fixed intro-slide2" style="background-color: #f6f6f6;">
                        <figure>
                            <img src="{{url('public/sliderimg/'.$sliderdata->image)}}" alt="intro-banner"
                            width="1903"
                            height="530" style="background-color: #f6f6f6; height: 530px; width: 1903px"/>
                        </figure>
                        <div class="container">
                            <div class="banner-content y-50">
                                <h4 class="banner-subtitle mb-4 slide-animate"
                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.2s'}">
                                {{$sliderdata->text_1}}
                            </h4>

                            <h2 class="banner-title slide-animate"
                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}">
                            {{$sliderdata->text_2}}</h2>
                            <a href="{{url('/')}}/category/Popular 2022" class="btn btn-dark btn-rounded slide-animate"
                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}">Shop
                            Now<i class="d-icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php } $i++;?>
            @endforeach
        </div>
    </section>

    <section class="service-section mt-6">
        <div class="container appear-animate">
            <div class="service-list">
                <div class="service-carousel owl-carousel owl-theme row cols-lg-3 cols-sm-2 cols-1"
                data-owl-options="{
                    'items': 3,
                    'nav': false,
                    'dots': false,
                    'loop': true,
                    'autoplay': true,
                    'autoplayTimeout': 4000,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '576': {
                            'items': 2
                        },
                        '768': {
                            'items': 3,
                            'loop': false
                        }
                    }
                }">
                <div class="icon-box icon-box-side icon-box1 appear-animate" data-animation-options="{
                    'name': 'fadeInRightShorter',
                    'delay': '.3s'
                }">
                <i class="icon-box-icon d-icon-truck mr-0 mr-lg-3" style="font-size: 46px;"></i>

                <div class="icon-box-content">
                    <h4 class="icon-box-title">Free Shipping &amp;
                        Return
                    </h4>

                    <p class="mb-0">Free shipping on orders over ₹999</p>
                </div>
            </div>

            <div class="icon-box icon-box-side icon-box2 appear-animate" data-animation-options="{
                'name': 'fadeInRightShorter',
                'delay': '.4s'
            }">
            <i class="icon-box-icon d-icon-service mr-0 mr-lg-3"></i>

            <div class="icon-box-content">
                <h4 class="icon-box-title">Customer Support 24/7
                </h4>

                <p class="mb-0">Instant access to perfect support</p>
            </div>
        </div>

        <div class="icon-box icon-box-side icon-box3 appear-animate" data-animation-options="{
            'name': 'fadeInRightShorter',
            'delay': '.5s'
        }">
        <i class="icon-box-icon d-icon-secure mr-0 mr-lg-3"></i>

        <div class="icon-box-content">
            <h4 class="icon-box-title">100% Secure Payment
            </h4>

            <p class="mb-0">We ensure secure payment!</p>
        </div>
    </div>
</div>
</div>
</div>
</section>
<div class="container pt-8 mt-10 appear-animate"
data-animation-options="{'name': 'fadeInUpShorter', 'delay': '.3s'}">
<h2 class="title title-underline text-center">Our Best Sellers</h2>

<div class="owl-carousel owl-theme row cols-lg-4 cols-md-3 cols-2" data-owl-options="{
    'items': 4,
    'nav': false,
    'dots': false,
    'margin': 20,
    'loop': false,
    'responsive': {
        '0': {
            'items': 2
        },
        '768': {
            'items': 3
        },
        '992': {
            'items': 4
        }
    }
}">
@foreach($freshproducts as $product)
<div class="product text-center">
    <figure class="product-media">
        <a href="{{url('product/'.$product->category.'/'.$product->sku.'/'.$product->id)}}">
            <img src="{{ featuredImage($product) }}" class="custom-product-img" alt="product"
            width="300" height="338">
            <img src="{{ featuredImage2($product) }}" class="custom-product-img" alt="product"
            width="300" height="338">
        </a>

        <div class="product-action-vertical">
            <input type="hidden" id="quantity" name="quantity" value="1">
            <input type="hidden" id="pid" name="pid" value={{$product->id}}>
            <a class="btn-product-icon btn-cart addtocartbtn" id="addtocartbtn1"
            data-id="{{$product->id}}" title="Select Options"><i class="d-icon-bag"></i></a>
            @php
            $rowId = isProductInWishlist($product);
            @endphp
            @if(!auth::user())
            <a href="{{url('postLogin')}}" class="btn-product-icon btn-wishlist1"
            title="Add to wishlist"><i class="d-icon-heart"></i></a>
            @endif

            @if(auth::user())
            @if($product->wish_list == 0)
            <a href="#" class="btn-product-icon btn-wishlist" data-rowid="{{$rowId}}"
            data-pid="{{$product->id}}" id="wishlist" title="Add to wishlist"><i
            class="d-icon-heart"></i></a>
            @else
            <a href="{{url('mywishlist')}}" class="btn-product-icon btn-wishlist1 added"
            title="Remove from wishlist"><i class="d-icon-heart-full"></i></a>
            @endif
            @endif
        </div>
                                <!-- <div class="product-action">
                                    <a href="#" class="btn-product btn-quickview" title="Quick View">QuickView</a>
                                </div> -->
                            </figure>
                            <div class="product-details">
                                <h3 class="product-name">
                                    <a href="{{url('product/'.$product->category.'/'.$product->sku.'/'.$product->id)}}">{{$product->name}}</a>
                                </h3>

                                <div class="product-price">
                                    <span class="price">₹{{$product->sell_price}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="container pt-4 mt-10 appear-animate"
                data-animation-options="{'name': 'fadeIn', 'delay': '.3s'}">
                <h2 class="title title-underline text-center mb-7">Popular Categories</h2>

                <div class="row gutter-md category-grid">
                    <div class="height-x1">
                        <div class="category category-banner category-absolute overlay-light overlay-zoom text-white">
                            <a href="{{url('/')}}/category/Low Maintenance">
                                <figure class="category-media">
                                    <img src="images/categories/cate1.jpg" alt="category" width="280"
                                    height="250"/>
                                </figure>
                            </a>

                            <div class="category-content">
                                <h4 class="category-name">Low Maintenance</h4>
                                <a href="{{url('/')}}/category/Low Maintenance" class="btn btn-underline btn-link btn-white">Shop
                                Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="height-x1 w-2">
                        <div class="category category-banner category-absolute overlay-dark overlay-zoom">
                            <a href="{{url('/')}}/category/Indoor Plants">
                                <figure class="category-media">
                                    <img src="images/categories/cate2.jpg" alt="category" width="480"
                                    height="250"/>
                                </figure>
                            </a>

                            <div class="category-content">
                                <h4 class="category-name">Indoor Plants</h4>
                                <a href="{{url('/')}}/category/Indoor Plants" class="btn btn-underline btn-link">Shop
                                Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="height-x2">
                        <div class="category category-banner category-absolute overlay-light overlay-zoom text-white">
                            <a href="{{url('/')}}/category/Flower Plants">
                                <figure class="category-media">
                                    <img src="images/categories/cate3.jpg" alt="category" width="380"
                                    height="250"/>
                                </figure>
                            </a>

                            <div class="category-content">
                                <h4 class="category-name">Flower Plants</h4>
                                <a href="{{url('/')}}/category/Flower Plants"
                                class="btn btn-underline btn-link btn-white">Shop
                            Now</a>
                        </div>
                    </div>
                </div>
                <div class="height-x1 w-2">
                    <div class="category category-banner category-absolute overlay-dark overlay-zoom">
                        <a href="{{url('/')}}/category/Cacti and Succulents">
                            <figure class="category-media">
                                <img src="images/categories/cate4.jpg" alt="category" width="480"
                                height="250"/>
                            </figure>
                        </a>

                        <div class="category-content">
                            <h4 class="category-name">Cacti and Succulents</h4>
                            <a href="{{url('/')}}/category/Cacti and Succulents" class="btn btn-underline btn-link">Shop
                            Now</a>
                        </div>
                    </div>
                </div>
                <div class="height-x1">
                    <div class="category category-banner category-absolute overlay-light overlay-zoom text-white">
                        <a href="{{url('/')}}/category/Air Purifier Plants">
                            <figure class="category-media">
                                <img src="images/categories/cate5.jpg" alt="category" width="280"
                                height="250"/>
                            </figure>
                        </a>

                        <div class="category-content">
                            <h4 class="category-name">Air Purifying</h4>
                            <a href="{{url('/')}}/category/Air Purifier Plants"
                            class="btn btn-underline btn-link btn-white">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt-6 mt-10 text-center appear-animate"
        data-animation-options="{'name': 'fadeIn', 'delay': '.3s'}">
        <h2 class="title title-underline text-center">Recent Arrivals</h2>

        <div class="owl-carousel owl-theme row cols-lg-4 cols-md-3 cols-2 mb-5" data-owl-options="{
            'items': 4,
            'nav': false,
            'dots': false,
            'margin': 20,
            'loop': true,
            'autoplay': true,
            'autoplayTimeout': 4000,
            'responsive': {
                '0': {
                    'items': 2
                },
                '768': {
                    'items': 3
                },
                '992': {
                    'items': 4
                }
            }
        }">
        @foreach($recentarrival as $product)

        <div class="product text-center">
            <figure class="product-media">
                <a href="{{url('product/'.$product->category.'/'.$product->sku.'/'.$product->id)}}">
                    <img src="{{ featuredImage($product) }}" class="custom-product-img" alt="product"
                    width="300" height="338">
                    <img src="{{ featuredImage2($product) }}" class="custom-product-img" alt="product"
                    width="300"
                    height="338">
                </a>

                <div class="product-action-vertical">
                    <input type="hidden" id="quantity" name="quantity" value="1">
                    <input type="hidden" id="pid" name="pid" value={{$product->id}}>
                    <a class="btn-product-icon btn-cart addtocartbtn1" id="addtocartbtn1"
                    data-id="{{$product->id}}" title="Select Options"><i class="d-icon-bag"></i></a>
                    @php
                    $rowId = isProductInWishlist($product);
                    @endphp
                    @if(!auth::user())
                    <a href="{{url('postLogin')}}" class="btn-product-icon btn-wishlist1"
                    title="Add to wishlist"><i class="d-icon-heart"></i></a>
                    @endif

                    @if(auth::user())
                    @if($product->wish_list == 0)
                    <a href="#" class="btn-product-icon btn-wishlist wishlist1"
                    data-rowid="{{$rowId}}" data-pid="{{$product->id}}" id="wishlist1"
                    title="Add to wishlist"><i class="d-icon-heart"></i></a>
                    @else
                    <a href="{{url('mywishlist')}}" class="btn-product-icon btn-wishlist1 added"
                    title="Remove from wishlist"><i class="d-icon-heart-full"></i></a>
                    @endif
                    @endif
                </div>
                                <!-- <div class="product-action">
                                    <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                        View</a>
                                    </div> -->
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-name">
                                        <a href="{{url('product/'.$product->category.'/'.$product->sku.'/'.$product->id)}}">{{$product->name}}</a>
                                    </h3>

                                    <div class="product-price">
                                        <ins class="new-price">₹{{$product->sell_price}}</ins>
                                        {{--
                                        <del class="old-price">₹210.00</del>
                                        --}}
                                    </div>

                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <section class="ellipse-section container mt-10">
                        <h2 class="title title-underline text-center">Shop By Color</h2>
                        <div class="code-template">
                            <div class="owl-carousel owl-theme owl-shadow-carousel row cols-xl-5 cols-lg-4 cols-md-3 cols-xs-2 cols-1"
                            data-owl-options="{
                                'nav': false,
                                'dots': true,
                                'items': 5,
                                'margin':  20,
                                'loop': false,
                                'responsive': {
                                    '0': {
                                        'items': 1 
                                    },
                                    '480': {
                                        'items': 2
                                    },
                                    '768': {
                                        'items': 3
                                    },
                                    '992': {
                                        'items': 4
                                    },
                                    '1200': {
                                        'items': 5,
                                        'dots': false
                                    }
                                }
                            }">
                            <div class="category category-ellipse">
                                <a href="{{url('/')}}/category/Fusion Plant">
                                    <figure class="category-media">
                                        <img src="/images/categories/color-f.png" alt="category" width="196"
                                        height="196" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name"><a href="{{url('/')}}/category/Fusion Plant">Fusion Plants</a></h4>
                                </div>
                            </div>
                            <div class="category category-ellipse">
                                <a href="{{url('/')}}/category/Green Plant">
                                    <figure class="category-media">
                                        <img src="/images/categories/color-g.png" alt="category" width="196"
                                        height="196" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name"><a href="{{url('/')}}/category/Green Plant">Green Plants</a></h4>
                                </div>
                            </div>
                            <div class="category category-ellipse">
                                <a href="{{url('/')}}/category/Red Plant">
                                    <figure class="category-media">
                                        <img src="/images/categories/color-r.png" alt="category" width="196"
                                        height="196" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name"><a href="{{url('/')}}/category/Red Plant">Red Plants</a></h4>
                                </div>
                            </div>
                            <div class="category category-ellipse">
                                <a href="{{url('/')}}/category/Yellow Plant">
                                    <figure class="category-media">
                                        <img src="images/categories/color-y.png" alt="category" width="196"
                                        height="196" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name"><a href="{{url('/')}}/category/Yellow Plant">Yellow Plants</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="category category-ellipse">
                                <a href="{{url('/')}}/category/Pink Plant">
                                    <figure class="category-media">
                                        <img src="images/categories/color-p.png" alt="category" width="196"
                                        height="196" />
                                    </figure>
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name"><a href="{{url('/')}}/category/Pink Plant">Pink Plants</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="banner parallax mt-10 appear-animate" style="background-color: #1d1e20"data-parallax-options="{'speed':2.5,'parallaxHeight':'150%','offset':-30}" data-image-src="images/banner2.jpg">
                    <div class="container">
                        <div class="banner-content appear-animate" data-animation-options="{
                            'name': 'blurIn'
                        }">
                        <h4 class="banner-subtitle text-uppercase text-primary slide-animate"
                        data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.2s'}">
                        Download App Now
                    </h4>

                    <h2 class="banner-title slide-animate font-weight-bold"
                    data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}">
                    Welcome Nature to Your Home <br>with Some Indoor Plants</h2>
                    <a href="#"
                    class="slide-animate"
                    data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}" style="background-color: transparent; border-color: transparent; padding: 0;"><img src="images/playstore.png" style="width: 14%"></a>
                    <a href="#"
                    class="slide-animate"
                    data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}" style="background-color: transparent; border-color: transparent; padding: 0;"><img src="images/appstore.png" style="width: 14%"></a>   
                </div>
            </div>
        </section>
        <section class="container mt-10 pt-4 appear-animate"
        data-animation-options="{'name': 'fadeInLeftShorter', 'delay': '.3s'}">
        <h2 class="title title-underline text-center">From Our Blogs</h2>

        <div class="owl-carousel owl-theme owl-shadow-carousel row cols-lg-3 cols-sm-2 cols-1"
        data-owl-options="{
            'items': 3,
            'margin': 20,
            'dots': true,
            'loop': false,
            'nav': false,
            'responsive': {
                '0': {
                    'items': 1
                },
                '576': {
                    'items': 2
                },
                '992': {
                    'items': 3,
                    'dots': false
                }
            }
        }">
        <div class="post post-frame overlay-zoom">
            <figure class="post-media">
                <a href="{{url('/blogpost1')}}">
                    <img src="images/blog/blog1.jpg" width="340" height="206"
                    alt="post"/>
                </a>

                <div class="post-calendar">
                    <span class="post-day">03</span>
                    <span class="post-month">MAY</span>
                </div>
            </figure>
            <div class="post-details">
                <h4 class="post-title"><a href="{{url('/blogpost1')}}">Tips for Growing Plants Indoors </a></h4>

                <p class="post-content">The old Chinese proverb “He who plants a garden, plants happiness” is just so true! Plants add life to every little space…</p>
                <a href="{{url('/blogpost1')}}" class="btn btn-link btn-underline btn-primary">Read
                    More<i class="d-icon-arrow-right"></i></a>
                </div>
            </div>
            <div class="post post-frame overlay-zoom">
                <figure class="post-media">
                    <a href="{{url('/blogpost2')}}">
                        <img src="images/blog/blog2.jpg" width="340" height="206"
                        alt="post"/>
                    </a>

                    <div class="post-calendar">
                        <span class="post-day">01</span>
                        <span class="post-month">APR</span>
                    </div>
                </figure>
                <div class="post-details">
                    <h4 class="post-title"><a href="{{url('/blogpost2')}}">Plants Make For More Peace</a></h4>

                    <p class="post-content">“To forget how to dig the earth and to tend the soil, is to forget ourselves”. Gandhiji’s quote is applicable to everyone on this planet…</p>
                    <a href="{{url('/blogpost2')}}" class="btn btn-link btn-underline btn-primary">Read
                        More<i class="d-icon-arrow-right"></i></a>
                    </div>
                </div>
                <div class="post post-frame overlay-zoom">
                    <figure class="post-media">
                        <a href="{{url('/blogpost3')}}">
                            <img src="images/blog/blog3.jpg" width="340" height="206"
                            alt="post"/>
                        </a>

                        <div class="post-calendar">
                            <span class="post-day">17</span>
                            <span class="post-month">APR</span>
                        </div>
                    </figure>
                    <div class="post-details">
                        <h4 class="post-title"><a href="{{url('/blogpost3')}}">Benefits of Indoor Plants</a></h4>

                        <p class="post-content">A human being on an average spends a large part of his/her day indoors or within an enclosed space, whether at home or at work…</p>
                        <a href="{{url('/blogpost3')}}" class="btn btn-link btn-underline btn-primary">Read
                            More<i class="d-icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="banner mt-10 appear-animate">
               <div class="tab-content">
                  <div class="active in" id="product-tab-description">
                     <div class="row">
                        <div class="col-md-12 pl-md-12 pt-4 pt-md-0">
                           <figure class="p-relative d-inline-block">
                              <img src="images/video.jpg" height="350"
                              alt="Product" />
                              <a class="btn-play btn-iframe" href="https://www.youtube.com/embed/tgbNymZ7vqY">
                                 <i class="d-icon-play-solid"></i>
                             </a>
                         </figure>
                     </div>
                 </div>
             </div>
         </div>
     </section>    
     <div class="brand-section pt-10 pb-10 appear-animate" data-animation-options="{
        'delay': '.3s'
    }">
    <h2 class="title title-underline text-center">Our Clients</h2>
    <div class="with-border mb-6 mt-6">
        <div class="owl-carousel mt-4 mb-4 owl-theme row brand-carousel cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2"
        data-owl-options="{
            'nav': false,
            'dots': false,
            'autoplay': true,
            'margin': 20,
            'loop': true,
            'responsive': {
                '0': {
                    'items': 2
                },
                '576': {
                    'items': 3
                },
                '768': {
                    'items': 4
                },
                '992': {
                    'items': 5
                },
                '1200': {
                    'items': 6
                }
            }
        }">
        <figure><img src="images/clients/ankita.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/apar.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/dj.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/bright.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/gtpl.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/kokendra.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/lok.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/naidu.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/oce.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/sathi.jpg" alt="brand" width="180" height="100"/>
        </figure>
        <figure><img src="images/clients/strange.jpg" alt="brand" width="180" height="100"/>
        </figure>
    </div>
</div>
</div>
<section class="instagram-section pt-10 pb-10 appear-animate" data-animation-options="{
    'delay': '.3s'
}">
<div class="container pb-8 pt-8">
    <h2 class="title title-underline text-center">Instagram</h2>

    <div class="owl-carousel owl-theme row brand-carousel cols-xl-5 cols-lg-4 cols-md-3 cols-sm-2 cols-2"
    data-owl-options="{
        'nav': false,
        'autoplay': true,
        'margin': 20,
        'loop': false,
        'responsive': {
            '0': {
                'items': 2
            },
            '576': {
                'items': 3
            },
            '992': {
                'items': 4
            }
        }
    }">
    <figure class="instagram">
        <a href="https://www.instagram.com/Myupavan/"><img src="images/instagram/1.jpg" alt="brand" width="280"
           height="280"/></a>
       </figure>
       <figure class="instagram">
        <a href="https://www.instagram.com/Myupavan/"><img src="images/instagram/2.jpg" alt="brand" width="280"
           height="280"/></a>
       </figure>
       <figure class="instagram">
        <a href="https://www.instagram.com/Myupavan/"><img src="images/instagram/3.jpg" alt="brand" width="280"
           height="280"/></a>
       </figure>
       <figure class="instagram">
        <a href="https://www.instagram.com/Myupavan/"><img src="images/instagram/4.jpg" alt="brand" width="280"
           height="280"/></a>
       </figure>
   </div>
</div>
</section>
</div>

</main>
</div>

@include('_partials.website.footer')
<script type="text/javascript">
    $('.addtocartbtn').on('click', function (e) {
        e.preventDefault();
        var quantity = $("#quantity").val();
        var pid = $(this).data('id');
        console.log(pid);

        var frmData = 'productid=' + pid;
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            cache: false, data: frmData, url: '{{ url('cartadd') }}',
            beforeSend: function () {

            },
            success: function (res) {
                window.location.reload();
                console.log(res);
            }, complete: function (httpObj, textStatus) {
                switch (1 * httpObj.status) {
                    case 301: //here you do whatever you need to do when your php does a redirection
                    break;
                    case 404: //here you handle the calls to dead pages
                    break;
                }
            },
            error: function (response) {

            }
        });

    });

</script>
<script type="text/javascript">
    $('.addtocartbtn1').on('click', function (e) {
        e.preventDefault();
        var quantity = $("#quantity").val();
        var pid = $(this).data('id');
        console.log(pid);

        var frmData = 'productid=' + pid;
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            cache: false, data: frmData, url: '{{ url('cartadd') }}',
            beforeSend: function () {

            },
            success: function (res) {
                window.location.reload();
                console.log(res);
            }, complete: function (httpObj, textStatus) {
                switch (1 * httpObj.status) {
                    case 301: //here you do whatever you need to do when your php does a redirection
                    break;
                    case 404: //here you handle the calls to dead pages
                    break;
                }
            },
            error: function (response) {

            }
        });

    });

</script>
<script>
    $('#wishlist').click(function () {

        $wishBtn = $(this);
        console.log($wishBtn);

        let pid = $wishBtn.attr('data-pid');

        let rowId = $wishBtn.attr('data-rowid');

        $(this).find('i').removeClass('jello');
        if (rowId) {
            console.log(pid);
            $(this).find('i').removeClass('fas fa-heart');
            $(this).find('i').addClass('far fa-heart');
        } else {
            $(this).find('i').removeClass('far fa-heart');
            $(this).find('i').addClass('fas fa-heart');
        }
        $.ajax({
            method: 'post',
            url: "{{route('wishlist',$product)}}",
            data: {"_token": "{{ csrf_token() }}", rowId: pid},
            success: function (data) {
                console.log(data);
                $wishBtn.attr('data-pid', data);
                $wishBtn.find('i').addClass('jello');
                location.reload();

            }
        });
    });

</script>
<script>
    $('.wishlist1').click(function () {
        console.log("okkk");

        $wishBtn = $(this);
        console.log($wishBtn);

        let pid = $wishBtn.attr('data-pid');

        let rowId = $wishBtn.attr('data-rowid');

        $(this).find('i').removeClass('jello');
        if (rowId) {
            console.log(pid);
            $(this).find('i').removeClass('fas fa-heart');
            $(this).find('i').addClass('far fa-heart');
        } else {
            $(this).find('i').removeClass('far fa-heart');
            $(this).find('i').addClass('fas fa-heart');
        }
        $.ajax({
            method: 'post',
            url: "{{route('wishlist',$product)}}",
            data: {"_token": "{{ csrf_token() }}", rowId: pid},
            success: function (data) {
                console.log(data);
                $wishBtn.attr('data-pid', data);
                $wishBtn.find('i').addClass('jello');
                location.reload();

            }
        });
    });

</script>

</body>

