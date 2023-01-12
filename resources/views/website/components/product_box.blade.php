
<div class="product"    >
    <a href="{{route('product.show',[$product->category, $product->model, $product->id])}}">
        <img class="img-responsive center-block" src="{{ featuredImage($product) }}" alt"Product Image" title="{{$product->name}}" style="height: 140px;" />
        <div class="product-caption">

            <h5 class="product-caption-title text-ellipsis-200" title="{{$product->name}}">{{$product->name}}</h5>
            <div class="product-caption-price">
                <span class="product-caption-price-new">
                    <i class="fa fa-inr"></i> {{$product->price_without_gst}}
                </span>
            </div>
            <ul class="product-caption-feature-list">
                <li>{!!$product->in_stock!!}</li>
            </ul>
        </div>
    </a>
</div>
