@include('_partials.website.header')
<?php
$qty ='';
$pro_price='';
?>

<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    {{--
            @include('_partials.website.navbar')
    --}}
    @include('_partials.website.nav')

            <!-- End Header -->
    <main class="main account">
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{url('/') }}"><i class="d-icon-home"></i></a></li>
                    <li>Account</li>
                </ul>
            </div>
        </nav>
        <div class="page-content mt-4 mb-10 pb-6">
            <div class="container">
                <h2 class="title title-center mb-10">My Account</h2>
                @include('layouts.notification')

                <div class="tab tab-vertical gutter-lg">
                    <ul class="nav nav-tabs mb-4 col-lg-3 col-md-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#orders">Orders</a>
                        </li>
                        {{-- <li class="nav-item">
                             <a class="nav-link" href="#downloads">Downloads</a>
                         </li>--}}

                        <li class="nav-item">
                            <a class="nav-link" href="#account">Account details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#changepassword">Change password</a>
                        </li>
                        <li class="nav-item">
                            {{--
                                                        <a href="{{ route('UserAuth.logout')}}">Logout</a>
                            --}}
                            <a href="{{ route('UserAuth.logout') }}" style="font-size: 16px;">Logout</a>

                        </li>
                    </ul>
                    <div class="tab-content col-lg-9 col-md-8">
                        <div class="tab-pane active" id="dashboard">
                            <p class="mb-0">
                                Redeem Point <span>{{auth::user()->redeem_point}}</span>
                            </p>
                            <p class="mb-0">
                                Hello <span>{{auth::user()->name}}</span>
                            </p>

                            <p class="mb-8">
                                From your account dashboard you can view your
                                <a href="#orders" class="link-to-tab text-primary">recent orders,<br>and edit your password and update profile</a>.
                            </p>
                            <a href="{{ url('/') }}" class="btn btn-dark btn-rounded">Go To Shop<i
                                        class="d-icon-arrow-right"></i></a>
                        </div>
                        <div class="tab-pane" id="orders">
                            <table class="order-table">
                                <thead>
                                <tr>
                                    <th class="pl-2">Order</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
{{--
                                    <th class="pr-2">Actions</th>
--}}
                                </tr>
                                </thead>
                                <tbody>


                                @foreach ($orders->load('BdOrder') as $key => $order)
                                    @php
                                    $images = json_decode($order->product_image);
                                    $items = json_decode($order->product_name);
                                    $price = json_decode($order->product_price);
                                    $qty = json_decode($order->product_qty);
                                    $tot =0;
                                    @endphp
                                    <tr>
                                        <td class="order-number"><a>#{{$order->order_id}}</a></td>
                                        <td class="order-date"><span>{{date('D d M, Y', strtotime($order->created_at))}}</span>@if(!is_null($order->delivery_date))<span>{{date('D d M, Y', strtotime($order->created_at))}}</span>@endif</td>
                                        <td class="order-status"><span>  {{str_replace('_',' ', $order->status)}}</span></td>

                                        <td class="order-total">
                                            @for($i = 0; $i < count($items); $i++)
                                                <?php $pro_price = (number_format($price[$i])) * $qty[$i]?>
                                            <span>₹ {{$pro_price}} {{$items[$i]}}  for {{$qty[$i]}} items</span>
                                            @endfor
                                        </td>

{{--
                                        <td class="order-action"><a href="#" class="btn btn-primary btn-link btn-underline">View</a></td>
--}}
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="account">
                            <form action="{{route('UserAuth.profileupdate')}}" class="form" method="post" id="profileupdate">
                                {{csrf_field()}}
                                <input type="hidden" name="uid" id="uid" value="{{auth::user()->id}}">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Full Name *</label>
                                        <input type="text" class="form-control" name="name" value="{{auth::user()->name}}">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="text" class="form-control" name="phone" value="{{auth::user()->phone}}">

                                    </div>
                                    <div class="col-sm-6">
                                        <label>Email Address *</label>
                                        <input type="email" class="form-control" name="email" value="{{auth::user()->email}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Landmark *</label>
                                        <input type="text" class="form-control" name="address_line_0" value="{{auth::user()->address_line_0}}">

                                    </div>
                                    <div class="col-sm-6">
                                        <label>Street *</label>
                                        <input type="text" class="form-control" name="address_line_1" value="{{auth::user()->address_line_1}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>City *</label>
                                        <input type="text" class="form-control" name="city" value="{{auth::user()->city}}">

                                    </div>
                                    <div class="col-sm-6">
                                        <label>Pincode *</label>
                                        <input type="text" class="form-control" name="pincode" value="{{auth::user()->pincode}}">
                                    </div>
                                </div>
                                {{--<fieldset>
                                    <legend>Password Change</legend>
                                    <label>Current password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control" name="current_password">

                                    <label>New password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control" name="new_password">

                                    <label>Confirm new password</label>
                                    <input type="password" class="form-control" name="confirm_password">
                                </fieldset>
--}}
                                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="changepassword">
                            <form action="{{route(('UserAuth.passwordupdate'))}}" method="post" class="form" id="passwordupdte">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Current password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>New password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">

                                    </div>
                                    <div class="col-sm-6">
                                        <label>Confirm new password</label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">

                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- End Main -->

@include('_partials.website.footer')
<script src="../vendor/validation/jquery.validate.min.js"></script>
<script>
    $.validator.addMethod("emailvalidate", function (value, element) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,14}|[0-9]{1,3})(\]?)$/;
        return this.optional(element) || filter.test(value);
    });
    $.validator.addMethod("mobilenumber", function (value, element) {
        var check = false;
        return this.optional(element) || /^[1-9]|^0{0}$/.test(value);
    });
    $.validator.addMethod("number", function (value, element) {
        var check = false;
        return this.optional(element) || /^[1-9]|^0{0}$/.test(value);
    });

    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");

    $(document).ready(function () {
        $("#profileupdate").validate({


            rules: {
                name: {lettersonly: true, required: true},
                email: {required: true, email: true, emailvalidate: true},
                phone: {minlength: 10, maxlength: 10, number: true, required: true},
                pincode: {required: true, minlength: 6},
                city: {required: true}

            },
            messages: {
                name: {required: "Please Enter Your Name."},
                email: {
                    required: "Please Enter Your Email.",
                    email: "Please Enter Valid Email.",
                    emailvalidate: "Please Enter valid Email."
                },
                phone: {
                    minlength: "Please Enter valid 10 digit mobile number",
                    maxlength: "Please Enter valid 10 digit mobile number",
                    required: "Enter Phone Number."
                },
                pincode: {
                    required: "Please Enter Pincode",
                    minlength: "Please Enter valid 6 digit",
                    maxlength: "Please Enter valid 6 digit",
                },
                city: {required: "Please Enter City"}

            },
            errorPlacement: function (error, element) {
                if (element.hasClass('select2') && element.next('.select2-container').length) {
                    error.insertAfter(element.next('.select2-container'));
                } else if (element.parent('.aa').length) {
                    error.insertAfter(element.parent());
                }
                else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                    error.insertAfter(element.parent().parent());
                }
                else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                    error.appendTo(element.parent().parent());
                }
                else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
        $("#passwordupdte").validate({
            // Specify validation rules
            rules: {
                current_password: {required: true},
                new_password: {required: true, minlength: 6},
                new_password_confirmation: {required: true, equalTo: "#new_password"}
            },
            // Specify validation error messages
            messages: {
                current_password: {required: "Please Enter Old Password"},
                new_password: {required: "Please Enter New Password"},
                new_password_confirmation: {required: "Please Re-Enter New Password "}
            },
            errorPlacement: function (error, element) {
                if (element.hasClass('select2') && element.next('.select2-container').length) {
                    error.insertAfter(element.next('.select2-container'));
                } else if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                }
                else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                    error.insertAfter(element.parent().parent());
                }
                else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                    error.appendTo(element.parent().parent());
                }
                else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $(".alert").fadeTo(10000, 500).slideUp(500, function () {
            $(".alert").slideUp(500);
        });
    });
</script>
</body>
