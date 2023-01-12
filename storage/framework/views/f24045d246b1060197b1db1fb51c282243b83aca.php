<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>

<div class="page-wrapper">
    <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- End Header -->
    <main class="main">
        <div class="page-header"
             style="background-image: url('/images/page-header/prod-bann.jpg'); background-color: #3C63A4;">
            <h1 class="page-title">Products results</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo e('/'); ?>"><i class="d-icon-home"></i></a></li>
                <li class="delimiter">/</li>
                <li>Products</li>
            </ul>
        </div>
        <!-- End PageHeader -->
        <div class="page-content">
            <div class="container">
                <section class="mt-10 pt-8">
                    <h2 class="title title-center">Product</h2>

                    <div class="code-template">
                        <div class="row product-wrapper">
                            <?php if(sizeof($products) == 0): ?>
                                <h2 class="title title-center">Product Not Available</h2>
                            <?php else: ?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e(($plants->featured_image)); ?>

                                    <div class="col-md-3 col-6">
                                        <div class="product shadow-media code-content">
                                            <figure class="product-media">
                                                <a href="<?php echo e(url('product/'.$plants->category.'/'.$plants->sku.'/'.$plants->id)); ?>">
                                                    <img src="<?php echo e(featuredImage($plants)); ?>" class="custom-product-img"
                                                         alt="product" width="300" height="338">
                                                    <img src="<?php echo e(featuredImage2($plants)); ?>" class="custom-product-img"
                                                         alt="product" width="300" height="338">
                                                </a>

                                                <div class="product-action-vertical">
                                                    <input type="hidden" id="quantity" name="quantity" value="1">
                                                    <input type="hidden" id="pid" name="pid" value=<?php echo e($plants->id); ?>>
                                                    <a class="btn-product-icon btn-cart addtocartbtn" id="addtocartbtn1"
                                                       data-id="<?php echo e($plants->id); ?>" title="Select Options"><i
                                                                class="d-icon-bag"></i></a>
                                                    <?php
                                                    $rowId = isProductInWishlist($plants);
                                                    ?>
                                                    <?php if(!auth::user()): ?>
                                                        <a href="<?php echo e(url('postLogin')); ?>"
                                                           class="btn-product-icon btn-wishlist1"
                                                           title="Add to wishlist"><i class="d-icon-heart"></i></a>
                                                    <?php endif; ?>
                                                    <?php if(auth::user()): ?>
                                                        <?php if($plants->wish_list == 0): ?>
                                                            <a href="#" class="btn-product-icon btn-wishlist"
                                                               data-rowid="<?php echo e($rowId); ?>" data-pid="<?php echo e($plants->id); ?>"
                                                               id="wishlist" title="Add to wishlist"><i
                                                                        class="d-icon-heart"></i></a>
                                                        <?php else: ?>
                                                            <a href="<?php echo e(url('mywishlist')); ?>"
                                                               class="btn-product-icon btn-wishlist1 added"
                                                               title="Remove from wishlist"><i
                                                                        class="d-icon-heart-full"></i></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="product-action">
                                                    <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                                        View</a>
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-name">
                                                    <a href="<?php echo e(url('product/'.$plants->category.'/'.$plants->sku.'/'.$plants->id)); ?>"><?php echo e($plants->name); ?></a>
                                                </h3>

                                                <div class="product-price">
                                                    <span class="price">₹<?php echo e($plants->sell_price); ?></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </main>
    <!-- End Main -->
</div>
<?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            cache: false, data: frmData, url: '<?php echo e(url('cartadd')); ?>',
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
<?php if(sizeof($products) !=0): ?>
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
                url: "<?php echo e(route('wishlist',$plants)); ?>",
                data: {"_token": "<?php echo e(csrf_token()); ?>", rowId: pid},
                success: function (data) {
                    console.log(data);
                    $wishBtn.attr('data-pid', data);
                    $wishBtn.find('i').addClass('jello');
                    location.reload();

                }
            });
        });

    </script>
<?php endif; ?>
</body>

