<?php

namespace App\Http\Controllers;

use App\Otp;
use App\User;
use App\Order;
use App\Product;
use App\Payment;
use App\QuesAns;
use App\Category;
use App\ReturnOrder;
use App\CategoriesSeo;
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
class UserController extends Controller
{
    public function getcart(Request $request)
    {
        return 'test';
    }
    
    public function addToCartnew(Request $request, Product $product)
    {
       /* if ($product->in_stock <= 0) {
            return back()->with('avalability_error', '<small class="text-danger">We are running low on stock for this product, please try again later</small>');
        }*/

        foreach (Cart::content() as $key => $cart) 
        {
            if($cart->id == $product->id)
            {
                //return back()->with('already_added', 'You already add this product in cart');
                return 0;
            }
        }
     
        $product = array(
            'id' => $product->id,
            'name'=>$product->name,
            'qty' => $request->quantity,
            'price' => $product->price_without_gst,
            'options'=>[
                'image' => featuredImage($product),
                'category' => $product->category,
                'model'=> $product->model,
                'sku'=> $product->sku,
                'delevery_charge' => intVal($product->delevery_charge),
                'stock' => intVal($product->in_stock),
                'combo_qty' => json_decode($product->combo_qty),
                'combo_discount' => json_decode($product->combo_discount),
                'product_weight' => $product->product_weight,
                'gst'   => $product->gst ?? 0,
              
            ]
        );
        Cart::add($product);
         $no=Cart::content()->count();
 if(Auth::user())
 {
    if ($no) {
    session(['totalcount' => $no]);         
        }
 }
 else
 {
 $no=Cart::content()->count();
    session(['totalcount' => $no]);   
 }
        //return redirect()->route('user.cart');
        return 1;
    }
     //public function search($q)
     public function search($q)    
    {
       /* $q='Fresho Mixed Capsicum';*/
        $products = Product::with('featuredImage')->where('name', 'LIKE', "%$q%")->orWhere('alt_name', 'LIKE', "%$q%")->orderBy('updated_at','desc')->get();
        // return view('website.search_result', compact('products'));
        return view('website.search_result',compact('q','products'));
    }
    public function catresult($q)
    {
        $cd=explode(' ',$q);
        
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
        $products = Product::with('featuredImage')->where('data', 'LIKE', "%$q%")->orderBy('updated_at','desc')->get();

        return view('website.cat_result',compact('q','products'));
    }


    public function index()
    {
        $query = @$_GET['query'];
        //checking if query is for category
        // $category = Category::where('name', $query)->first();
        // if ($category) {
        // }
        // $parentCategories = parentCategory::all();
        $no=Cart::content()->count();
         if(Auth::user())
         {
            if ($no) {
            session(['totalcount' => $no]);         
                }
         }
         else
         {
         $no=Cart::content()->count();
            session(['totalcount' => $no]);   
         }
        /*dd($no);*/
   
        // $parentCategories = DB::table('parent_categories')->get();
        //if query is for product
        $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%VEGETABLE%")->orderBy('updated_at','desc')->offset(0)->limit(10)->get();
         $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%FRUITS%")->orderBy('updated_at','desc')->offset(0)->limit(10)->get();
        if ($query) {
            $product = Product::where('name', $query)->first();
            if ($product) {
                $similar_products  = $product->similarProducts();
                return view('website.product-page',
                    compact('product', 'similar_products'));
            }
        }
        return view('website.index',compact('freshfruitsproducts','freshproducts'));
    }
  public function allveg()
    {
        $query = @$_GET['query'];       
        $no=Cart::content()->count();
         if(Auth::user())
         {
            if ($no) {       session(['totalcount' => $no]);    }
         }
         else
         {
         $no=Cart::content()->count();
         session(['totalcount' => $no]);   
         }
        $allProducts = Product::with('featuredImage')->all();
        $cat=DB::table('categories')->get();
        $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%VEGETABLE%")->orderBy('updated_at','desc')->offset(0)->limit(10)->get();
         $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%FRUITS%")->orderBy('updated_at','desc')->offset(0)->limit(10)->get();
      
        return view('website.allVegandFruits',compact('freshfruitsproducts','freshproducts','allProducts','cat'));
    }

 public function dynamic()
    {
        $query = @$_GET['query'];
        //checking if query is for category
        // $category = Category::where('name', $query)->first();
        // if ($category) {
        // }
        // $parentCategories = parentCategory::all();
        $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%VEGETABLE%")->orderBy('updated_at','desc')->offset(0)->limit(10)->get();
         $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%FRUITS%")->orderBy('updated_at','desc')->offset(0)->limit(10)->get();
        $no=Cart::content()->count();
         if(Auth::user())
         {
            if ($no) {
            session(['totalcount' => $no]);         
                }
         }
         else
         {
         $no=Cart::content()->count();
            session(['totalcount' => $no]);   
         }
        /*dd($no);*/
   session(['user.cart.total' =>$no]);
        // $parentCategories = DB::table('parent_categories')->get();
        //if query is for product
        if ($query) {
            $product = Product::where('name', $query)->first();
            if ($product) {
                $similar_products  = $product->similarProducts();
                return view('website.product-page',
                    compact('product', 'similar_products','freshfruitsproducts','freshproducts'));
            }
        }
        return view('website.indexdynamic',compact('freshfruitsproducts','freshproducts'));
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
                $similar_products  = $product->similarProducts();
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
        $orders = Order::withoutGlobalScope('paid_orders')->where('user_id',auth()->user()->id)->get();
        return view('website.home', compact('orders'));
    }
        public function home()
    {
        Cache::flush();
        // $orders = auth()->user()->orders->withoutGlobalScope('paid_orders');
        $orders = Order::withoutGlobalScope('paid_orders')->where('user_id',auth()->user()->id)->get();
        return view('website.testlogin', compact('orders'));
    }

    public function getorderbyorder_id($id)
    {
        Cache::flush();
        // $orders = auth()->user()->orders->withoutGlobalScope('paid_orders');
        $order = Order::withoutGlobalScope('paid_orders')->where('order_id',$id)->first();
        return view('website.guest_order_view', compact('order'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3|max:191',
            'email' => 'required|email|min:3|max:191|unique:users,email,'.auth()->user()->id,
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
        $this->validate($request,[
            'contact_person' => 'required|string|min:3|max:191',
            'contact_number' => 'required|digits_between:10,12',
            'address_line_0' => 'required|string|max:30',
            'address_line_1' => 'required|string|max:30',
            'address_line_2' => 'required|string|max:30',
            'pincode' => 'required|digits_between:6,6',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);

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

       return back();
    }

    public function categoryShow($category_name)
    {   
        if(strpos($category_name, ' ') !== false)
        {
           $category_name = str_replace(" ","-",$category_name);
           return redirect('category/'.$category_name);                  
        }
        else
        {
            $category_name = str_replace("-"," ",$category_name);
            $category = Category::where('name', $category_name)->firstOrFail();
            $products = Product::InStock()->where('category', $category_name)->orderBy('updated_at','desc')->get();
            $category_seo = CategoriesSeo::where('category_id',$category->id)->get();
            return view('website.category', compact('category','category_name','products','category_seo'));
        }
    }

public function productShow($category, $model, Product $product)
    {  
        $product->load(['gallerImages','questionAndAnswer','questionAndAnswer.askBy']);
        $similar_products = $product->similarProducts();
        $category=array();   
        if($product['is_variations'])
        {
          $data = json_decode($product->variation_data,true) ?? '';
                        $variant_name = $data['variant_name'] ?? '';
                        $skus         = $data['sku']     ?? '';
         $category=DB::table('products')
                ->join('media','media.product_id','products.id')
                    ->select('products.sku','media.type','media.url','products.model')
                      ->whereIn('products.sku', $skus)  
                     ->where('media.type', 'featured') 
                    ->get();                 
        }      
        return view('website.product-page', compact('product', 'similar_products','category'));
    }

public function productShow1($category, $model, Product $product)
    {
        /*DB::enableQueryLog();*/
        $product->load(['gallerImages','questionAndAnswer','questionAndAnswer.askBy']);
        $similar_products = $product->similarProducts();
        $category=array();     
        if($product['is_variations'])
        {
          $data = json_decode($product->variation_data,true) ?? '';
                        $variant_name = $data['variant_name'] ?? '';
                        $skus         = $data['sku']     ?? '';
                      /*  print_r($skus);*/
         $category=DB::table('products')
                ->join('media','media.product_id','products.id')
                    ->select('products.sku','media.type','media.url','products.model')
                     ->whereIn('products.sku', $skus) 
                     ->where('media.type', 'featured') 
                    ->get();  
                    /*print_r($category);  
                    die(); */           
        }     
       /* $log=DB::getQueryLog();
        dd(end($log)); */
        return view('website.product1', compact('product', 'similar_products','category'));
    }
    public function filterProduct(Request $request)
    {
        $filter = new FilterProduct($request);
        return response()->json($filter->filteredProducts());
    }

    public function addToCart(Request $request, Product $product)
    {
        /*if ($product->in_stock <= 0) {
            return back()->with('avalability_error', '<small class="text-danger">We are running low on stock for this product, please try again later</small>');
        }*/

        foreach (Cart::content() as $key => $cart) 
        {
            if($cart->id == $product->id)
            {
                //return back()->with('already_added', 'You already add this product in cart');
                return 0;
            }
        }
        // dd($cart_details);

        // $bd = new ShipToPincode;
        // $response = $bd->isShipmentAvailableToPincode($request->pincode);

        // if($response != 'Yes') {
        //     return back()->withInput()
        //     ->with('avalability_error', '<small class="text-danger"> Shipping Not Available <i class="fa fa-times"></i></small>');
        // }


        $product = array(
            'id' => $product->id,
            'name'=>$product->name,
            'qty' => 1,
            'price' => $product->price_without_gst,
            'options'=>[
                'image' => featuredImage($product),
                'category' => $product->category,
                'model'=> $product->model,
                'sku'=> $product->sku,
                'delevery_charge' => intVal($product->delevery_charge),
                'stock' => intVal($product->in_stock),
                'combo_qty' => json_decode($product->combo_qty),
                'combo_discount' => json_decode($product->combo_discount),
                'product_weight' => $product->product_weight,
                'gst'   => $product->gst ?? 0,
              
            ]
        );
        Cart::add($product);
        //return redirect()->route('user.cart');
        return 1;
    }


    public function repeatorder($orderid){
      Cache::flush();
        $order = Order::withoutGlobalScope('paid_orders')->where('id',$orderid)->first();
        // if ($product->in_stock <= 0) {
        //     return back()->with('avalability_error', '<small class="text-danger">We are running low on stock for this product, please try again later</small>');
        // }

        $productid = (json_decode($order->product_id));

        // foreach (Cart::content() as $key => $cart) 
        // {
        //     if($cart->id == $product->id)
        //     {
        //         return back()->with('already_added', 'You already add this product in cart');
        //     }
        // }
        $totalProducts = [];
        foreach ($productid as $key => $proid) {
            $product  = Product::find($proid);

            $productDetails = array(
            'id' => $product->id,
            'name'=>$product->name,
            'qty' => 1,
            'price' => $product->price_without_gst,
            'options'=>[
                'image' => featuredImage($product),
                'category' => $product->category,
                'model'=> $product->model,
                'sku'=> $product->sku,
                'delevery_charge' => intVal($product->delevery_charge),
                'stock' => intVal($product->in_stock),
                'combo_qty' => json_decode($product->combo_qty),
                'combo_discount' => json_decode($product->combo_discount),
                'product_weight' => $product->product_weight,
                'gst'   => $product->gst ?? 0,
              
            ]
        );
            array_push($totalProducts , $productDetails);
        }
       
        // dd($totalProducts);

        Cart::add($totalProducts);
        return redirect()->route('user.cart');
    }

        public function buy_now(Request $request, Product $product)
    {
        if ($product->in_stock < 1) 
        {
            return back()->with('avalability_error', '<small class="text-danger">We are running low on stock for this product, please try again later</small>');
        }

        foreach (Cart::content() as $key => $cart) 
        {
            if($cart->id == $product->id)
            {
                return back()->with('already_added', 'You already add this product in cart');
            }
        }

        // $bd = new ShipToPincode;
        // $response = $bd->isShipmentAvailableToPincode($request->pincode);

        // if($response != 'Yes') {
        //     return back()->withInput()
        //     ->with('avalability_error', '<small class="text-danger"> Shipping Not Available <i class="fa fa-times"></i></small>');
        // }


        $product = array(
            'id' => $product->id,
            'name'=>$product->name,
            'qty' => 1,
            'price' => $product->price_without_gst,
            'options'=>[
                'image' => featuredImage($product),
                'category' => $product->category,
                'model'=> $product->model,
                'sku'=> $product->sku,
                'delevery_charge' => intVal($product->delevery_charge),
                'stock' => intVal($product->in_stock),
                'combo_qty' => json_decode($product->combo_qty),
                'combo_discount' => json_decode($product->combo_discount),
                'product_weight' => $product->product_weight,
                'gst'   => $product->gst ?? 0,
              
            ]
        );
        Cart::add($product);
        return redirect()->route('confirmOrderGuest');
    }

    public function userCart()
    {
        $cart_price = [];

        foreach (Cart::content() as $key => $cart) {
            
            $combo_qty = $cart->options->combo_qty ?? [0];
            $combo_dis = $cart->options->combo_discount ?? [0];

            $discount_rate = combo_discount($combo_qty,$combo_dis, $cart->qty);

            $price = $cart->price * $cart->qty - $cart->price * $cart->qty * ($discount_rate/100);
            array_push($cart_price, round($price));
        }
        session(['user.cart.total' => array_sum($cart_price)]);
        $noOfItems=Cart::content()->count();
    /*    dd($noOfItems);*/
        /*session(['user.noOfItems' =>$noOfItems]);*/
    
 session(['totalcount' => $noOfItems]);            

        return view('website.shopping-cart', compact('cart_price'));
    }

    public function updateCart(Request $request)
    {


        Cart::update($request->rowId, $request->qty);

        $cart_price = [];
        foreach (Cart::content() as $key => $cart) {
            $combo_qty = $cart->options->combo_qty ?? [0];
            $combo_dis = $cart->options->combo_discount ?? [0];

            $discount_rate = combo_discount($combo_qty,$combo_dis, $cart->qty);

            $price = $cart->price * $cart->qty - $cart->price * $cart->qty * ($discount_rate/100);
            array_push($cart_price, round($price, 2));
        }
        session(['user.cart.total' => array_sum($cart_price)]);
        return $cart_price;
    }

    public function removeFromCart(Request $request)
    {
        Cart::remove($request->rowId);
        return response()->json(Cart::count());
    }

    public function confirmOrder()
    {
        //print date('H');
$hour = date('H');
        if (Cart::count() == 0) {
            return view('website.empty_cart');
        }
        if ($hour>20) {
            return redirect()->route('user.cart');
        }
        //die();
        // dd(Cart::content());
        //check if all cart prd qrt is less than prd qty;
        $pincode=DB::table('pincode_shippings')->get();
        foreach (Cart::content() as $key => $cart) {
            $product = Product::find($cart->id);
            if ($product) {
                if (intVal($product->in_stock) < $cart->qty) {
                    return back()->with("stock_error_$product->id",
                    "Low on stock<br>try with ".intVal($product->in_stock)." qty");
                }
            }
        }
        return view('website.checkout',compact('pincode'));
    }

        public function confirmOrderGuest()
    {
        if (Cart::count() == 0) {
            return view('website.empty_cart');
        }
        // dd(Cart::content());
        //check if all cart prd qrt is less than prd qty;
        foreach (Cart::content() as $key => $cart) {
            $product = Product::find($cart->id);
            if ($product) {
                if (intVal($product->in_stock) < $cart->qty) {
                    return back()->with("stock_error_$product->id",
                    "Low on stock<br>try with ".intVal($product->in_stock)." qty");
                }
            }
        }

        return view('website.checkout');
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
            $order->user->notify(
                new \App\Notifications\NewOrderPlaceNotification($order)
            );
            return redirect()->route('order_placed', $order);

        } else {

            $payment->status = 'failed';
            $payment->save();

            $message = '';
            if ($response['failure_message']) {
                $message = '<br>'.$response['failure_message'];
            }

            return redirect()->route('checkout')
            ->with('retry_order', $response['order_id'])
            ->with('payment_error','Your last trasaction was incomplete. Please try again!.'.$message);
        }
    }

    public function cancelOrder(Request $request, $order)
    {

        $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        
        if (auth()->user()->can('update', $order)) 
        {

            $product_id = json_decode($order->product_id,true);

            $product_qty = json_decode($order->product_qty,true);

            foreach($product_id as $key1 => $value1)
            {
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

    public function returnOrder(Request $request,Order $order)
    {  
        $this->validate($request,[
            'return_reason' => 'required',
            
        ]);

          
        ReturnOrder::updateOrCreate(['order_id' => $order->id],
            [
            'order_id' => $order->id,
            'reason' => $request->return_reason,
            'bank'     => $request->bank,
            'account_no' => $request->account_no,
            'ifsc_code'  => $request->ifsc_code,
            'mobile'     => $request->mobile,
            'email'      => $request->email,
            'status'     => 'processing',
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
        $answer[]= array(
            'replied_by' => auth()->user()->name,
            'replier_id' => auth()->user()->id,
            'message' => $request->answer,
            'replied_at' => date('d M, Y', strtotime(now()))
        );
        $question = QuesAns::findOrFail($request->reply_to);
        if ($question->answers) {
            $question->answers = $question->answers. '~'. json_encode($answer);
        }else {
            $question->answers = json_encode($answer);
        }
        $question->save();
        return response()->json(true);
    }

    public function wishlist()
    {
        return view ('website.wishlist');
    }

    public function addToWishlist(Request $request, Product $product)
    {
        if ($request->rowId) {
            if (Cart::instance('wishlist')->get($request->rowId)) {
                Cart::instance('wishlist')->remove($request->rowId);
                return;// response()->json(true);
            }
        } else {
            $product = array(
                'id' => $product->id,
                'name'=>$product->name,
                'price' => $product->price_without_gst,
                'qty' =>1,
                'options'=>[
                    'image' => featuredImage($product),
                    'category' => $product->category,
                    'model'=> $product->model,
                    'sku'=> $product->sku,
                    'added_on' => now(),
                    ]
            );
            return Cart::instance('wishlist')->add($product)->rowId;
        }
        return $product;
    }

    public function removeFromWishlist($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        return back();
    }

     public function sendCodOrderOtp(Request $request)
    {
        $otp = rand(1000,9999);
        $message = "Your one time password to place your order  ".env('APP_NAME')." is $otp . This code is valid for 10 minutes. Thank You.";

        Session::put('guest_phone_text', $request->guest_phone_text);
        Session::save();

        Otp::where('phone', auth()->user()->phone ?? $request->guest_phone_text)->delete();

        Otp::create([
            'phone' => auth()->user()->phone ?? $request->guest_phone_text,
            'code' => $otp
        ]);



        // $data = array('username'=>'farmtoresto','password'=>'Farm@123','senderid'=>'FARMTR','route'=>1,'number'=>auth()->user()->phone ?? $request->guest_phone_text,'message'=>$message);
         $data = array('username'=>'novasell','password'=>'Novasell@123','senderid'=>'NOVASL','route'=>1,'number'=>auth()->user()->phone ?? $request->guest_phone_text,'message'=>$message);
 
    // Send the POST request with cURL
    $ch = curl_init('http://smsservice.fourbrothers.co.in/http-api.php');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $code_sent = curl_exec($ch);
    curl_close($ch);

//$code_sent='http://smsservice.fourbrothers.co.in/http-api.php?username=novasell&password=Novasell@123&senderid=NOVASL&route=1&number=9730450492&message=hello there'; 
        //$code_sent = sendMessage(auth()->user()->phone ?? $request->guest_phone_text, $message);
        //$code_sent = sendMessage(9730450492, $otp);

         /*return response()->json([
                'status' => $code_sent
            ]);*/
        if ($code_sent){
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

        
        $code = Otp::where('code', $request->otp)
                    ->where('phone', auth()->user()->phone ?? $request->guest_phone_text)
                    ->orderBy('id', 'desc')
                    ->first();
        if($code){
            if (now()->diffInMinutes($code->created_at) > 10) {
                return response()->json('error');
            }
            return response()->json('success');
        }
        return response()->json('error');
    }

    public function postContact(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'message'=>'required'
        ]);
        \Notification::route('mail','info@novasell.in')
            ->notify(new \App\Notifications\CustomerSupport($request->except('_token')));
        return back()->withStatus('Mail Sent');
    }

    public function signUp(Request $request)
    {
        $this->validate($request,[
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
        $api_url = 'http://postalpincode.in/api/pincode/'.$request->pincode;

        return \Curl::to($api_url)->get() ?? '';
    }

    public function sendLoginOtp(Request $request)
    {
        $code = rand(1000, 9999);   
        $status = Otp::create([
            'code' => $code,
            'phone' => $request->phone,
        ]);
        
        if ($status) {

            $message = $code." is your one time password for login at ".env('APP_NAME');
            //sendMessage($request->phone, $message);
            $data = array('username'=>'novasell','password'=>'Novasell@123','senderid'=>'NOVASL','route'=>1,'number'=>$request->phone,'message'=>$message); 

            return response()->json(['status'=>true,'message' =>'Otp Sent, Please enter the same to login ']);
        }
        return response()->json(['status'=>false,'message' =>'Something went wrong, Please try again later']);
    }

    public function loginWithOtp(Request $request)
    {
        $status = Otp::where('phone',$request->phone)
                    ->where('code', $request->otp)
                    ->orderBy('id', 'desc')
                    ->first();
        if ($status) {
            $user = User::where('phone', $request->phone)->first();
            if ($user) {
                \Auth::loginUsingId($user->id);
            }
            $status->delete();
            return response()->json(['status'=>true,'message' =>'Otp Verified']);
        }
        return response()->json(['status'=>false,'message' =>'Invalid Otp, try again']);
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
                return view ('website.newsletter_subscription', compact('message'));
            }
        }
        abort(404);
    }

    //razor pay
    public function captureOrder(Request $request)
    {
            $delevery_totaloption = 0;
             foreach (\Cart::content() as $key => $products)
            {
            $delevery_totaloption += $products->options->delevery_charge;
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
        
        foreach (Cart::content() as $key => $product){
            array_push($products, array(
                'id' => $product->id,
                'sku' => $product->options->sku,
                'name' => $product->name,
                'qty' => $product->qty,
                'price' => $product->price,
                'image'=> $product->options->image,
                'delivery_charge'=> $product->options->delivery_charge,
                'weight'         => $product->options->product_weight,

            ));
           
           
            //deduct product stock
            $prod = Product::find($product->id);
            if ($prod) {
                $prod->in_stock = intVal($prod->in_stock) - $product->qty;
                $prod->save();
            }
        }
       

        if(!$request->retry_payment){

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
                'product_id' => json_encode(array_column($products,'id')),
                'product_sku' => json_encode(array_column($products,'sku')),
                'product_qty' => json_encode(array_column($products,'qty')),
                'product_weight' => json_encode(array_column($products,'weight')),
                'product_name' => json_encode(array_column($products,'name')),
                'product_price' => json_encode(array_column($products,'price')),
                'product_image' => json_encode(array_column($products,'image')),
                'delevery_charge' => $delevery_totaloption,
                'bulk_purchase_discount' => cart_amount_saved(),
                'order_price' => cart_total(),
                'gst' => cart_gst(),
                'total' => cart_grand_total(),
                'order_total_weight' => order_weight(),

            ]);
          
        }else {
            $order = Order::find($request->retry_order);
        }

          $amount = (cart_grand_total() + $delevery_totaloption) * 100 ;

         
        $api = new Api('rzp_live_2lc8DI76YEjgcA', 'U20zruKEtTGOvwdsIKmWQEmP'); //test razorpay config

        // capture payment
        $api->payment->fetch($request->rp_payment_id)->capture(array('amount'=>$amount));
        $payment = $api->payment->fetch($request->rp_payment_id);
        $tid = time().rand(111,999);
        $razorpay_payment = [
            'tid' => $tid,
            'order_id' => $order->id,
            'invoice_no' => '',
            'amount' => $order->total +  $delevery_totaloption,
            'utr_no' => $request->utr_no,
            'rp_payment_method' => $payment->method,
            'merchant_param1' => $tid,
            'rp_payment_id'   => $payment->id,
            'rp_payment_status'  => $payment->status,
            'invoice_no'         => invoiceNo(),
            'method'             => 'online',
            'status'     => 'paid',
        ];
        $payment = $order->payment()
                    ->updateOrCreate(['order_id'=> $order->id],$razorpay_payment);

        $order->is_paid = 'yes';
        $order->save();
        $payment->invoice_no = invoiceNo();
       

        $order->user->notify(
            new \App\Notifications\NewOrderPlaceNotification($order)
        );

         //sms
        sendMessage($order->user->phone, 'Dear '.$order->user->name.'.Your order '.$order->order_id.' is successfully placed, Thank you for shopping. Team Novasell');

        //mail
         \Mail::to($order->user->email)->send(new OrderPlaceMail($order->user, $order));

         //sms to admin
        $message = 'There is new order on novasell.in of customer name '.Auth::user()->name.' order no. '.$order->order_id;
         sendMessage('8928205265',$message);

        Cart::destroy();
         // return response()->json(['success'=>true,'url'=> route('order_placed', ['order' => $order ])]);

            return response()->json(['order' => $order]);

    }


    public function getProductWithSku($sku)
    {
        $product = Product::where('sku',$sku)->first();
        if($product)
        {
            return response()->json(['success'=>true,'url'=> route('product.show', ['category'=> $product->category,'model' =>$product->model, 'product' => $product->id ])]);

        }
        return response()->json(['error'=>'Product Not Available']);
       
    }

    public function getThankYouPage(Request $request){


        $order = Order::withoutGlobalScope('paid_orders')->find($request->order_id);

        return view('website.thank_you',compact('order'));
    }


    public function register(Request $request){

        // dd($request);
          $user = User::create([
               'name' =>  $request->name,
               'email' =>  $request->reg_email,
               'phone' =>  $request->phone,
               'password' =>  \Hash::make($request->req_password),
          ]);

            $user = User::where(['email'=>$request->reg_email])->select(['id', 'email','phone' ,'password'])->first();

            if($user != null &&  \Hash::check( $request->req_password,  $user->password))
            {
            
             Auth::loginUsingId($user['id']);
                 
              return redirect()->route('home');

            }

    }


    public function newlogin(Request $request){
        
     
            $user = User::where('phone', $request->phone)->first();
           
            if ($user) {
                Auth::login($user_for_auth, true);
                 return Redirect::route('admin_home');
               
            }else{
                 
                 return response()->json(['status'=>false,'message' =>'Invalid Otp, try again']);
            }
        }


        public function login_user_by_id($id=''){
            if(isset($_GET['id'])&&!empty($_GET['id'])){
                $id = $_GET['id'];
            }
            $User = new User();
            $Log=new Log();
            $user_for_auth = $User->find($id);
            Auth::login($user_for_auth, true);

            $User->id=AUTH::user()->id;
            $auth_user_role=$User->auth_user_role();
            $rl_title=$auth_user_role[0]->rl_title;

            return Redirect::route('admin_home');

        }


        public function updaterestoinfo(Request $request){


            // dd($request);
            //  $this->validate($request,[
            //     'restaurant_logo' => 'required',
            //     'licence_image' => 'required',
            //     'restaurant_logo'  => 'required|mimes:pdf,png,jpeg,jpg',
            //     'licence_image'  => 'required|mimes:pdf,png,jpeg,jpg',
            //     'certificate_image'  => 'required|mimes:pdf,png,jpeg,jpg',
            // ]);
            // dd($request->hasFile('restaurant_logo'));
               $logoFileName = null;

                if($request->hasFile('restaurant_logo')){
                      $logoFileName = time()."_restaurant_".$request->restaurant_logo->getClientOriginalName();
                    
                      $request->restaurant_logo->storeAs('restaurant', $logoFileName);

                }

                 $licenceFileName = null;

                if($request->hasFile('licence_image')){
                      $licenceFileName = time().'_licence_'.$request->licence_image->getClientOriginalName();
                      $request->licence_image->storeAs('restaurant', $licenceFileName);

                }

                $certificateFileName = null;

                if($request->hasFile('certificate_image')){
                      $certificateFileName = time().'_certificate_'.$request->certificate_image->getClientOriginalName();
                      $request->certificate_image->storeAs('restaurant', $certificateFileName);

                }

                 $id = \Auth::user()->id;


                $user = User::where("id",$id)->update([
                    'restaurant_name' => $request->restaurant_name,
                    'restaurant_logo' => $logoFileName,
                    'licence' => $request->licence,
                    'licence_image' => $licenceFileName,
                    'certificate_no' => $request->certificate_no,
                    'certificate_image' => $certificateFileName,
                    'restaurant_phone' => $request->restaurant_phone,
                    'owner_name' => $request->owner_name,
                    'owner_mobile_no' => $request->owner_mobile_no,
                    'owner_email' => $request->owner_email,
                    'manager_name' => $request->manager_name,
                    'manager_mobile_no' => $request->manager_mobile_no,
                    'gst' => $request->gst,
                    'restaurant_address' => $request->restaurant_address,
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


           
        Session::flash('success','Please wait for till admin approval');

        return redirect()->route('home');

        }


        
}
