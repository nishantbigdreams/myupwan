@extends('layouts.website_master')

@section('page-style')
<style>
body {background:#ccc}
h1.heading:after {
    content: '';
    display: block;
    background-color: #2b8dfc;
    width: 80px;
    height: 2px;   
    margin:10px auto;
}

.box a{
  text-align:center;
  position:relative;
  /*top:80px;*/
}
.box h3{
  margin-top:10px;
  background-color: #2b8dfc;
  padding: 5px;
  color: #fff;
  font-weight: normal;
}
.box {
    width:50%;
    /*height:200px;*/
    height: auto;
    background:#FFF;
    margin:40px auto;
    position:relative;
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
}
.box:before, .box:after
{
    content:"";
    position:absolute;
    z-index:-1;
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
    box-shadow:0 0 20px rgba(0,0,0,0.8);
    top:10px;
    bottom:10px;
    left:0;
    right:0;
    -moz-border-radius:100px / 10px;
    border-radius:100px / 10px;
}
.box:after
{
    right:10px;
    left:auto;
    -webkit-transform:skew(8deg) rotate(3deg);
    -moz-transform:skew(8deg) rotate(3deg);
    -ms-transform:skew(8deg) rotate(3deg);
    -o-transform:skew(8deg) rotate(3deg);
    transform:skew(8deg) rotate(3deg);
}

</style>
@endsection
@section('body_content')

<div class="global-wrapper clearfix" id="global-wrapper">
    <div class="row">
        <div class="container-fluid">
            <img src="http://workfarmtoresto.bigdreams.in/website/img/home_products/slide3.jpg" class="img-responsive center-block">
        </div>
    </div>
    <div class="gap gap-small"></div>
    <div class="container-fluid">
        <h1 class="text-center heading">Womens Accessories</h1>

        <div class="col-sm-6">
            <div class="box">
                <a href="http://workfarmtoresto.bigdreams.in/category/Imitation%20Jewellery">
                    <img src="http://workfarmtoresto.bigdreams.in/website/img/home_products/novesell_jwellery.jpeg" class="img-responsive center-block">
                    <h3 class="text-center">Imitation Jewellery</h3>
                </a>
            </div>
        </div>
    </div>
    <div class="gap gap-small"></div>
</div>

@endsection
