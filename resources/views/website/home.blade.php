@extends('layouts.website_master')
@section('body_content')

    <style>

        .coverbg {
            background: url(http://workfarmtoresto.bigdreams.in/website/img/user-form.jpg);
            background-size: cover;
        }

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

        .wrap-contact100 {
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            box-shadow: 0px 0px 10px 0px #504f4f;
            margin-top: 40px;
            margin-bottom: 10px;
            opacity: 0.9;
            min-height: 750px;

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

        input[type=text], input[type=password], select, textarea, .input-style {
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
            top: -2.2em;
            padding: 10px 10px 10px 0px;
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

        .contact100-form-btn:hover {
            color: #000 !important;
        }
    </style>
    <?php
    $disable = "";
    $gapclass = "";
    $required = "";
    if (auth()->user()->firstlogin == "No") {
// $disable = 'disabled';
    }

    if (auth()->user()->licence_image == "") {
        $required = "required";
    }

    if (auth()->user()->status == "Approved") {
        $gapclass = "gap";
    }
    ?>
    <div class="coverbg">
        <div class="container-contact100 ">
            <div class="col-md-7">
                <div class="wrap-contact100">
                    <ul class="nav nav-tabs" style="margin-top: 50px;margin-left:15px">
                        <li class="active"><a data-toggle="tab" href="#Information">Delivery Address</a></li>
                        <li><a data-toggle="tab" href="#Profile">My Profile</a></li>
                        @if(auth()->user()->status == "Approved")
                            <li><a data-toggle="tab" href="#Orders">My Orders</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div id="Information" class="tab-pane fade in active">
                            <div class="contact100-form-title">
                                <h1>User <span>Information</span></h1>
                            </div>
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong> <!-- {{session()->get('success')}} -->
                                </div>
                            @endif
                            <form class="contact100-form validate-form" action="{{route('profile.updaterestoinfo')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                        <!-- <div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Restaurant Name:</p>
<input type="text" class="input" value="{{old('restaurant_name') ?? auth()->user()->restaurant_name}}" name="restaurant_name" required="">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
 -->
                                <input type="hidden" class="input" value="{{old('restaurant_name') ?? auth()->user()->restaurant_name}}" name="restaurant_name" required="" value="xyz">
                                <!-- <div class="col-sm-12 col-xs-12 col-md-6">
                                <label>
                                <p class="label-txt">Upload Restaurant Logo :</p>
                                 <input type="file" class="form-control-file" id="exampleFormControlFile1" name="restaurant_logo">

                                <div class="line-box">
                                <div class="line"></div>
                                </div>
                                </label>
                                </div>
                                 -->


                                <!--
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Name:</p>
<input type="text" class="input" value="{{auth()->user()->name}}" name="name" required="">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Mobile No:</p>
<input type="text" class="input" value="{{auth()->user()->phone}}" name="phone" required="">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div>
<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">E-mail:</p>
<input type="text" class="input" value="{{auth()->user()->email}}" name="email" required="">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div> -->
                                <!--
                                <div class="col-sm-12 col-xs-12 col-md-6">
                                <label>
                                    <p class="label-txt">Licence Type :</p>
                                <select name="licence_type">
                                    <option class="label-txt" value="EL (Establishment Licence)">EL (Establishment Licence)</option>
                                    <option class="label-txt" value="FL (FSSAI Licence)">FL (FSSAI Licence)</option>
                                    <option class="label-txt" value="GL (Gumasta Licence)">GL (Gumasta Licence)</option>
                                </select>
                                <div class="line-box">
                                <div class="line"></div>
                                </div>
                                </label>
                                </div> -->
                                <input type="hidden" name="licence_type" value="FL (FSSAI Licence)">

                                <!-- <div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">Upload Licence copy :</p>
<input type="file"  class="custom-file-input" id="licence_image"  name="licence_image" {{$disable}} {{$required}}>
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div> -->
                                <!--


<div class="col-sm-12 col-xs-12 col-md-6">
<label>
<p class="label-txt">GST:</p>
<input type="text" class="input" value="{{old('gst') ?? auth()->user()->gst}}" name="gst">
<div class="line-box">
<div class="line"></div>
</div>
</label>
</div> -->
                                <div class="col-sm-12 col-xs-12 col-md-6">
                                    <label>
                                        <p class="label-txt">Street</p>
                                        <input type="text" class="input" name="address_line_0" placeholder="Flat No/Society" value="{{old('address_line_0') ?? auth()->user()->address_line_0}}" required="">

                                        <div class="line-box">
                                            <div class="line"></div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6">
                                    <label>
                                        <p class="label-txt">City</p>
                                        <input type="text" class="input" name="address_line_1" placeholder="Street" value="{{old('address_line_1') ?? auth()->user()->address_line_1}}" required="">

                                        <div class="line-box">
                                            <div class="line"></div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6">
                                    <label>
                                        <p class="label-txt">Landmark</p>
                                        <input type="text" class="input" name="address_line_2" placeholder="locality/Landmark" value="{{old('address_line_2') ?? auth()->user()->address_line_2}}" required="">

                                        <div class="line-box">
                                            <div class="line"></div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-6">
                                    <label>
                                        <p class="label-txt">Pincode:</p>
                                        <input type="text" class="input" id="pincode" placeholder="pincode" required="" value="{{old('pincode') ?? auth()->user()->pincode}}" name="pincode">

                                        <div class="line-box">
                                            <div class="line"></div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <button type="submit" name="submit" class="contact100-form-btn center">Update User Info</button>
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

                                            <p class="label-txt"><input class="form-check-input" type="checkbox" value="" id="invalidCheck" required style="margin-left:-12px;">Sign Up to the Newsletter:</p>


                                        </label>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <button type="submit" name="submit" class="contact100-form-btn" style="margin-left:64px; margin-top:30px">Update Profile</button>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </form>
                        </div>
                        <div id="Orders" class="tab-pane fade">
                            <div class="container-fluid tab" id="order-tab">
                                @if(count($orders) == 0)
                                    <center>
                                        <h3 class="text-primary">
                                            Your Orders Will Appear Here
                                        </h3>
                                    </center>
                                @endif
                                @foreach ($orders->load('BdOrder') as $key => $order)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <button type="button" class="btn btn-sm btn-warning">
                                                Order No. # {{$order->order_id}}
                                            </button>
                                            <button type="button" class="btn btn-sm btn-info">
                                                Status: {{str_replace('_',' ', $order->status)}}
                                            </button>
                                            <a class="btn btn-success" style="color: #fff;" href="{{url('repeatorder' , $order->id)}}" title="Repeat Order">
                                                <i class="fa fa-check"></i> Repeat Order
                                            </a>
                                        </div>
                                        <div class="panel-body">
                                            <table class="" style="width:100%">
                                                @php
                                                $name = json_decode($order->product_name);
                                                $image = json_decode($order->product_image);
                                                $qty = json_decode($order->product_qty);
                                                @endphp
                                                @for($i = 0; $i < count($name); $i++)
                                                    <tr>
                                                        <td class="text-center">
<span class="bg-primary" style="padding:5px;border-radius:10%;">
{{ $i+1 }}
</span>
                                                        </td>
                                                        <td>
                                                            <img class="center-block" src="{{image_url($image[$i])}}" style="width:75px" alt="Product Image"/>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;">
                                                                {{$name[$i]}} {{ $qty[$i] > 1 ? 'x ('.$qty[$i].') Qty' : '' }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <hr>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </table>
                                        </div>
                                        <div class="panel-footer">
                                            Ordered Place On:
                                            <strong>{{date('D d M, Y', strtotime($order->created_at))}}</strong>
                                            @if(!is_null($order->delivery_date))
                                                Delivered on:
                                                <strong>{{date('D d M, Y', strtotime($order->created_at))}}</strong>
                                            @endif
                                            <span class="pull-right">
@if($order->status == 'cancelled')
                                                    <a href="javascript:;" class="text-danger" title="Cancel Order">
                                                        Cancelled on {{date('D d M, Y', strtotime($order->cancelled_at))}}
                                                    </a>
                                                @else
                                                    @if($order->status == 'delivered')
                                                        <a href="javascript:;" class="text-danger return-order" title="Return Order">
                                                            <i class="fa fa-undo"></i> RETURN
                                                        </a>
                                                        {{-- <a href="javascript:;" class="text-danger complaint-order" title="Complaint">
                                                        <i class="fa fa-question"></i> RAISE COMPLAIN
                                                        </a> --}}
                                                    @elseif($order->BdOrder && $order->BdOrder->expected_delivery_date)
                                                        Expected Delivery Date:
                                                        {{date('M d, Y', strtotime($order->BdOrder->expected_delivery_date))}}
                                                    @endif
                                                    @if(in_array($order->status,['processing','packed','registered']))
                                                        <a href="javascript:;" class="text-danger cancle-order pull-right" title="Cancel Order">
                                                            Cancel Order
                                                        </a>
                                                    @endif
                                                @endif
</span>

                                            <div style="display: none;" class="toggle-returnorder">
                                                <hr/>
                                                <form method="post" action="{{route('return_order', $order->id)}}" class="return_order_form">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <textarea type="text" name="return_reason" class="form-control" rows="3" placeholder="Reason" required="required"></textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="bank" placeholder="bank name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="account_no" placeholder="Account Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="ifsc_code" placeholder="IFSC code">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="mobile" placeholder="Enter mobile number" value="{{auth()->user()->phone ?? ''}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{auth()->user()->email ?? ''}}">
                                                    </div>
                                                    <div class="col-sm-2 col-sm-offset-10">
                                                        <div class="form-group">
                                                            <button class="btn btn-sm  btn-link">
                                                                Return Order <i class="fa fa-paper-plane"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                </form>
                                            </div>
                                            <div class="form-group text-center text-primary return_reason">{{($order->status == 'return')?'Your return request successfully registered': ''}}</div>
                                            <div style="display: none;" class="toggle-complaintorder">
                                                <hr/>
                                                <form method="post" action="{{route('complain.store', $order)}}" class="complain_form">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label class="control-lable">
                                                            Select Subject
                                                        </label>
                                                        <select style="width:100%" class="form-control" name="complain_type" required>
                                                            <option value="" selected disabled>--SELECT COMPLAIN TYPE--</option>
                                                            <option value="Order not delivered ">
                                                                Order not delivered
                                                            </option>
                                                            <option value="Wrong product delivered">
                                                                Wrong product delivered
                                                            </option>
                                                            <option value="Damaged product">
                                                                Damaged Product
                                                            </option>
                                                            <option value="other">
                                                                Other
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-lable">
                                                            Message
                                                        </label>
                                                        <textarea name="message" class="form-control" rows="3" placeholder="Tell us more."></textarea>
                                                    </div>
                                                    <div class="form-group text-center text-primary" id="complain_msg">
                                                    </div>
                                                    <button class="btn btn-sm pull-right btn-danger">
                                                        <i class="fa fa-paper-plane"></i> Raise complain
                                                    </button>
                                                    <br>
                                                    <br>
                                                </form>
                                            </div>
                                            <div style="display: none;" class="toggle-cancelorder">
                                                <hr/>
                                                <form method="post" action="{{route('cancel_order', $order->id)}}">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <textarea type="text" name="reason" class="form-control" rows="3" placeholder="Cancel Reason"></textarea>
                                                        <br>
                                                        @if($order->payment_method != 'cod')
                                                            <span class="text-info">
<strong>NOTE:</strong> Your payment will be refunded in 7 working days
</span>
                                                        @endif
                                                        <button class="btn btn-sm pull-right btn-link">
                                                            Cancel Order <i class="fa fa-paper-plane"></i>
                                                        </button>
                                                    </div>
                                                    <br>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            $('.input').focus(function () {
                $(this).parent().find(".label-txt").addClass('label-active');
            });

            $(".input").focusout(function () {
                if ($(this).val() == '') {
                    $(this).parent().find(".label-txt").removeClass('label-active');
                }
                ;
            });

        });
    </script>

@endsection