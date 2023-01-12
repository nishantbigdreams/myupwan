@include('_partials.website.header')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.min.css')}}">
<style type="text/css">
	.count-to{
		font-size: 30px!important;
		font-weight: 700!important;
		color: #666!important;
	}
</style>
<body class="about-us">

    <div class="page-wrapper">
        @include('_partials.website.nav')
        <!-- End Header -->
        <main class="main">
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/') }}"><i class="d-icon-home"></i></a></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </nav>
            <div class="page-header pl-4 pr-4" style="background-image: url(images/page-header/about-us.jpg)">
                <h1 class="page-title font-weight-bold lh-1 text-white text-capitalize">Welcome to My Upavan</h1>
            </div>
            <div class="page-content mt-10 pt-10">
                <section class="about-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <!-- <div class="col-lg-4 mb-10 mb-lg-4">
                                <h5 class="section-subtitle lh-2 ls-md font-weight-normal">01. What We Do</h5>
                                <h3 class="section-title lh-1 font-weight-bold">01. What We Do</h3>
                                <p class="section-desc">We create green spaces, both indoors and outdoors. We are here to make the concrete jungle, we call home, a greener and more sustainable space through customized gardening solutions. Through our Own Grown Farms initiative we convert open urban spaces into food gardens to lower food miles and promote community gardening values. In the last five years we have worked towards neutralizing over 400 tonnes of carbon.</p>
                            </div> -->
                            <div class="col-lg-12 ">
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <div class="counter text-center text-dark">
                                            <span class="count-to" data-fromvalue="0" data-tovalue="150"
                                                data-duration="900" data-delimiter=",">0</span>
                                            <h4 class="count-title font-weight-bold text-body ls-md">Business Partners</h4>
                                            <!-- <p class="text-grey mb-0">Lorem ipsum dolor sit<br>amet, conctetur adipisci
                                                elit. viverra erat orci.</p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="counter text-center text-dark">
                                            <span class="count-to" data-fromvalue="0" data-tovalue="500"
                                                data-duration="900" data-delimiter=",">0</span>
                                            <h4 class="count-title font-weight-bold text-body ls-md"> Available Plants</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="counter text-center text-dark">
                                            <span class="count-to" data-fromvalue="0" data-tovalue="1000"
                                                data-duration="900" data-delimiter=",">0</span>
                                            <h4 class="count-title font-weight-bold text-body ls-md">Happy Customer</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="counter text-center text-dark">
                                            <span class="count-to" data-fromvalue="0" data-tovalue="100"
                                                data-duration="900" data-delimiter=",">0</span>
                                            <h4 class="count-title font-weight-bold text-body ls-md">plant Varities</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End About Section-->

                <section class="customer-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7 mb-4">
                                <figure>
                                    <img src="{{asset('images/about-1.jpg')}}" alt="Happy Customer" width="580"
                                        height="507" class="banner-radius" style="background-color: #BDD0DE;" />
                                </figure>
                            </div>
                            <div class="col-md-5 mb-4">
                                <!-- <h5 class="section-subtitle lh-2 ls-md font-weight-normal">01. Happy Customer</h5> -->
                                <h3 class="section-title lh-1 font-weight-bold">01. What We Do</h3>
                                <p class="section-desc text-grey">What started as a pandemic Lockdown discovery, is today a thriving venture. Welcome to My Upavan, the online junction for all your plant requirements - indoor as well as outdoor plants. For all your plant queries and starting steps and tips on how to grow your own garden – indoor as well as outdoor, My Upavan is the place to check out. With more than 1000 plants to choose from, meet the many plants and choose the best one that fits your lifestyle and requirement. This is not just about buying plants online. My Upavan is all about finding the perfect fit of plants for your homes or workspaces. It’s no longer about only having a green thumb! We can help you choose your plants, as well as help to maintain and take care of them. A one-stop shop for all your plant and gardening requirements, My Upavan!</p>
                                <a href="{{url('/subscription') }}" class="btn btn-dark btn-link btn-underline ls-m">buckle up and subscribe us now!<i
                                        class="d-icon-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Customer Section -->

                <section class="store-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6 order-md-first mb-4">
                                <h3 class="section-title lh-1 font-weight-bold">02. Who We Are</h3>
                                <p class="section-desc text-grey">
                                    Started by the young entrepreneur Ms. Priyanka and My Upavan has its roots in a hobby that was started during the Lockdown 2020, when Priyanka was gifted a money plant by her friend. The entire world had come to a standstill and the plant was also almost dying. Priyanka wanted to take care of the plant and ensure it would not die. In the process, she started speaking to the plant and saw it reciprocate with its wonderful growth. She saw the plant grow and as each new leaf emerged, she felt closer to nature and experienced the joy of gratitude. Through the journey of the plant, she realized her true calling.
                                </p>
                                <p class="section-desc text-grey">
                                	An entrepreneur at heart, it was as if the hidden potential of this hobby was being released towards becoming a full-fledged business. From one plant to the journey of 35 plants today in Priyanka’s balcony garden, My Upavan has got amazing support from friends and well-wishers, who helped sow this seed of making this hobby into her full-time profession.<br>
                                	Thanks
                                </p>
                                <a href="{{url('/')}}/category/Popular 2022" class="btn btn-dark btn-link btn-underline ls-m">Have a look at our trending products<i
                                        class="d-icon-arrow-right"></i></a>
                            </div>
                            <div class="col-md-6 mb-4">
                                <figure>
                                    <img src="{{asset('images/offer3.jpg')}}" alt="Our Store" width="580" height="507"
                                        class="banner-radius" style="background-color: #DEE6E8;" />
                                </figure>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Store-section -->

                <section class="brand-section grey-section pt-10 pb-10 appear-animate">
                    <div class="container mt-8 mb-10">
                        <!-- <h5 class="section-subtitle lh-2 ls-md font-weight-normal mb-1 text-center">03. Our Clients</h5> -->
                        <h3 class="section-title lh-1 font-weight-bold text-center mb-5">03. Our Clients</h3>
                        <div class="owl-carousel owl-theme row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2"
                            data-owl-options="{
                            'nav': false,
                            'dots': false,
                            'autoplay': true,
                            'margin': 20,
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
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/ankita.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/apar.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/bright.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/gtpl.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/kokendra.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/lok.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/naidu.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/oce.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/sathi.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                            <figure class="brand-wrap bg-white banner-radius">
                                <img src="{{asset('images/clients/strange.jpg')}}" alt="Brand" width="180" height="100" />
                            </figure>
                        </div>
                    </div>
                </section>
                <!-- Team Section -->
                <!-- <section class="team-section pt-8 mt-10 pb-10 mb-6 appear-animate">
                    <div class="container">
                        <h5 class="section-subtitle lh-2 ls-md font-weight-normal mb-1 text-center">04. Our Leaders</h5>
                        <h3 class="section-title lh-1 font-weight-bold text-center mb-5">Meet our team</h3>
                        <div class="row cols-sm-2 cols-md-4">
                            <div class="member appear-animate" data-animation-options="{'name': 'fadeInLeftShorter'}">
                                <figure class="banner-radius">
                                    <img src="{{asset('images/subpages/team1.jpg')}}" alt="team member" width="280" height="280"
                                        style="background-color: #EEE;">
                                    <div class="overlay social-links">
                                        <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                        <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                        <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                                    </div>
                                </figure>
                                <h4 class="member-name">Kaleem Akhtar</h4>
                                <h5 class="member-job">Ceo / Founder</h5>
                            </div>
                            <div class="member appear-animate"
                                data-animation-options="{'name': 'fadeInLeftShorter', 'delay': '.3s'}">
                                <figure class="banner-radius">
                                    <img src="{{asset('images/subpages/team2.jpg')}}" alt="team member" width="280" height="280"
                                        style="background-color: #121A1F;">
                                    <div class="overlay social-links">
                                        <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                        <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                        <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                                    </div>
                                </figure>
                                <h4 class="member-name">Vijay Kumar Jain</h4>
                                <h5 class="member-job">Support manager / founder</h5>
                            </div>
                            <div class="member appear-animate"
                                data-animation-options="{'name': 'fadeInLeftShorter', 'delay': '.4s'}">
                                <figure class="banner-radius">
                                    <img src="{{asset('images/subpages/team3.jpg')}}" alt="team member" width="280" height="280"
                                        style="background-color: #E8E7E3;">
                                    <div class="overlay social-links">
                                        <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                        <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                        <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                                    </div>
                                </figure>
                                <h4 class="member-name">Salini Mane</h4>
                                <h5 class="member-job">Designer</h5>
                            </div>
                            <div class="member appear-animate"
                                data-animation-options="{'name': 'fadeInLeftShorter', 'delay': '.5s'}">
                                <figure class="banner-radius">
                                    <img src="{{asset('images/subpages/team4.jpg')}}" alt="team member" width="280" height="280"
                                        style="background-color: #465D7F;">
                                    <div class="overlay social-links">
                                        <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                        <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                        <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                                    </div>
                                </figure>
                                <h4 class="member-name">Nikhil Khare</h4>
                                <h5 class="member-job">Support</h5>
                            </div>
                        </div>
                    </div>
                </section> -->
                <!-- End Team Section -->
            </div>
        </main>
        <!-- End Main -->
        @include('_partials.website.footer')
        <script src="{{asset('vendor/jquery.count-to/jquery-numerator.min.js')}}"></script>
</body>

</html>