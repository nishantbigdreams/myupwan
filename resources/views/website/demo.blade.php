@extends('layouts.website_master')
@section('page-style')
<style>
h1 {
    font-size: 60px;
    color: #312587;
}
h2 {
    color: #312587;
    line-height: 0px;
}

.ribbon {
  font-weight: 100;
  color: #fff;
  background: #2c8cfa;
  padding: 0 20px;
  font-size: 20px;
  line-height: 40px;
  max-width: 90vw;
  width: max-content;
  position: relative;
  text-align: center;
  height: 40px;
  margin: 2em auto 1em;
  filter: drop-shadow(0 6px 3px rgba(0, 0, 0, 0.1));
  border-right: 2px solid #2c8cfa;
  border-left: 2px solid #2c8cfa;
}

.ribbon:after,
.ribbon:before {
  content: "";
  position: absolute;
  display: block;
  bottom: 0;
  border: 20px solid #2c8cfa;
}

.ribbon:before {
  left: -32px;
  border-right-width: 10px;
  border-left-color: transparent;
  filter: drop-shadow(-6px 6px 3px rgba(0, 0, 0, 0.04));
}

.ribbon:after {
  right: -32px;
  border-left-width: 10px;
  border-right-color: transparent;
  filter: drop-shadow(6px 6px 3px rgba(0, 0, 0, 0.04));
}

</style>
@endsection
@section('body_content')
<div class="global-wrapper clearfix" id="global-wrapper">

    <div class="gap"></div>

    <div class="container ">
        <img src="{{ asset('website/img/shopping-bag.png') }}" class="img-responsive center-block">
        <br/>
        <h1 class="text-center">Thank You</h1>
        <h2 class="text-center">for shopping with us!</h2>
        <div class="ribbon">We are thrilled you choose our products</div>
        <h5 class="text-center">We promise to always deliver <em>the best products and deals</em> to you</h5>
        <br/>
        <div class="col-sm-4 col-sm-offset-4">
            <a href="" class="btn btn-primary btn-block">
               <i class="fa fa-paper-plane"></i> Check Order Details
            </a>
        </div>
    </div>
    <div class="gap"></div>

</div>

@endsection
