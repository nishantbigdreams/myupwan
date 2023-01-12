@extends('layouts.website_master')
@section('body_content')

<style>
.coverbg
{
background: url(http://workfarmtoresto.bigdreams.in/website/img/user-form.jpg);
background-size: cover;
}

.container-contact100 {
width: 100%;
min-height: 100%;
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

.wrap-contact100 {
background: #fff;
border-radius: 30px;
overflow: hidden;
position: relative;
box-shadow: 0px 0px 10px 0px #504f4f;
margin-top: 40px;
margin-bottom: 10px;
opacity: 0.9;
}

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
padding: 30px 50px;
text-transform: uppercase;
}

.contact100-form {
width: 100%;
display: -webkit-box;
display: -webkit-flex;
display: -moz-box;
display: -ms-flexbox;
display: flex;
flex-wrap: wrap;
justify-content: space-between;
padding: 30px;
}

input[type=text], input[type=password], select, textarea, .input-style
{
border: none !important;
padding: 2px;
background: #fff;
}

label {
display: block;
position: relative;
margin: 25px 0px;
}

.label-txt {
position: absolute;
top: -1.6em;
padding: 10px;
font-size: 15px;
color: #000;
transition: ease .3s;
}

.input {
width: 100%;
padding: 10px;
background: transparent;
border: none;
outline: none;
}

.line-box {
position: relative;
width: 100%;
height: 2px;
background: #BCBCBC;
}

.line {
position: absolute;
width: 0%;
height: 2px;
top: 0px;
left: 50%;
transform: translateX(-50%);
background: #8BC34A;
transition: ease .6s;
}

.input:focus + .line-box .line {
width: 100%;
}

.label-active {
top: -3em;
}

.contact100-form-btn {
display: -webkit-box;
display: -webkit-flex;
display: -moz-box;
display: -ms-flexbox;
display: flex;
justify-content: center;
align-items: center;
padding: 0 30px;
min-width: 150px;
font-family: 'Roboto', Tahoma, Arial, helvetica, sans-serif !important;
height: 50px;
background-color: #57b846;
border-radius: 25px;
font-size: 16px;
color: #fff !important;
-webkit-transition: all 0.4s;
-o-transition: all 0.4s;
-moz-transition: all 0.4s;
transition: all 0.4s;
border: 0px;
text-transform: uppercase;
}

.contact100-form-btn:hover
{
color: #000 !important;
}
</style>

<div class="coverbg">
<div class="container-contact100 ">
<div class="col-md-7">
<div class="wrap-contact100">
<ul class="nav nav-tabs" style="margin-top: 50px;">
<li class="active"><a data-toggle="tab" href="#Information">Restaurant Information</a></li>
<li><a data-toggle="tab" href="#Profile">My Profile</a></li>
<li><a data-toggle="tab" href="#Orders">My Orders</a></li>
</ul>
<div class="tab-content">
<div id="Information" class="tab-pane fade in active">
<div class="contact100-form-title">
<h1>Restaurant <span>Information</span></h1>
</div>
<form class="contact100-form validate-form" action="{{route('profile.updaterestoinfo')}}" method="post" >
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Restaurant Name:</p>
<input type="text" class="input" value="auth()->user()->restaurant_name}}" name="restaurant_name">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>


<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Upload Restaurant Logo :</p>
 <input type="file" class="form-control-file" id="exampleFormControlFile1" name="restaurant_logo">

<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>


<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Restaurant Licence No:</p>
<input type="text" class="input" value="{{auth()->user()->licence}}" name="licence" >
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>

<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Upload Restaurant Licence copy :</p> 
 <input type="file" class="form-control-file" id="exampleFormControlFile1" placeholder="Restaurant Certificate No">

<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>

<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Restaurant Certificate No:</p>
<input type="text" class="input" value="{{auth()->user()->certificate_no}}" name="certificate_no">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>

<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Upload Restaurant Certificate Copy:</p>
 <input type="file" class="form-control-file" id="exampleFormControlFile1">

<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>

<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Restaurant Phone:</p>
<input type="text" class="input" value="{{auth()->user()->restaurant_phone}}" name="restaurant_phone">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>



<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Owner Name:</p>
<input type="text" class="input" value="{{auth()->user()->owner_name}}" name="owner_name">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Owner Mobile No:</p>
<input type="text" class="input" value="{{auth()->user()->owner_mobile_no}}" name="owner_mobile_no">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Owner E-mail:</p>
<input type="text" class="input" value="{{auth()->user()->owner_email}}" name="owner_email">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Manager Name:</p>
<input type="text" class="input" value="{{auth()->user()->owner_email}}" name="owner_email">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Manager Mobile No:</p>
<input type="text" class="input" value="{{auth()->user()->owner_email}}" name="owner_email">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">GST:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Steet</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">City</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Landmark</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Pincode:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-md-12">
<div class="col-md-3"></div>
<div class="col-md-6">
<button type="submit" name="submit" class="contact100-form-btn center">Update Restaurant Info</button>
</div>
<div class="col-md-3"></div>
</div>
</form>
</div>
<div id="Profile" class="tab-pane fade">
<div class="contact100-form-title">
<h1>My <span>Profile</span></h1>
</div>
<form class="contact100-form validate-form" action="{{route('profile.update')}}" method="post">
{{ csrf_field() }}
<form class="contact100-form validate-form">
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Name:</p>
<input type="text" class="input" value="{{auth()->user()->name}}" name="name">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>

<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt"> E-mail Address:</p>
<input type="text" class="input" value="{{auth()->user()->email}}" name="email">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>

<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Contact Number:</p>
<input type="text" class="input" value="{{auth()->user()->phone}}" name="phone">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>

<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Password:</p>
<input type="password" class="form-control" id="exampleInputPassword1" style="margin-top: -8px;" name="password">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>

<div class="col-sm-12 col-xs-12 col-md-6">
<label>

<p class="label-txt">  <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required style="margin-left:-12px;">Sign Up to the Newsletter:</p>



</label>
</div>
  


<div class="col-md-12">
<div class="col-md-3"></div>
<div class="col-md-6">
<button type="submit" name="submit" class="contact100-form-btn" style="margin-left:64px;">Update Profile</button>
</div>
<div class="col-md-3"></div>
</div>
</form>
</div>
<div id="Orders" class="tab-pane fade">
<div class="contact100-form-title">
<h1>My <span>Orders</span></h1>
</div>
<form class="contact100-form validate-form">
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Restaurant Name:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Restaurant Licence No:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Restaurant Certificate No:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Restaurant Phone:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Owner Name:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Owner Mobile No:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Owner E-mail:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">GST:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Steet</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">City</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Landmark</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Pincode:</p>
<input type="text" class="input">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-md-12">
<div class="col-md-3"></div>
<div class="col-md-6">
<button type="submit" name="submit" class="contact100-form-btn">Update Restaurant Info</button>
</div>
<div class="col-md-3"></div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){

$('.input').focus(function(){
$(this).parent().find(".label-txt").addClass('label-active');
});

$(".input").focusout(function(){
if ($(this).val() == '') {
$(this).parent().find(".label-txt").removeClass('label-active');
};
});

});
</script>

@endsection