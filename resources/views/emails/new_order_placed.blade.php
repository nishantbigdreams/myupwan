@component('mail::message')
# Hello, {{ ucfirst($user->name) }}

@component('mail::panel')
    Thank you for shopping with us. We have received your order#: {{$order->order_id}}.<br>
    You can check your order status by logging in your account. @if(Auth::user())
                                            						<a href="{{url('/account') }}">Account</a>
                                        						@else
                                            						<a href="{{url('/postLogin') }}">Login</a>
                                        						@endif
@endcomponent

@php
    $images = json_decode($order->product_image);
    $items = json_decode($order->product_name);
    $price = json_decode($order->product_price);
    $qty = json_decode($order->product_qty);
@endphp

#Order Details

@component('mail::table')
| Product       | Item          | Qty      | Price  | Delivery Charge |
| ------------- |:-------------:| --------:| ------:| ---------------:|
@for($i = 0; $i < count($items); $i++)
| <img src="{{$images[$i]}}" alt="Product Image" style="width:40px;height:40px"> | {{strlen($items[$i]) > 15 ?  substr($items[$i],0 , 13).'...' : $items[$i]}}      | {{$qty[$i]}}    | ₹{{number_format($price[$i])}} | ₹60       | 
@endfor
@endcomponent


Thanks,<br>
My Upavan
@endcomponent

