@extends('layouts.master')

@section('page-content')
<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<form method="post" action="{{route('admin.calculator.setting')}}">
					{{ csrf_field() }}
					<table class="table table-bordered table-striped m-0">
						<thead>
							<tr>
								<th>#</th>
								<th class="text-center" colspan="2">Shipping Fee charges (&#8377;)</th>
								<th class="text-center" colspan="2">Collection Fee charges (&#8377;)</th>
							</tr>
						</thead>
						<tbody>
							@php
								$zones = ['Local', 'Zonal', 'National'];
							@endphp
							@foreach ($zones as $key => $zone)
								<tr>
									<th>
										{{$zone}} Charges
										<input type="hidden" name="zone[]" value="{{$zone}}">
									</th>
									<td>
										Shipping Charges
										<input type="number" min="0" class="form-control input-sm" name="shipping_charge[]" placeholder="Shipping Charge" value="{{$charges[$key]->shipping_charge ?? ''}}">
									</td>
									<td>
										Tax
										<input type="number" min="0" class="form-control input-sm" name="shipping_tax[]" placeholder="18" value="{{$charges[$key]->shipping_tax ?? ''}}">
									</td>
									<td>
										Collection Charges
										<input type="number" min="0" class="form-control input-sm" name="collection_charge[]" placeholder="Collection charge" value="{{$charges[$key]->collection_charge ?? ''}}">
									</td>
									<td>
										Tax
										<input type="number" min="0" class="form-control input-sm" name="collection_tax[]" placeholder="18" value="{{$charges[$key]->collection_tax ?? ''}}">
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<br/>
					<button class="btn btn-custom pull-right">
						<i class="mdi mdi-check-all"></i> Save Settings
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
