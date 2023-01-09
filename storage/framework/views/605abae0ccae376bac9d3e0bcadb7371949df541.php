<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/jquery.filer.css')); ?>">
    <link href="<?php echo e(asset('css/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-content'); ?>
    <br/>
    <div class="container-fluid">
        <form action="<?php echo e(route('admin.product.update', $product->id)); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <?php echo e(method_field('put')); ?>

            <input type="hidden" name="media_token" value="<?php echo e(time()); ?>">
            <div class="col-md-7">
                <div class="card-box">
                    <div class="form-group">
                        <label class="control-label">Product Name </label>
                        <input type="text" class="form-control input-sm" name="name" placeholder="List Name" required value="<?php echo e($product->name); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Model</label>
                        <input type="text" class="form-control input-sm" name="model" placeholder="Model No " required value="<?php echo e($product->model); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Product Video Url
                            <small class="text-danger">(Enter Valid Youtube URL by copying it from Browser Address Bar)</small>
                        </label>
                        <input type="text" class="form-control input-sm" name="video_url" placeholder="Youtube Product Url E.g https://www.youtube.com/watch?v=6ZfuNTqbHE8" value="<?php echo e(old('video_url') ?? $product->video_url); ?>" autocomplete="off">
                        <?php if($errors->has('video_url')): ?>
                            <strong class="text-danger">
                                <?php echo e($errors->first('video_url')); ?>

                            </strong>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Product Description </label>
                        <textarea name="description" class="form-control" rows="8"><?php echo $product->description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Product Details </label>
                        <textarea name="details" class="form-control" rows="8"><?php echo $product->details; ?></textarea>
                    </div>
                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="control-label">Featured Image </label>
                            <div class="dropzone" id="featured"></div>
                        </div>
                        <div class="col-md-4" id="featured_image_div">
                            <br/>

                        <?php if($product->featuredImage): ?>
                                <div class="jFiler-items jFiler-row">
                                    <ul class="jFiler-items-list jFiler-items-grid list-style-none">
                                        <li class="jFiler-item">
                                            <div class="jFiler-item-container">
                                                <div class="jFiler-item-inner">
                                                    <div class="jFiler-item-thumb">
                                                        <div class="jFiler-item-thumb-image">
                                                            <img src="<?php echo e($product->featuredImage->url); ?>" alt="Product Featured Image" class="img-responsive" style="width:150px;height:150px">

                                                        </div>
                                                    </div>
                                                    <div class="jFiler-item-assets jFiler-row">
                                                        <ul class="list-inline pull-left">
                                                            <li>
                                                                <span class="jFiler-item-others">
                                                                    <i class="fa fa-file text-custom"></i>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                        <ul class="list-inline pull-right">
                                                            <li>
                                                                <a href="javascript:;" id="<?php echo e($product->featuredImage->id); ?>" class="text-danger media-delete featured" title="Delete Image">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <label class="control-label">Featured Image2 </label>
                            <div class="dropzone" id="featured2"></div>
                        </div>
                        <div class="col-md-4" id="featured_image_div2">
                            <br/>
                        <?php if($product->featuredImage2): ?>
                                <div class="jFiler-items jFiler-row">
                                    <ul class="jFiler-items-list jFiler-items-grid list-style-none">
                                        <li class="jFiler-item">
                                            <div class="jFiler-item-container">
                                                <div class="jFiler-item-inner">
                                                    <div class="jFiler-item-thumb">
                                                        <div class="jFiler-item-thumb-image">
                                                            <img src="<?php echo e($product->featuredImage2->url); ?>" alt="Product Featured Image" class="img-responsive" style="width:150px;height:150px">

                                                        </div>
                                                    </div>
                                                    <div class="jFiler-item-assets jFiler-row">
                                                        <ul class="list-inline pull-left">
                                                            <li>
                                                                <span class="jFiler-item-others">
                                                                    <i class="fa fa-file text-custom"></i>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                        <ul class="list-inline pull-right">
                                                            <li>
                                                                <a href="javascript:;" id="<?php echo e($product->featuredImage2->id); ?>" class="text-danger media-delete featured" title="Delete Image">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Gallery Images </label>
                            <div class="dropzone" id="gallery"></div>
                            <div id="gallery_image_div">
                                <?php if(count($product->gallerImages)): ?>
                                    <br>
                                    <div class="jFiler-items jFiler-row">
                                        <ul class="jFiler-items-list jFiler-items-grid list-style-none">
                                            <?php $__currentLoopData = $product->gallerImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="jFiler-item">
                                                    <div class="jFiler-item-container">
                                                        <div class="jFiler-item-inner">
                                                            <div class="jFiler-item-thumb">
                                                                <div class="jFiler-item-thumb-image">
                                                                    <img src="<?php echo e($img->url); ?>" alt="Product Gallery Image" class="img-responsive" style="width:150px;height:150px">
                                                                </div>
                                                            </div>
                                                            <div class="jFiler-item-assets jFiler-row">
                                                                <ul class="list-inline pull-left">
                                                                    <li>
                                                                        <span class="jFiler-item-others">
                                                                            <i class="fa fa-file text-custom"></i>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                <ul class="list-inline pull-right">
                                                                    <li>
                                                                        <a href="javascript:;" id="<?php echo e($img->id); ?>" class="text-danger media-delete" title="Delete Image">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">SKU Code </label>
                                <input type="text" class="form-control input-sm" name="sku_code" placeholder="Unique Sku Code" required="" value="<?php echo e($product->sku); ?>">
                                <center id="sku_msg"></center>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox checkbox-custom">
                                    <input type="checkbox" name="home_best_sellers" id="home_best_sellers" value="<?php echo e($product->home_best_sellers); ?>" <?php echo e($product->home_best_sellers == 1 ? 'checked' : ''); ?>>
                                    <label for="home_best_sellers">Our Best Sellers</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox checkbox-custom">
                                    <input type="checkbox" name="home_recent_arrivals" id="home_recent_arrivals" value="<?php echo e($product->home_recent_arrivals); ?>" <?php echo e($product->home_recent_arrivals == 1 ? 'checked' : ''); ?>>
                                    <label for="home_recent_arrivals">Recent Arrivals</label>
                                </div>
                            </div>
                        </div>
                    <div class="row">

                    <div class="col-md-12">
                        <div class="checkbox checkbox-custom">
                            <input type="checkbox" name="is_variations" id="variations" value="true">
                            <label for="variations">Create Variations (for Size)</label>
                        </div>
                    </div>
                </div>
                <div class="variations_div " style="display: none">
                    <div class="row">

                        <?php if(!isset($product->is_variations) && $product->is_variations != 1): ?>
                        <div class="col-md-2">
                            <h5>Variable</h5>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="sku" class="form-control input-sm" name="sku[]" placeholder="SKU Code" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="v_name" class="form-control input-sm" name="variant_name[]" placeholder="Enter Name" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="javascript:;" class="add_more_variation" title="Add Variation">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </div>
                       <?php endif; ?>

                    </div>
                    <div class="append_variations_div"></div>
                </div>
                <hr/>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Similar products </label>
                                <input type="text" class="form-control input-sm" name="similar_products" placeholder="Similar products SKU Code" value="<?php echo e($product->similar_products); ?>">
                                <span class="help-block">
                                    <small>Enter Sku seperated with coma ( , )</small>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">MRP Price</label>
                                <input type="number" class="form-control input-sm" name="base_price" placeholder="Base Price" required="" value="<?php echo e($product->base_price); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Image Alt Name</label>
                                <input type="text" class="form-control input-sm" name="alt_name" placeholder="Alt Name " value="<?php echo e($product->alt_name); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Selling Price</label>
                                <input type="number" class="form-control input-sm" name="sell_price" placeholder="Sell Price" value="<?php echo e($product->price_without_gst); ?>" step="any">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Delevery Charge</label>
                                <input type="number" class="form-control input-sm" name="delevery_charge" placeholder="Delevery Charge" value="<?php echo e($product->delevery_charge); ?>" step="any">
                            </div>
                        </div>

                        <div class="col-md-6 ">
                             <div class="form-group">
                                <label class="control-label">Unit</label>
                                <input type="text" class="form-control input-sm" required name="unit" placeholder="unit" value="<?php echo e($product->unit); ?>">
                            </div>
                       <!--  <div class="form-group  text-center">
                            <label class="control-label">Unit</label>
                            <select class="form-control" name="unit">
                               <option value="Kg"  <?php echo e($product->unit == 'Kg' ? 'selected' : ''); ?>>Kg</option>
                               <option value="Gm" <?php echo e($product->unit == 'Gm' ? 'selected' : ''); ?>>Gm</option>
                                <option value="Packets" <?php echo e($product->unit == 'Packets' ? 'selected' : ''); ?>>Packets</option>
                                <option value="Liter" <?php echo e($product->unit == 'Liter' ? 'selected' : ''); ?>>Liter</option>
                                <option value="Nos" <?php echo e($product->unit == 'Nos' ? 'selected' : ''); ?>>Nos</option>
                                <option value="Meter" <?php echo e($product->unit == 'Meter' ? 'selected' : ''); ?>>METER</option>
                                <option value="Each" <?php echo e($product->unit == 'Each' ? 'selected' : ''); ?>>Each</option>
                                <option value="dozen" <?php echo e($product->unit == 'dozen' ? 'selected' : ''); ?>>dozen</option>
                                <option value="Bunddle" <?php echo e($product->unit == 'Bunddle' ? 'selected' : ''); ?>>Bunddle</option>
                                <option value="Box" <?php echo e($product->unit == 'Box' ? 'selected' : ''); ?>>Box</option>
                            </select>
                        </div> -->
                    </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">In Stock</label>
                                <input type="number" class="form-control input-sm" required name="in_stock" placeholder="Stock" value="<?php echo e(intVal($product->in_stock)); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Product GST</label>
                                <input type="number" class="form-control input-sm" required name="product_gst" placeholder="Product Gst" value="<?php echo e($product->gst ?? 18); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Product Weight(Kg)</label>
                            <input type="text" class="form-control input-sm" name="product_weight" placeholder="Product Weight in Kg" value="<?php echo e($product->product_weight); ?>">
                        </div>
                    </div>
                        <?php echo $__env->make('admin.components.category_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="text-custom">Combo Offer</h4>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover" id="combo_table">
                            <tr>
                                <th>Unit Req.</th>
                                <th>Discount(% off)</th>
                                <th>
                                    <a href="javascript:;" id="add_more_combo" title="Add Combo">
                                        <i class="fa fa-plus-circle fa-2x"></i>
                                    </a>
                                </th>
                            </tr>
                            <?php
                            $qty = json_decode($product->combo_qty);
                            $discount = json_decode($product->combo_discount);
                            ?>
                            <?php if(is_array($qty) && is_array($discount)): ?>
                                <?php $__currentLoopData = $qty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <input type="number" name="combo_qty[]" class="form-control" value="<?php echo e($value); ?>" placeholder="Unit" min="2" required="">
                                        </td>
                                        <td>
                                            <input type="number" name="combo_discount[]" class="form-control" value="<?php echo e($discount[$key] ?? ''); ?>" placeholder="Discount" min="2" required="">
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="remove_combo" title="Remove Combo">
                                                <i class="fa fa-minus-circle fa-2x text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary btn-block">
                    <i class="fa fa-check"></i> UPDATE LISTING
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    let is_sku_available = true;
    $sku_msg = $('#sku_msg');
    $('input[name="sku_code"]').change(function(){
        let code = $(this).val();
        $sku_msg.html(
            `<small class="btn-link">
            CHECKING SKU CODE AVAILABILITY <i class="fa fa-spinner fa-spin"></i>
            </small>`
        );
        $.ajax({
            url: "<?php echo e(route('admin.check.sku_code')); ?>",
            method: 'post',
            data:{sku:code},
        }).done(function(data, textStatus, jqXHR) {
            console.log(data.trim());
            if (data == 'sku available') {
                $(this).addClass('input-success');
                $(this).removeClass('input-error');
                $sku_msg.html(
                    `<small class="text-success">
                    SKU CODE AVAILABLE <i class="fa fa-check"></i>
                    </small>`
                );
                is_sku_available = true;
            } else if (data == 'sku not available'){
                $(this).removeClass('input-success');
                $(this).addClass('input-error');
                $sku_msg.html(
                    `<small class="text-danger">
                    SKU CODE NOT AVAILABLE <i class="fa fa-times"></i>
                    </small>`
                );
                is_sku_available = false;
            }
        });
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote.min.js"></script>

<script type="text/javascript">
$('[name=description]').summernote(
    {
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
                ['codeview']
        ],
        height:'150px',
        placeholder:'Product Description'
    }
);
</script>
<script type="text/javascript">
$('[name=details]').summernote(
    {
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
                ['codeview']
        ],
        height:'150px',
        placeholder:'Product Details'
    }
);
</script>

<script src="<?php echo e(asset('js/dropzone.js')); ?>"></script>

<script type="text/javascript">
let media_token = $('[name=media_token]').val();
Dropzone.options.featured = {
    url: "<?php echo e(route('admin.uploads')); ?>",
    paramName: "file",
    maxFilesize: 2,
    maxFiles: 1,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    dictDefaultMessage: "Click or Drag file here to upload featured Images.",
    init: function() {
        this.on("sending", function(file, xhr, formData){
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("type", 'featured');
            formData.append("media_token", media_token);
        });
    }
};
Dropzone.options.featured2 = {
    url: "<?php echo e(route('admin.uploads')); ?>",
    paramName: "file",
    maxFilesize: 2,
    maxFiles: 1,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    dictDefaultMessage: "Click or Drag file here to upload featured Images.",
    init: function() {
        this.on("sending", function(file, xhr, formData){
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("type", 'featured2');
            formData.append("media_token", media_token);
        });
    }
};

Dropzone.options.gallery = {
    url: "<?php echo e(route('admin.uploads')); ?>",
    paramName: "file",
    maxFilesize: 2,
    maxFiles: 4,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    dictDefaultMessage: "Drag files here to upload gallery Images.",
    init: function() {
        this.on("sending", function(file, xhr, formData){
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("type", 'gallery');
            formData.append("media_token", media_token);
        });
    }
};
</script>

<script type="text/javascript">
$('form').submit(function(e){
    if (!is_sku_available) {
        alert('Please Type Valid SKU CODE');
        e.preventDefault();
    }

    if ($('[name="description"]').summernote('code').length > 11) {
        alert('Please Type Listing Description');
        e.preventDefault();
    }
});

$('#add_more_combo').click(function(){
    $t_body = $('#combo_table tbody');
    $t_body.append(`
        <tr>
        <td>
        <input type="number" name="combo_qty[]" class="form-control" placeholder="Unit" min="2" required>
        </td>
        <td>
        <input type="number" name="combo_discount[]" class="form-control" placeholder="Discount" min="2" required>
        </td>
        <td>
        <a href="javascript:;" class="remove_combo" title="Remove Combo">
        <i class="fa fa-minus-circle fa-2x text-danger"></i>
        </a>
        </td>
        </tr>
        `);
    });

    $(document).on('click','.remove_combo',function(){
        $(this).closest('tr').remove();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script>
$(document).on('click', '.media-delete', function(){
    let type = 'gallery';
    if ($(this).hasClass('featured')) {
        type = 'featured';
    } if ($(this).hasClass('featured2')) {
        type = 'featured2';
    }

    let id = $(this).attr('id');
    swal({
        title: "Delete Media ?",
        text: "",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonText: 'Proceed',
    }, function () {
        $.ajax({
            url: '<?php echo e(route("admin.media.delete")); ?>',
            method: 'POST',
            data: {media:id},
        }).done(function(data, textStatus, jqXHR) {
            if (data) {
                swal("Success", "Media Deleted Successfully", "success");
                if (type == 'featured') {
                    $('#featured_image_div').load(location.href + ' #featured_image_div');
                }
                if (type == 'featured2') {
                    $('#featured_image_div2').load(location.href + ' #featured_image_div2');
                }
                if (type == 'gallery'){
                    $('#gallery_image_div').load(location.href + ' #gallery_image_div');
                }
            } else {
                swal("Error", "Something Went Wrong", "error");
            }
        });
    });
});

//variation scripts

    $("#variations").click(function() {
        if($(this).is(":checked")) {
            if($('#variations').html()==''){

            $('.variations_div').append('<div class="row"><div class="col-md-2"> <h5>Variable</h5></div><div class="col-md-4"><div class="form-group"><input type="text" id="sku" class="form-control input-sm" name="sku[]" placeholder="SKU Code" ></div></div><div class="col-md-4"><div class="form-group"><input type="text" id="v_name" class="form-control input-sm" name="variant_name[]" placeholder="Enter Name" ></div></div> <div class="col-md-2"><a href="javascript:;" class="add_more_variation" title="Add Variation"><i class="fa fa-plus-circle fa-2x"></i></a></div> </div>');
            $(".variations_div").show(300);
            }
            else
            {
            $(".variations_div").show(300);
            }

        } else {
             $(".variations_div").html('');
             $(".variations_div").append('<div class="append_variations_div"></div>');
            $(".variations_div").hide(200);
        }
    });

    var append_variations_data = `
    <div class="row">
    <div class="col-md-2">
    <h5>Variable</h5>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <input type="text" id="sku" class="form-control input-sm" name="sku[]" placeholder="SKU Code" required>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <input type="text" id="v_name" class="form-control input-sm" name="variant_name[]" placeholder="Enter Name" required>
    </div>
    </div>
    <div class="col-md-2">
    <a href="javascript:;" class="remove_variation" title="Add Variation">
    <i class="fa fa-minus-circle fa-2x text-danger"></i>
    </a>
    </div>
    </div>`;

    $(document).on('click','.add_more_variation',function(){
        $('.append_variations_div').append(append_variations_data);
    })

    $(document).on('click','.remove_variation',function(){
        $(this).closest('.row').remove();
    });

     <?php
        $data = json_decode($product->variation_data,true) ?? '';
        $variant_name = $data['variant_name'] ?? '';
        $skus         = $data['sku']     ?? '';
    ?>
    <?php if($product->is_variations == 1): ?>

        $("#variations").prop("checked",true);
        $(".variations_div").show(300);

         <?php $__currentLoopData = $variant_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              var html = `
                    <div class="row">
                    <div class="col-md-2">
                    <h5>Variable</h5>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                    <input type="text" id="sku" value="<?php echo e($skus[$index]); ?>" class="form-control input-sm" name="sku[]" placeholder="SKU Code">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                    <input type="text" id="v_name" value="<?php echo e($name); ?>" class="form-control input-sm" name="variant_name[]" placeholder="Enter Name">
                    </div>
                    </div>

                    <div class="col-md-2">
                    <a href="javascript:;" class="<?php echo e($index == 0?'add_more_variation':'remove_variation'); ?>" title="Add Variation">
                    <i class="<?php echo e($index == 0?'fa fa-plus-circle fa-2x':'fa fa-minus-circle fa-2x text-danger'); ?>"></i>
                    </a>
                    </div>
                    </div>`;

                    $('.append_variations_div').append(html);
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <?php endif; ?>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>