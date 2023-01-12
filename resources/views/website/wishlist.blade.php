@include('_partials.website.header')

<link rel="stylesheet" type="text/css" href="newcss/style.min.css">
<body>
<div class="page-wrapper">
    @include('_partials.website.nav')
            <!-- End Header -->
    <main class="main">
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{url('/')}}"><i class="d-icon-home"></i></a></li>
                    <li>Wishlist</li>
                </ul>
            </div>
        </nav>

        <div class="page-content pt-10 pb-10 mb-2">
            <div class="container">
                @if(sizeof($wishlists) == 0)
                    <table class="shop-table wishlist-table mt-2 mb-4">
                        <h4 class="custom-text-center"> Your wishlist is empty</h4>
                        <div class="custom-text-center">
                            <a href="{{url('/')}}" class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4"><i class="d-icon-arrow-left"></i>Continue Shopping</a>
                        </div>
                    </table>


                @else
                    <table class="shop-table wishlist-table mt-2 mb-4">
                        <thead>
                        <tr>
                            <th class="product-name"><span>Product</span></th>
                            <th></th>
                            <th class="product-price"><span>Price</span></th>
                            <th class="product-stock-status"><span>Stock status</span></th>
                            <th class="product-add-to-cart"></th>
                            <th class="product-remove"></th>
                        </tr>
                        </thead>

                        <tbody class="wishlist-items-wrapper">
                        @foreach($wishlists as $wishlist)
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#">
                                        <figure>
                                            <img src="{{$wishlist->url}}" width="100" height="100"
                                                 alt="{{$wishlist->url}}">
                                        </figure>
                                    </a>
                                </td>
                                <td class="product-name">
                                    <a href="#">{{$wishlist->name}}</a>
                                </td>
                                <td class="product-price">
                                    <span class="amount">₹ {{number_format($wishlist->sell_price)}}</span>
                                </td>
                                <td class="product-stock-status">
                                    <?php
                                    $datastock = '';
                                    if ($wishlist->instock <= 1) {
                                        $datastock = "In Stock";
                                    } else {
                                        $datastock = "Out Of Stock";
                                    }
                                    ?>
                                    <span class="wishlist-in-stock">{{$datastock}}</span>
                                </td>
                                <input type="hidden" id="pid" name="pid" value={{$wishlist->id}}>
                                <input type="hidden" id="quantity" name="quantity" value="1">

                                    <td class="product-stock-status"><a class="btn btn-primary btn-link btn-underline wishlistcart" data-id="{{$wishlist->id}}">Add To Cart</a></td>


                                <td class="product-remove">
                                    <input type="hidden" name="pid" value="{{$wishlist->id}}">

                                    <div>
                                        <a href="{{route('destroyWishlist',$wishlist->id)}}" class="remove"
                                           title="Remove this product"><i class="fas fa-times"></i></a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="social-links share-on">
                    <h5 class="text-uppercase font-weight-bold mb-0 mr-4 ls-s">Share on:</h5>
                    <a href="#" class="social-link social-icon social-facebook" title="Facebook"><i
                                class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link social-icon social-twitter" title="Twitter"><i
                                class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link social-icon social-pinterest" title="Pinterest"><i
                                class="fab fa-pinterest-p"></i></a>
                    <a href="#" class="social-link social-icon social-email" title="Email"><i
                                class="far fa-envelope"></i></a>
                    <a href="#" class="social-link social-icon social-whatsapp" title="Whatsapp"><i
                                class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

    </main>
</div>
<!-- End Main -->
@include('_partials.website.footer')
<script>
    $('.wishlistcart').on('click', function (e) {
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
            url: '{{ url('wishlistcartadd') }}',
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
</body>
