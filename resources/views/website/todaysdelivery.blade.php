@extends('layouts.website_master')
@section('body_content')
<?php
$disable = "";
$gapclass = "";
if(auth()->user()->firstlogin == "No"){
    $disable = 'disabled';
    $gapclass = "gap";
}
?>
<div class="global-wrapper clearfix" id="global-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<header class="page-header">
					<h1 class="page-title">Today's Delivery</h1>
				</header>
				<div class="box-lg">
					<div class="row" data-gutter="60">
                        <div class="col-md-10">
                           <h3 class="widget-title">Today's Delivery</h3>
                           <form class="" action="{{route('profile.updaterestoinfo')}}" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group {{$errors->has('restaurant_name')? 'has-error':''}}">
                                 <label for="restaurant_name">Region:</label>
                                 <input type="text" class="form-control" id="restaurant_name" required value="{{old('restaurant_name') ?? auth()->user()->restaurant_name}}" name="restaurant_name" {{$disable}}>
                                 @if($errors->has('restaurant_name'))
                                 <span class="text-danger">{{$errors->first('restaurant_name')}}</span>
                                 @endif
                             </div>
                             <div class="custom-file form-group {{$errors->has('restaurant_logo')? 'has-error':''}}">
                                 <input type="file"  class="custom-file-input" id="restaurant_logo" required name="restaurant_logo" {{$disable}}>
                                 <label class="custom-file-label" for="restaurant_logo">Upload Restaurant Logo Photo Choose file</label>
                             </div>
                             @if(isset(auth()->user()->restaurant_logo))
                             <a href="{{url('storage/restaurant/'.auth()->user()->restaurant_logo)}}" rel="bookmark" target="_blank">
                                 <img src="{{url('storage/'.auth()->user()->restaurant_logo)}}" alt="" class="img-responsive">
                             </a>
                             @endif
                             <div class="form-group {{$errors->has('licence')? 'has-error':''}}">
                                 <label for="licence">Location:</label>
                                 <input type="text" class="form-control" id="licence" required value="{{old('licence') ?? auth()->user()->licence}}" name="licence" {{$disable}}>
                                 @if($errors->has('licence'))
                                 <span class="text-danger">{{$errors->first('licence')}}</span>
                                 @endif
                             </div>
                             <div class="custom-file form-group {{$errors->has('licence_image')? 'has-error':''}}">
                                 <input type="file"  class="custom-file-input" id="licence_image" required name="licence_image" {{$disable}}>
                                 <label class="custom-file-label" for="licence_image">Upload Restaurant licence Photo Choose file</label>
                             </div>
                             <div class="form-group {{$errors->has('certificate_no')? 'has-error':''}}">
                                 <label for="certificate_no">Store:</label>
                                 <input type="text" class="form-control" id="certificate_no" required value="{{old('certificate_no') ?? auth()->user()->certificate_no}}" name="certificate_no" {{$disable}}>
                                 @if($errors->has('certificate_no'))
                                 <span class="text-danger">{{$errors->first('certificate_no')}}</span>
                                 @endif
                             </div>
                             <div class="custom-file form-group {{$errors->has('certificate_image')? 'has-error':''}}">
                                 <input type="file"  class="custom-file-input" id="certificate_image" required name="certificate_image" {{$disable}}>
                                 <label class="custom-file-label" for="certificate_mage">Upload Registration Certificate Photo Choose file</label>
                             </div>
                             <div class="form-group {{$errors->has('restaurant_phone')? 'has-error':''}}">
                                 <label for="restaurant_phone">Name:</label>
                                 <input type="number" class="form-control" id="restaurant_phone" required value="{{old('restaurant_phone') ?? auth()->user()->restaurant_phone}}" name="restaurant_phone" {{$disable}}>
                                 @if($errors->has('restaurant_phone'))
                                 <span class="text-danger">{{$errors->first('restaurant_phone')}}</span>
                                 @endif
                             </div>
                             <div class="form-group {{$errors->has('owner_name')? 'has-error':''}}">
                                 <label for="owner_name">Packs:</label>
                                 <input type="text" class="form-control" id="owner_name" required value="{{old('owner_name') ?? auth()->user()->owner_name}}" name="owner_name" {{$disable}}>
                                 @if($errors->has('owner_name'))
                                 <span class="text-danger">{{$errors->first('owner_name')}}</span>
                                 @endif
                             </div>
                             <div class="form-group {{$errors->has('owner_mobile_no')? 'has-error':''}}">
                                 <label for="owner_name">Concern Person:</label>
                                 <input type="number" class="form-control" id="owner_mobile_no" required value="{{old('owner_mobile_no') ?? auth()->user()->owner_mobile_no}}" name="owner_mobile_no"{{$disable}}>
                                 @if($errors->has('owner_mobile_no'))
                                 <span class="text-danger">{{$errors->first('owner_mobile_no')}}</span>
                                 @endif
                             </div>
                             <div class="form-group {{$errors->has('email')? 'has-error':''}}">
                                 <label for="email">Time Of Delivery:</label>
                                 <input type="email" class="form-control" id="owner_email" required value="{{old('owner_email') ?? auth()->user()->owner_email}}" name="owner_email" {{$disable}}>
                                 @if($errors->has('owner_email'))
                                 <span class="text-danger">{{$errors->first('owner_email')}}</span>
                                 @endif
                             </div>
                             <div class="form-group {{$errors->has('manager_name')? 'has-error':''}}">
                                 <label for="manager_name">Note:</label>
                                 <input type="text" class="form-control" id="manager_name" required value="{{old('manager_name') ?? auth()->user()->manager_name}}" name="manager_name" {{$disable}}>
                                 @if($errors->has('manager_name'))
                                 <span class="text-danger">{{$errors->first('manager_name')}}</span>
                                 @endif
                             </div>
                            		<!-- <div class="form-group {{$errors->has('manager_mobile_no')? 'has-error':''}}">
                            			<label for="manager_mobile_no">Manager Mobile No:</label>
                            			<input type="number" class="form-control" id="manager_mobile_no" required value="{{old('manager_mobile_no') ?? auth()->user()->manager_mobile_no}}" name="manager_mobile_no" {{$disable}}>
                            			@if($errors->has('manager_mobile_no'))
                            			<span class="text-danger">{{$errors->first('manager_mobile_no')}}</span>
                            			@endif
                            		</div>
                            		<div class="form-group {{$errors->has('gst')? 'has-error':''}}">
                            			<label for="manager_name">GST :</label>
                            			<input type="text" class="form-control" id="gst" required value="{{old('gst') ?? auth()->user()->gst}}" name="gst" {{$disable}}>
                            			@if($errors->has('gst'))
                            			<span class="text-danger">{{$errors->first('gst')}}</span>
                            			@endif
                            		</div>
                            		<div class="form-group {{$errors->has('restaurant_address')? 'has-error':''}}">
                            			<label for="restaurant_address">Restaurant Address :</label>
                            			<textarea name="restaurant_address" rows="4" id="restaurant_address" class="form-control" {{$disable}}>{{old('restaurant_address') ?? auth()->user()->restaurant_address}}</textarea>

                            			@if($errors->has('restaurant_address'))
                            			<span class="text-danger">{{$errors->first('restaurantrestaurant_address')}}</span>
                            			@endif
                            		</div>
                            		<div class="form-group {{$errors->has('billing_address')? 'has-error':''}}">
                            			<label for="billing_address">Billing Address :</label>
                            			<textarea name="billing_address" rows="4" id="billing_address" class="form-control" {{$disable}}>{{old('billing_address') ?? auth()->user()->billing_address}}</textarea>

                            			@if($errors->has('billing_address'))
                            			<span class="text-danger">{{$errors->first('billing_address')}}</span>
                            			@endif
                            		</div> -->
                            		<button type="button" name="submit" class="btn btn-primary" data-toggle="modal" data-target="#Delivered">
                            			Delivered
                            		</button>
                                    <!-- Modal -->
                                    <div id="Delivered" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delivery Delivered</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Delivery Delivered</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" name="submit" class="btn" data-toggle="modal" data-target="#Rejected" style="color: #fff!important;background: #ff0000;border-color: #2b8dfc;padding: 10px 30px 10px 30px;border-radius: 3px;margin-bottom: 10px; margin-left: 5px;">
                                Rejected
                            </button>
                            <!-- Modal -->
                            <div id="Rejected" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Delivery Rejected</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Delivery Rejected</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="gap gap-small"></div>

@endsection
