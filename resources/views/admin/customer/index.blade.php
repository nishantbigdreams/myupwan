@extends('layouts.master')
@section('styles')
<style media="screen">
mark{background:#188ae2;color:#fff;}
.panel{
	border: initial;
}
.panel-heading {
	padding: 5px;
}
.panel .panel-body {
	padding: 10px;
}
</style>
@endsection
@section('page-content')
<br>
<br>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Time</th>
						<th>View</th>
					</tr>
				</thead>
						
			</table>
		</div>
	</div>
</div>
@endsection
@section('page-scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript">
	let table;
	$(document).ready( function () {

    $(document).on('click','.approval', function(){


     let id = $(this).attr('id'); 

	    	var r = confirm("Are you sure to confirm ..?");
			  if (r == true) {
			  	 
			   $.ajax({
                    url:'/admin/userapproval',
                    type:'POST',
                    data:{id : id, _token:'{{ csrf_token() }}'},
                    success : function(response) {

                      $( "#datatable" ).load( "/admin/customer .dataTable" );

                    }
                });
			  }

		});

    // 	 swal({
			 //    title: "Are you sure?",
			 //    text: "You will not be able to recover this imaginary file!",
			 //    type: "warning",
			 //    showCancelButton: true,
			 //    confirmButtonColor: '#DD6B55',
			 //    confirmButtonText: 'Yes, I am sure!',
			 //    cancelButtonText: "No, cancel it!",
			 //    closeOnConfirm: false,
			 //    closeOnCancel: false
			 // },
			 // function(isConfirm){

			 //   if (isConfirm.value){
			 //      $.ajax({
	   //                  url:'/admin/userapproval/'+ id,
	   //                  type:'post',
	   //                  data:{_method:'delete',_token:'{{ csrf_token() }}'},
	   //                  success : function(response) {
	   //                      swal("Poof! Your imaginary file has been deleted!", {
	   //                          icon: "success",
	   //                      });
	   //                      $( ".dataTable" ).load( "/region .dataTable" );
	   //                  }
	   //              })

			 //    } else {
			 //      swal("Cancelled", "Your imaginary file is safe :)", "error");
			 //         e.preventDefault();
			 //    }
			 // });

    // });

		table =  $('table').DataTable({
			'language':{
				"loadingRecords": "&nbsp;",
				"processing": "Loading customers..."
			},
			"ajax": "{{route('customer.all')}}",
			'mark':true,
			"processing": true,
			'dom': 'Bfrtip',
			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": [0]
			}],
			'buttons': [
			{
				className: 'btn btn-info',
				title: 'All Customers',
				text: 'EXCEL',
				extend: 'excelHtml5',
				exportOptions: {
					columns: [1,2,3 ]
				}
			}
			]
		});
		table.on( 'order.dt search.dt', function () {
			table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			});
		}).draw();


	});
</script>
@endsection