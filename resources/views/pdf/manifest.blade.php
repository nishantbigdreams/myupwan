<!DOCTYPE html>
<html>
<head>
	<title>MANIFEST</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
	.order-block{page-break-inside: avoid;}	
	.order-block>div{
		margin-top:5px;
	}
</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-6" style="padding: 0px">
				<img src="{{ public_path('images/pdf/novasell-invoice.jpeg') }}" alt="NOVASELL LOGO" class="img-responsive center-block" style="height:150px;width: 100%">
			</div>
			<div class="col-xs-6" style="margin-top: 30px">
				<div class="pull-right">
					<h4>Logistics Manifest</h4>
					<h5>No of Dispatch: {{count($orders)}}</h5>
					<h5>Generated On: {{date('d M, Y')}}</h5>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<th>Sr</th>
					<th>Order Id</th>
					<th>Tracking Id</th>
					<th>RTS Date</th>
				</thead>
				<tbody>
					@foreach($orders as $order)
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{$order->order_id}}</td>
						<td>{{$order->BdOrder->awb_no}}</td>
						<td></td>
					</tr>
					@endforeach		
				</tbody>
			</table>
			<div style="border: 1px dotted black;padding: 10px;font-size:18px" class="order-block">
				<div class="col-xs-6">
					PickUp Date: ______________
				</div>
				<div class="col-xs-6">
					Total Items Picked : ______________
				</div>
				<div class="col-xs-12">
					PickUp Time: ______________
				</div>
				<div class="col-xs-6">
					FE Name : ______________
				</div>
				<div class="col-xs-6">
					FE Sign : ______________
				</div>
				<div class="col-xs-12" style="height: 80px"></div>
				<div class="col-xs-12">
					<span class="pull-right col-xs-3 col-xs-offset-7">
						SELLER SIGNATURE
					</span>
				</div>
				<div class="clearfix"></div>
			</div>
			<center>
				<small>
					This is system generated document
				</small>
			</center>
		</div>
	</div>
</body>
</html>