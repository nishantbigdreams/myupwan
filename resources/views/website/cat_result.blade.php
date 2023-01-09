@foreach($products as $product)


<div class="col-md-2"><!-- 
<div class="carousel-block" data-toggle="modal" data-target="modal{{$product->id}}"> -->
  @if($product->in_stock!='<span class="text-danger">Out of Stock</span>')
              <div class="carousel-block" data-toggle="modal" data-target="#modal{{$product->id}}">
                @else
              <div class="carousel-block" >
                @endif
                <div class="forgray">               
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
                        <span class="price"> <span class="price-value"><span class="currency"><i class="fa fa-inr"></i>{{$product->price_without_gst}}</span></span>
                        <span class="market-price">(<span class="nowrap strikeit"><i class="fa fa-inr"></i> {{$product->base_price}}</span>)</span>
                      </span>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 price-row">
                        <p>You Save:<i class="fa fa-inr"></i>{{$product->base_price-$product->price_without_gst}} 
                        </p>
                      </div>
                    </div>
                    @if($product->in_stock!='<span class="text-danger">Out of Stock</span>')
                    <div class="row text-center">
                      <button class="btn btn-cart-small mobby">Add to Cart</button>
                    </div>
                    @else
                    <div class="row text-center ">
                      <span class="bnt-danger"><button class="btn bnt-danger mobby text-danger">Out of Stock</button></span>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </div> {{-- carousal block ends --}}{{-- carousal block starts --}}
            
<div class="modal fade" id="modal{{$product->id}}" role="dialog">
<div class="modal-dialog"> 
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">{{$product->name}}</h4>
<p class="text-center modal-small-title">{{$product->product_weight}}</p>
</div>

<form method="post" class="form" action="/homecart/{{$product->id}}" onclick="return false;">
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
                                                    <!-- <input type="checkbox" name="pname{{$product->name}}" class="abc" > -->Only <span id="cart-amount-{{$product->id}}">{{$product->price_without_gst}} </span> / {{$product->unit}} <span class="start">*</span> &nbsp; <span class="cart-item-count-{{$product->id}}" >1</span>
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    <span>Total : </span><span id="total-kg-{{$product->id}}"></span> <span id="total-kg-show-{{$product->id}}">{{$product->price_without_gst}}</span>&nbsp;&nbsp;<i class="fa fa-inr" aria-hidden="true">.</i>
                                                </div>
                                                <div class="col-md-4 pt12 text-center">                                      
                                                    <div class="value-button" id="decrease-{{$product->id}}" data="{{$product->id}}" value="Decrease Value">-</div>
                                                        <input type="number" id="number" class="number number-{{$product->id}}" name="quantity" min="1" name="quantity" value="1" />
                                                        <div class="value-button" id="increase-{{$product->id}}"  data="{{$product->id}}" value="Increase Value">+</div>                        
                                                </div>
                                            </div>
                                            <div class="row text-center pT20">
                                                
                                                <button class="btn btn-cart mobby" id="addtocartbtn-{{$product->id}}" data-toggle="modal" data-target="#myModal-{{$product->id}}" data="{{$product->id}}">
                                                    Add <span id="add-cart-name-{{$product->id}}"></span><span id="add-cart-amount-{{$product->id}}"></span>
                                                </button>
                                            </div>
</div>
</form>
</div>      
</div>
</div>
</div>
     <div class="modal fade" id="myModal-{{$product->id}}" role="dialog">
                        <div class="modal-dialog " style="padding-right:0px;    width: 331px;
                        float: right;">
                        
                          <!-- Modal content-->
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