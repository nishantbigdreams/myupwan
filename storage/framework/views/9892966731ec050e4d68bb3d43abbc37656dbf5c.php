<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote.css" />
<link href="<?php echo e(asset('css/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-content'); ?>
<br/>
<div class="container-fluid">
    <form action="<?php echo e(url('admin/product')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="media_token" value="<?php echo e(time()); ?>">
        <div class="col-md-7">
            <div class="card-box">
                <div class="form-group">
                    <label class="control-label">Product Name </label>
                    <input type="text" class="form-control input-sm" name="name" placeholder="List Name" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Model</label>
                    <input type="text" class="form-control input-sm" name="model" placeholder="Model No " required>
                </div>
                <div class="form-group">
                    <label class="control-label">Product Video Url
                        <small class="text-danger">(Enter Valid Youtube URL by copying it from Browser Address Bar)</small>
                    </label>
                    <input type="text" class="form-control input-sm" name="video_url" placeholder="Youtube Product Url E.g https://www.youtube.com/watch?v=6ZfuNTqbHE8" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="control-label">Product Description </label>
                    <textarea name="description" class="form-control" rows="8"></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">MRP</label>
                            <input type="number" class="form-control input-sm" name="base_price" placeholder="Base Price"  min="0" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Image Alt Name</label>
                            <input type="text" class="form-control input-sm" name="alt_name" placeholder="Alt Name" placeholder="Alt Name" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Selling Price</label>
                            <input type="number" class="form-control input-sm" name="sell_price" placeholder="Sell Price" min="0" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Delivery Charge</label>
                            <input type="number" class="form-control input-sm" name="delevery_charge" placeholder="Delevery Charge"  step="any">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Product GST</label>
                            <input type="number" class="form-control input-sm" required name="product_gst" placeholder="Product Gst" value="18">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Product Weight(Kg)</label>
                            <input type="text" class="form-control input-sm" name="product_weight" placeholder="Product Weight in Kg" >
                        </div>
                    </div>


                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label class="control-label">Unit</label>
                            <input type="text" class="form-control input-sm" name="unit" placeholder="Product unit" >
                        </div>
                       <!--  <div class="form-group  text-center">
                            <label class="control-label">Unit</label>
                            <select class="form-control" name="unit">
                               <option value="Kg">Kg</option>
                               <option value="pieces">Piece</option>
                               <option value="Gm">Gm</option>
                                <option value="Packets">Packets</option>
                                <option value="Liter">Liter</option>
                                <option value="Nos">Nos</option>
                                <option value="Meter">METER</option>
                                <option value="Each">Each</option>
                                <option value="dozen">dozen</option>
                                <option value="Bunddle">Bunddle</option>
                                <option value="Box">Box</option>


                            </select>
                        </div> -->
                    </div>

                    <div class="clearfix">

                    </div>
                    <div id="combo-set" style="display:none;">

                        <div class="col-md-12">
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
                            </table>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-offset-6">
                        <button type="button" id="combo" class="btn btn-sm btn-primary pull-right">
                            <i class="ion-chevron-down"></i> Combo Setting
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label">Featured Image </label>
                        <div class="dropzone" id="featured">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Featured Image2 </label>
                        <div class="dropzone" id="featured2">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">Gallery Images </label>
                        <div class="dropzone" id="gallery">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-box">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="checkbox checkbox-custom">
                            <input type="checkbox" name="send_news_letter" id="NewsLetter">
                            <label for="NewsLetter">Send product as news letter</label>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="m-t-10">
                            Newsletter Members
                            <span class="badge">
                                <?php echo e($news_letter_member); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">SKU Code </label>
                            <input type="text" class="form-control input-sm" name="sku_code" placeholder="Unique Sku Code" required="">
                            <center id="sku_msg" style="height:5px"></center>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Similar products </label>
                            <input type="text" class="form-control input-sm" name="similar_products" placeholder="Similar products SKU Code">
                            <span class="help-block">
                                <small>Enter Sku seperated with coma ( , )</small>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="checkbox checkbox-custom">
                            <input type="checkbox" name="home_best_sellers" id="home_best_sellers" value="1" checked>
                            <label for="home_best_sellers">Our Best Sellers</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkbox checkbox-custom">
                            <input type="checkbox" name="home_recent_arrivals" id="home_recent_arrivals" value="1" checked>
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
                        <div class="col-md-2">
                            <h5>Variable</h5>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="sku" class="form-control input-sm" name="sku[]" placeholder="SKU Code">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="v_name" class="form-control input-sm" name="variant_name[]" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="javascript:;" class="add_more_variation" title="Add Variation">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="append_variations_div"></div>
                </div>
                <hr/>
                <?php echo $__env->make('admin.components.category_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                    <label class="control-label">Product Details </label>
                    <textarea name="details" class="form-control" rows="8"></textarea>
                </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary btn-block">
                <i class="fa fa-check"></i> SAVE LISTING
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-script'); ?>
<script type="text/javascript">

    let is_sku_available = false;
    $sku_msg = $('#sku_msg');
    $('input[name="sku_code"]').change(function(){
        let code = $(this).val();
        $sku_msg.html(
            `<small class="btn-link">
            CHECKING SKU CODE AVAILABILITY <i class="fa fa-spinner fa-spin"></i>
            </small>`
            );
        $.ajax({
            url: "<?php echo e(url('admin/check/sku_code')); ?>",
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote.min.js"></script>\

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
        url: "<?php echo e(url('admin/dropzone/media/uploads')); ?>",
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
        url: "<?php echo e(url('admin/dropzone/media/uploads')); ?>",
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
        url: "<?php echo e(url('admin/dropzone/media/uploads')); ?>",
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

    $('#combo').click(function(){
        $(this).toggleClass('btn-danger');
        $(this).find('i').toggleClass('ion-chevron-up');
        $('#combo-set').toggle();
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

    $("#variations").click(function() {
        if($(this).is(":checked")) {
            $(".variations_div").show(300);
        } else {
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
    <input type="text" id="sku" class="form-control input-sm" name="sku[]" placeholder="SKU Code">
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <input type="text" id="v_name" class="form-control input-sm" name="variant_name[]" placeholder="Enter Name">
    </div>
    </div>
    <div class="col-md-2">
    <a href="javascript:;" class="remove_variation" title="Add Variation">
    <i class="fa fa-minus-circle fa-2x text-danger"></i>
    </a>
    </div>
    </div>`;

    $('.add_more_variation').click(function(){
        $('.append_variations_div').append(append_variations_data);
    })

    $(document).on('click','.remove_variation',function(){
        $(this).closest('.row').remove();
    });
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
   

</script>



<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>