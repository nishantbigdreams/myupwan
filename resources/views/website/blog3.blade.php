@include('_partials.website.header')
<body>
    <div class="page-wrapper">
        @include('_partials.website.nav')
        <!-- End Header -->
        <main class="main">
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="demo1.html"><i class="d-icon-home"></i></a></li>
                        <li><a href="#" class="active">Blog</a></li>
                        <li>Single Post</li>
                    </ul>
                </div>
            </nav>
            <div class="page-content with-sidebar">
                <div class="container">
                    <div class="row gutter-lg">
                        <div class="col-lg-9">
                            <article class="post-single">
                                <figure class="post-media">
                                    <a href="#">
                                        <img src="images/blog/blog3.jpg" width="880" height="300" alt="post" />
                                    </a>
                                </figure>
                                <div class="post-details">
                                    <div class="post-meta">
                                        by <a href="#" class="post-author">Priyanka Desai</a>
                                        on <a href="#" class="post-date">APR 18, 2022</a>
                                        | <a href="#" class="post-comment"><span>2</span> Comments</a>
                                    </div>
                                    <h4 class="post-title"><a href="#">Benefits of Indoor Plants</a></h4>
                                    <div class="post-body mb-7">
                                        <p class="mb-3">A human being on an average spends a large part of his/her day indoors or within an
                                        enclosed space, whether at home or at work. Moreover, in recent times, we have seen that
                                        a person’s workspace too has been enclosed within the home itself. So, in such a scenario,
                                        the best recourse in order to be in touch with nature is to simply bring the outside…inside
                                        our homes! It is true that the quality that the free expanse of the outdoors offer may not
                                        match upto that of an indoor green space. But the benefits of indoor gardens make up for
                                        quality, if not for size or expanse.</p>

                                        <p class="mb-3">So, let us discuss a few of the numerous benefits that indoor plants offer:</p>

                                        <h6>1) Plants improve air quality</h6>
                                        <p class="mb-3">
                                            In big cities, we hardly get the luxury of breathing fresh unadulterated air. So, what is the
                                            next best option? Get a houseplant! Our homes too contain several harmful things that
                                            create air pollution such as cleaning products, mould, mildew, paints as well as cancer
                                            causing chemicals such as formaldehyde and benzene. The best natural air purifiers, plants,
                                            absorb these harmful toxins present in air and make it healthier for us to breathe. Micro-
                                            organisms present in soil cleanse the air too. NASA recommends several houseplants such
                                            as Peace Lily, Areca Palm, Pothos, Rubber plant among numerous others that are efficient
                                            air purifiers. The bigger the leaves of the plants, better is the air-purifying ability too.
                                        </p>
                                        <h6>2) Help you work better</h6>
                                        <p class="mb-3">
                                           Tired of looking into the screen all day? Creativity and productivity output not up to the
                                           mark? Place a plant on your worktop or in the room and get re-energised by its presence.
                                           Studies have shown plants can actually increase productivity, improve a person’s creative
                                           output and problem-solving ability to a large extent as well as boost concentration and
                                           enhance memory retention. Also, it has been found that work performed amongst the
                                           presence of plants is more accurate and of a higher quality too in comparison to that done in
                                           an environment without plants.</p>
                                        
                                        <h6>3) Help you relax and sleep well </h6>
                                        <p class="mb-3">
                                            Adequate sleep is the most important factor required by everyone in order to function better
                                            in all ways. Plants with their lush colours, subtle scents and their ability to give out oxygen
                                            help you to breathe better and therefore sleep better.
                                        </p>
                                       
                                        <h6>4) Relieves stress and anxiety</h6>
                                        <p class="mb-3">
                                            Studies prove that looking after plants and even touching and feeling the textures of different
                                            leaves of plants has a positive effect on a person’s stress levels and can reduce anxiety.
                                            Plants have natural healing abilities and just being around them for even a small part of the
                                            day goes a long way in improving mental wellness.
                                        </p>

                                        <h6>5) Natural humidifiers</h6>
                                        <p class="mb-3">
                                          The process through which plants release moisture from their leaves is called transpiration.
                                          This automatically regulates the indoor air humidity especially in the dry season during
                                          winter. Writer and Botanist Robin Wall Kimmerer who is an avid gardener herself, has
                                          described this special relation or connection with plants beautifully. She says “In some native
                                          languages, the term for plants translates to 'those who take care of us’.”
                                        </p>
                                       
                                        <p class="mb-3">
                                            So, here’s some food for thought - do we take care of plants? Or do they actually take care
                                            of us? Or is it a bit of both? A little bit of a symbiotic relationship, perhaps? That’s for each one of us to decide.
                                        </p>
                                        <p class="mb-3">
                                            However, one thing is definitely true is that plants do make us happier and healthier versions
                                            of ourselves!
                                        </p>
                                       
                                    </div>
                                </div>
                            </article>
                            <!-- <div class="reply">
                                <div class="title-wrapper text-left">
                                    <h3 class="title title-simple text-left text-normal">Leave A Reply</h3>
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                </div>
                                <form action="#">
                                    <textarea id="reply-message" cols="30" rows="6" class="form-control mb-4"
                                        placeholder="Comment *" required></textarea>
                                    <div class="row">
                                        <div class="col-md-6 mb-5">
                                            <input type="text" class="form-control" id="reply-name" name="reply-name"
                                                placeholder="Name *" required />
                                        </div>
                                        <div class="col-md-6 mb-5">
                                            <input type="email" class="form-control" id="reply-email" name="reply-email"
                                                placeholder="Email *" required />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-rounded">POST COMMENT<i
                                            class="d-icon-arrow-right"></i></button>
                                </form>
                            </div> -->
                            <!-- End Reply -->
                        </div>
                        <aside class="col-lg-3 right-sidebar sidebar-fixed sticky-sidebar-wrapper">
                            <div class="sidebar-overlay">
                            </div>
                            <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
                            <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-left"></i></a>
                            <div class="sidebar-content">
                                <div class="sticky-sidebar" data-sticky-options="{'top': 89, 'bottom': 70}">
                                    <div class="widget widget-search border-no mb-2">
                                        <form action="#" class="input-wrapper input-wrapper-inline btn-absolute">
                                            <input type="text" class="form-control" name="search" autocomplete="off"
                                                placeholder="Search in Blog" required />
                                            <button class="btn btn-search btn-link" type="submit">
                                                <i class="d-icon-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title">Popular Posts</h3>
                                        <div class="widget-body">
                                            <div class="post-col">
                                                <div class="post post-list-sm">
                                                    <figure class="post-media">
                                                        <a href="{{url('/blogpost1')}}">
                                                            <img src="images/blog/blog1.jpg" width="90" height="90"
                                                                alt="post" />
                                                        </a>
                                                    </figure>
                                                    <div class="post-details">
                                                        <div class="post-meta">
                                                            <a href="#" class="post-date">May 03, 2022</a>
                                                        </div>
                                                        <h4 class="post-title"><a href="{{url('/blogpost1')}}">Tips for Growing Plants Indoors </a></h4>
                                                    </div>
                                                </div>
                                                <div class="post post-list-sm">
                                                    <figure class="post-media">
                                                        <a href="{{url('/blogpost2')}}">
                                                            <img src="images/blog/blog2.jpg" width="90" height="90"
                                                                alt="post" />
                                                        </a>
                                                    </figure>
                                                    <div class="post-details">
                                                        <div class="post-meta">
                                                            <a href="#" class="post-date">Apr 01, 2022</a>
                                                        </div>
                                                        <h4 class="post-title"><a href="{{url('/blogpost2')}}">Plants Make For More Peace</a></h4>
                                                    </div>
                                                </div>
                                                <div class="post post-list-sm">
                                                    <figure class="post-media">
                                                        <a href="{{url('/blogpost3')}}">
                                                            <img src="images/blog/blog3.jpg" width="90" height="90"
                                                                alt="post" />
                                                        </a>
                                                    </figure>
                                                    <div class="post-details">
                                                        <div class="post-meta">
                                                            <a href="#" class="post-date">Apr 18, 2022</a>
                                                        </div>
                                                        <h4 class="post-title"><a href="{{url('/blogpost3')}}">Benefits of Indoor Plants</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('_partials.website.footer')
</body>

</html>