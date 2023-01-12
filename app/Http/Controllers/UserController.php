<?php
namespace App\Http\Controllers;

use App\Contact;
use App\Otp;
use App\ProductAttribute;
use App\Slider;
use App\Subcategories;
use App\Subcribe;
use App\User;
use App\Order;
use App\Product;
use App\Payment;
use App\QuesAns;
use App\WishlistModel;
use App\Media;
use App\Contactus;
use App\Category;
use App\ReturnOrder;
use App\CategoriesSeo;
use App\PincodeShipping;
use Session;

use Illuminate\Http\Request;
use App\Repository\FilterProduct;
use Softon\Indipay\Facades\Indipay;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Repository\BlueDart\ShipToPincode;
use Razorpay\Api\Api;
use Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\parentCategory;
use Redirect;
use Hash;
use Validator;
use App\Mail\OrderPlaceMail;
use Carbon\Carbon;
use Mail;
use DateTime;
use App\Mail\ContactMail;
use Socialite;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getcart(Request $request)
    {
        return view('_partials/website/dynamiccart');
    }

    public function addToCartnew(Request $request, Product $product)
    {

        foreach (Cart::content() as $key => $cart) {
            if ($cart->id == $request->product_id) {
                return back()->with('already_added', 'You already add this product in cart');
                /*                return 0;*/
            }
        }


        $product = array(
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->quantity,
            'price' => $product->sell_price,
            'options' => [
                'image' => featuredImage($product),
                'category' => $product->category,
                'model' => $product->model,
                'sku' => $product->sku,
                'delevery_charge' => intVal($product->delevery_charge),
                'stock' => intVal($product->in_stock),
                'combo_qty' => json_decode($product->combo_qty),
                'combo_discount' => json_decode($product->combo_discount),
                'product_weight' => $product->product_weight,
                'price_without_gst' => $product->price_without_gst,
                'gst' => $product->gst ?? 0,


            ]
        );
        // dd($product);
        Cart::add($product);
        $no = Cart::content()->count();
        session(['totalcount' => $no]);

        //return redirect()->route('user.cart');
        return $no;
    }


    public function add_to_my_cart(Request $request)
    {
        foreach (Cart::instance('cart')->content() as $key => $cart) {
            if ($cart->id == $request->product_id) {
                return back()->with('already_added', 'You already add this product in cart');
                // return 0;
            }
        }
        $product = Product::find($request->product_id);
        $product = array(
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->product_qty,
            'price' => $product->sell_price,
            'options' => [
                'image' => featuredImage($product),
                'category' => $product->category,
                'model' => $product->model,
                'sku' => $product->sku,
                'type' => $product->type,
                'description' => $product->description,
                'delevery_charge' => intVal($product->delevery_charge),
                'stock' => intVal($product->in_stock),
                'combo_qty' => json_decode($product->combo_qty),
                'combo_discount' => json_decode($product->combo_discount),
                'product_weight' => $product->product_weight,
                'price_without_gst' => $product->price_without_gst,
                'gst' => $product->gst ?? 0,

            ]
        );

        $noOfItems = Cart::instance('cart')->content()->count();
        session(['totalcount' => $noOfItems]);
        Cart::instance('cart')->add($product);
        return 1;
    }

    //public function search($q)
    public function search(Request $request)
    {
        $q = $request->search;
        $products = Product::with('featuredImage')->where('name', 'LIKE', "%$request->search%")->orWhere('alt_name', 'LIKE', "%$request->search%")->orderBy('updated_at', 'desc')->get();
        return view('website.search_result', compact('q', 'products'));
    }

    public function catresult($q)
    {
        $cd = explode(' ', $q);

        /* $p=[];
         foreach ($cd as $value) {

             if ($value!='&')
             {
                 $value=substr($value, 0, -1);
         $p=array_merge($p,Product::with('featuredImage')->where('name', 'LIKE', "%$value%")->orderBy('updated_at','desc')->get()->toArray());
             }
         }
         $products =$p;
         dd($products);*/
         $products = Product::with('featuredImage')->where('data', 'LIKE', "%$q%")->orderBy('updated_at', 'desc')->get();

         return view('website.cat_result', compact('q', 'products'));
     }


     public function index()
     {
        $query = @$_GET['query'];
        //checking if query is for category
        // $category = Category::where('name', $query)->first();
        // if ($category) {
        // }
        // $parentCategories = parentCategory::all();
        $no = Cart::content()->count();
        if (Auth::user()) {
            if ($no) {
                session(['totalcount' => $no]);
            }
        } else {
            $no = Cart::content()->count();
            session(['totalcount' => $no]);
        }
        /*dd($no);*/

        // $parentCategories = DB::table('parent_categories')->get();
        //if query is for product
        $freshproducts = Product::with('featuredImage')->where('home_best_sellers', '1')->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
        $recentarrival = Product::with('featuredImage')->where('home_recent_arrivals', '1')->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
        $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%FRUITS%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
        if ($query) {
            $product = Product::where('name', $query)->first();
            if ($product) {
                $similar_products = $product->similarProducts();
                return view('website.product-page',
                    compact('product', 'similar_products'));
            }

        }
        /*        $category = Subcategories::select('id', 'name', 'parent_category_id', 'sku_initial', 'data')->orderBy('id', 'asc')->get();*/
        $category = Product::selectRaw('products.id ,products.sell_price,products.name,products.sku,products.model,products.category ,products.product_weight,categories.id as cid,categories.name as cname,categories.data,categories.parent_category_id,categories.sku_initial')->
        join('categories', 'products.category', '=', 'categories.name')
        ->orderby('products.id', 'asc')
        ->get();

        $slider = Slider::select('text_1','text_2','image','id')->where('status',1)->orderBy('priority','asc')->get();
        return view('website.index', compact('freshfruitsproducts', 'freshproducts', 'category', 'recentarrival','slider'));
    }

    public function allveg()
    {
        $query = @$_GET['query'];
        $no = Cart::content()->count();
        if (Auth::user()) {
            if ($no) {
                session(['totalcount' => $no]);
            }
        } else {
            $no = Cart::content()->count();
            session(['totalcount' => $no]);
        }
        $allProducts = Product::with('featuredImage')->all();
        $cat = DB::table('categories')->get();
        $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%VEGETABLE%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
        $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%FRUITS%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();

        return view('website.allVegandFruits', compact('freshfruitsproducts', 'freshproducts', 'allProducts', 'cat'));
    }

    public function dynamic()
    {
        $query = @$_GET['query'];
        //checking if query is for category
        // $category = Category::where('name', $query)->first();
        // if ($category) {
        // }
        // $parentCategories = parentCategory::all();
        $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%VEGETABLE%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
        $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%FRUITS%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
        $no = Cart::content()->count();
        if (Auth::user()) {
            if ($no) {
                session(['totalcount' => $no]);
            }
        } else {
            $no = Cart::content()->count();
            session(['totalcount' => $no]);
        }
        /*dd($no);*/

        // $parentCategories = DB::table('parent_categories')->get();
        //if query is for product
        if ($query) {
            $product = Product::where('name', $query)->first();
            if ($product) {
                $similar_products = $product->similarProducts();
                return view('website.product-page',
                    compact('product', 'similar_products', 'freshfruitsproducts', 'freshproducts'));
            }
        }
        return view('website.indexdynamic', compact('freshfruitsproducts', 'freshproducts'));
    }

    public function index2()
    {
        $query = @$_GET['query'];

        //checking if query is for category
        // $category = Category::where('name', $query)->first();
        // if ($category) {
        // }

        //if query is for product
        if ($query) {
            $product = Product::where('name', $query)->first();
            if ($product) {
                $similar_products = $product->similarProducts();
                return view('website.product-page',
                    compact('product', 'similar_products'));
            }
        }

        return view('website.index2');
    }

    public function oldhome()
    {
        Cache::flush();
        // $orders = auth()->user()->orders->withoutGlobalScope('paid_orders');
        $orders = Order::withoutGlobalScope('paid_orders')->where('user_id', auth()->user()->id)->get();
        return view('website.home', compact('orders'));
    }

    public function account()
    {
        Cache::flush();
        // $orders = auth()->user()->orders->withoutGlobalScope('paid_orders');
        $orders = Order::withoutGlobalScope('paid_orders')->where('user_id', auth()->user()->id)->get();
        return view('website.account', compact('orders'));
    }

    public function home()
    {
        Cache::flush();
        // $orders = auth()->user()->orders->withoutGlobalScope('paid_orders');
        $orders = Order::withoutGlobalScope('paid_orders')->where('user_id', auth()->user()->id)->get();
        return view('website.testlogin', compact('orders'));
    }

    public function getorderbyorder_id($id)
    {
        Cache::flush();
        // $orders = auth()->user()->orders->withoutGlobalScope('paid_orders');
        $order = Order::withoutGlobalScope('paid_orders')->where('order_id', $id)->first();
        return view('website.guest_order_view', compact('order'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:191',
            'email' => 'required|email|min:3|max:191|unique:users,email,' . auth()->user()->id,
            'phone' => 'required|digits_between:10,12',
            'password' => 'nullable|min:6|max:191',
            'confirm_password' => 'nullable|required_with:password|min:6|max:191|same:password',
        ]);

        auth()->user()->name = $request->name;
        auth()->user()->email = $request->email;
        auth()->user()->phone = $request->phone;
        auth()->user()->subcribe_to_newsletter = ($request->newsletter ?? 'no') != 'no' ? 'yes' : 'no';

        if ($request->password) {
            auth()->user()->password = \Hash::make($request->password);
        }

        auth()->user()->save();

        return back();
    }

    public function updateBilling(Request $request)
    {
        $this->validate($request, [
            'contact_person' => 'required|string|min:3|max:191',
            'contact_number' => 'required|digits_between:10,12',
            'address_line_0' => 'required|string|max:30',
            'address_line_1' => 'required|string|max:30',
            'address_line_2' => 'required|string|max:30',
            'pincode' => 'required|digits_between:6,6',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);

        DB::table('addresses')->insert(
            ['user_id' => auth()->user()->id],
            [
                'contact_person' => $request->contact_person,
                'contact_number' => $request->contact_number,
                'type' => 'billing',
                'is_company' => $request->isCompany ? 1 : 0,
                'gst_no' => $request->gst,
                'pan_no' => $request->pan,
                'tin_no' => $request->tin_no,
                'address_line_0' => $request->address_line_0,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'state' => $request->state,
            ]);

        return back();
    }

    public function categoryShow($category_name)
    {   

        if (strpos($category_name, ' ') !== false) {

            $category_name = str_replace(" ", "-", $category_name);
            return redirect('category/' . $category_name);
        } else {

            $category_name = str_replace("-", " ", $category_name);
            $category = Category::where('name', $category_name)->firstOrFail();
       
            $category_image=Category::where('id',$category->id)->first();


            $products = Product::InStock()->selectRaw('products.id ,products.sell_price,products.name,products.sku,products.model,products.category ,products.product_weight, media.product_id,media.url')->
            leftjoin('media', 'media.product_id', '=', 'products.id')->
            where('media.type', 'featured')->
            Where('category', 'like', '%' . $category_name . '%')->
            groupBy('products.id')->
            orderBy('products.updated_at', 'desc')->get();
            //Log::info("else me hoon  second ".$products);
            // dd($products);


            $category_seo = CategoriesSeo::where('category_id', $category->id)->get();
        }
            return view('website.category', compact('category', 'category_name', 'products', 'category_seo','category_image'));

    }

    public function productShow($category, $model, Product $product)
    {
        $product->load(['gallerImages', 'fImage', 'questionAndAnswer', 'questionAndAnswer.askBy']);

        $details= $product->details;
        // dd($details);
        // dd($product);

        $similar_products = $product->similarProducts();
        $category = array();
        if ($product['is_variations']) {
            $data = json_decode($product->variation_data, true) ?? '';
            $variant_name = $data['variant_name'] ?? '';
            $skus = $data['sku']     ?? '';
            $category = DB::table('products')
            ->join('media', 'media.product_id', 'products.id')
            ->select('products.sku', 'media.type', 'media.url', 'products.model')
            ->whereIn('products.sku', $skus)
            ->where('media.type', 'featured')
            ->get();
        }
        $recentarrival = Product::with('featuredImage')->where('home_recent_arrivals', '1')->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
        $productattributes = ProductAttribute::with('productattributemaster', 'productname')->select('id', 'p_id', 'patt_id', 'text')->where('p_id', $product->id)->get();

        $reviewData = DB::table('review')
        ->join('users', 'users.id', 'review.user_id')
        ->select('review.*', 'users.name')
        ->where('review.product_id',$product->id)
        ->where('review.approve',1)
        ->orderBy('review.id', 'desc')
        ->get();
        $no_review =    count($reviewData);

        $avg_stars = DB::table('review')
        ->where('approve',1)
        ->where('product_id',$product->id)
        ->avg('rating');

        $percentage     =   $avg_stars*20;            

        return view('website.product-page', compact('details','product', 'similar_products', 'category', 'productattributes','recentarrival','reviewData','no_review','avg_stars','no_review','percentage'));
    }

    public function productShow1($category, $model, Product $product)
    {
        $product->load(['gallerImages', 'questionAndAnswer', 'questionAndAnswer.askBy']);
        $similar_products = $product->similarProducts();
        $category = array();
        if ($product['is_variations']) {
            $data = json_decode($product->variation_data, true) ?? '';
            $variant_name = $data['variant_name'] ?? '';
            $skus = $data['sku']     ?? '';
            /*  print_r($skus);*/
            $category = DB::table('products')
            ->join('media', 'media.product_id', 'products.id')
            ->select('products.sku', 'media.type', 'media.url', 'products.model')
            ->whereIn('products.sku', $skus)
            ->where('media.type', 'featured')
            ->get();

        }
        return view('website.product1', compact('product', 'similar_products', 'category'));
    }

    public function filterProduct(Request $request)
    {
        $filter = new FilterProduct($request);
        return response()->json($filter->filteredProducts());
    }

    public function addToCart(Request $request, Product $product)
    {
        Session()->forget('order_id');
        $updateqty = false;
        foreach (Cart::content() as $key => $cart) {
            if ($cart->id == $product->id) {
                Cart::update($cart->rowId, $request->quantity);
                $updateqty = true;
                //  return back()->with('already_added', 'You already add this product in cart');
                /*                return 0;*/
            }
        }
        if ($updateqty == false) {

            $product = array(
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->quantity,
                'price' => $product->sell_price,
                'options' => [
                    'image' => featuredProductImage($product),
                    'category' => $product->category,
                    'model' => $product->model,
                    'sku' => $product->sku,
                    'delevery_charge' => intVal($product->delevery_charge),
                    'stock' => intVal($product->in_stock),
                    'combo_qty' => json_decode($product->combo_qty),
                    'combo_discount' => json_decode($product->combo_discount),
                    'product_weight' => $product->product_weight,
                    'price_without_gst' => $product->price_without_gst,
                    'gst' => $product->gst ?? 0,

                ]
            );

            Cart::add($product);
        }
        return back()->with('already_added', 'You already add this product in cart');

    }

    public function wishlistcartadd(Request $request, Product $product)
    {
        Session()->forget('order_id');
        $updateqty = false;
        foreach (Cart::content() as $key => $cart) {
            if ($cart->id == $request->productid) {
                Cart::update($cart->rowId, 1);
                $updateqty = true;
            }
        }
        if ($updateqty == false) {
            $product1 = Product::with('featuredImage')->where('id', $request->productid)->get()->toArray();

            $productarray = array(
                'id' => $product1[0]['id'],
                'name' => $product1[0]['name'],
                'qty' => '1',
                'price' => $product1[0]['sell_price'],
                'options' => [
                    'image' => $product1[0]['featured_image']['url'],
                    'category' => $product1[0]['category'],
                    'model' => $product1[0]['model'],
                    'sku' => $product1[0]['sku'],
                    'delevery_charge' => intVal($product1[0]['delevery_charge']),
                    'stock' => intVal($product1[0]['in_stock']),
                    'combo_qty' => json_decode($product1[0]['combo_qty']),
                    'combo_discount' => json_decode($product1[0]['combo_discount']),
                    'product_weight' => $product1[0]['product_weight'],
                    'price_without_gst' => $product1[0]['price_without_gst'],
                    'gst' => $product1[0]['gst'] ?? 0,

                ]
            );

            Cart::add($productarray);
        }
        $wishlist = WishlistModel::where('cust_id', auth::user()->id)->where('p_id', $request->productid);
        $wishlist->delete();

        return response()->json('You already add this product in cart');
    }

    public function ajaxaddToCart(Request $request)
    {
        Session()->forget('order_id');
        $updateqty = false;
        foreach (Cart::content() as $key => $cart) {
            if ($cart->id == $request->productid) {
                Cart::update($cart->rowId, 1);
                $updateqty = true;
            }
        }
        if ($updateqty == false) {
            $product1 = Product::with('featuredImage')->where('id', $request->productid)->get()->toArray();

            $productarray = array(
                'id' => $product1[0]['id'],
                'name' => $product1[0]['name'],
                'qty' => '1',
                'price' => $product1[0]['sell_price'],
                'options' => [
                    'image' => $product1[0]['featured_image']['url'],
                    'category' => $product1[0]['category'],
                    'model' => $product1[0]['model'],
                    'sku' => $product1[0]['sku'],
                    'delevery_charge' => intVal($product1[0]['delevery_charge']),
                    'stock' => intVal($product1[0]['in_stock']),
                    'combo_qty' => json_decode($product1[0]['combo_qty']),
                    'combo_discount' => json_decode($product1[0]['combo_discount']),
                    'product_weight' => $product1[0]['product_weight'],
                    'price_without_gst' => $product1[0]['price_without_gst'],
                    'gst' => $product1[0]['gst'] ?? 0,

                ]
            );

            Cart::add($productarray);
        }
        return response()->json('You already add this product in cart');

    }

    public function repeatorder($orderid)
    {
        Cache::flush();
        $order = Order::withoutGlobalScope('paid_orders')->where('id', $orderid)->first();

        $productid = (json_decode($order->product_id));
        $totalProducts = [];
        foreach ($productid as $key => $proid) {
            $product = Product::find($proid);

            $productDetails = array(
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->sell_price,
                'options' => [
                    'image' => featuredImage($product),
                    'category' => $product->category,
                    'model' => $product->model,
                    'sku' => $product->sku,
                    'delevery_charge' => intVal($product->delevery_charge),
                    'stock' => intVal($product->in_stock),
                    'combo_qty' => json_decode($product->combo_qty),
                    'combo_discount' => json_decode($product->combo_discount),
                    'product_weight' => $product->product_weight,
                    'price_without_gst' => $product->price_without_gst,
                    'gst' => $product->gst ?? 0,

                ]
            );
            array_push($totalProducts, $productDetails);
        }

        Cart::add($totalProducts);
        return redirect()->route('user.cart');
    }

    public function buy_now(Request $request, Product $product)
    {
        if ($product->in_stock < 1) {
            return back()->with('avalability_error', '<small class="text-danger">We are running low on stock for this product, please try again later</small>');
        }

        foreach (Cart::content() as $key => $cart) {
            if ($cart->id == $product->id) {
                return back()->with('already_added', 'You already add this product in cart');
            }
        }
        $product = array(
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->sell_price,
            'options' => [
                'image' => featuredImage($product),
                'category' => $product->category,
                'model' => $product->model,
                'sku' => $product->sku,
                'delevery_charge' => intVal($product->delevery_charge),
                'stock' => intVal($product->in_stock),
                'combo_qty' => json_decode($product->combo_qty),
                'combo_discount' => json_decode($product->combo_discount),
                'product_weight' => $product->product_weight,
                'price_without_gst' => $product->price_without_gst,
                'gst' => $product->gst ?? 0,

            ]
        );
        Cart::add($product);
        return redirect()->route('confirmOrderGuest');
    }

    public function userCart()
    {
        $cart_price = [];

        // workingStatus
        $workingStatus = "";
        if (session('workingStatus')) {
            $workingStatus = session('workingStatus');
        }

        foreach (Cart::instance('cart')->content() as $key => $cart) {

            $combo_qty = $cart->options->combo_qty ?? [0];
            $combo_dis = $cart->options->combo_discount ?? [0];

            $discount_rate = combo_discount($combo_qty, $combo_dis, $cart->qty);

            $price = $cart->price * $cart->qty - $cart->price * $cart->qty * ($discount_rate / 100);
            array_push($cart_price, round($price));
        }
        session(['user.cart.total' => array_sum($cart_price)]);
        $noOfItems = Cart::instance('cart')->content()->count();
        /*    dd($noOfItems);*/
        /*session(['user.noOfItems' =>$noOfItems]);*/

        session(['totalcount' => $noOfItems]);

        return view('website.shopping-cart', compact('cart_price', 'workingStatus'));
    }

    public function updateCart(Request $request)
    {
        $cart_price = [];

        foreach (Cart::content() as $key => $cart) {
            // for($i=1; $i <=Cart::content()->count(); $i++ ){
            $i = 0;

            foreach ($request->id as $pid) {
                if ($cart->id == $pid) {
                    Cart::update($cart->rowId, $request->quantity[$i]);
                    $price = $cart->price * $cart->qty;
                    array_push($cart_price, round($price, 2));
                }
                $i++;
            }


            //  }

        }
        /*
         foreach (Cart::instance('cart')->content() as $key => $cart) {
             $combo_qty = $cart->options->combo_qty ?? [0];
             $combo_dis = $cart->options->combo_discount ?? [0];

             $discount_rate = combo_discount($combo_qty, $combo_dis, $cart->qty);

         }*/
         session(['user.cart.total' => array_sum($cart_price)]);
         /*        return $cart_price;*/
         return redirect('cartnew');
     }

     public function removeFromCart(Request $request)
     {
        /*        Cart::instance('cart')->remove($request->rowId);*/
        Cart::remove($request->rowId);

        session(['totalcount' => Cart::instance('cart')->count()]);
        /*        return response()->json(Cart::count());*/
        return back()->with('remove', 'remove From cart');

    }

    public function confirmOrder()
    {
        $seconds = time();
        $rounded_seconds = ceil($seconds / (30 * 60)) * (30 * 60);
        function seconds_from_time($time)
        {
            list($h, $m) = explode(':', $time);
            return ($h * 3600) + ($m * 60);
        }

        $roundtime = date('H:i', $rounded_seconds);
        $convertedToSecond = seconds_from_time($roundtime) + 3600;

        function hoursRange($lower = 32400, $upper = 80000, $step = 1800, $format = '')
        {
            $times = array();
            $i = 0;
            if (empty($format)) {
                $format = 'g:i a';
            }
            foreach (range($lower, $upper, $step) as $key => $increment) {
                $increment = gmdate('H:i', $increment);
                list($hour, $minutes) = explode(':', $increment);
                $date = new DateTime($hour . ':' . $minutes);
                $times[$i] = $date->format($format);
                $i++;

            }

            return $times;
        }

        if ($convertedToSecond < 79200 && $convertedToSecond > 32400) {
            $range = hoursRange();
        } else {
            $range = hoursRange();

        }

        //    if ($convertedToSecond < 79200 && $convertedToSecond > 32400) {
        //     $range = hoursRange($convertedToSecond, 79200, 60 * 30, 'h:i a');
        // } else {
        //     $range = hoursRange(32400, 79200, 60 * 30, 'h:i a');

        // }
        // dd($convertedToSecond);
        $between = array();
        $arraySize = count($range);


        $i = 0;
        for ($range; $i < $arraySize - 1; $i++) {
            array_push($between, $range[$i] . " - " . $range[$i + 1]);
        }


        //print date('H');
        // $hour = date('H');
        if (Cart::count() == 0) {
            return view('website.empty_cart');
        }

        $timezone = 'Asia/Kolkata';

        // $cart=Cart::content('cart');

        // dd($cart);

        // $workingStatus = $this->workingStatus();

        // if ($workingStatus == "closed") {
        //     //now is >= today/8pm and <= tomorrow/9am

        //      return redirect()->route('user.cart')->with(['workingStatus'=>$workingStatus]);
        // // return view('user.cart',compact('workingStatus'));
        // }

        // if ($hour>20) {
        //     return redirect()->route('user.cart');
        // }
        //die();
        // dd(Cart::content());
        //check if all cart prd qrt is less than prd qty;

        $pincode = DB::table('pincode_shippings')->get();

        // Cart::subtotal();
        $delevery_total = 60;
        $subtotal = str_replace(',', '', Cart::subtotal());

        if ($subtotal < 999) {
            $delevery_total = $delevery_total +0;
        }
        // dd($subtotal,$delevery_total);


// dump(str_replace(',', '', Cart::subtotal()) + 30);
// dd(Cart::subtotal());

        // foreach (Cart::content() as $key => $cart) {
        //     $product = Product::find($cart->id);

        //     if ($product) {
        //         if (intVal($product->in_stock) < $cart->qty) {
        //             return back()->with("stock_error_$product->id",
        //             "Low on stock<br>try with ".intVal($product->in_stock)." qty");
        //         }
        //     }
        // }
        return view('website.checkout', compact('pincode', 'delevery_total', 'between'));
    }

    public function confirmSubs(Request $request){
        $delevery_total     =   $request->price;
        $pincode            =   DB::table('pincode_shippings')->get();
        $between            =   '';
        return view('website.subs_checkout', compact('pincode', 'delevery_total', 'between'));

    }

    public function confirmOrderGuest()
    {
        if (Cart::instance('cart')->count() == 0) {
            return view('website.empty_cart');
        }
        // dd(Cart::content());
        //check if all cart prd qrt is less than prd qty;
        foreach (Cart::instance('cart')->content() as $key => $cart) {
            $product = Product::find($cart->id);
            if ($product) {
                if (intVal($product->in_stock) < $cart->qty) {
                    return back()->with("stock_error_$product->id",
                        "Low on stock<br>try with " . intVal($product->in_stock) . " qty");
                }
            }
        }

        return view('website.checkout');
    }

    private function workingStatus()
    {
        $dateformat = 'D d/m/Y h:i:sa';

        $times = array(
            'opening_hours_mon' => '8am - 8pm',
            'opening_hours_tue' => '8am - 8pm',
            'opening_hours_wed' => '8am - 8pm',
            'opening_hours_thu' => '8am - 8pm',
            'opening_hours_fri' => '8am - 8pm',
            'opening_hours_sat' => '8am - 8pm',
            'opening_hours_sun' => '8am - 8pm'
        );

        foreach ($times as $key => $value)
            // echo "$key = '$value'<br>";
//$times=array_values($times);
            $curdate = date($dateformat);
        $basedate = date($dateformat, strtotime('this week midnight'));
// echo "<hr>Week started at <strong>$basedate</strong> - Current date/time is <strong>$curdate</strong><br><hr>";

        function get_time_slot($weekday, $fromtime, $totime)
        {
            $from_ts = strtotime("this week $weekday $fromtime");
            $to_ts = strtotime("this week $weekday $totime");
            if ($to_ts < $from_ts) {
                $to_ts = strtotime("this week $weekday +1 day $totime");
                if ($to_ts > strtotime("next week midnight"))
                    $to_ts = strtotime("this week mon $totime");
            }
            return array('from' => $from_ts, 'to' => $to_ts);
        }

// transform to a timestamp from/to array
        $slots = array();
        foreach ($times as $key => $entry) {
            list(, , $dow) = explode('_', $key);
            foreach (explode(',', $entry) as $d) {
                $arr = explode('-', $d);
                if (count($arr) == 2) {
                    $slot = get_time_slot($dow, $arr[0], $arr[1]);
                    $slots[] = $slot;
                    // sanity:
                    $fromstr = date($dateformat, $slot['from']);
                    $tostr = date($dateformat, $slot['to']);
                    // echo "From: <strong>$fromstr</strong> to: <strong>$tostr</strong> -- Slot: <code>".print_r($slot,true)."</code><br>";
                }
            }
        }

        $status = 'closed';
        $rightnow = time();
        foreach ($slots as $slot)
            if ($rightnow <= $slot['to']) {
                if ($rightnow >= $slot['from']) $status = 'open';
                break;
            }
// echo "<hr>The restaurant is <strong>$status</strong> right now<br>";
            return $status;
        }

        public function paymentResponse(Request $request)
        {
            $response = Indipay::response($request);
            $payment = Payment::where('tid', $response['merchant_param1'])
            ->firstOrFail();
            if ($response['status_message'] == 'Y') {

                $payment->status = 'paid';
                $payment->invoice_no = invoiceNo();
                $payment->data = json_encode($response);
                $payment->save();

                Cart::destroy();
                $order = Order::withoutGlobalScope('paid_orders')
                ->where('is_paid', 'no')
                ->findOrFail($response['order_id']);
                $order->is_paid = 'yes';
                $order->save();
            //$order=Order::orderBy('id', 'DESC')->first();
                $order->user->notify(
                    new \App\Notifications\NewOrderPlaceNotification($order)
                );
                return redirect()->route('order_placed', $order);

            } else {

                $payment->status = 'failed';
                $payment->save();

                $message = '';
                if ($response['failure_message']) {
                    $message = '<br>' . $response['failure_message'];
                }

                return redirect()->route('checkout')
                ->with('retry_order', $response['order_id'])
                ->with('payment_error', 'Your last trasaction was incomplete. Please try again!.' . $message);
            }
        }

        public function cancelOrder(Request $request, $order)
        {

            $order = Order::withoutGlobalScope('paid_orders')->find($order);

            if (auth()->user()->can('update', $order)) {

                $product_id = json_decode($order->product_id, true);

                $product_qty = json_decode($order->product_qty, true);

                foreach ($product_id as $key1 => $value1) {
                    $product = Product::find($value1);
                    $stock = ((int)$product->in_stock + $product_qty[$key1]);
                    $product->in_stock = $stock;
                    $product->save();
                }

                $order->status = 'cancelled';
                $order->cancelled_at = now();
                $order->cancelled_reason = $request->reason;
                $order->save();
                return back();

            }

            abort(404);

        }

        public function returnOrder(Request $request, Order $order)
        {
            $this->validate($request, [
                'return_reason' => 'required',

            ]);


            ReturnOrder::updateOrCreate(['order_id' => $order->id],
                [
                    'order_id' => $order->id,
                    'reason' => $request->return_reason,
                    'bank' => $request->bank,
                    'account_no' => $request->account_no,
                    'ifsc_code' => $request->ifsc_code,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'status' => 'processing',
                    'invoice_no' => returnInvoiceNO()
                ]);

            $order->status = 'return';
            $order->save();

            return response()->json('Your return request successfully registered');

        }

        public function orderPlaced($order)
        {
            Cache::flush();
            $order = Order::withoutGlobalScope('paid_orders')->find($order);
            return view('website.order_placed', compact('order'));
        }

        public function postQuestion(Request $request, Product $product)
        {
            $product->questionAndAnswer()->create([
                'question' => $request->question,
                'asked_by' => auth()->user()->id,
            ]);
            return response()->json(true);
        }

        public function replyQuestion(Request $request)
        {
            $answer[] = array(
                'replied_by' => auth()->user()->name,
                'replier_id' => auth()->user()->id,
                'message' => $request->answer,
                'replied_at' => date('d M, Y', strtotime(now()))
            );
            $question = QuesAns::findOrFail($request->reply_to);
            if ($question->answers) {
                $question->answers = $question->answers . '~' . json_encode($answer);
            } else {
                $question->answers = json_encode($answer);
            }
            $question->save();
            return response()->json(true);
        }

        public function wishlist()
        {
            return view('website.wishlist');
        }

        public function displaywishlist()
        {
            $cid = auth::user()->id;
            $wishlists = Product::selectRaw('products.id ,products.sell_price,products.name,products.sku,products.model,products.category ,products.product_weight,media.product_id,media.url,tbl_wishlist.cust_id')->
            join('tbl_wishlist', 'tbl_wishlist.p_id', '=', 'products.id')->
            join('media', 'media.product_id', '=', 'products.id')->
            where('media.type', 'featured')->
            where('tbl_wishlist.cust_id', $cid)->
            groupBy('products.id')->
            orderBy('products.id', 'desc')->get();
            cache::flush();
            return view('website.wishlist', compact('wishlists'));
        }


        public function addToWishlist1(Request $request, Product $product)
        {
            if ($request->rowId) {
                if (Cart::instance('wishlist')->get($request->rowId)) {
                    Cart::instance('wishlist')->remove($request->rowId);
                return;// response()->json(true);
            }
        } else {
            $product = array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sell_price,
                'qty' => 1,
                'options' => [
                    'image' => featuredImage($product),
                    'category' => $product->category,
                    'model' => $product->model,
                    'sku' => $product->sku,
                    'stock' => $product->in_stock,
                    'price_without_gst' => $product->price_without_gst,
                    'added_on' => now(),
                ]
            );
            return Cart::instance('wishlist')->add($product)->rowId;
        }
        return $product;
    }

    public function addToWishlist(Request $request){
        $wishlist = new WishlistModel();
        $wishlist->p_id = $request->rowId;
        $wishlist->cust_id = auth::user()->id;
        $wishlist->created_at = Carbon::now();
        $wishlist->updated_at = Carbon::now();
        $wishlist->save();
        return $request->pid;
    }

    public function destroyWishlist($id)
    {

        $wishlist = new WishlistModel();
        $wishlist = WishlistModel::where('p_id', $id);
        try {
            $wishlist->delete();
            return redirect('mywishlist');
        } catch (\Exception $e) {
            return redirect('mywishlist');
        }


    }

    public function removeFromWishlist($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        return back();
    }

    public function sendCodOrderOtp(Request $request)
    {
     $phoneno=auth()->user()->phone;
     $otp = rand(1000, 9999);
        //$message = "Your one time password to place your order  " . env('APP_NAME') . " is $otp . This code is valid for 10 minutes. Thank You.";

     Session::put('guest_phone_text', $request->guest_phone_text);
     Session::save();

     Otp::where('phone', auth()->user()->phone ?? $request->guest_phone_text)->delete();

     Otp::create([
        'phone' => auth()->user()->phone ?? $request->guest_phone_text,
        'code' => $otp
    ]);


     $message = "Dear User, Your OTP for login is ".$otp.". Valid for 10 mins. Please do not share this OTP. Regards, Big Dreams Team";

        //$data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => $request->phone, 'msg' => $message);
        /*$data = "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=BIGDRM&number=".$request->phone."&message=".urlencode($message)."&format=json";

        //$ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
        $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $code_sent = curl_exec($ch);
        curl_close($ch);*/


        $curl = curl_init();

        curl_setopt_array($curl, array( CURLOPT_URL => "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=BIGDRM&number=".$phoneno."&message=".urlencode($message)."&format=json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($response) {
            return response()->json([
                'status' => true
            ]);
        }
        return response()->json([
            'status' => false
        ]);
    }

    public function verifyOtp(Request $request)
    {
        if($request->code){
        $check_coupen  =    DB::table('coupen_code')->where('name',$request->code)->where('expiry',0)->get();
        $data          =    json_decode($check_coupen);
        $coupen_id     =     $data[0]->id;
    }

        $code = Otp::where('code', $request->otp)
        ->where('phone', auth()->user()->phone ?? $request->guest_phone_text)
        ->orderBy('id', 'desc')
        ->first();
        if ($code) {
            if (now()->diffInMinutes($code->created_at) > 10) {
                return response()->json('error');
            }

            return response()->json('success');

        }
        return response()->json('error');
    }

    public function postContact(Request $request)
    {
        $strType = '';
        $strMessage = '';
        /*$this->validate($request, [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'message' => 'required',
            'phone' => 'required'
        ],
        ['name.required' => 'Name is required.','email.required' => 'email is required.','message.required' => 'message is required.','phone.required' => 'phone is required.']);*/
        $contact = new Contact();

        $title = "Contect us";
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $feedback = $request->message;
        $from = config('mail.from.address');
        $from_name = config('mail.from.name');
        $to = $email;
        $emailtoadmin = config('constant.admin_email');

        Mail::to($to)->send(new ContactMail($name, $email, $from, $from_name, $title, $phone, $feedback));

        Mail::to($emailtoadmin)->send(new ContactMail($name, $email, $from, $from_name, $title, $phone, $feedback));
        $msg = '';

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->created_at = Carbon::now();
        $contact->updated_at = Carbon::now();
        $contact->save();
        $strType = 'success';
        $strMessage = 'Thank you for your message. We will get back to you as soon possible';
        return redirect('/contact')->with($strType, $strMessage);


    }

    public function signUp(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'reg_email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|digits_between:10,12',
            'req_password' => 'required|string|min:6',
            'newsletter' => 'nullable|string'
        ], [
            '*.unique' => 'Email Address is already in use',
            'req_password.min' => 'Password Must be atleast 6 characters',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->reg_email,
            'phone' => $request->phone,
            'password' => bcrypt($request->req_password),
            'subcribe_to_newsletter' => ($request->newsletter ?? 'no') != 'no' ? 'yes' : 'no',
        ]);

        auth()->loginUsingId($user->id);
        return redirect()->route('confirm_order');
    }

    public function getStateCity(Request $request)
    {

        //  dd($request->all());
        $pincode = PincodeShipping::where('pincode', $request->pincode)->first();


        if ($pincode) {
            return ["status" => "success", "city" => $pincode->region, 'state' => 'Maharshatra', 'pincode' => $pincode->pincode];
        } else {
            return ["status" => "error", "message" => "Delivery is not available on this pincode"];
        }
        // $api_url = 'http://postalpincode.in/api/pincode/'.$request->pincode;

        // dd(\Curl::to($api_url)->get() ?? '');
        // return \Curl::to($api_url)->get() ?? '';
    }

    public function sendLoginOtp(Request $request)
    {
        $code = rand(1000, 9999);
        $status = Otp::create([
            'code' => $code,
            'phone' => $request->phone,
        ]);

        if ($status) {

            $message = "Dear User, Your OTP for login is ".$code.". Valid for 10 mins. Please do not share this OTP. Regards, Big Dreams Team";

            //$data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => $request->phone, 'msg' => $message);
            /*$data = "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=BIGDRM&number=".$request->phone."&message=".urlencode($message)."&format=json";

            //$ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
            $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $code_sent = curl_exec($ch);
            curl_close($ch);*/


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=BIGDRM&number=".$request->phone."&message=".urlencode($message)."&format=json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            $err = curl_error($curl);
            curl_close($curl);

            return response()->json(['status' => true, 'message' => 'Otp Sent, Please enter the same to login ']);
        }
        return response()->json(['status' => false, 'message' => 'Something went wrong, Please try again later']);
    }
    public function resendLoginOtp(Request $request)
    {
        $code = rand(1000, 9999);
        $deleteotp =Otp::where('phone',$request->phone)->delete();
        if($deleteotp)
        {
            $status = Otp::create([
                'code' => $code,
                'phone' => $request->phone,
            ]);

        }

        if ($status) {
          //  $message = $code . " is your one time password for login at " . env('APP_NAME');
            $message = "Dear User, Your OTP for login is ".$code.". Valid for 10 mins. Please do not share this OTP. Regards, Big Dreams Team";

            //$data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => $request->phone, 'msg' => $message);
            /*$data = "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=BIGDRM&number=".$request->phone."&message=".urlencode($message)."&format=json";

            //$ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
            $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $code_sent = curl_exec($ch);
            curl_close($ch);*/


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=BIGDRM&number=".$request->phone."&message=".urlencode($message)."&format=json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            $err = curl_error($curl);
            curl_close($curl);

            return response()->json(['status' => true, 'message' => 'Otp Sent, Please enter the same to login ']);
        }
        return response()->json(['status' => false, 'message' => 'Something went wrong, Please try again later']);
    }

    public function loginWithOtp(Request $request)
    {
        $status = Otp::where('phone', $request->phone)
        ->where('code', $request->otp)
        ->orderBy('id', 'desc')
        ->first();
        // dd($status);
        if ($status) {
            $user = User::where('phone', $request->phone)->first();
            if ($user) {
                \Auth::loginUsingId($user->id);
            }
            $status->delete();
            return response()->json(['status' => true, 'message' => 'Otp Verified']);
        }
        return response()->json(['status' => false, 'message' => 'Invalid Otp, try again']);
    }

    public function newsletterUnsubcribe($email, $user_id_hash)
    {
        foreach (User::all() as $key => $user) {
            if (\Hash::check($user->id, $user_id_hash)) {
                if ($user->subcribe_to_newsletter == 'yes') {
                    $user->subcribe_to_newsletter = 'no';
                    $user->save();
                    $message = 'You have successfully unsubscribed from our newsletter.';
                } else {
                    $message = 'You have already unsubscribed from our newsletter.';
                }
                return view('website.newsletter_subscription', compact('message'));
            }
        }
        abort(404);
    }

    //razor pay
    public function captureOrder(Request $request)
    {
        $delevery_totaloption = 0;
        /*foreach (\Cart::instance('cart')->content() as $key => $products)
       {
       $delevery_totaloption += $products->options->delevery_charge;
   }*/
   if (cart_grand_total() < 500) {
    $delevery_totaloption = 60;
}

        //updating billing if changed
auth()->user()->billingAddress()->updateOrCreate(
    ['user_id' => auth()->user()->id],
    [
        'contact_person' => $request->contact_person,
        'contact_number' => $request->contact_number,
        'type' => 'billing',
        'is_company' => $request->isCompany ? 1 : 0,
        'gst_no' => $request->gst,
        'pan_no' => $request->pan,
        'tin_no' => $request->tin_no,
        'address_line_0' => $request->address_line_0,
        'address_line_1' => $request->address_line_1,
        'address_line_2' => $request->address_line_2,
        'city' => $request->city,
        'pincode' => $request->pincode,
        'state' => $request->state,
    ]);

        //updating shipping address
if ($request->ship_to_diff_add) {
    auth()->user()->shippingAddress()->updateOrCreate(
        ['user_id' => auth()->user()->id],
        [
            'contact_person' => $request->ship_contact_person,
            'contact_number' => $request->ship_contact_number,
            'type' => 'shipping',
            'is_company' => $request->isCompany ? 1 : 0,
            'gst_no' => $request->gst,
            'pan_no' => $request->pan,
            'tin_no' => $request->tin_no,
            'address_line_0' => $request->ship_address_line_0,
            'address_line_1' => $request->ship_address_line_1,
            'address_line_2' => $request->ship_address_line_2,
            'city' => $request->ship_city,
            'pincode' => $request->ship_pincode,
            'state' => $request->ship_state,
        ]);
}

$products = [];

foreach (Cart::content() as $key => $product) {
    array_push($products, array(
        'id' => $product->id,
        'sku' => $product->options->sku,
        'name' => $product->name,
        'qty' => $product->qty,
        'price' => $product->price,
        'image' => $product->options->image,
        'delivery_charge' => $product->options->delivery_charge,
        'weight' => $product->options->product_weight,

    ));


            //deduct product stock
    $prod = Product::find($product->id);
            // if ($prod) {
            //     $prod->in_stock = intVal($prod->in_stock) - $product->qty;
            //     $prod->save();
            // }
}


if (!$request->retry_payment) {
    $order = auth()->user()->orders()->create([
        'contact_person' => $request->ship_to_diff_add ?
        $request->ship_contact_person : $request->contact_person,
        'contact_number' => $request->ship_to_diff_add ?
        $request->ship_contact_number : $request->contact_number,
        'address_line_0' => $request->ship_to_diff_add ?
        $request->ship_address_line_0 : $request->address_line_0,
        'address_line_1' => $request->ship_to_diff_add ?
        $request->ship_address_line_1 : $request->address_line_1,
        'address_line_2' => $request->ship_to_diff_add ?
        $request->ship_address_line_2 : $request->address_line_2,
        'city' => $request->ship_to_diff_add ? $request->ship_city : $request->city,
        'pincode' => $request->ship_to_diff_add ? $request->ship_pincode : $request->pincode,
        'state' => $request->ship_to_diff_add ? $request->ship_state : $request->state,
        'product_id' => json_encode(array_column($products, 'id')),
        'product_sku' => json_encode(array_column($products, 'sku')),
        'product_qty' => json_encode(array_column($products, 'qty')),
        'product_weight' => json_encode(array_column($products, 'weight')),
        'product_name' => json_encode(array_column($products, 'name')),
        'product_price' => json_encode(array_column($products, 'price')),
        'product_image' => json_encode(array_column($products, 'image')),
        'delevery_charge' => cart_total() > 999 ? 0 : 60,
        'bulk_purchase_discount' => cart_amount_saved(),
        'order_price' => cart_total(),
        'gst' => cart_gst(),
        'total' => cart_total(),
        'payment_method' => 'online',
        'order_total_weight' => order_weight(),
        'delivery_time' => $request->delivery_time ? $request->delivery_time : '03:00 pm - 03:30 pm',
        'order_from' => "app",
    ]);
            // code by nandu for payment table
    $amount = (cart_total() + cart_total() > 999 ? 0 : 60) * 100;

    $tid = time() . rand(111, 999);
    $razorpay_payment = [
        'tid' => $tid,
        'order_id' => $order->id,
        'invoice_no' => '',
        'amount' => $order->total + cart_total() > 999 ? 0 : 60,
        'utr_no' => $request->utr_no ? $request->utr_no : "",
        'rp_payment_method' => $request->payment_method ? $request->payment_method : "",
        'merchant_param1' => $tid,
        'rp_payment_id' => $request->rp_payment_id ? $request->rp_payment_id : "",
        'rp_payment_status' => "captured",
        'invoice_no' => invoiceNo(),
        'method' => 'online',
        'status' => 'paid',
    ];

    $payment = Payment::where('order_id', $order->id)->first();
    if ($payment) {
        $payment->tid = $tid;
        $payment->order_id = $order->id;
        $payment->amount = $order->total + cart_total() > 999 ? 0 : 60;
        $payment->utr_no = $request->utr_no ? $request->utr_no : "";
        $payment->rp_payment_method = $request->payment_method ? $request->payment_method : "";
        $payment->rp_payment_id = $request->rp_payment_id ? $request->rp_payment_id : "";
        $payment->rp_payment_status = "captured";
        $payment->invoice_no = invoiceNo();
        $payment->method = 'online';
        $payment->status = 'paid';
        $payment->save();
    } else {
        $payment = Payment::create([
            'tid' => $tid,
            'order_id' => $order->id,
            'amount' => $order->total + cart_total() > 999 ? 0 : 60,
            'utr_no' => $request->utr_no ? $request->utr_no : "",
            'rp_payment_method' => $request->payment_method ? $request->payment_method : "",
            'rp_payment_id' => $request->rp_payment_id ? $request->rp_payment_id : "",
            'rp_payment_status' => "captured",
            'invoice_no' => invoiceNo(),
            'method' => 'online',
            'status' => 'paid',
        ]);
    }
            // $payment = $order->payment()->updateOrCreate(['order_id'=> $order->id],$razorpay_payment);
    $order->is_paid = 'yes';
    $order->save();
    $payment->invoice_no = invoiceNo();
    Session::put('order_id', $order->order_id);

            // $order->user->notify(
            //     new \App\Notifications\NewOrderPlaceNotification($order)
            // );
            //sms
            /*if ($payment->method == "online") {
                $msg = 'Dear ' . $order->user->name . '.Your order ' . $order->order_id . ' is successfully placed with Online Payment, Thank you for shopping. Team My Upavan';

            } else {
                $msg = 'Dear ' . $order->user->name . '.Your order ' . $order->order_id . ' is successfully placed, Thank you for shopping. Team FARMERCART';

            }


            $data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => $order->user->phone, 'msg' => $msg);
            // Send the POST request with cURL
            $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $code_sent = curl_exec($ch);
            curl_close($ch);*/


            $success    = "15 Days";
            $feedbackno = 9619049996;
        //$message    = "Dear Customer, Kindly note your order will get delivered within {#".$success."#}. Please stay available for the same or if you want to reschedule the delivery, give us a call on {#".$feedbackno."#} -Big Dreams Team";

            $message    =  "Dear Customer, Thank you for choosing us. This message is to confirm your recent order of My Upavan- {#".$order->order_id."#}. This is will get delivered before {#".$success."#}. In case you have any queries kindly connect us on {#".$feedbackno."#} -Big Dreams Team";
            $curl       = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=MYUPVN&number=".$order->user->phone."&message=".urlencode($message)."&format=json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            //mail
            \Mail::to($order->user->email)->send(new OrderPlaceMail($order->user, $order));

            //sms to admin
            /*$message = 'There is new order on farmercart.in of customer name ' . Auth::user()->name . ' order no. ' . $order->order_id;


            $data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => 7715916266, 'msg' => $message);
            // Send the POST request with cURL
            $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $code_sent = curl_exec($ch);
            curl_close($ch);*/
            Cart::destroy();
            // return response()->json(['success'=>true,'url'=> route('order_placed', ['order' => $order ])]);

            return response()->json(['order' => $order]);
        } else {
            // $order = Order::find($request->retry_order);
            return response()->json(['status' => false]);
        }

    }

    public function subscription_store(Request $request){
        exit("here");

    }


    public function getProductWithSku($sku)
    {
        $product = Product::where('sku', $sku)->first();
        if ($product) {
            return response()->json(['success' => true, 'url' => route('product.show', ['category' => $product->category, 'model' => $product->model, 'product' => $product->id])]);

        }
        return response()->json(['error' => 'Product Not Available']);

    }

    public function getThankYouPage(Request $request)
    {

        $order = Order::withoutGlobalScope('paid_orders')->find($request->order_id);

        return view('website.thank_you', compact('order'));
    }


    public function register(Request $request)
    {

        $rules = array(
            'name' => 'required',
            'reg_email' => 'unique:users,email|required',
            'phone' => 'unique:users,phone|required',
            'req_password' => 'required',
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {
            $u = User::where('phone', $request->phone)->get();
            if (count($u) == 0) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->reg_email,
                    'phone' => $request->phone,
                    // 'otp'   => rand(11111,99999);
                    'password' => \Hash::make($request->req_password),]);

                $user = User::where(['email' => $request->reg_email])->select(['id', 'email', 'phone', 'password'])->first();
                // dd($user);
                if ($user != null && \Hash::check($request->req_password, $user->password)) {

                    $data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => $request->phone, 'msg' => 'THANK YOU FOR REGISTERING WITH US.');
                    // Send the POST request with cURL
                    $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $code_sent = curl_exec($ch);
                    curl_close($ch);
                    Auth::loginUsingId($user['id']);
                    return response()->json(['success' => 'successfully done.']);

                    //return redirect()->route('home');
                }
            } else {
                $query = @$_GET['query'];
                $no = Cart::instance('cart')->content()->count();
                if (Auth::user()) {
                    if ($no) {
                        session(['totalcount' => $no]);
                    }
                } else {
                    $no = Cart::instance('cart')->content()->count();
                    session(['totalcount' => $no]);
                }
                $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%VEGETABLE%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
                $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%FRUITS%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
                if ($query) {
                    $product = Product::where('name', $query)->first();
                    if ($product) {
                        $similar_products = $product->similarProducts();
                        return view('website.product-page',
                            compact('product', 'similar_products'));
                    }
                }
                $message = "Sorry Your mobile number is already registered.";
                return view('website.index', compact('freshfruitsproducts', 'freshproducts', 'message'));
            }
        }
    }


    public function newlogin(Request $request)
    {


        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            Auth::login($user_for_auth, true);
            return Redirect::route('admin_home');

        } else {

            return response()->json(['status' => false, 'message' => 'Invalid Otp, try again']);
        }
    }


    public function login_user_by_id($id = '')
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
        }
        $User = new User();
        $Log = new Log();
        $user_for_auth = $User->find($id);
        Auth::login($user_for_auth, true);

        $User->id = AUTH::user()->id;
        $auth_user_role = $User->auth_user_role();
        $rl_title = $auth_user_role[0]->rl_title;

        return Redirect::route('admin_home');

    }


    // public function updaterestoinfo(Request $request){


    //     dd($request);
    //     //  $this->validate($request,[
    //     //     'restaurant_logo' => 'required',
    //     //     'licence_image' => 'required',
    //     //     'restaurant_logo'  => 'required|mimes:pdf,png,jpeg,jpg',
    //     //     'licence_image'  => 'required|mimes:pdf,png,jpeg,jpg',
    //     //     'certificate_image'  => 'required|mimes:pdf,png,jpeg,jpg',
    //     // ]);
    //     // dd($request->hasFile('restaurant_logo'));
    //        $logoFileName = null;

    //         if($request->hasFile('restaurant_logo')){
    //               $logoFileName = time()."_restaurant_".$request->restaurant_logo->getClientOriginalName();

    //               $request->restaurant_logo->storeAs('restaurant', $logoFileName);

    //         }

    //          $licenceFileName = null;

    //         if($request->hasFile('licence_image')){
    //               $licenceFileName = time().'_licence_'.$request->licence_image->getClientOriginalName();
    //               $request->licence_image->storeAs('restaurant', $licenceFileName);

    //         }

    //         $certificateFileName = null;

    //         if($request->hasFile('certificate_image')){
    //               $certificateFileName = time().'_certificate_'.$request->certificate_image->getClientOriginalName();
    //               $request->certificate_image->storeAs('restaurant', $certificateFileName);

    //         }

    //          $id = \Auth::user()->id;


    //         $user = User::where("id",$id)->update([
    //             'restaurant_name' => $request->restaurant_name,
    //             'restaurant_logo' => $logoFileName,
    //             'licence' => $request->licence,
    //             'licence_image' => $licenceFileName,
    //             'certificate_no' => $request->certificate_no,
    //             'certificate_image' => $certificateFileName,
    //             'restaurant_phone' => $request->restaurant_phone,
    //             'owner_name' => $request->owner_name,
    //             'owner_mobile_no' => $request->owner_mobile_no,
    //             'owner_email' => $request->owner_email,
    //             'manager_name' => $request->manager_name,
    //             'manager_mobile_no' => $request->manager_mobile_no,
    //             'gst' => $request->gst,
    //             'restaurant_address' => $request->restaurant_address,
    //             // 'billing_address' => $request->billing_address,
    //             'firstlogin' => 'No',
    //             'usertype' => 'Restaurant',
    //             'address_line_0' => $request->address_line_0,
    //             'address_line_1' => $request->address_line_1,
    //             'address_line_2' => $request->address_line_2,
    //             'pincode' => $request->pincode,
    //             'city' => 'Mumbai',
    //             'state' => 'Maharshatra',
    //         ]);


    // Session::flash('success','Please wait for till admin approval');

    // return redirect()->route('home');

    // }

    public function updaterestoinfo(Request $request)
    {


        // dd($request->all());
        //  $this->validate($request,[
        //     'restaurant_logo' => 'required',
        //     'licence_image' => 'required',
        //     'restaurant_logo'  => 'required|mimes:pdf,png,jpeg,jpg',
        //     'licence_image'  => 'required|mimes:pdf,png,jpeg,jpg',
        //     'certificate_image'  => 'required|mimes:pdf,png,jpeg,jpg',
        // ]);
        // dd($request->hasFile('restaurant_logo'));
        $logoFileName = null;

        if ($request->hasFile('restaurant_logo')) {
            $logoFileName = time() . "_restaurant_" . $request->restaurant_logo->getClientOriginalName();

            $request->restaurant_logo->storeAs('restaurant', $logoFileName);

        }

        $licenceFileName = null;

        if ($request->hasFile('licence_image')) {
            $licenceFileName = time() . '_licence_' . $request->licence_image->getClientOriginalName();
            $request->licence_image->storeAs('restaurant', $licenceFileName);

        }


        $id = \Auth::user()->id;


        $user = User::where("id", $id)->update([
            'restaurant_name' => $request->restaurant_name,
            'restaurant_logo' => $logoFileName,
            'licence_type' => $request->licence_type,

            'licence_image' => $licenceFileName,
            // 'name' => $request->name,
            // 'phone' => $request->phone,
            // 'email' => $request->email,
            // 'gst' => $request->gst,
            // 'billing_address' => $request->billing_address,
            'firstlogin' => 'No',
            'usertype' => 'Restaurant',
            'address_line_0' => $request->address_line_0,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'pincode' => $request->pincode,
            'city' => 'Mumbai',
            'state' => 'Maharshatra',
        ]);


        Session::flash('success', 'Please wait for till admin approval');

        return redirect()->route('home');

    }


    public function captureOrderapi(Request $request)
    {


        $delevery_totaloption = 0;
        /* foreach (\Cart::instance('cart')->content() as $key => $products)
        {
        $delevery_totaloption += $products->options->delevery_charge;
    }*/

        //updating billing if changed
    $user = User::where('user_id', $request->user_id)->first();
        // dd($request);
    DB::table('addresses')->insert(
        ['user_id' => $user->id,
        'contact_person' => $request->contact_person,
        'contact_number' => $request->contact_number,
        'type' => 'billing',
        'is_company' => $request->isCompany ? 1 : 0,
        'gst_no' => 'ABCDEFGH',
        'pan_no' => 'XYZPQR',
        'tin_no' => '1111',
        'address_line_0' => $request->address_line_0,
        'address_line_1' => $request->address_line_1,
        'address_line_2' => $request->address_line_2,
        'city' => $request->city,
        'pincode' => $request->pincode,
        'state' => $request->state,
    ]);

        //updating shipping address
    if ($request->ship_to_diff_add) {
        auth()->user()->shippingAddress()->updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'contact_person' => $request->ship_contact_person,
                'contact_number' => $request->ship_contact_number,
                'type' => 'shipping',
                'is_company' => $request->isCompany ? 1 : 0,
                'gst_no' => 'ABCDEFG',
                'pan_no' => 'XYZPQR',
                'tin_no' => '111111',
                'address_line_0' => $request->ship_address_line_0,
                'address_line_1' => $request->ship_address_line_1,
                'address_line_2' => $request->ship_address_line_2,
                'city' => $request->ship_city,
                'pincode' => $request->ship_pincode,
                'state' => $request->ship_state,
            ]);
    }

    $products = [];

    foreach (Cart::instance('cart')->content() as $key => $product) {
        array_push($products, array(
            'id' => $product->id,
            'sku' => $product->options->sku,
            'name' => $product->name,
            'qty' => $product->qty,
            'price' => $product->price,
            'image' => $product->options->image,
            'delivery_charge' => $product->options->delivery_charge,
            'weight' => $product->options->product_weight,

        ));


            //deduct product stock
        $prod = Product::find($product->id);
            // if ($prod) {
            //     $prod->in_stock = intVal($prod->in_stock) - $product->qty;
            //     $prod->save();
            // }
    }

    $user = auth()->loginUsingId($user->id);
    if (!$request->retry_payment) {
        $order = auth()->user()->orders()->create([
            'contact_person' => $request->ship_to_diff_add ?
            $request->ship_contact_person : $request->contact_person,
            'contact_number' => $request->ship_to_diff_add ?
            $request->ship_contact_number : $request->contact_number,
            'address_line_0' => $request->ship_to_diff_add ?
            $request->ship_address_line_0 : $request->address_line_0,
            'address_line_1' => $request->ship_to_diff_add ?
            $request->ship_address_line_1 : $request->address_line_1,
            'address_line_2' => $request->ship_to_diff_add ?
            $request->ship_address_line_2 : $request->address_line_2,
            'city' => $request->ship_to_diff_add ? $request->ship_city : $request->city,
            'pincode' => $request->ship_to_diff_add ? $request->ship_pincode : $request->pincode,
            'state' => $request->ship_to_diff_add ? $request->ship_state : $request->state,
            'product_id' => json_encode(array_column($products, 'id')),
            'product_sku' => json_encode(array_column($products, 'sku')),
            'product_qty' => json_encode(array_column($products, 'qty')),
            'product_weight' => json_encode(array_column($products, 'weight')),
            'product_name' => json_encode(array_column($products, 'name')),
            'product_price' => json_encode(array_column($products, 'price')),
            'product_image' => json_encode(array_column($products, 'image')),
            'delevery_charge' => $delevery_totaloption,
            'bulk_purchase_discount' => cart_amount_saved(),
            'order_price' => cart_total(),
            'gst' => cart_gst(),
            'total' => cart_grand_total(),
            'payment_method' => 'online',
            'order_total_weight' => order_weight(),
            'order_from' => "app",
        ]);
            // code by nandu for payment table
        $amount = (cart_grand_total() + $delevery_totaloption) * 100;

        $tid = time() . rand(111, 999);
        $razorpay_payment = [
            'tid' => $tid,
            'order_id' => $order->id,
            'invoice_no' => '',
            'amount' => $order->total + $delevery_totaloption,
            'utr_no' => $request->utr_no ? $request->utr_no : "",
            'rp_payment_method' => $request->payment_method ? $request->payment_method : "",
            'merchant_param1' => $tid,
            'rp_payment_id' => $request->rp_payment_id ? $request->rp_payment_id : "",
            'rp_payment_status' => "captured",
            'invoice_no' => invoiceNo(),
            'method' => 'online',
            'status' => 'paid',
        ];

        $payment = Payment::where('order_id', $order->id)->first();
        if ($payment) {
            $payment->tid = $tid;
            $payment->order_id = $order->id;
            $payment->amount = $order->total + $delevery_totaloption;
            $payment->utr_no = $request->utr_no ? $request->utr_no : "";
            $payment->rp_payment_method = $request->payment_method ? $request->payment_method : "";
            $payment->rp_payment_id = $request->rp_payment_id ? $request->rp_payment_id : "";
            $payment->rp_payment_status = "captured";
            $payment->invoice_no = invoiceNo();
            $payment->method = 'online';
            $payment->status = 'paid';
            $payment->save();
        } else {
            $payment = Payment::create([
                'tid' => $tid,
                'order_id' => $order->id,
                'amount' => $order->total + $delevery_totaloption,
                'utr_no' => $request->utr_no ? $request->utr_no : "",
                'rp_payment_method' => $request->payment_method ? $request->payment_method : "",
                'rp_payment_id' => $request->rp_payment_id ? $request->rp_payment_id : "",
                'rp_payment_status' => "captured",
                'invoice_no' => invoiceNo(),
                'method' => 'online',
                'status' => 'paid',
            ]);
        }
            // $payment = $order->payment()->updateOrCreate(['order_id'=> $order->id],$razorpay_payment);
        $order->is_paid = 'yes';
        $order->save();
        $payment->invoice_no = invoiceNo();
            // $order->user->notify(
            //     new \App\Notifications\NewOrderPlaceNotification($order)
            // );
            //sms
        $msg = 'Dear ' . $order->user->name . '.Your order ' . $order->order_id . ' is successfully placed, Thank you for shopping. Team FARMERCART';


        $data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => $order->user->phone, 'msg' => $msg);
            // Send the POST request with cURL
        $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $code_sent = curl_exec($ch);
        curl_close($ch);
            //mail
        \Mail::to($order->user->email)->send(new OrderPlaceMail($order->user, $order));

            //sms to admin
        $message = 'There is new order on farmercart.in of customer name ' . Auth::user()->name . ' order no. ' . $order->order_id;

        $data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => 7715916266, 'msg' => $message);
            // Send the POST request with cURL
        $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');


        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $code_sent = curl_exec($ch);
        curl_close($ch);
        Cart::destroy();
            // return response()->json(['success'=>true,'url'=> route('order_placed', ['order' => $order ])]);

        return response()->json(['order' => $order]);
    } else {
            // $order = Order::find($request->retry_order);
        return response()->json(['status' => false]);
    }

}

public function getsubscribe(Request $request)
{
    $sub = new Subcribe();
    $msg = '';

    $custdata = Subcribe::where('email', $request->email)->get();
    if ($custdata->count() == 0) {
        $sub->email = $request->email;
        $sub->status = 1;
        $sub->created_at = Carbon::now();
        $sub->updated_at = Carbon::now();
        $sub->save();
        /*            $msg = 'Subcription Suceessfully Done.';*/
        return response()->json(['status' => true, 'message' => 'Subcription Suceessfully Done']);


    } else {
        /*            $msg = 'Subcription already exist.';*/
        return response()->json(['status' => false, 'message' => 'Subcription already exist']);


    }
    /*        return response()->json($msg);*/

}


    /*
    *** SUbmit Review
    */
    public function subreview(Request $request){
        //print_r($request->product_id);
        $user_id                =   auth()->user()->id;
        
        $create_date            =   date('Y-m-d');
        $data   =   DB::table('review')->where('product_id',$request->product_id)->where('user_id',$user_id)->get();
        $data   =   json_decode($data);
        
        if(empty($data)){
            $values = array('product_id' => $request->product_id,'user_id' => $user_id,'rating'=>$request->rating_data,'review'=>$request->review,'create_date'=>$create_date);
            $flag   = DB::table('review')->insert($values);
            if($flag){
                return response()->json(['status' => true, 'message' => 'Your review submit successfully']);

            }
            

        }else{
            return response()->json(['status' => false, 'message' => 'you have already give review on this product']);

        }
        

    }

    public function mobilenocheck(Request $request)
    {
        $usernumber = User::select('phone')->where('phone', $request->Mobile)->get();
        $number = User::select('*')->where('phone', $request->Mobile)->get();
        $phonecount = $usernumber->count();

        if ($phonecount > 0) {
            return response()->json(['status' => true, 'message' => $number]);

        } else {
            return response()->json(['status' => false, 'message' => 'User not exist Go for registration.']);

        }
    }

    public function redirect($provider, Request $request)
    {
        \Session::put('action', $request->action);
        return Socialite::driver($provider)->redirect();
    }
    public function Callback($provider)
    {

    }

}
