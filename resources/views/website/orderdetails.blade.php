@extends('layouts.website_master')
@section('body_content')

<style type="text/css">
	* {
		margin: 0px; 
		padding: 0px; 
		box-sizing: border-box;
	}

	body, html {
		height: 100%;
		font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important;
		letter-spacing: 0.2px;
	}

	/*---------------------------------------------*/
	a {

		font-size: 14px;
		line-height: 1.7;
		color: #666666;
		margin: 0px;
		transition: all 0.4s;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		-moz-transition: all 0.4s;
	}

	a:focus {
		outline: none !important;
	}

	a:hover {
		text-decoration: none;
	}
	/*---------------------------------------------*/
	h1,h2,h3,h4,h5,h6 {
		margin: 0px;
	}

	p {

		font-size: 14px;
		line-height: 1.7;
		color: #666666;
		margin: 0px;
	}

	ul, li {
		margin: 0px;
		list-style-type: none;
	}
	/*---------------------------------------------*/
	input {
		outline: none;
		border: none;
	}

	input[type="number"] {
		-moz-appearance: textfield;
		appearance: none;
		-webkit-appearance: none;
	}

	input[type="number"]::-webkit-outer-spin-button,
	input[type="number"]::-webkit-inner-spin-button {
		-webkit-appearance: none;
	}

	textarea {
		outline: none;
		border: none;
	}

	textarea:focus, input:focus {
		border-color: transparent !important;
	}

	input:focus::-webkit-input-placeholder { color:transparent; }
	input:focus:-moz-placeholder { color:transparent; }
	input:focus::-moz-placeholder { color:transparent; }
	input:focus:-ms-input-placeholder { color:transparent; }

	textarea:focus::-webkit-input-placeholder { color:transparent; }
	textarea:focus:-moz-placeholder { color:transparent; }
	textarea:focus::-moz-placeholder { color:transparent; }
	textarea:focus:-ms-input-placeholder { color:transparent; }

	input::-webkit-input-placeholder {color: #999999;}
	input:-moz-placeholder {color: #999999;}
	input::-moz-placeholder {color: #999999;}
	input:-ms-input-placeholder {color: #999999;}

	textarea::-webkit-input-placeholder {color: #999999;}
	textarea:-moz-placeholder {color: #999999;}
	textarea::-moz-placeholder {color: #999999;}
	textarea:-ms-input-placeholder {color: #999999;}

	/*---------------------------------------------*/
	button {
		outline: none !important;
		border: none;
		background: transparent;
	}

	button:hover {
		cursor: pointer;
	}

	iframe {
		border: none !important;
	}
/*//////////////////////////////////////////////////////////////////
[ Contact ]*/

.container-contact100 {
	width: 100%;  
	min-height: 100vh;
	display: -webkit-box;
	display: -webkit-flex;
	display: -moz-box;
	display: -ms-flexbox;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	align-items: center;
	padding: 15px;
	background: transparent;
	position: relative;
	z-index: 1;
}

.contact100-map {
	position: absolute;
	z-index: -2;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
}

.wrap-contact100 {
	/*width: 670px;*/
	background: #fff;
	border-radius: 30px;
	overflow: hidden;
	position: relative;
	box-shadow: 0px 0px 10px 0px #504f4f;
	margin-top: 40px;
	margin-bottom: 10px;
	opacity: 0.9;
}
/*==================================================================
[ Title form ]*/
.contact100-form-title {
	width: 100%;
	position: relative;
	z-index: 1;
	display: -webkit-box;
	display: -webkit-flex;
	display: -moz-box;
	display: -ms-flexbox;
	display: flex;
	flex-wrap: wrap;
	flex-direction: column;
	align-items: center;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
	/*padding: 64px 15px 64px 15px;*/
	padding: 30px;
	text-transform: uppercase;
}

.contact100-form-title-1 {

	font-size: 28px;
	color: #fff;
	line-height: 1.2;
	text-align: center;
	/*padding-bottom: 7px;*/
}

.contact100-form-title-2 {

	font-size: 15px;
	color: #fff;
	line-height: 1.5;
	text-align: center;
}
.contact100-form-title::before {
	content: "";
	display: block;
	position: absolute;
	z-index: -1;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	/*background-color: rgba(54,84,99,0.7);*/
	/*background-color: #84c225;*/
}
/*==================================================================
[ Form ]*/

.contact100-form {
	width: 100%;
	display: -webkit-box;
	display: -webkit-flex;
	display: -moz-box;
	display: -ms-flexbox;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	/*padding: 43px 88px 57px 190px;*/
	padding: 30px;
}

/*------------------------------------------------------------------
[ Input ]*/

.wrap-input100 {
	width: 100%;
	position: relative;
	border-bottom: 1px solid #b2b2b2;
	margin-bottom: 30px;
}

.label-input100 {
	font-size: 15px;
	color: #000;
	line-height: 1.2;
	text-align: right;
	position: absolute;
	top: 4px;
	width: 125px;
	left: 0px;
}
/*---------------------------------------------*/
.input100 {
	font-size: 15px;
	color: #555555;
	line-height: 1.2;

	display: block;
	width: 100%;
	background: transparent;
	padding: 0 5px;
}

.focus-input100 {
	position: absolute;
	display: block;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	pointer-events: none;
}

.focus-input100::before {
	content: "";
	display: block;
	position: absolute;
	bottom: -1px;
	left: 0;
	width: 0;
	height: 1px;

	-webkit-transition: all 0.6s;
	-o-transition: all 0.6s;
	-moz-transition: all 0.6s;
	transition: all 0.6s;

	background: #57b846;
}
/*---------------------------------------------*/
input.input100 {
	height: 45px;
}
textarea.input100 {
	min-height: 115px;
	padding-top: 14px;
	padding-bottom: 13px;
}
.input100:focus + .focus-input100::before {
	width: 100%;
}

.has-val.input100 + .focus-input100::before {
	width: 100%;
}
p {
	font-size: 0.6em!important;
	margin-top: -8px!important;
}

/*------------------------------------------------------------------
[ Button ]*/
.container-contact100-form-btn {
	width: 100%;
	display: -webkit-box;
	display: -webkit-flex;
	display: -moz-box;
	display: -ms-flexbox;
	display: flex;
	flex-wrap: wrap;
	padding-top: 8px;
}

.contact100-form-btn {
	display: -webkit-box;
	display: -webkit-flex;
	display: -moz-box;
	display: -ms-flexbox;
	display: flex;
	justify-content: center;
	align-items: center;
	padding: 0 20px;
/*min-width: 160px;
line-height: 1.2;*/
min-width: 150px;
font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important;
height: 50px;
background-color: #57b846;
border-radius: 25px;
font-size: 16px;
color: #fff;

-webkit-transition: all 0.4s;
-o-transition: all 0.4s;
-moz-transition: all 0.4s;
transition: all 0.4s;
}

.contact100-form-btn i {
	-webkit-transition: all 0.4s;
	-o-transition: all 0.4s;
	-moz-transition: all 0.4s;
	transition: all 0.4s;
}

.contact100-form-btn:hover {
	background-color: #d4d4d4;
	color: #000;
}

.contact100-form-btn:hover i {
	-webkit-transform: translateX(10px);
	-moz-transform: translateX(10px);
	-ms-transform: translateX(10px);
	-o-transform: translateX(10px);
	transform: translateX(10px);
}


/*------------------------------------------------------------------
[ Responsive ]*/

@media (max-width: 576px) {
	.contact100-form {
		padding: 43px 15px 57px 117px;
	}
}

@media (max-width: 480px) {
	.contact100-form {
		padding: 43px 15px 57px 15px;
	}

	.label-input100 {
		text-align: left!important;
		position: unset;
		top: unset;
		left: unset;
		width: 100%;
		padding: 0 5px;
	}
}


/*------------------------------------------------------------------
[ Alert validate ]*/

.validate-input {
	position: relative;
}

.alert-validate::before {
	content: attr(data-validate);
	position: absolute;
	max-width: 70%;
	background-color: #fff;
	border: 1px solid #c80000;
	border-radius: 2px;
	padding: 4px 25px 4px 10px;
	top: 50%;
	-webkit-transform: translateY(-50%);
	-moz-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	-o-transform: translateY(-50%);
	transform: translateY(-50%);
	right: 2px;
	pointer-events: none;
	font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important;
	color: #c80000;
	font-size: 13px;
	line-height: 1.4;
	text-align: left;

	visibility: hidden;
	opacity: 0;

	-webkit-transition: opacity 0.4s;
	-o-transition: opacity 0.4s;
	-moz-transition: opacity 0.4s;
	transition: opacity 0.4s;
}

.alert-validate::after {
	content: "\f06a";
	font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important;
	display: block;
	position: absolute;
	color: #c80000;
	font-size: 15px;
	top: 50%;
	-webkit-transform: translateY(-50%);
	-moz-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	-o-transform: translateY(-50%);
	transform: translateY(-50%);
	right: 8px;
}

.alert-validate:hover:before {
	visibility: visible;
	opacity: 1;
}

@media (max-width: 992px) {
	.alert-validate::before {
		visibility: visible;
		opacity: 1;
	}
}

.btn_color{
	background-color: #57b846;
}

.coverbg
{
	background: url(http://workfarmtoresto.bigdreams.in/website/img/bgvan.jpg);
	background-repeat: no-repeat;
	background-size: cover;
}
</style>
<div class="coverbg">
	<div class="container-contact100">
		<div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>
		<div class="col-md-7">
			<div class="wrap-contact100">
				<div class="contact100-form-title" style="background-image: url(website/img/gallery/melon.png);">
<!-- <span class="contact100-form-title-1">
Order Details
</span> -->
<h1>Order <span>Details</span></h1>
<!--<span class="contact100-form-title-2">
Feel free to drop us a line below!
</span> -->
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	{{session()->get('success')}}
</div>
@endif




<form class="contact100-form validate-form">
<!-- <div class="wrap-input100 validate-input">
<span class="label-input100">Name:</span>
<label  class="input100">{{$order->contact_person}}</label>
<span class="focus-input100"></span>
</div> -->
<div class="col-md-12 col-xs-12" style="padding-bottom: 30px;">
	<div class="col-md-4">
		<span class="label-input100">Name:</span>
	</div>
	<div class="col-md-8" style="border-bottom: 1px solid #b2b2b2;">
		<label class="input100"><strong>{{$order->contact_person}}</strong></label>
		<span class="focus-input100"></span>
	</div>
</div>
<!-- <div class="wrap-input100 validate-input">
<span class="label-input100">Phone No:</span>
<label  class="input100">{{$order->contact_number}}</label>
<span class="focus-input100"></span>
</div> -->
<div class="col-md-12 col-xs-12" style="padding-bottom: 30px;">
	<div class="col-md-4">
		<span class="label-input100">Phone No:</span>
	</div>
	<div class="col-md-8" style="border-bottom: 1px solid #b2b2b2;">
		<label  class="input100"><strong>{{$order->contact_number}}</strong></label>
		<span class="focus-input100"></span>
	</div>
</div>
<!-- <div class="wrap-input100 validate-input">
<span class="label-input100">Location:</span>
<label class="input100">{{$order->address_line_0 }} {{$order->address_line_1 }} {{$order->address_line_2 }} {{$order->city }}  {{$order->pincode }}</label>
<span class="focus-input100"></span>
</div> -->
<div class="col-md-12 col-xs-12" style="padding-bottom: 30px;">
	<div class="col-md-4">
		<span class="label-input100">Location:</span>
	</div>
	<div class="col-md-8" style="border-bottom: 1px solid #b2b2b2;">
		<label class="input100"><strong>{{$order->address_line_0 }} {{$order->address_line_1 }} {{$order->address_line_2 }} {{$order->city }}  {{$order->pincode }}</strong></label>
		<span class="focus-input100"></span>
	</div>
</div>
<!-- <div class="wrap-input100 validate-input">
<span class="label-input100">Packs:</span>
<label  class="input100">{{ $order->packed_box }}</label>
<span class="focus-input100"></span>
</div> -->
<div class="col-md-12 col-xs-12" style="padding-bottom: 30px;">
	<div class="col-md-4">
		<span class="label-input100">Packs:</span>
	</div>
	<div class="col-md-8" style="border-bottom: 1px solid #b2b2b2;">
		<label  class="input100"><strong>{{ $order->packed_box }}</strong></label>
		<span class="focus-input100"></span>
	</div>
</div>
<!-- <div class="wrap-input100 validate-input">
<span class="label-input100">Time Of Delivery:</span>
<label  class="input100">{{ date('h:i A', strtotime($order->created_at))}}</label>
<span class="focus-input100"></span>
</div> -->
<div class="col-md-12 col-xs-12" style="padding-bottom: 30px;">
	<div class="col-md-4">
		<span class="label-input100">Time Of Delivery:</span>
	</div>
	<div class="col-md-8" style="border-bottom: 1px solid #b2b2b2;">
		<label  class="input100"><strong> {{ date('h:i A', strtotime($order->created_at))}}</strong></label>
		<span class="focus-input100"></span>
	</div>
</div>

<div class="col-md-12 col-xs-12" style="padding-bottom: 30px;">
	<div class="col-md-4">
		<span class="label-input100">Total {{ ($order->delevery_charge > '0') ? "with Delivery" : "" }}</span>
	</div>
	<div class="col-md-8" style="border-bottom: 1px solid #b2b2b2;">
		<label  class="input100"><strong> Rs. {{ ($order->delevery_charge == '0')  ? $order->total : $order->total + $order->delevery_charge }} </strong></label>
		<span class="focus-input100"></span>
	</div>
</div>
<div class="container-contact100-form-btn col-xs-6">

	@if($order->status === 'delivered')
	<div class="col-md-4">
		<button class="contact100-form-btn" type="button" name="submit" class="btn btn-primary" style="font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important; margin-bottom: 10px;">
			<span style="text-transform: uppercase;">Already Delivered
				<!-- <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i> -->
			</span>
		</button>
	</div>
	@else

	<div class="col-md-4">
		<button class="contact100-form-btn" type="button" name="submit" class="btn btn-primary" data-toggle="modal" data-target="#Delivered" style="font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important; margin-bottom: 10px;">
			<span style="text-transform: uppercase;">Delivered
				<!-- <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i> -->
			</span>
		</button>
	</div>
	@endif
	<!-- <br> -->

	@if($order->status === 'delivered' || $order->status === 'return')
	<div class="col-md-4">
		<div> Rejected Date : {{$order->cancelled_at}}</div>
	</div>
	@else
	<div class="col-md-4">
		<button class="contact100-form-btn" type="button" name="submit" class="btn btn-primary" data-toggle="modal" data-target="#Rejected" style="font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important; margin-bottom: 10px;">
			<span style="text-transform: uppercase;">Rejected
				<!-- <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i> -->
			</span>
		</button>
	</div>
	@endif

	<div class="col-md-4">
		<a href="{{url('/admin/order/'.$order->id.'/pdf')}}" style="font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important;" target="_blank">
			<button class="contact100-form-btn" type="button" name="submit" class="btn btn-primary" style="font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important;">
				<span style="text-transform: uppercase;">Download
					<!-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> -->
				</span>
			</button>
		</a>
	</div>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- Modal -->
<div id="Rejected" class="modal fade" role="dialog">
	<form action="{{'/orderrejection'}}" method="post" >
		{{csrf_field()}}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> Delivery Rejected</h4>
				</div>
				<div class="modal-body">
					<label  class="input100">Name: {{$order->contact_person}}</label>
					<div class="wrap-input100 validate-input" data-validate = "Message is required">
						<input type="hidden" name="orderid" value="{{$order->id}}">
						<textarea class="input100" name="message" placeholder="Notes:"></textarea>
						<span class="focus-input100"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn_color" data-dismiss="modal">Close</button>

					<button type="submit" class="btn btn-default btn_color">Submit</button>
				</div>
			</div>
		</div>
	</form>
</div>


<!-- delivery modal -->
<div id="Delivered" class="modal fade" role="dialog">
	<form action="{{'/orderdelivered'}}" method="post" >
		{{csrf_field()}}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delivery  Delivered</h4>
				</div>
				<div class="modal-body">
					<label  class="input100">Name: {{$order->contact_person}}</label>
					<div class="wrap-input100 validate-input" data-validate = "Message is required">
						<input type="hidden" name="orderid" value="{{$order->id}}">
						<textarea class="input100" name="message" placeholder="Notes:"></textarea>
						<span class="focus-input100"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn_color" data-dismiss="modal">Close</button>
					<button type="type" class="btn btn-default btn_color">Submit</button>
				</div>
			</div>
		</div>
	</form>
</div>

@endsection