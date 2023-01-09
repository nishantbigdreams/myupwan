
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-xs-6">
        <i class="fa fa-check-circle"></i> Product Specficification
    </div>
    <div class="col-xs-6">
        <a href="<?php echo e(route('admin.category.create')); ?>" class="btn btn-link w-lg">
            <i class="mdi mdi-plus-circle-outline"></i> Or Create New
        </a>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Category Template </label>
    <div class="col-sm-9">
        

        

        <?php 
        $selected = '';
        if($product->name !="empty"){
            $categorySelected   =   [];
            $product_category   =   json_decode($product->category,true);
            $selected           =   '';

            //$size               =   sizeof($product_category);
            



            

        }



        ?>
       
        <?php if(@$categories[21]->name == @$product->category): ?>



        <?php endif; ?>

        <select class="js-example-basic-multiple" name="category[]" multiple="multiple" id="template" required>
            <option disabled>Select Template</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                
                


                
                <option value="<?php echo e($category->name); ?>"    data-last_prd_sku="<?php echo e($category->last_product()->sku ?? '0'); ?>" data-sku="<?php echo e($category->sku_initial); ?>" data-fields='<?php echo e($category->data); ?>' selected="<?php echo e($selected); ?>">
                    <?php echo e(str_replace("%26","&",$category->name)); ?>

                </option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>
        
        <br>
    </div>
    <div class="clearfix"></div>
    <div id="field_content" class="row"></div>

</div>


<?php $__env->startPush('page-script'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script type="text/javascript">
         $(document).ready(function() {
        $(".js-example-basic-multiple").select2({
            tags: true
        });
    });
    let product_data = [];


    

    if(<?php echo e($product->name!="empty"); ?>){
       // $("js-example-basic-multiple").val("Seeds")
        

    }

    if ("<?php echo e(isset($product)); ?>")
    {
        product_data = JSON.parse('<?php echo str_replace("'", "\'", $product->data?? "") ?? ""; ?>');
        product_data = Object.entries(product_data);
    }

     $("#template").val(["MCH Boys Branch","MCH Girls Branch","JPPS Shuja Abad Campus"]).trigger("change")

    $fields = $('#field_content');
    $sku_field = $('input[name="sku_code"]');

    let setInputState = (type, name, value) => {
        if (type == 'checkbox') {
            let match_found = false;
            product_data.forEach(function(data){
                if (data[0] == name){
                    if (data[1] == value){
                        match_found = true;
                        // break;
                    }
                }
            });
            return match_found ? 'checked' : '';
        } else {
            let value = ''
            product_data.forEach(function(data){
                if (data[0] == name) {
                    value =  data[1];
                    // break;
                }
            });
            return value==null?"":value;
        }
        return '';
    }

    let mapField = (attribute) => {

        console.log(attribute);

        let append_str = `<div class="col-xs-12"><i class="fa fa-circle"></i> ${attribute[0].name}</div>`;
        let attribute_str = `<div class="col-xs-11 col-xs-offset-1 m-t-15">`;
        attribute[1].forEach(function(object){
            if (object.type == 'checkbox') {
                
                attribute_str += `
                <div class="col-xs-4">
                    <label class="control-label">
                        <input type="checkbox" name="${attribute[0].name}" value="${object.attribute} " ${setInputState(object.type, attribute[0].name, object.attribute)} >
                        ${object.attribute}
                    </label>
                </div>`;

            } else {

                attribute_str += `
                <div class="col-xs-12 m-t-10">
                    <label class="control-label col-xs-3">${object.attribute}</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control input-sm" placeholder="Enter ${object.attribute}" name="${object.attribute}" value="${setInputState(object.type, object.attribute, '')}">
                    </div>
                </div>`;

            }
        });
        attribute_str += `</div>`;
        return append_str + attribute_str;
    }

    let showCategoryTemplate = () => {
        let field_array = $('#template option:selected').data('fields');
        $fields.html(field_array.map(mapField));
        let new_prd_sku = '';
        let sku_prefix = $('#template option:selected').data('sku') + '-';
        let last_prd_sku = 0;
        if ($('#template option:selected').data('last_prd_sku')) {
            let tmp = $('#template option:selected').data('last_prd_sku').split('-');
            last_prd_sku = parseInt(tmp[1]);
        }
        new_prd_sku = sku_prefix + (++last_prd_sku);
        <?php if(!isset($product)): ?>
        $sku_field.val(new_prd_sku).trigger('change');
        <?php endif; ?>
    }

    if ("<?php echo e(isset($product)); ?>") {
        var str = "<?php echo e($product->category ?? ''); ?>";
        $('#template').val(str.replace("&amp;", "&")).change();
        showCategoryTemplate();
    }

    $('#template').change(showCategoryTemplate);

        $(document).on('click','#field_content input[type="checkbox"]',function(){
         var $box = $(this);
          if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
          } else {
            $box.prop("checked", false);
          }
    })

</script>
<?php $__env->stopPush(); ?>
