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


<header class="page-header text-center">
	<h1 class="page-title">Dashboard</h1>
</header>
<label >Hi. {{ Auth::guard('admin')->user()->name }}</label>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Order No</th>
						<th>Name</th>
						<th>Contact</th>
						<th>Address</th>
						<th>Selected Time</th>
						<th>time</th>
						<th>Payment</th>						
						<th>Packets</th>
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
		table =  $('table').DataTable({
			'language':{
				"loadingRecords": "&nbsp;",
				"processing": "Loading customers..."
			},
			"ajax": "{{route('admin.order.all')}}", 
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