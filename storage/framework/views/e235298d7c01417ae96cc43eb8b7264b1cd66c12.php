

<?php $__env->startSection('page-content'); ?>

   
   <div class="container">
    
      <div class="card-box text-center">
      		 <table class="table table-stripped table-bordered dataTable" id="pincode_listing" style="width:100%">
      		 	<thead>
      		 	  <tr>
                  <th class="text-center">#</th>
                      <th class="text-center" width="20%">Product Name</th>
      		 	  	  <th class="text-center" width="20%">User Name</th>
      		 	  	  <th class="text-center">Review</th>
      		 	  	  <th class="text-center">Rating</th>
      		 	  	  <th class="text-center">Create Date</th>
                      <th class="text-center">Status</th>
      		 	  	  <th class="text-center">Action</th>
      		 	  </tr>
      		 	</thead>
      		 	<tbody>

            </tbody>
      		 </table>
      </div>
   </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
<script type="text/javascript">

    let lived_list = $('#pincode_listing').DataTable({
        
        'language':{
            "loadingRecords": "&nbsp;",
            "processing": "Loading Pincode"
        },
        'mark':true,
        "ajax": {
            "url" : "/admin/get_review",
            "type" : "GET",
            "data" : function(d){
                
               
            }
        },
        "processing": true,
        "pageLength": 100,
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0,1]
        }]
    });
    lived_list.on( 'order.dt search.dt', function () {
        lived_list.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
    lived_list.on('draw.dt', function(){
        $('#live_list_count').html('Live (' + lived_list.page.info().recordsTotal +' )');
    });

            /*$(document).on('click','.save_pincode', function(){

            var pincode = $(this).parent().parent().find(".pincode_name").text();

            var pincode_block = "0";
            if($(this).parent().parent().find(".pincode_block").is(':checked'))
            {
				pincode_block = "1";
            }

            var pincode_cod = "0";
            if($(this).parent().parent().find(".pincode_cod").is(':checked'))
            {
				pincode_cod = "1";
            }

            var pincode_refund = "0";
            if($(this).parent().parent().find(".pincode_refund").is(':checked'))
            {
				pincode_refund = "1";
            }

               
				$.ajax({
				  url: "<?php echo e(route('admin.update_pincode_status')); ?>",
				  method: "POST",
				  data: {
					  'pincode' : pincode,
  					  'pincode_block' : pincode_block,
  					  'pincode_cod' : pincode_cod,
  					  'pincode_refund' : pincode_refund,
					},
				  cache: false,
				  success: function(html){

                    alert("Pincode status successfully updated!");

				  }
				});
        });*/
        function change_status(id,status){
          
            $.ajax({
                  url: "/admin/update_review_status",
                  method: "POST",
                  data: {
                      'review_id' : id,
                      'status'    : status
                      
                    },
                  cache: false,
                  success: function(html){

                    alert("Review status has been updated Successfully!");
                    location.reload();

                  }
                });
        }


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>