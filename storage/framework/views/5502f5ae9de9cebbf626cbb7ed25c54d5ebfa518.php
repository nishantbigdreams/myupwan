

<?php $__env->startSection('page-content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <li class="active">
                        <a href="#addCategories" data-toggle="tab" aria-expanded="true">
                            Add Master Product Attribute
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active" id="addCategories">
                        <form action="<?php echo e(url('admin/productattibute')); ?>" method="post"
                              enctype="multipart/form-data">
                            <div class="row">
                                <?php echo e(csrf_field()); ?>

                                <div class="col-md-12">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label">Product</label>

                                            <select class="form-control input-sm" name="p_id" id="template" required>
                                                <option disabled>Select Product</option>
                                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <option value="<?php echo e($product->id); ?>" data-sku="<?php echo e($product->name); ?>"
                                                            data-fields='<?php echo e($product->data); ?>'>
                                                        <?php echo e($product->name); ?>

                                                    </option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Master Attribute</label>

                                            <select class="form-control input-sm" name="patt_id" id="template" required>
                                                <option disabled>Select Product Attribute</option>
                                                <?php $__currentLoopData = $attributemasters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attributemaster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($attributemaster->id); ?>"
                                                            data-fields='<?php echo e($attributemaster->id); ?>'>
                                                        <?php echo e($attributemaster->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="control-label">Text</label>
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Enter Attribute Text" required="" name="text"
                                                       value="<?php echo e(old('text')); ?>">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                           
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-block">
                                    <i class="fa fa-check"></i> SAVE LISTING
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>