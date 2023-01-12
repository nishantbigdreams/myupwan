<div class="form-group ">
    <label for="contact_person">Contact Person:
        <small class="text-danger">Max (30) Chars</small>
    </label>
    <input type="text" class="form-control" id="contact_person" required value="<?php echo e(old('contact_person') ?? auth()->user()->contact_person ?? ( auth()->user()->name ??'')); ?>" name="contact_person" placeholder="Contact Person Name" maxlength="30" required>

</div>
<div class="form-group">
    <label for="contact_number">Contact Person Phone:</label>
    <input type="text" class="form-control" id="contact_number" required value="<?php echo e(old('contact_number') ?? auth()->user()->contact_number ?? auth()->user()->phone ??''); ?>" name="contact_number" placeholder="Contact Number" required>
</div>
<div class="form-group ">
    <label for="address_line_0">Flat / Room no / Building name:
        <small class="text-danger">Max (30) Chars</small>
    </label>
    <input type="text" class="form-control" id="address_line_0" required value="<?php echo e(old('address_line_0') ?? auth()->user()->address_line_0 ?? ''); ?>" name="address_line_0" maxlength="30" placeholder="Flat / Room no / Building name" required>

</div>
<div class="form-group">
    <label for="address_line_1">Street Name / Area Name:
        <small class="text-danger">Max (30) Chars</small>
    </label>
    <input type="text" class="form-control" id="address_line_1" required value="<?php echo e(old('address_line_1') ?? auth()->user()->address_line_1 ?? ''); ?>" name="address_line_1" maxlength="30" placeholder="Street Name / Area Name" required>

</div>
<div class="form-group">
    <label for="address_line_2">Landmark:
        <small class="text-danger">Max (30) Chars</small>
    </label>
    <input type="text" class="form-control" id="address_line_2" required value="<?php echo e(old('address_line_2') ?? auth()->user()->address_line_2 ?? ''); ?>" name="address_line_2" maxlength="30" placeholder="locality/landmark" required>

</div>
<input type="hidden" name="flag_coupen" id="flag_coupen" value="0">
<input type="hidden" name="coupen_id" id="coupen_id" value="0">


<div class="row">
    <div class="col-md-6">
        <div class="form-group ">
            <label for="bill_pincode">Pincode:</label>
            <small class="text-primary pincode_loader"></small>
            <input type="text" class="form-control pincode" id="bill_pincode" required value="<?php echo e(old('pincode') ?? auth()->user()->pincode ?? ''); ?>" name="pincode" maxlength="6" pattern="^[1-9][0-9]{5}$" placeholder="pincode" required="required" required>
        </div>
    </div>
    <div class="col-md-6" style="">
        <div class="form-group ">
            <label for="city">City:</label>
            <input type="text" class="form-control city" id="city" required value="<?php echo e(old('city') ?? auth()->user()->city ?? ''); ?>" name="city" placeholder="city" readonly="">

        </div>
    </div>
    
     <div class="col-md-12">
        <div class="form-group ">
            <label for="state">State:</label>
            <input type="text" class="form-control" id="state" required value="<?php echo e(old('state') ?? auth()->user()->state ?? ''); ?>" name="state" placeholder="state" readonly="">
        </div>
    </div>

     <div class="col-md-12">
        <div class="form-group ">
            <label for="state">Delivery Time Slot:</label>
            <select class="form-control" name="delivery_time" required="" id="timeslot">
                            <option  value="">Select Delivery Time</option>  
             
                 <?php $__currentLoopData = $dropdownValue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  value="<?php echo e($value); ?>"><?php echo e($value); ?></option>  
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
            
            </select>
        </div>
        
    </div>
   

</div>

<?php $__env->startPush('page-script'); ?>
    <script type="text/javascript">
    $(function(){
        $(document).on('change keyup', '.pincode', function(){
            console.log('ok');
            if ($(this).val().length == 6) {
                $this = $(this);
                $loader = $this.parent().find('.pincode_loader');
                $input = $this.parent().parent().parent();
                $loader.html('<i class="fa fa-spinner fa-spin"></i>');
                $.ajax({
                    url: "<?php echo e(route('get_state_city')); ?>",
                    method: 'post',
                    data:{pincode:$this.val()},
                }).done(function(data, textStatus, jqXHR) {
                    $loader.html('');
                    let state = '', city = '';
                    if(data['status']=="success")
                    {

                        city=data['city'];
                        state=data['state'];
                    }else
                    {
                        console.log(data);
                        $loader.html('<i class="fa fa-times text-danger">Shipping Not Available</i>');
                    }
                    // let response = JSON.parse(data);
                    // let state = '', city = '';
                    // if (!response.PostOffice || response.PostOffice.length < 0) {
                    //     $loader.html('<i class="fa fa-times text-danger">Invalid Pincode</i>');
                    // } else {
                    //     city = response.PostOffice[0].Region;
                    //     state = response.PostOffice[0].State;
                    // }
                    $input.find('input[name=city]').val(city);
                    $input.find('input[name=state]').val(state);
                            $.ajax({
                            method : 'post',
                            url : "<?php echo e(route('shipping_availability')); ?>",
                            data : {pincode : $this.val()},

                            success : function(data){
                            $loader.html(data);
                            // city = response.PostOffice[0].Region;
                            // state = response.PostOffice[0].State;   
                            if(data.includes("Cash on Delivery not Available"))
                            {
                                $("#cod_content").hide();
                                $("#cod_not_available").removeClass("hide");
                            }
                            else
                            {
                                $("#cod_content").show();
                                $("#cod_not_available").addClass("hide");
                            }
                                                   }
                        });
                });
            }
        });
    });
    </script>
<?php $__env->stopPush(); ?>
