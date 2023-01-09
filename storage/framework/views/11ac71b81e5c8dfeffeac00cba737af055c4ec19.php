<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>
    <div class="page-wrapper">
        <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                                        <img src="images/blog/blog2.jpg" width="880" height="300" alt="post" />
                                    </a>
                                </figure>
                                <div class="post-details">
                                    <div class="post-meta">
                                        by <a href="#" class="post-author">Priyanka Desai</a>
                                        on <a href="#" class="post-date">Apr 01, 2022</a>
                                        | <a href="#" class="post-comment"><span>2</span> Comments</a>
                                    </div>
                                    <h4 class="post-title"><a href="#">Plants Make For More Peace</a></h4>
                                    <div class="post-body mb-7">
                                        <p class="mb-3">“To forget how to dig the earth and to tend the soil, is to forget ourselves”. Gandhiji’s quote is applicable to everyone on this planet. We humans are ‘earthed’ to Mother Nature and the best way to stay connected is simply to plant a seed, tend to it and watch it grow!</p>

                                        <p class="mb-3">What is it that makes avid gardeners and amateurs spend hours nurturing their gardens, whether indoors and outdoors? It isn’t an easy job - digging, weeding, watering, pruning; all this involves time, efforts and a lot of labour… but for them, it is a source of immense joy!</p>

                                        <p class="mb-3">
                                            Yes, plants do liven up the décor of any dwelling, though the advantages of having indoor plants aren’t limited to beautifying your home or office, but rather enhancing the aesthetic aspect. Moreover, they improve the aura of every space they adorn and can work like magic in making way for a happy, joyful and positive vibe all around.
                                        </p>
                                        <p class="mb3">
                                            Research has shown that plants work wonders on one’s professional output too. It has been found that people perform better when surrounded by plants. ‘Plant Therapy’ actually increases concentration and productivity at work. If you are staring blankly at your screen or too confused to make a decision, then having plants around brings along a fresh breath of air along with a hint of the outdoors. A small potted plant on your desk top will lift your mood and help you become calm, relaxed and help you think clearer. Plants are natural air-purifiers, the oxygen emitted by plants help to counter-balance the carbon dioxide levels in our surroundings. 
                                        </p>
                                        <p class="mb3">
                                            Nature has the best palette of colours in the guise of plants and flowers. Their attractive hues, soothing greenery and calming gentle aromas can stimulate and motivate the senses to perform better. In this technologically wired world, with people more home-bound and desk-bound in the present-scenario, having atleast one indoor companion seems like a good decision. 
                                        </p>
                                        <p class="mb3">
                                            Clinical studies have also proved that plants help individuals to effectively deal with loneliness and depression. These beautiful gifts of nature calm your mind and encourage coping with stress and anxiety. When you have to pay attention to your plants and nurture them, look into their upkeep and well-being, mechanically your brain gets distracted from apprehensive or fretful thoughts by focussing on the present moment by caring for them. When you move around to dig and water, or prune and weed, re-pot and harvest, you feel a sense of delight and satisfaction which automatically takes care of mental wellness. Moreover, every plant has specific needs, so that means you need to move around more, which results in more exercise and more endorphins produced naturally that act as stress busters! Just to see your plants thrive and flourish is gratifying enough!
                                        </p>
                                        <p class="mb3">
                                            It is believed that ancient Egyptian doctors had been recommending walks around gardens as an effective means of mental health and recuperation. In recent times, Horticultural Therapy is widely recognized as a means to improve not only physical and mental well-being, but also has been found to help heal faster from injuries. Potted plants and flowers are considered effective remedies for people recuperating from traumas or surgeries. 
                                        </p>
                                        <p class="mb3">
                                            An indoor garden, can be a sanctuary that always reminds us of simpler and natural ways of living life, one that is a lot slower but incredibly beautiful which brings in happiness and a glow of positivity in life.
                                        </p>
                                        <p class="mb3">
                                            So, what does happiness, contentment, physical, emotional and mental well-being subsequently lead to? Peace, isn’t it! 
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
                                                        <a href="<?php echo e(url('/blogpost1')); ?>">
                                                            <img src="images/blog/blog1.jpg" width="90" height="90"
                                                                alt="post" />
                                                        </a>
                                                    </figure>
                                                    <div class="post-details">
                                                        <div class="post-meta">
                                                            <a href="#" class="post-date">May 03, 2022</a>
                                                        </div>
                                                        <h4 class="post-title"><a href="<?php echo e(url('/blogpost1')); ?>">Tips for Growing Plants Indoors </a></h4>
                                                    </div>
                                                </div>
                                                <div class="post post-list-sm">
                                                    <figure class="post-media">
                                                        <a href="<?php echo e(url('/blogpost2')); ?>">
                                                            <img src="images/blog/blog2.jpg" width="90" height="90"
                                                                alt="post" />
                                                        </a>
                                                    </figure>
                                                    <div class="post-details">
                                                        <div class="post-meta">
                                                            <a href="#" class="post-date">Apr 01, 2022</a>
                                                        </div>
                                                        <h4 class="post-title"><a href="<?php echo e(url('/blogpost2')); ?>">Plants Make For More Peace</a></h4>
                                                    </div>
                                                </div>
                                                <div class="post post-list-sm">
                                                    <figure class="post-media">
                                                        <a href="<?php echo e(url('/blogpost3')); ?>">
                                                            <img src="images/blog/blog3.jpg" width="90" height="90"
                                                                alt="post" />
                                                        </a>
                                                    </figure>
                                                    <div class="post-details">
                                                        <div class="post-meta">
                                                            <a href="#" class="post-date">Apr 18, 2022</a>
                                                        </div>
                                                        <h4 class="post-title"><a href="<?php echo e(url('/blogpost3')); ?>">Benefits of Indoor Plants</a></h4>
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
    <?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>

</html>