<?php
use App\Product;
use App\Categories;
?>

@extends('layouts.website_master') @section('title')
<title>Farmtoresto</title>
@endsection @section('sco')
<meta name="keywords" content="Online Shopping Site" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="description" description=""> @endsection @section('page-style') @section('title')
<meta name="keywords" content="xxxxxxxxxx" />
<meta charset="description" description="xxxxxxxx"> @endsection
<style>
	.price-row p
	{
		font-size: 12px;
		letter-spacing: 0.5px;
		color: #000;
	}
	.banner{
		height: 100%;
		display: block;
	}
</style>
<style>
	.buy-now button{display: none!important}
	.buy-now a{display: none!important}
	button.button.main-button.add-to-cart-button .button-right {
		margin-left: 50%!important;
		width: 100%!important;
	}
	.carousel-control.left {
		background-image: -webkit-linear-gradient(left,rgba(0,0,0,0) 0,rgba(0,0,0,.0001) 100%);
		background-image: -o-linear-gradient(left,rgba(0,0,0,.0) 0,rgba(0,0,0,.0001) 100%);
		background-image: -webkit-gradient(linear,left top,right top,from(rgba(0,0,0,0)),to(rgba(0,0,0,.0001)));
		background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,.0001) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
		background-repeat: repeat-x;
	}
	.carousel-control.right {
		right: 0;
		left: auto;
		background-image: -webkit-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.0) 100%);
		background-image: -o-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.0) 100%);
		background-image: -webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.0001)),to(rgba(0,0,0,.0)));
		background-image: linear-gradient(to right,rgba(0,0,0,.0001) 0,rgba(0,0,0,.0) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
		background-repeat: repeat-x;
	}

	.dialog-fp .content{    margin-top: -22px; }

	.myfav{display: none}
	@media only screen and (max-width: 600px) {
		.carousel-block {
			margin: 0 5px!important;
			float: left;
		}
		.banner{
			height: 100%;
			display: block;
			margin-top:20px;
		}
	}

	.fa-heart-o {
		font-size: 30px!important;
	}

	.contains {
		margin: 0% 0%!important;
	}

	.carousel-wrapper {
		width: 100%!important;
		overflow: hidden;
		margin-top: -7px;
	}
}
.contains {
	margin: 0% 5%;
}
section {
	padding: 30px 0px;
	/*box-shadow: 1px 1px 5px #00000030;*//*Commented by ruchira*/
}
.diamond {
	margin-bottom: 30px
}
.diamond .product-title-box {
	height: 65px;
}
.image-fp img {
	height: 100%;
	width: 100%;
	/*object-fit: contain;*/
}
.cosmetics .product-title-box {
	height: 79px!important;
}
.carousel-button-left {
	text-align: center
}
.carousel-button-right {
	text-align: center
}
.carousel-button-left .fa {
	font-size: 31px;
	color: white!important;
}
.carousel-button-right .fa {
	font-size: 31px;
	color: white!important;
}
.price-row {
	text-align: center!important;
}
.carousel-button-right a {
	float: right;
	margin-right: 2px;
	/*  z-index: 10000;*/
	background: #2188fd!important;
}
.col-sm-12 {
	text-align: center!important
}
button.button.main-button.add-to-cart-button .button-right {
	margin-left: 20px!important;
}
.carousel-button-left a {
	float: left;
	margin-left: 2px;
	/*  z-index: 10000;*/
	background: #1583ff!important;

}
..carousel-button-right a {
	float: right;
	margin-right: 2px;
	/*  z-index: 10000;*/
	background: #1583ff!important;
	overflow: hidden!important;
}
.product-title-box a {
	color: black;
	font-weight: 900
}
.strikeit {
	white-space: nowrap;
	text-decoration: line-through;
	color: #080808;
}
.image-fp-layer {
	/*background: #fff;*/
	border: none!important;
	text-align: center;
	position: relative;
	padding: 5px;
}
.myfav {
	height: 32px!important;
	width: 46px!important;
}
button.button .button-left {
	background: #268bfd!important;
	padding: 0 6px;
	height: 31px;
	line-height: 31px;
	font-size: 11px;
	font-weight: normal;
	border-radius: 5px !important;
	color: #fff;
	text-transform: uppercase;
}
button.main-button .button-left {
	background: #268bfd!important;
	color: #fff;
}
.comment {
	display: none!important
}
.hanger {
	display: none;
}
body {
	background: none!important;
}
.carousel-wrapper {
	width: 95%;
	overflow: hidden;
	margin-top: -7px;
}

}
.myshortimg {
	height: 231px;
}
.product_box .product_offer_box {
	width: 80%;
	background: rgba(255, 255, 255, 0.8);
	text-align: center;
	color: #2b8dfc;
	box-shadow: 0px 0px 20px #978b8b;
	position: absolute;
	bottom: -92px;
	left: 50%;
	transform: translate(-50%, 0%);
}
@media only screen and (max-width: 900px) {
	.mymars {
		margin-bottom: 20px
	}
	.mymarsbot {
		margin-bottom: 22px
	}
}
.mymars {
	margin-top: 72px
}
.mymarsbot {
	margin-bottom: 72px;
	margin-top: 102px
}
.myimgs {}
.why_choose {
	background: #F0F0F0;
}
.why_choose h1 {
	text-transform: capitalize;
	text-align: center;
	color: black;
	font-size: 25px;
}
.why_choose .why_choos_box {
	background-image: linear-gradient(to right, #1281ff, #2b8dfc);
	width:250px;
	height: 250px;
	position: relative;
	text-align: center;
	border-radius: 3px;
	box-shadow: 0px 0px 10px #777;
	margin: 20px 0px;
}
.why_choose .why_choos_box .child_box {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}
.why_choose .why_choos_box img {
	width:60px;
	margin: auto;
}
.why_choose .why_choos_box p {
	color: white;
}
.product_box {
	position: relative;
}

/*.product_box .product_offer_box{
width: 80%;
background: rgba(255,255,255,0.8);
text-align: center;
color: #2b8dfc;
box-shadow: 0px 0px 20px #978b8b;
position: absolute;
bottom: 5px;
left: 50%;
transform: translate(-50%, 0%);
}*/
.product_box .product_offer_box img {
	padding:20px;
}
.product_box .product_offer_box p {
	text-transform: uppercase;
	font-size: 20px;
	font-weight: bold;
	letter-spacing: 2px;
	margin-bottom: 0px;
}
.product_box .product_offer_box h4 {
	text-transform: uppercase;
	font-size: 18px;
	padding: 10px;
	letter-spacing: 2px;
	margin-bottom: 0px;
}
.trending_offer_box {
	position: relative;
	width: 238px;
	height: 222px;
	margin: auto;
}
.trending_offer_text {
	position: absolute;
	top: 127%!important;
	left: 50%;
	transform: translate(-50%, -50%);
	color: #2b8dfc;
	text-align: center;
	background: white;
	opacity: 0.8;
	padding: 10px;
}
.trending_offer_text p {
	font-size: 16px;
}
.h4 {
	font-size: 18px;
	margin-bottom: 0px;
}
@media only screen and (max-width: 900px) {
	.product_box img {
		width: 180px;
	}
	.product_box .product_offer_box p {
		text-transform: uppercase;
		font-size: 12px;
		font-weight: bold;
		padding: 5px;
		letter-spacing: 2px;
		margin-bottom: 0;
	}
	.product_box .product_offer_box h4 {
		font-size: 15px;
		padding: 0px;
	}
	.product_box .product_offer_box {
		width: 65%;
	}
	@media only screen and (max-width: 900px) {
		.fa-chevron-left {
			margin-top: 25px!important;
			padding: 5px;
		}

		.fa-chevron-right {
			margin-top: 25px!important;
			padding: 5px;
		}

		.myfirst {
			height: 350px;
		}

		.mysecond {
			height: 350px;
		}

		.myfourth {
			height: 350px;
		}

		.myfifth {
			height: 350px;
		}

		.myeleven {
			height: 350px;
		}

		.mytwelve {
			height: 350px;
		}

		.mythirteen {
			height: 350px;
		}

		.myfourteen {
			height: 350px;
		}

		.main-footer {
			margin-top: 0px!important;
		}
	}
/*.trending_offer_text 
{
position: absolute;
left: 50%;
transform: translate(-50%, -50%);
color: #2b8dfc;
text-align: center;
background: white;
width: 190px;
opacity: 0.8;
padding: 8px;
}*/
.cs {
	display: none!important
}
</style>

@endsection @section('body_content')
<div class="global-wrapper clearfix" id="global-wrapper">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<!-- Wrapper for slides -->
		<!-- <div class="carousel-inner">
			<div class="item active banner">
				<a href="http://workfarmtoresto.bigdreams.in"><img src="{{asset('website/img/banner/banner-1.jpg')}}" alt="" class="img-responsive center-block" style="width: 100%;"></a>
			</div>
			<div class="item banner">
				<a href="http://workfarmtoresto.bigdreams.in"><img src="{{asset('website/img/banner/banner-6.jpg')}}" alt="" class="img-responsive center-block" style="width: 100%;"></a>
			</div>
			<div class="item banner">
				<a href="http://workfarmtoresto.bigdreams.in"><img src="{{asset('website/img/banner/banner-7.jpg')}}" alt="" class="img-responsive center-block" style="width: 100%;"></a>
			</div>
			<div class="item banner">
				<a href="http://workfarmtoresto.bigdreams.in"><img src="{{asset('website/img/banner/banner-3.jpg')}}" alt="Women Accessories" class="img-responsive center-block" style="width: 100%;"></a>
			</div>
			<div class="item banner">
				<a href="http://workfarmtoresto.bigdreams.in"><img src="{{asset('website/img/banner/banner-4.jpg')}}" alt="Women Accessories" class="img-responsive center-block" style="width: 100%;"></a>
			</div>
			
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="fa fa-chevron-left" style="margin-top:160px;padding:20px 20px;"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="fa fa-chevron-right" style="margin-top:160px;padding:20px 20px;"></span>
				<span class="sr-only">Next</span>
			</a>
		</div> -->
		<style type="text/css">
			.carousel-button-left a {
				float: left;
				margin-left: 2px;
				z-index: 10000;
				height: 50px;
				width: 33px;
				background: #84c225 !important;
			}
			.carousel-button-right a {
				float: right;
				margin-left: 2px;
				z-index: 10000;
				height: 50px;
				width: 33px;
				background: #84c225 !important;
			}
			.carousel-button-left .fa {
				font-size: 20px !important;
				margin-top: 15px !important;
				color: white!important;
			}
			.carousel-button-right .fa {
				font-size: 20px !important;
				margin-top: 15px !important;
				color: white!important;
			}
			.carousel-button-right a, .carousel-button-left a {
				width: 35px;
				/*height: 55px;*/
				background: #84c225;
				border: 1px solid #84c225;
				border-radius: 0px !important;
				position: relative;
				/*top: 169px;
				z-index: 9;*/
				top: 100px;
				cursor: pointer;
				z-index: 1;
				}
.counterhead{
	margin-top: 15px;color: #fff;
}
.dnoneblock{
		display:none!important;


	}
#demo{
	margin-top: 0em;
	font-size: 36px;
	color: #fff;
	text-align: center;
}
.box-body21{
	background-image: linear-gradient(to right, #1281ff, #2b8dfc);
	padding-top: 124px;
	padding-bottom: 124px;
	margin-top: 5px;
}
.hidden-md-counter{
	display: none;
}
@media only screen and (max-width: 767px) {
	.counterhead{
		margin-top: 15px;color: #fff;
		font-size: 20px;
	}
	#demo1{
		margin-top: 0em;
		font-size: 36px;
		color: #fff;
		text-align: center;
	}
	.hidden-md-counter{
		display: block;
	}
	.hidden-xs-counter{
		display: none;
	}
	.box-body212{
		background-image: linear-gradient(to right, #1281ff, #2b8dfc);
		padding-top: 10px;
		padding-bottom: 10px;
		margin-top: 5px;
	}
	#demo{
		margin-top: 0em;
		font-size: 20px;
		color: #fff;
		text-align: center;
	}
/*.carousel-block{
min-width: 185px !important;
}*/

}
	@media only screen and  (max-device-width:1024px) {
		.dnoneblock{
		display: block!important;
	}
	.mleft{
		margin-left: -100px;
	}


	}
@media only screen and (max-width: 425px) {
	.box-body21{
		background-image: linear-gradient(to right, #1281ff, #2b8dfc);
		padding-top: 135px !important;
		padding-bottom: 135px !important;
		margin-top: 5px;
	}
	.banner{
		height: 100%;
		display: block;
		margin-top:20px;
	}
	.dnoneblock{
		display: block!important;


	}

}

</style>
<!-- Timer slider Starts-->
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<!-- <div class="col-md-12 col-xs-12"> -->
					<!-- Commented by ruchira -->
					<section class="wear">
						<h1 class="text-center">Product <span>Categories</span></h1>
						<div class="dialog-fp" style="margin-bottom:30px;">
						 <div class="content">
								<div class="carousel-button-left dnoneblock">
									<a href="#"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>    
								</div>
								<div class="carousel-button-right dnoneblock">
									<a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
								</div> 
								<div class="container ">
									<div class="carousel-wrapper">
										<div class="carousel-items mleft">

											 
												{{-- carousal block starts --}}
											<a href="http://workfarmtoresto.bigdreams.in/category/Fresh-Vegetables">
												<div class="carousel-block" style="width:170px;margin-left: 230px;">
													<div class="first item">
														<div class="hanger"></div>
														<div class="image-fp-layer">
															<div class="image-fp">
																<img src="http://workfarmtoresto.bigdreams.in/website/img/Vegetables.png" alt="Vegetables" title="Fresh Vegetables" />
															</div>
														</div>
														<div class="details">
															<div class="product-title-box" style="text-align: center;">
															Fresh Vegetables
															</div>
															
															<div class="row text-center">
																<button class="btn btn-cart-small mobby">Find more</button>
															</div>
														</div>
													</div>
												</div> {{-- carousal block ends --}}{{-- carousal block starts --}}
											</a>
											


											<a href="http://workfarmtoresto.bigdreams.in/category/Herbs-And-Seasonings">
												<div class="carousel-block" style="width:170px;">
													<div class="first item">
														<div class="hanger"></div>
														<div class="image-fp-layer">
															<div class="image-fp">
																<img src="http://workfarmtoresto.bigdreams.in/website/img/herbs&seasoning.png" alt="Herbs-And-Seasonings" title="Herbs-And-Seasonings" />
															</div>
														</div>
														<div class="details">
															<div class="product-title-box" style="text-align: center;">
															Herbs and Seasonings
															</div>
														
															<div class="row text-center">
																<button class="btn btn-cart-small mobby">Find more</button>
															</div>
														</div>
													</div>
												</div> {{-- carousal block ends --}}{{-- carousal block starts --}}
											</a>
									
											
											
							<a href="http://workfarmtoresto.bigdreams.in/category/Fresh-Fruits">
												<div class="carousel-block" style="width: 170px;">
													<div class="first item">
														<div class="hanger"></div>
														<div class="image-fp-layer">
															<div class="image-fp">
																<img src="http://workfarmtoresto.bigdreams.in/website/img/freshfruits.png" alt="Fresh Fruits" title="Fresh Fruits" />
															</div>
														</div>
														<div class="details">
															<div class="product-title-box" style="text-align: center;">
																Fresh Fruits
															</div>
														
															<div class="row text-center">
																<button class="btn btn-cart-small mobby">Find more</button>
															</div>
														</div>
													</div>
												</div> {{-- carousal block ends --}}{{-- carousal block starts --}}
											
												{{-- carousal block starts --}}
											<a href="http://workfarmtoresto.bigdreams.in/category/Seasonal-Fruits">
												<div class="carousel-block" style="width:170px;">
													<div class="first item">
														<div class="hanger"></div>
														<div class="image-fp-layer">
															<div class="image-fp">
																<img src="http://workfarmtoresto.bigdreams.in/website/img/fruitorganic.png" alt="Fresh Fruits" title="Fresh Fruits" />
															</div>
														</div>
														<div class="details">
															<div class="product-title-box" style="text-align: center;">
															Seasonal Fruits
															</div>
															<!-- <div class="price-row pB10">
																<p>FLAT</p>
															</div> -->
															<!-- <div class="row">
																<div class="col-sm-12 price-row">
																	<p>30%
																	</p>
																</div>
															</div> -->
															<div class="row text-center">
																<button class="btn btn-cart-small mobby">Find more</button>
															</div>
														</div>
													</div>
												</div> {{-- carousal block ends --}}{{-- carousal block starts --}}
											</a>
											
													{{-- carousal block starts --}}
											<a href="http://workfarmtoresto.bigdreams.in/category/Fresh-Fruits">
												<div class="carousel-block" style="width:170px;">
													<div class="first item">
														<div class="hanger"></div>
														<div class="image-fp-layer">
															<!-- <div class="image-fp">
																<img src="http://workfarmtoresto.bigdreams.in/website/img/fruitorganic.png" alt="Fresh Fruits" title="Fresh Fruits" /> -->
															</div>
														</div>
														<div class="details">
															<!-- <div class="product-title-box" style="text-align: center;">
																Fresh Fruits
															</div> -->
															<!-- <div class="price-row pB10">
																<p>FLAT</p>
															</div> -->
															<!-- <div class="row">
																<div class="col-sm-12 price-row">
																	<p>30%
																	</p>
																</div>
															</div> -->
															<div class="row text-center">
																<!-- <button class="btn btn-cart-small mobby">Find more</button> -->
															</div>
														</div>
													</div>
												</div> {{-- carousal block ends --}}{{-- carousal block starts --}}
											</a>

											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>
<div class="contains">
	<div class="gap gap-small"></div>

<!-- 30July 2019 end -->
<!-- Start commented by ruchira -->
@foreach($cat as $category)
<section class="wear">
	<h1 class="text-center">{{$category->name}}</h1>
	<div class="dialog-fp">
		<div class="content">
			<div class="carousel-button-left">
				<a href="#"><i class="fa fa-arrow-left" aria-hidden="true"></i>
				</a>    
			</div>
			<div class="carousel-button-right">
				<a href="#">
					<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
				</div>
				<div class="container">
					<div class="carousel-wrapper">
						<div class="carousel-items">
							@php
							$counting=0;
							@endphp
							@foreach($allProducts as $product)
							
							@if($product->category==$category->name and $counting <=10)
							@php
							$counting+=1;
							@endphp
							{{-- carousal block starts --}}
							<div class="carousel-block" data-toggle="modal" data-target="#modal{{$product->id}}">
								<div class="first item">
									<div class="hanger"></div>
									<div class="image-fp-layer">
										<div class="image-fp">
											<img src="@if ($product->featuredImage){{$product->featuredImage->url}}@endif" alt="{{$product->name}}" title="{{$product->name}}" />
										</div>
									</div>
									<div class="details">
										<div class="product-title-box" style="text-align: center;">
											{{$product->name}}<br><p  style="margin-top: 2px; color: grey; font-size:12px;">({{$product->unit}})</p>
										</div>
										<div class="price-row pB10">
											<span class="price"> <span class="price-value"><span class="currency">₹ {{$product->price_without_gst}}</span></span>
											<span class="market-price">(<span class="nowrap strikeit"> {{$product->base_price}}</span>)</span>
										</span>
									</div>
									<div class="row">
										<div class="col-sm-12 price-row">
											<p>You Save: ₹ {{$product->base_price-$product->price_without_gst}} 
											</p>
										</div>
									</div>
									<div class="row text-center">
										<button class="btn btn-cart-small mobby">Add to Cart</button>
									</div>
								</div>
							</div>
						</div> {{-- carousal block ends --}}{{-- carousal block starts --}}
						<!-- Modal -->
						<div class="modal fade" id="modal{{$product->id}}" role="dialog">
							<div class="modal-dialog"> 
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">{{$product->name}}</h4>
										<p class="text-center modal-small-title">{{$product->product_weight}}-{{$product->unit}}</p>
									</div>
									<form method="post" class="form" action="{{ route('add_to_cartnew',$product->id) }}" onclick="return false;">
										{{ csrf_field() }}
										<div class="modal-body">
											<div class="row">
												<div class="col-md-4"></div>
												<div class="col-md-4">
													<img src="@if ($product->featuredImage){{$product->featuredImage->url}}@endif" alt="{{$product->name}}" title="{{$product->name}}" class="img-responsive" />
												</div>
												<div class="col-md-4"></div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-4 checkbox-text">
													Only <span id="cart-amount-{{$product->id}}">{{$product->price_without_gst}} </span> / {{$product->unit}} <span class="start">*</span> &nbsp; <span class="cart-item-count-{{$product->id}}" >1</span>
												</div>
												<div class="col-md-4 text-center">
													<span>Total : </span><span id="total-kg-{{$product->id}}"></span> <span id="total-kg-show-{{$product->id}}">{{$product->price_without_gst}}</span>&nbsp;&nbsp;<i class="fa fa-inr" aria-hidden="true">.</i>
												</div>
												<div class="col-md-4">   
													<div class="value-button" id="decrease-{{$product->id}}" data="{{$product->id}}" value="Decrease Value">-</div>
													<input type="number" id="number" class="number number-{{$product->id}}" name="quantity" min="1" name="quantity" value="1" />
													<div class="value-button" id="increase-{{$product->id}}"  data="{{$product->id}}" value="Increase Value">+</div>                         
												</div>
											</div>
											<div class="row text-center pT20">
												<!-- <button class="btn btn-cart mobby">
													<i class="fa fa-shopping-cart"></i>Add to Cart
												</button> -->
												<!-- <button class="btn btn-cart mobby">
												Add <span id="add-cart-name-{{$product->id}}"></span><span id="add-cart-amount-{{$product->id}}"></span>
												</button> -->
												<button class="btn btn-cart mobby" id="addtocartbtn-{{$product->id}}" data-toggle="modal" data-target="#myModal-{{$product->id}}" data="{{$product->id}}">
													Add <span id="add-cart-name-{{$product->id}}"></span><span id="add-cart-amount-{{$product->id}}"></span>
												</button>
											</div>
										</div>
									</form>
								</div>      
							</div>
						</div>
						@endif

						<!-- pop up model -->
						<!-- Modal -->
  <div class="modal fade" id="myModal-{{$product->id}}" role="dialog" style="z-index: 9">
    <div class="modal-dialog " style="    width: 331px;
    float: right; padding-right:0px;">
    
     
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="containershow">
             <div class="col-sm-4 col-xs-4 col-md-4">
      <img src="@if ($product->featuredImage){{$product->featuredImage->url}}@endif" alt="{{$product->name}}" title="{{$product->name}}" height="100px" width="100px"/>
    </div>
   
    <div class="col-sm-8 col-xs-8 col-md-8">
       <p class="carttotalt">You have added <strong> <span id="short-total-kg-{{$product->id}}"></span> {{$product->unit}}</strong> of {{$product->name}}.</p>
      <p class="carttotalp">Total: <span id="short-total-amount-{{$product->id}}"></span></p>
    </div>
</div>
        </div>
      </div>
      
    </div>
  </div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div> 
</section>
@endforeach
</div> {{-- contains --}}
</div>


 
 


<div class="container">
  <!-- Trigger the modal with a button -->
 <!--  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
 -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modalright" style="    width: 331px;
    float: right;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="containershow">
             <div class="col-sm-4 col-xs-4 col-md-4">
     <img src="http://workfarmtoresto.bigdreams.in/storage/featured/x7kgZ6xOYhxoCc695AOp7d19ffLWwmN7WtkSXqIa.png" alt="Smiley face" height="100px" width="100px">
    </div>
   
    <div class="col-sm-8 col-xs-8 col-md-8">
       <p class="carttotalt">You have added <strong> 2KG</strong> of Green Crespa.</p>
      <p class="carttotalp">Total: 435</p>
    </div>
</div>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

 




















<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>

	$(document).ready(function(){
	 $("div[id*='increase-']").click(function(){ 
	 	var id = $(this).attr('data');
	 	$('#total-kg-show-'+id).hide();
	 	$('.number-'+id).val(parseInt($('.number-'+id).val())+1);
	 	// alert($('.number-'+id).val());
	 	var count = $('.number-'+id).val();


	 	var amount = $('#cart-amount-'+id).text();
	 	var total = count * amount;
	 	$('#total-kg-'+id).text(total);

	});
	 $("div[id*='decrease-']").click(function(){ 
	 	var id = $(this).attr('data');
	 	$('#total-kg-show-'+id).hide();
	 	var val=parseInt($('.number-'+id).val());
	 	var count = $('.number-'+id).val();
	 	var total_kg = $('#total-kg-'+id).text();
	 	// alert(total_kg);
	 	var amount = $('#cart-amount-'+id).text();
	 	var total = parseInt(total_kg) - parseInt(amount);
	 	// alert(amount);
	 	$('#total-kg-'+id).text(total);

	 	if (parseInt($('.number-'+id).val())<=1) 
	 	{
	 		// var amount = $('#cart-amount-'+id).text();
		 	// var total = count * amount;
		 	// $('#total-kg-'+id).text("Total : "+total+" KG");
	 		alert("Quantity Should Not Less Than 1.");
	 	}
	 	else
	 	{
	 	
	 	$('.number-'+id).val(parseInt($('.number-'+id).val())-1);	 		
	 	}
	});
});
	 /*$(".abc").click(function () {
	 alert();	 	
            if ($(this).is(":checked")) {
                alert('checked');
            } else {
               alert('not checked');
            }
        });*/
/*function abc(element)
{
	alert();
	return false;
}*/
/*
$(document).on('click','.btn-cart',function()
{
	var url=$(this).closest('.form').attr('action');  
	var number=$(this).closest('.pT20').siblings('.row').find('.number').val();
	$.ajax({
		url : url,
		data :{'quantity':number},
		method : 'post',
		success : function(data){
			if (data==0) 
    {
     // Swal.fire("Already in cart.")
     Swal.fire({
  title: 'Already in cart.',
  showClass: {
    popup: 'animated fadeInDown faster'
  },
  hideClass: {
    popup: 'animated fadeOutUp faster'
  }
})
    
    }
    else
    {
      Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Added to cart successfully.',
      showConfirmButton: false,
      timer: 1500
    })
      // Swal.fire('Added to cart successfully.')
      //alert('Added to cart successfully.');
    }
			location.reload(true);
		}
	})
}) */



$(document).on('click','.btn-cart',function()
{
		var productid = $(this).attr('data');
	$('#myModal-'+productid).addClass('modal-backdrop-transparent');
	var url=$(this).closest('.form').attr('action');  
	var number=$(this).closest('.pT20').siblings('.row').find('.number').val();

	 var _token = '{{ csrf_token() }}';
	$.ajax({
		url : url,
		data :{'quantity':number, '_token': _token  },
		method : 'post',
		success : function(data){
    	$('#modal'+productid).hide();    
  //  $('#modal'+productid).modal('toggle');
    var totalamount = $('#total-kg-show-'+productid).text();
    var totalamount1 = $('#total-kg-'+productid).text();
    var totalqty = $('.number-'+productid).val();
    $('#short-total-kg-'+productid).text(totalqty);
    //$('#short-total-amount-'+productid).text(totalamount1);

	 $('#short-total-amount-'+productid).text(parseInt($('.number-'+productid).val())*parseInt(totalamount));
	 	$('.number').val('1');
    setTimeout(function(){
	$('#myModal-'+productid).hide();
	$('.modal-backdrop').removeAttr('class');
	$('.mybody').removeAttr( 'style' );
	$('#myModal-'+productid).addClass('modal-backdrop-transparent');
	$('.fa-shopping-cart').text(data);
	// $('#myModal-'+productid).addClass('modal-backdrop-transparent');
	$('.mybody').removeAttr( 'style' );
	$('#cd-cart').html('');
	$.ajax({
		url : '/getcart',
		method : 'get',
		success : function(data){
			//alert(data);
			$('#cd-cart').html(data);
		}
	});
 
	
//location.reload(true);
		},1500); 
		} 
	});
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.carousel-showmanymoveone .item').each(function()
		{
			var itemToClone = jQuery(this);
			for (var i=1;i<3;i++) {
				itemToClone = itemToClone.next();
// wrap around if at end of item collection
if (!itemToClone.length) {
	itemToClone = jQuery(this).siblings(':first');
}
// grab item, clone, add marker class, add to collection
itemToClone.children(':first-child').clone()
.addClass("cloneditem-"+(i))
.appendTo(jQuery(this));
}
});
	});
</script>
<!-- end wrapper -->
@endsection