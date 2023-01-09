@component('mail::message')
# {{$product->name}}

@if($product->featuredImage)
<center>
	<img src="{{featuredImage($product)}}" style="width: 50%">
</center>
@endif


@component('mail::panel')
{!! $product->description !!}
@endcomponent

@component('mail::subcopy')
<center style="font-size: 9px; text-transform: capitalize;">
	you are receiving this email because you have subscribe to your newsletter <br>
	you can subscribe at any time by visiting 
	<a href="{{route('newsletter.unsubscribe',[$data['email'], $data['user_id_hash']])}}" style="text-transform: uppercase;">
		UNSUBCRIBE
	</a>
</center>
@endcomponent

@endcomponent
