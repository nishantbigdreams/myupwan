@extends('layouts.master')
@section('page-content')
<br>
<div class="col-lg-12">
	<div class="panel panel-color panel-success">
		<div class="panel-heading" style="background-color: #36404E">
			<h3 class="panel-title">Delivery Boy Details</h3>
		</div>
		<div class="panel-body text-capitalize">
			<div class="col-md-6">
				<p>Name : {{ $user->name }}</p>
				<p>Mobile : {{$user->mobile_no}}</p>
				<p>Email: <span class="text-lowercase">{{$user->email}}</span> </p>
				<p>vehicle_no: <span class="text-lowercase">{{$user->vehicle_no}}</span> </p>
				<p>vehicle_type: <span class="text-lowercase">{{$user->vehicle_type}}</span> </p>
				
			</div>
			<div class="col-md-6">
				<img src="{{ url('storage/restaurant/'.$user->profile) }}"  class="img-responsive" alt="{{ $user->name }}" title="{{ $user->name }}" style="width: 200px; height: 200px;" />
				<!-- <p>
					Newsletter subscription:
					@if($user->subcribe_to_newsletter== 'yes')
					<i class="fa fa-check text-success"></i>
					@else
					<i class="fa fa-times text-danger"></i>
					@endif
				</p> -->
			</div>
		</div>
	</div>

	<!-- <div class="panel panel-color panel-success">
		<div class="panel-heading" style="background-color: #36404E;cursor: pointer;">
			<h3 class="panel-title " data-toggle="collapse" data-parent="#accordion-test" href="#Order">New Orders</h3>
		</div>
		
	</div> -->
</div>
@endsection