@extends('layouts.master')
@section('page-content')
<br>
<div class="col-lg-12">
	<div class="panel panel-color panel-success">
		<div class="panel-heading" style="background-color: #36404E">
			<h3 class="panel-title">Customer Details</h3>
		</div>
		<div class="panel-body text-capitalize">
			<div class="col-md-6">
				<p>Customer Name : {{ $user->name }}</p>
				<p>Mobile : {{$user->phone}}</p>
				<p>Email: <span class="text-lowercase">{{$user->email}}</span> </p>
			</div>
			<div class="col-md-6">
				<p>Total Purchase : {{$user->orders->count()}}</p>
				<p>Total Purchase Amount: &#8377; {{number_format($user->orders->sum('total'))}}</p>
				<p>
					Newsletter subscription:
					@if($user->subcribe_to_newsletter== 'yes')
					<i class="fa fa-check text-success"></i>
					@else
					<i class="fa fa-times text-danger"></i>
					@endif
				</p>
			</div>
		</div>
	</div>

	<div class="panel panel-color panel-success">
		<div class="panel-heading" style="background-color: #36404E;cursor: pointer;">
			<h3 class="panel-title " data-toggle="collapse" data-parent="#accordion-test" href="#Order">New Orders</h3>
		</div>
		<div class="panel-body table-responsive panel-collapse in " id="Order">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Invoice #</th>
						<th>Purchase date</th>
						<th>Mode Of Payment</th>
						<th>Amount</th>
						<th>Shipping Address</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($user->orders->load('payment') as $key => $order)
					<tr>
						<th>{{$key +1}}</th>
						<th class="text-uppercase">{{$order->payment->invoice_no}}</th>
						<td>
							{{date('M d, Y', strtotime($order->created_at))}} <br>
							<small>{{$order->created_at->diffForHumans()}}</small>
						</td>
						<td class="text-uppercase">
							{{$order->payment->method}} <br>
							{{$order->payment->utr_no}}
						</td>
						<td>&#8377; {{number_format($order->total)}}</td>
						<td>
							{{$order->city}}, {{$order->pincode}}
						</td>
						<td>
							<a href="{{route('admin.order.show', $order)}}">
								<i class="fa fa-eye"></i> more
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection