@include('_partials.website.header')
<?php
   // echo "<pre>";
   // print_r($productattributes);
   // echo "<pre>";
   
   ?>
<link rel="stylesheet" type="text/css" href="{{asset('newcss/style.min.css')}}">
<style>
   /*.zoomContainer{
   -webkit-transform: translateZ(0);
   position: absolute;
   left:85px!important;
   top: 174.46875px;
   height: 653.453px;
   width: 520px!important;
   }*/
   /*.zoomLens{
   background-position: 0px 0px;
   float: right;
   overflow: hidden;
   z-index: 999;
   transform: translateZ(0px);
   opacity: 0.4;
   zoom: 1;
   width: 580.333px!important;
   height: 653.453px;
   background-color: white;
   cursor: default;
   border: 1px solid rgb(0, 0, 0);
   background-repeat: no-repeat;
   position: absolute;
   left: -193.328px;
   top: 0px;
   display: none;
   }*/
   .btn-cart1{
   border: 0;
   flex: 1;
   min-width: 13rem;
   font-size: 1.4rem;
   border-radius: 0.3rem;
   background-color: #68b723;
   transition: background-color 0.3s;
   color: #fff;
   cursor: pointer;
   max-width: 20.7rem;
   height: 4.5rem;
   }
   .featured-card{
   padding: 20px 50px 20px 40px;
   border: solid 1px #f2f2f2;
   border-radius: 10px;
   position: relative;
   width: 80%;
   background-color: #f1f1f1;
   z-index: 1;
   -webkit-box-shadow: 2px 3px 12px -5px rgb(0 0 0 / 52%);
   -moz-box-shadow: 2px 3px 12px -5px rgba(0,0,0,.52);
   box-shadow: 2px 3px 12px -5px rgb(0 0 0 / 52%);
   background-color: #f7f7f7;
   }
   .card-header a{
      padding: 0!important;
   }
   .icons-img img{
   		width: 40%!important;
   }
   .description-title{
   	  color: #704e4b!important;
   }
</style>
<body>
   
   <div class="page-wrapper">
      @include('_partials.website.nav')
      <!-- End Header -->
      <main class="main pt-6 with-border single-product">
         <div class="page-content mb-10 pb-6">
            <div class="container">
               <div class="product product-single row">
                  <div class="col-md-6">
                     <div class="product-gallery product-gallery-sticky mb-lg-9 mb-4">
                        <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1">
                           @foreach($product->gallerImages as $proimg)
                           <figure class="product-image">
                              <img src="{{$proimg->url}}" data-zoom-image1="{{$proimg->url}}"
                                 alt="{{$product->name}}" width="600" height="675">
                           </figure>
                           @endforeach
                        </div>
                        <div class="product-thumbs-wrap">
                           <div class="product-thumbs">
                              @foreach($product->gallerImages as $proimg)
                              <div class="product-thumb ">
                                 <img src="{{$proimg->url}}" alt="{{$product->name}}"
                                    width="150" height="169">
                              </div>
                              @endforeach
                           </div>
                           <button class="thumb-up disabled"><i class="fas fa-chevron-left"></i></button>
                           <button class="thumb-down disabled"><i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div>
                           <h5 class="description-title mt-4">Help me grow!</h5>
                           <p>{!! $details !!}</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="product-details">
                        <div class="product-navigation">
                           <ul class="breadcrumb breadcrumb-lg">
                              <li><a href="{{('/')}}"><i class="d-icon-home"></i></a></li>
                              <li class="delimiter">/</li>
                              <li><a href="{{('/product')}}" class="active">Products</a></li>
                              <li class="delimiter">/</li>
                              <li>View product</li>
                           </ul>
                           <ul class="product-nav">
                              <li class="product-nav-prev">
                                 <a href="#">
                                 <i class="d-icon-arrow-left"></i> Prev
                                 <span class="product-nav-popup">
                                 <img src="images/product/recent2.jpg"
                                    alt="product thumbnail" width="110" height="123">
                                 <span class="product-name">Flower Plants</span>
                                 </span>
                                 </a>
                              </li>
                              <li class="product-nav-next">
                                 <a href="#">
                                 Next <i class="d-icon-arrow-right"></i>
                                 <span class="product-nav-popup">
                                 <img src="images/product/recent3.jpg"
                                    alt="product thumbnail" width="110" height="123">
                                 <span class="product-name">Flower Plants</span>
                                 </span>
                                 </a>
                              </li>
                           </ul>
                        </div>
                        <h1 class="product-name">{{$product->name}}</h1>
                        <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                        <div class="product-meta">
                           SKU: <span class="product-sku">{{$product->sku}}</span>
                        </div>
                        <div class="product-price">
                           <ins class="new-price">₹{{$product->sell_price}}</ins>
                           <del class="old-price">₹{{$product->base_price}}</del>
                        </div>
                        <div class="ratings-container">
                           <div class="ratings-full">
                              <span class="ratings" style="width:{{$percentage}}%"></span>
                              <span class="tooltiptext tooltip-top"></span>
                           </div>
                           <a href="#product-tab-reviews" class="link-to-tab rating-reviews">( {{$no_review}} reviews )</a>
                        </div>
                        <p class="product-short-desc">Details</p>
                        <hr class="product-divider">
                        <form class="" action="{{ route('add_to_cart', $product) }}" method="post">
                           {{ csrf_field() }}
                           <div class="product-form product-qty">
                              <label>QTY:</label>
                              <div class="product-form-group">
                                 <div class="input-group">
                                    <button type="button" class="quantity-minus d-icon-minus"></button>
                                    <input class="quantity form-control" name="quantity" type="number" min="1"
                                       max="1000000" value="1">
                                    <button type="button" class="quantity-plus d-icon-plus"></button>
                                 </div>
                                 <button class="btn-product btn-cart1"><i class="d-icon-bag"></i> Add To Cart
                                 </button>
                              </div>
                           </div>
                        </form>
                        <hr class="product-divider mb-3">
                        <div class="product-footer">
                           <div class="social-links mr-4">
                              <a href="https://www.facebook.com/Myupavan-104412385283041" class="social-link social-facebook fab fa-facebook-f"></a>
                              <a href="https://www.twitter.com/" class="social-link social-twitter fab fa-twitter"></a>
                              <a href="https://www.linkedin.com/company/my-upavan/" class="social-link social-twitter fab fa-linkedin-in"></a>
                           </div>
                           <span class="divider d-lg-show"></span>
                           <div class="product-action mr-4">
                              @php
                              $rowId = isProductInWishlist($product);
                              @endphp
                              @if(!auth::user())
                              <a href="{{url('postLogin')}}" class="btn-product1 btn-wishlist1 mr-6"
                                 data-rowid="{{$rowId}}" data-pid="{{$product->id}}" id="wishlist"><i
                                 class="far fa-heart"></i>Add to wishlist</a>
                              @endif
                              @if(auth::user())
                              @if($product->wish_list == 0)
                              <a href="#" class="btn-product1 btn-wishlist1 mr-6" data-rowid="{{$rowId}}"
                                 data-pid="{{$product->id}}" id="wishlist"><i class="far fa-heart"></i>Add
                              to wishlist</a>
                              @else
                              <a href="{{url('mywishlist')}}" class="btn-product1 btn-wishlist1 mr-6 added"
                                 data-rowid="{{$rowId}}" data-pid="{{$product->id}}" id="wishlist11"
                                 title="Browse wishlist"><i class="d-icon-heart-full"></i> Browse wishlist</a>
                              @endif
                              @endif
                           </div>
                           <span class="divider d-lg-show"></span>
                           <div class="product-action">
                           	<a href="https://api.whatsapp.com/send?phone=+919619049996" class="btn btn-primary btn-rounded btn-md ml-2" target="_blank">
                                Bulk orders<i class="d-icon-arrow-right"></i></a>
                           </div>	
                        </div>
                        <div class="accordion accordion-simple mb-4">
                           <div class="card border-no card-description">
                              <div class="card-header">
                                 <a href="#collapse1-1" class="collapse">That's Me</a>
                              </div>
                              <div id="collapse1-1" class="card-body expanded">
                                 <div class="row mt-5">
                                    <div class="mb-4">
                                       <div class="desc-p">{!! $product->description !!}</div>
                                       <br>
                                       @if(sizeof($productattributes) != 0)
                                       <h3 class="description-title mb-3 font-weight-semi-bold ls-m">
                                          Up, Close & Personal!
                                       </h3>
                                       <p>Get your plants ready to slay!</p>
                                       {{--
                                       <div class="featured-card mb-4 mt-4 col-md-9 col-sm-12">
                                          <div class="row">
                                             @foreach($productattributes as $productattribute)
                                             <div class="col-md-3">
                                                <img src="{{url('public/productattributeimg/'.$productattribute->productattributemaster->image)}}" alt="img" width="40" height="40" > 
                                             </div>
                                             <div class="col-md-9">
                                                <h6 class="mb-2">
                                                   {{$productattribute->productattributemaster->name}}
                                                </h6>
                                                <p>{{$productattribute->text}}</p>
                                             </div>
                                             @endforeach
                                          </div>
                                       </div>
                                       --}}
                                       <div class="row">
                                          @foreach($productattributes as $productattribute)
                                          <div class="col-xl-5 col-lg-5 col-sm-4 col-6 mb-4">
                                             <div class="category category-icon code-content">
                                                <figure class="category-media icons-img">
                                                   <img src="{{url('public/productattributeimg/'.$productattribute->productattributemaster->image)}}" alt="img">
                                                </figure>
                                                <div class="category-content">
                                                   <h4 class="category-name" style="color: #704e4b;">{{$productattribute->productattributemaster->name}}</h4>
                                                   <p style="margin: 0; color: #68b723;">{{$productattribute->text}}</p>
                                                </div>
                                             </div>
                                          </div>
                                          @endforeach
                                       </div>
                                       @endif    
                                    </div>
                                    <div class="">
                                       <div class="icon-box-wrap d-flex flex-wrap">
                                          <div class="icon-box icon-box-side icon-border pt-2 pb-2 mb-4 mr-10">
                                             <div class="icon-box-icon">
                                                <i class="d-icon-lock"></i>
                                             </div>
                                             <div class="icon-box-content">
                                                <h4 class="icon-box-title lh-1 pt-1 ls-s text-normal">100%
                                                   Secure Payment
                                                </h4>
                                                <p>Secure payment with no doubt</p>
                                             </div>
                                          </div>
                                          <div class="divider d-xl-show mr-10"></div>
                                          <div class="icon-box icon-box-side icon-border pt-2 pb-2 mb-4">
                                             <div class="icon-box-icon">
                                                <i class="d-icon-truck"></i>
                                             </div>
                                             <div class="icon-box-content">
                                                <h4 class="icon-box-title lh-1 pt-1 ls-s text-normal">
                                                   Free shipping
                                                </h4>
                                                <p>On orders over ₹999.00</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card card-reviews">
                           <div class="card-header">
                              <a href="#collapse1-4" class="expand">Reviews ({{$no_review}})</a>
                           </div>
                           <div class="card-body collapsed" id="collapse1-4">
                              <div class="row">
                                 <div class="col-12 mb-6">
                                    <div class="avg-rating-container">
                                       <mark>{{$avg_stars}}</mark>
                                       <div class="avg-rating">
                                          <span class="avg-rating-title">Average Rating</span>
                                          <div class="ratings-container mb-0">
                                             <div class="ratings-full">
                                                <span class="ratings" style="width:{{$percentage}}%"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                             </div>
                                             <span class="rating-reviews">({{$no_review}} Reviews)</span>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- <div class="ratings-list mb-2">
                                       <div class="ratings-item">
                                          <div class="ratings-container mb-0">
                                             <div class="ratings-full">
                                                <span class="ratings" style="width:100%"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                             </div>
                                          </div>
                                          <div class="rating-percent">
                                             <span style="width:100%;"></span>
                                          </div>
                                          <div class="progress-value">100%</div>
                                       </div>
                                       <div class="ratings-item">
                                          <div class="ratings-container mb-0">
                                             <div class="ratings-full">
                                                <span class="ratings" style="width:80%"></span>
                                                <span class="tooltiptext tooltip-top">4.00</span>
                                             </div>
                                          </div>
                                          <div class="rating-percent">
                                             <span style="width:0%;"></span>
                                          </div>
                                          <div class="progress-value">0%</div>
                                       </div>
                                       <div class="ratings-item">
                                          <div class="ratings-container mb-0">
                                             <div class="ratings-full">
                                                <span class="ratings" style="width:60%"></span>
                                                <span class="tooltiptext tooltip-top">4.00</span>
                                             </div>
                                          </div>
                                          <div class="rating-percent">
                                             <span style="width:0%;"></span>
                                          </div>
                                          <div class="progress-value">0%</div>
                                       </div>
                                       <div class="ratings-item">
                                          <div class="ratings-container mb-0">
                                             <div class="ratings-full">
                                                <span class="ratings" style="width:40%"></span>
                                                <span class="tooltiptext tooltip-top">4.00</span>
                                             </div>
                                          </div>
                                          <div class="rating-percent">
                                             <span style="width:0%;"></span>
                                          </div>
                                          <div class="progress-value">0%</div>
                                       </div>
                                       <div class="ratings-item">
                                          <div class="ratings-container mb-0">
                                             <div class="ratings-full">
                                                <span class="ratings" style="width:20%"></span>
                                                <span class="tooltiptext tooltip-top">4.00</span>
                                             </div>
                                          </div>
                                          <div class="rating-percent">
                                             <span style="width:0%;"></span>
                                          </div>
                                          <div class="progress-value">0%</div>
                                       </div>
                                    </div> -->

                                    @if(Auth::user())
                                            
                                            <a class="btn btn-dark btn-rounded submit-review-toggle" href="#">Submit Review</a>
                                        @else
                                          <a class="btn btn-dark btn-rounded" href="{{url('/postLogin')}}">Submit Review</a>
                                            

                                    @endif
                                    
                                 </div>
                                 <div class="col-12 comments pt-2 pb-10 border-no">
                                    <!-- <nav class="toolbox">
                                       <div class="toolbox-left">
                                          <div class="toolbox-item">
                                             <a href="#" class="btn btn-outline btn-rounded">All
                                             Reviews</a>
                                          </div>
                                          <div class="toolbox-item">
                                             <a href="#" class="btn btn-outline btn-rounded">With
                                             Images</a>
                                          </div>
                                          <div class="toolbox-item">
                                             <a href="#" class="btn btn-outline btn-rounded">With
                                             Videos</a>
                                          </div>
                                       </div>
                                       <div class="toolbox-right">
                                          <div class="toolbox-item toolbox-sort select-box text-dark">
                                             <label>Sort By :</label>
                                             <select name="orderby" class="form-control">
                                                <option value="">Default Order</option>
                                                <option value="newest" selected="selected">Newest
                                                   Reviews
                                                </option>
                                                <option value="oldest">Oldest Reviews</option>
                                                <option value="high_rate">Highest Rating</option>
                                                <option value="low_rate">Lowest Rating</option>
                                                <option value="most_likely">Most Likely</option>
                                                <option value="most_unlikely">Most Unlikely</option>
                                             </select>
                                          </div>
                                       </div>
                                    </nav> -->
                                    <ul class="comments-list">
                                    	@if($no_review>0)
                                    		@foreach($reviewData as $reviewDatakey)
                                    		<li>
	                                          <div class="comment">
	                                             <figure class="comment-media">
	                                                <a href="#">
	                                                <img src="/images/user.png"
	                                                   alt="avatar">
	                                                </a>
	                                             </figure>
	                                             <div class="comment-body">
	                                                <div class="comment-rating ratings-container">
	                                                   <div class="ratings-full">
	                                                      <span class="ratings"
	                                                         style="width:{{$reviewDatakey->rating*20}}%"></span>
	                                                      <span
	                                                         class="tooltiptext tooltip-top"></span>
	                                                   </div>
	                                                </div>
	                                                <div class="comment-user">
	                                                   <span class="comment-date">by 

                                                         @if($reviewDatakey->name == "")
                                                         <span class="font-weight-semi-bold text-uppercase text-dark">My Upavan Customer</span> on
                                                         @else
                                                            <span class="font-weight-semi-bold text-uppercase text-dark">{{$reviewDatakey->name}}</span> on
                                                         @endif

                                                          
	                                                   <span
	                                                      class="font-weight-semi-bold text-dark">{{$reviewDatakey->create_date}}</span></span>
	                                                </div>
	                                                <div class="comment-content mb-5">
	                                                   <p>{{$reviewDatakey->review}}
	                                                   </p>
	                                                </div>
	                                                <!-- <div class="file-input-wrappers">
	                                                   <img class="btn-play btn-img pwsp"
	                                                      src="images/product/recent1.jpg"
	                                                      width="280" height="315" alt="product"/>
	                                                   <img class="btn-play btn-img pwsp"
	                                                      src="images/product/recent2.jpg"
	                                                      width="280" height="315" alt="product"/>
	                                                   <a class="btn-play btn-iframe"
	                                                      style="background-image: url(images/product/product.jpg);background-size: cover;"
	                                                      href="video/memory-of-a-woman.mp4">
	                                                   <i class="d-icon-play-solid"></i>
	                                                   </a>
	                                                </div> -->
	                                                <div class="feeling mt-5" style="display: none">
	                                                   <button
	                                                      class="btn btn-link btn-icon-left btn-slide-up btn-infinite like mr-2">
	                                                   <i class="fa fa-thumbs-up"></i>
	                                                   Like (<span class="count">0</span>)
	                                                   </button>
	                                                   <button
	                                                      class="btn btn-link btn-icon-left btn-slide-down btn-infinite unlike">
	                                                   <i class="fa fa-thumbs-down"></i>
	                                                   Unlike (<span class="count">0</span>)
	                                                   </button>
	                                                </div>
	                                             </div>
	                                          </div>
	                                       </li>
                                    		@endforeach

	                                       
	                                    @endif
                                    </ul>
                                    <!--<nav class="toolbox toolbox-pagination justify-content-end">
                                       <ul class="pagination">
                                          <li class="page-item disabled">
                                             <a class="page-link page-link-prev" href="#"
                                                aria-label="Previous" tabindex="-1"
                                                aria-disabled="true">
                                             <i class="d-icon-arrow-left"></i>Prev
                                             </a>
                                          </li>
                                          <li class="page-item active" aria-current="page"><a
                                             class="page-link" href="#">1</a>
                                          </li>
                                          <li class="page-item"><a class="page-link" href="#">2</a>
                                          </li>
                                          <li class="page-item"><a class="page-link" href="#">3</a>
                                          </li>
                                          <li class="page-item page-item-dots"><a class="page-link"
                                             href="#">6</a>
                                          </li>
                                          <li class="page-item">
                                             <a class="page-link page-link-next" href="#"
                                                aria-label="Next">
                                             Next<i class="d-icon-arrow-right"></i>
                                             </a>
                                          </li>
                                       </ul>
                                    </nav>-->
                                 </div>
                              </div>
                              <!-- End Comments -->
                              <div class="review-form-section">
                                 <div class="review-overlay"></div>
                                 <div class="review-form-wrapper">
                                    <div class="title-wrapper text-left">
                                       <h3 class="title title-simple text-left text-normal">Add a
                                          Review
                                       </h3>
                                       <p>Your email address will not be published. Required fields are
                                          marked *
                                       </p>
                                    </div>
                                    <div class="rating-form">
                                       <label for="rating" class="text-dark">Your rating * </label>
                                       <span class="rating-stars selected">
                                       <a class="star-1 submit_star" id="submit_star_1" data-rating="1" href="#">1</a>
                                       <a class="star-2 submit_star" id="submit_star_2" data-rating="2" href="#">2</a>
                                       <a class="star-3 submit_star" id="submit_star_3" data-rating="3" href="#">3</a>
                                       <a class="star-4 submit_star" id="submit_star_4" data-rating="4" href="#">4</a>
                                       <a class="star-5 submit_star" id="submit_star_5" data-rating="5" href="#">5</a>
                                       </span>
                                       <select name="rating" id="rating" required=""
                                          style="display: none;">
                                          <option value="">Rate…</option>
                                          <option value="5">Perfect</option>
                                          <option value="4">Good</option>
                                          <option value="3">Average</option>
                                          <option value="2">Not that bad</option>
                                          <option value="1">Very poor</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
	        							<textarea id="review" cols="30" rows="6"
                                          class="form-control mb-4" placeholder="Comment *"
                                          required></textarea>
	        						</div>
                                       
                                       <!-- <div class="review-medias">
                                          <div class="file-input form-control image-input"
                                             style="background-image: url(images/product/placeholder.png);">
                                             <div class="file-input-wrapper">
                                             </div>
                                             <label class="btn-action btn-upload"
                                                title="Upload Media">
                                             <input type="file" accept=".png, .jpg, .jpeg"
                                                name="riode_comment_medias_image_1">
                                             </label>
                                             <label class="btn-action btn-remove"
                                                title="Remove Media">
                                             </label>
                                          </div>
                                          <div class="file-input form-control image-input"
                                             style="background-image: url(images/product/placeholder.png);">
                                             <div class="file-input-wrapper">
                                             </div>
                                             <label class=" btn-action btn-upload"
                                                title="Upload Media">
                                             <input type="file" accept=".png, .jpg, .jpeg"
                                                name="riode_comment_medias_image_2">
                                             </label>
                                             <label class="btn-action btn-remove"
                                                title="Remove Media">
                                             </label>
                                          </div>
                                          <div class="file-input form-control video-input"
                                             style="background-image: url(images/product/placeholder.png);">
                                             <video class="file-input-wrapper" controls=""></video>
                                             <label class="btn-action btn-upload"
                                                title="Upload Media">
                                             <input type="file" accept=".avi, .mp4"
                                                name="riode_comment_medias_video_1">
                                             </label>
                                             <label class="btn-action btn-remove"
                                                title="Remove Media">
                                             </label>
                                          </div>
                                       </div>
                                       <p>Upload images and videos. Maximum count: 3, size: 2MB</p> -->
                                       <div class="form-group ">
	        								<button type="button" id="save_review"
                                          class="btn btn-primary btn-rounded">Submit<i
                                          class="d-icon-arrow-right"></i></button>
	        							</div>
                                       
                                    </form>
                                 </div>
                              </div>
                              <!-- End Reply -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <section class="pt-3 mt-2">
              <h2 class="title justify-content-center ls-normal mb-10 title-underline text-center">Similar Products</h2>
                <div class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4"
                  data-owl-options="{
                  'items': 5,
                  'nav': false,
                  'loop': false,
                  'dots': true,
                  'margin': 20,
                  'responsive': {
                  '0': {
                  'items': 2
                  },
                  '768': {
                  'items': 3
                  },
                  '992': {
                  'items': 4,
                  'dots': false,
                  'nav': true
                  }
                  }
                  }">
                  @foreach($recentarrival as $product)

                  <div class="product text-center">
                    <figure class="product-media">
                      <a href="{{url('product/'.$product->category.'/'.$product->sku.'/'.$product->id)}}">
                        <img src="{{ featuredImage($product) }}" class="custom-product-img" alt="product"
                        width="300" height="338">
                        <img src="{{ featuredImage2($product) }}" class="custom-product-img" alt="product"
                        width="300"
                        height="338">
                      </a>

                      <div class="product-action-vertical">
                        <input type="hidden" id="quantity" name="quantity" value="1">
                        <input type="hidden" id="pid" name="pid" value={{$product->id}}>
                        <a class="btn-product-icon btn-cart addtocartbtn1" id="addtocartbtn1"
                        data-id="{{$product->id}}" title="Select Options"><i class="d-icon-bag"></i></a>
                        @php
                        $rowId = isProductInWishlist($product);
                        @endphp
                        @if(!auth::user())
                        <a href="{{url('postLogin')}}" class="btn-product-icon btn-wishlist1"
                        title="Add to wishlist"><i class="d-icon-heart"></i></a>
                        @endif

                        @if(auth::user())
                        @if($product->wish_list == 0)
                        <a href="#" class="btn-product-icon btn-wishlist wishlist1"
                        data-rowid="{{$rowId}}" data-pid="{{$product->id}}" id="wishlist1"
                        title="Add to wishlist"><i class="d-icon-heart"></i></a>
                        @else
                        <a href="{{url('mywishlist')}}" class="btn-product-icon btn-wishlist1 added"
                        title="Remove from wishlist"><i class="d-icon-heart-full"></i></a>
                        @endif
                        @endif
                      </div>
                    </figure>
                    <div class="product-details">
                      <h3 class="product-name">
                        <a href="{{url('product/'.$product->category.'/'.$product->sku.'/'.$product->id)}}">{{$product->name}}</a>
                      </h3>

                      <div class="product-price">
                        <ins class="new-price">₹{{$product->sell_price}}</ins>
                        {{--
                          <del class="old-price">₹210.00</del>
                          --}}
                        </div>
                      </div>
                    </div>
                    @endforeach
                </div>
            </section>
         </div>
   </div>
   </main>
   </div>
   
   @include('_partials.website.footer')

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

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
        url: "{{route('wishlist',$product)}}",
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

   <script type="text/javascript">
   	  var rating_data = '';      
      $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');


      });
      /*var frm = $('#review_form');

    frm.submit(function (e) {

        e.preventDefault();
        //rating_data = $(this).data('rating');
        alert(rating_data);

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                console.log('Submission was successful.');
                console.log(data);
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    });*/


    $('#save_review').click(function(){
    	if(rating_data == ''){
        	rating_data 	=	0;

        }
        var review 				=	$("#review").val();
        var product_id			=	$("#product_id").val();
        if(review == ""){
        	alert("Please write a review for submit review!");

        }else{
        	/*$.ajax({
            	url:"submit_rating.php",
            	method:"POST",
            	data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
            	success:function(data)
            	{
                	$('#review_modal').modal('hide');

                	load_rating_data();

                	alert(data);
            	}
        	});*/

        	$.ajax({
            	url: "{{ route('sub_review') }}",
            	type: "POST",
            	headers: {
                	'X-CSRF-TOKEN': "{{ csrf_token() }}"
            	},
            	data:{rating_data:rating_data, review:review,product_id:product_id},
            	cache: false,
           		success: function (response) {
                	console.log(response.status);
                	if (response.status == true) {
                    	//$('.output-display1').show(response);
                    	//$('.output-display1').append(response.message);
                    	//$(".output-display11").hide();
                     swal("Review submit!", response.message, "success");
                     location.reload();   
                    
                    	//alert(response.message);

                	}
                	if (response.status == false) {
                		swal("Oops!",response.message, "error");  
                     location.reload();
                    	//$('.output-display11').show(response);
                    	//$('.output-display11').append(response.message);
                    	//$(".output-display1").hide();
                	}

            	}


        	});

        }
    	//alert(review);

        /*$.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
            success:function(data)
            {
                $('#review_modal').modal('hide');

                load_rating_data();

                alert(data);
            }
        });*/

    });
   </script>
</body>