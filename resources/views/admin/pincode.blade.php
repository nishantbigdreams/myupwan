@extends('layouts.master')

@section('page-content')

   
   <div class="container">
      <div class="card-box text-center">
      		 <table class="table table-stripped table-bordered dataTable" id="pincode_listing" style="width:100%">
      		 	<thead>
      		 	  <tr>
                  <th class="text-center">#</th>
      		 	  	  <th class="text-center" width="20%">Pincode</th>
      		 	  	  <th class="text-center">Block</th>
      		 	  	  <th class="text-center">COD</th>
      		 	  	  <th class="text-center">Refund</th>
      		 	  	  <th class="text-center">Action</th>
      		 	  </tr>
      		 	</thead>
      		 	<tbody>

            </tbody>
      		 </table>
      </div>
   </div>

@endsection

@section('page-scripts')
<script type="text/javascript">

    let lived_list = $('#pincode_listing').DataTable({
        'language':{
            "loadingRecords": "&nbsp;",
            "processing": "Loading Pincode"
        },
        'mark':true,
        "ajax": {
            "url" : "{{route('admin.get_pincode')}}",
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

            $(document).on('click','.save_pincode', function(){

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
				  url: "{{ route('admin.update_pincode_status') }}",
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
        });


</script>
@endsection