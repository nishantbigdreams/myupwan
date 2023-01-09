@include('_partials.website.header')
<body>
 <div class="page-wrapper">
  @include('_partials.website.nav')
  <!-- End Header -->
  <main class="main">
   <div class="page-header"
                           style="background-image: url({{asset('public/sliderimg/'. $category_image->category_image)}})!important; background-color: #3C63A4;">
   @if(sizeof($products) ==0)
   <h1 class="page-title">No Product Available</h1>
   @else
   @if ($category_name == 'popular 2022')
                        <h1 class="page-title">Trending 2022</h1>

                        @elseif($category_name == 'Popular 2022')
                                                <h1 class="page-title">Trending 2022</h1>

                    @else
                        <h1 class="page-title">{{ $category_name }}</h1>
                    @endif
   @endif
   <ul class="breadcrumb">
    <li><a href="{{'/'}}"><i class="d-icon-home"></i></a></li>
    <li class="delimiter">/</li>
    <li>Products</li>
   </ul>
  </div>
  <!-- End PageHeader -->
  <div class="page-content">
   <div class="container">
    <section class="mt-10 pt-8">
     <h2 class="title title-center">Product</h2>

     <div class="code-template">
      <div class="row product-wrapper">
       @if(sizeof($products) == 0)
       <h2 class="title title-center">Product Not Available</h2>
       @else
       @foreach($products as $plants)
       {{($plants->featured_image)}}
       <div class="col-md-3 col-6">
        <div class="product shadow-media code-content">
         <figure class="product-media">
          <a href="{{url('product/'.$plants->category.'/'.$plants->sku.'/'.$plants->id)}}">
           <img src="{{featuredImage($plants) }}" class="custom-product-img"
           alt="product" width="300" height="338">
           <img src="{{featuredImage2($plants) }}" class="custom-product-img"
           alt="product" width="300" height="338">
          </a>

          <div class="product-action-vertical">
           <input type="hidden" id="quantity" name="quantity" value="1">
           <input type="hidden" id="pid" name="pid" value={{$plants->id}}>
           <a class="btn-product-icon btn-cart addtocartbtn" id="addtocartbtn1" data-id="{{$plants->id}}" title="Select Options"><i class="d-icon-bag"></i></a>
           @php
           $rowId = isProductInWishlist($plants);
           @endphp
           @if(!auth::user())
           <a href="{{url('postLogin')}}"
           class="btn-product-icon btn-wishlist1"
           title="Add to wishlist"><i
           class="d-icon-heart"></i></a>
           @endif
           @if(auth::user())
           @if($plants->wish_list == 0)
           <a href="#" class="btn-product-icon btn-wishlist"
           data-rowid="{{$rowId}}" data-pid="{{$plants->id}}"
           id="wishlist" title="Add to wishlist"><i
           class="d-icon-heart"></i></a>
           @else
           <a href="{{url('mywishlist')}}"
           class="btn-product-icon btn-wishlist1 added"
           title="Remove from wishlist"><i
           class="d-icon-heart-full"></i></a>
           @endif
           @endif
          </div>
          {{--<div class="product-action">
           <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
           View</a>
          </div>--}}
         </figure>
         <div class="product-details">
          <h3 class="product-name">
           <a href="{{url('product/'.$plants->category.'/'.$plants->sku.'/'.$plants->id)}}">{{$plants->name}}</a>
          </h3>

          <div class="product-price">
           <span class="price">₹{{$plants->sell_price}}</span>
          </div>

         </div>
        </div>
       </div>
       @endforeach
       @endif

      </div>
     </div>
    </section>
   </div>
  </div>

 </main>
</div>
<!-- End Main -->
@include('_partials.website.footer')
<script type="text/javascript">
 $('.addtocartbtn').on('click', function (e) {
  e.preventDefault();
  var quantity = $("#quantity").val();
  var pid = $(this).data('id');
  console.log(pid);

  var frmData = 'productid=' + pid;
  $.ajax({
   type: "POST",
   headers: {
    'X-CSRF-TOKEN': "{{ csrf_token() }}"
   },
   cache: false, data: frmData,
   url: '{{ url('cartadd') }}',
   beforeSend: function () {

   },
   success: function (res) {
    window.location.reload();
    console.log(res);
   }, complete: function (httpObj, textStatus) {
    switch (1 * httpObj.status) {
                    case 301: //here you do whatever you need to do when your php does a redirection
                    break;
                    case 404: //here you handle the calls to dead pages
                    break;
                   }
                  },
                  error: function (response) {

                  }
                 });

 });

</script>
@if(sizeof($products) !=0)
<script>
 $('#wishlist').click(function () {
  $wishBtn = $(this);
  console.log($wishBtn);

  let pid = $wishBtn.attr('data-pid');

  let rowId = $wishBtn.attr('data-rowid');

  $(this).find('i').removeClass('jello');
  if (rowId) {
   console.log(pid);
   $(this).find('i').removeClass('fas fa-heart');
   $(this).find('i').addClass('far fa-heart');
  } else {
   $(this).find('i').removeClass('far fa-heart');
   $(this).find('i').addClass('fas fa-heart');
  }
  $.ajax({
   method: 'post',
   url: "{{route('wishlist',$plants)}}",
   data: {"_token": "{{ csrf_token() }}", rowId: pid},
   success: function (data) {
    console.log(data);
    $wishBtn.attr('data-pid', data);
    $wishBtn.find('i').addClass('jello');
    location.reload();

   }
  });
 });

</script>
@endif

</body>
