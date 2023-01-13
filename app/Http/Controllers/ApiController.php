<?php

namespace App\Http\Controllers;

use App\Otp;
use App\User;
use App\Order;
use App\Product;
use App\Payment;
use App\QuesAns;
use App\Contactus;
use App\Category;
use App\ReturnOrder;
use App\CategoriesSeo;
use App\WishlistModel;
use App\ProductAttribute;
use Session;
use Illuminate\Http\Request;
use App\Repository\FilterProduct;
use Softon\Indipay\Facades\Indipay;
use Gloudemans\Shoppingcart\Facades\Cart;
// use App\Repository\BlueDart\ShipToPincode;
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
use DateTime;
use Illuminate\Support\Facades\Log;


function debugLogApi($logdata) {
  date_default_timezone_set('Asia/Kolkata');
  $currentdate = date('Y-m-d H:i:s');
    // $file = "bcard.log";
  $file = "../bcard.log";
  $data = "[".$currentdate."]# ".$logdata."\n";
  file_put_contents($file, $data,FILE_APPEND);
}

class ApiController extends Controller
{
  public function Init_curl_sms($message,$phoneno){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=BIGDRM&number=".$phoneno."&message=".urlencode($message)."&format=json",
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
    Log::info("curl_exec RESPONSe --->".$response);

    $err = curl_error($curl);
    curl_close($curl);

    if ($response) {
      return true;
    }else{
      return false;
    }
  }

  public function slider(){
    $slider=DB::table('slider')->get();
    foreach($slider as $slidervalue){
      $slidervalue->image='https://www.myupavan.com/public/sliderimg/'.$slidervalue->image;
    }
    return response()->json(['status'=>'200','slider'=>$slider]);  
    
  }

  public function profile_details(){
    $users=DB::table('users')->get();
    // foreach($slider as $slidervalue){
    //   $slidervalue->image='https://www.myupavan.com/public/sliderimg/'.$slidervalue->image;
    // }
    return response()->json(['status'=>'200','users'=>$users]);  
    
  }

  protected function register(Request $request){
    $email = $request->email;
    $phone = $request->phone;
    $user = User::where(['email'=>$email])->select(['id', 'email','phone' ,'password'])->first();;
    if($user != null)
    {
      return response()->json(['status'=>'200','exist'=>'1','message'=>'email already registered']);
    }
    $user = User::where(['phone'=>$phone])->select(['id', 'email','phone' ,'password'])->first();;
    if($user != null)
    {
      return response()->json(['status'=>'200','exist'=>'1','message'=>'Number already registered']);           
    }
    $user =  User::create([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => bcrypt($request->password),
      'subcribe_to_newsletter' =>  'yes',
    ]);
    $message = 'Thanks for registering with us.';
    sendMessage($user->phone, $message);
    return response()->json(['status'=>'200','exist'=>'1','message'=>'Thanks for registering with us.','user'=>$user]);  
  }

  public function postLogin(Request $request)
  {
    $email = $request->email;
    $password = $request->password;
    $user = User::where(['email'=>$email])->select(['id', 'email','phone' ,'password'])->first();
    if($user != null &&  Hash::check(  $password ,  $user->password))
    {
      Auth::loginUsingId($user['id']);
      session(['totalcount' => 0]);            
      return response()->json(['status'=>'200','authentcated'=>'1','user'=>$user]);
    }
    else
    {             
      return response()->json(['status'=>'200','authentcated'=>'0']); 
    }               
    if($user === null)
    {
     Session::flash('success','Login Failed! Please Try again');
     return response()->json(['status'=>'200','authentcated'=>'0']);           
   }
 }
 public function Login()
 {
  $email = 'k@gmail.com';
  $password ='123456' ;
  $user = User::where(['email'=>$email])->select(['id', 'email','phone' ,'password'])->first();
  if($user != null &&  Hash::check(  $password ,  $user->password))
  {
    Auth::loginUsingId($user['id']);
    session(['totalcount' => 0]);            
    return response()->json(['status'=>'200','authentcated'=>'1','user'=>$user]);
  }
  else
  {             
    return response()->json(['status'=>'200','authentcated'=>'0']); 
  }               
  if($user === null)
  {
   Session::flash('success','Login Failed! Please Try again');
   return response()->json(['status'=>'200','authentcated'=>'0']);           
 }
}

public function home()
{
  $query = @$_GET['query'];
  $no=Cart::content()->count();
  if(Auth::user())
  {
    if ($no) 
    {
      session(['totalcount' => $no]);         
    }
  }
  else
  {
    $no=Cart::content()->count();
    session(['totalcount' => $no]);   
  }

  // $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%Plants%")->orderBy('updated_at','desc')->offset(0)->limit(10)->get();
  // Log::info($freshproducts);


  // $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%popular 2022%")->orderBy('updated_at','desc')->offset(0)->limit(10)->get()->toArray();

  $freshfruitsproducts = Product::with('featuredImage')->where('home_best_sellers', '1')->orderBy('updated_at', 'asc')->offset(0)->limit(10)->get();

  foreach ($freshfruitsproducts as $key => $proid) {
    $proid->productattributes =ProductAttribute::with('productattributemaster', 'productname')->select('id', 'p_id', 'patt_id', 'text')->where('p_id', $proid->id)->get();
  }


  $freshproducts = Product::with('featuredImage')->where('home_recent_arrivals', '1')->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();


  foreach ($freshproducts as $key => $proid) {
    $proid->productattributes =ProductAttribute::with('productattributemaster', 'productname')->select('id', 'p_id', 'patt_id', 'text')->where('p_id', $proid->id)->get();
  }

  return response()->json(['status'=>200, 'freshfruitsproducts'=>$freshfruitsproducts,'freshproducts'=>$freshproducts]);
}

public function categoryShow(Request $request){
 $valid = Validator::make($request->all(),[
  "f_id" => "required",
]);
 if ($valid->fails()) {
  return response()->json(['status' => 400, 'error' => $valid->errors()]);
} else {

    // echo "I FIF -->".$request->f_id;

  $category = Category::select("*")->get();

    // $getclient = Category::select("*")->Join("leads","clients.id","=","leads.customer_id")->where("sales_person_id","=",$request->uid_id)->get();

    // $products = Product::InStock()->with('featuredImage')->where('category', $category_name)->orderBy('updated_at','desc')->get();
    // $category_seo = CategoriesSeo::where('category_id',$category->id)->get();

  return response()->json(['status'=>200, 'category'=>$category]);

//     if(strpos($category_name, ' ') !== false)
//     {
//        $category_name = str_replace(" ","-",$category_name);
//        return redirect('category/'.$category_name);                  
//    } else {
//             // echo "else me ";
//     $category_name = str_replace("-"," ",$category_name);
//     // $category = Category::where('name', $category_name)->firstOrFail();
//     $category = Category::select("*")->get();
//             // print_r($category);
//     $products = Product::InStock()->with('featuredImage')->where('category', $category_name)->orderBy('updated_at','desc')->get();
//     $category_seo = CategoriesSeo::where('category_id',$category->id)->get();

//     return response()->json(['status'=>200, 'category'=>$category,'category_name'=>$category_name,'products'=>$products,'category_seo'=>$category_seo]);
//            // return view('website.category', compact('category','category_name','products','category_seo'));
// }
}
}
public function removeFromCart(Request $request)
{
  Cart::instance('cart')->remove($request->product_id);
  session(['totalcount' => Cart::instance('cart')->count()]);
  return response()->json(Cart::count());
} 

public function addCart(Request $request){
 foreach (Cart::content() as $key => $cart) 
 {
  if($cart->id == $request->product_id)
  {
                //return back()->with('already_added', 'You already add this product in cart');
   return response()->json(['status'=>204, 'msg'=> 'already add this product in cart' ]);
 }
}
$product = Product::find($request->product_id); 
        // $product=DB::table('products')->where('id',$request->product_id)->first();

if(isset($product)){
  $product = array(
    'id' => $product->id,
    'name'=>$product->name,
    'qty' => $request->product_qty,
    'price' => $product->price_without_gst,
    'options'=>[
      'image' => featuredImage($product),
      'category' => $product->category,
      'model'=> $product->model,
      'sku'=> $product->sku,
      'type'=>$product->type,
      'description'=>$product->description,
      'delevery_charge' => intVal($product->delevery_charge),
      'stock' => intVal($product->in_stock),
      'combo_qty' => json_decode($product->combo_qty),
      'combo_discount' => json_decode($product->combo_discount),
      'product_weight' => $product->product_weight,
      'gst'   => $product->gst ?? 0,

    ]
  );
            // $noOfItems=Cart::instance('cart')->content()->count(); 
            // $noOfItems=Cart::content()->count();
  $noOfItems = session(['totalcount' => $request->product_qty]);
  if($noOfItems > 0 || $noOfItems != null){
    $noOfItems = session(['totalcount' => $noOfItems]); 
    $noOfItems +=  $request->product_qty;

  }else{
    $noOfItems =  $request->product_qty;
  }
  Cart::add($product);

  return response()->json(['status'=>200, 'totalcart'=> $noOfItems ]);
}else{
 return response()->json(['status'=>204, 'msg'=> 'Product not available' ]);
}

} 
public function addToCart(Request $request){
 foreach (Cart::content() as $key => $cart) 
 {
  if($cart->id == $request->product_id)
  {
                //return back()->with('already_added', 'You already add this product in cart');
   return response()->json(['status'=>204, 'msg'=> 'already add this product in cart' ]);
 }
}
$product = Product::find($request->product_id); 
        // $product=DB::table('products')->where('id',$request->product_id)->first();

if(isset($product)){
  $product = array(
    'id' => $product->id,
    'name'=>$product->name,
    'qty' => $request->product_qty,
    'price' => $product->price_without_gst,
    'options'=>[
      'image' => featuredImage($product),
      'category' => $product->category,
      'model'=> $product->model,
      'sku'=> $product->sku,
      'type'=>$product->type,
      'description'=>$product->description,
      'delevery_charge' => intVal($product->delevery_charge),
      'stock' => intVal($product->in_stock),
      'combo_qty' => json_decode($product->combo_qty),
      'combo_discount' => json_decode($product->combo_discount),
      'product_weight' => $product->product_weight,
      'gst'   => $product->gst ?? 0,

    ]
  );
            // $noOfItems=Cart::instance('cart')->content()->count(); 
            // $noOfItems=Cart::content()->count();
  $noOfItems = session(['totalcount' => $request->product_qty]);
  if($noOfItems > 0 || $noOfItems != null){
    $noOfItems = session(['totalcount' => $noOfItems]); 
    $noOfItems +=  $request->product_qty;

  }else{
    $noOfItems =  $request->product_qty;
  }
  Cart::add($product);

  return response()->json(['status'=>200, 'totalcart'=> $noOfItems ]);
}else{
 return response()->json(['status'=>204, 'msg'=> 'Product not available' ]);
}

} 
public function search($q)    
{

  $products = Product::with('featuredImage')->where('name', 'LIKE', "%$q%")->orWhere('alt_name', 'LIKE', "%$q%")->orderBy('updated_at','desc')->get();
     //   return view('website.search_result',compact('q','products'));
  return response()->json(['status'=>200, 'q'=>$q,'products'=>$products]);

}
public function profileUpdate(Request $request)
{

  $user = User::where(['id'=>$request->user_id])->first();

  $user->name = $request->name;
  $user->email = $request->email;
  $user->phone = $request->phone;
  $user->subcribe_to_newsletter = 'yes';

  if ($request->password) {
    $user->password = \Hash::make($request->password);
  }

  $user->save();
  $user = User::where(['email'=>$request->email])->first();

  return response()->json(['status'=>'200','user'=>$user]); 

}

public function get_subcateg_byname(Request $request){

    // debugLogApi("API REQUEST --->".$request."\n");
    // debugLogApi("API REQUEST --->".$request->categ_name);

    // Log::info("else me hoon first".$request);

  $categ_id=0;
  $category='';

  if ($request['categ_name'] == "Plants") {
    $categ_id=19;
  }elseif ($request['categ_name'] == "By Color") {
    $categ_id=18;
  }else{
    $category_name="popular-2022";
  }


  if ($categ_id == 19 || $categ_id == 18) {
    $category = Category::where(['parent_category_id'=>$categ_id])->get();
  }else{

    $category_name=strtolower($category_name);
    $category_name = str_replace("-", " ", $category_name);

    Log::info("first category_name ".$category_name);
    $category_names = Category::where('name',$category_name)->firstOrFail();

    Log::info("else second ".$category_names);

    $category = Product::InStock()->selectRaw('products.id ,products.sell_price,products.name,products.sku,products.model,products.category ,products.product_weight, media.product_id,media.url')->leftjoin('media', 'media.product_id', '=', 'products.id')->where('media.type', 'featured')->Where('category', 'like', '%' . $category_name . '%')->get();

        // $category = Product::InStock()->selectRaw('products.id ,products.sell_price,products.name,products.sku,products.model,products.category ,products.product_weight, media.product_id,media.url')->leftjoin('media', 'media.product_id', '=', 'products.id')->where('media.type', 'featured')->Where('category', 'like', '%' . $category_names . '%')->groupBy('products.id')->orderBy('products.updated_at','desc')->get();


  }

  return response()->json(['status'=>200,'category'=>$category]); 

}

public function get_product_bysubcategname(Request $request, Product $product){
  Log::info($request);
    // $category = Product::where(['category'=>$request['sub_categ_name']])->get();

  $name = $request['sub_categ_name'];
  Log::info("SUB CATEG NAME --->".$name);
    // $products = Product::with('featuredImage')->where('category', 'like', "%{$name}%")->orderBy('updated_at','desc');

  $products = Product::with('featuredImage')->where('category', 'LIKE',"%{$name}%")->orderBy('updated_at','desc')->get();    

  foreach ($products as $key => $proid) {
    $proid->productattributes =ProductAttribute::with('productattributemaster', 'productname')->select('id', 'p_id', 'patt_id', 'text')->where('p_id', $proid->id)->get();
  }


    // Log::info($products->toSql());

    // $products = Product::InStock()->selectRaw('products.id ,products.sell_price,products.name,products.sku,products.model,products.category ,products.product_weight, media.product_id,media.url')->
    // leftjoin('media', 'media.product_id', '=', 'products.id')->
    // where('media.type', 'featured')->
    // where('products.category', $request['sub_categ_name'])->
    // groupBy('products.id')->
    // orderBy('products.updated_at', 'desc')->get();


  return response()->json(['status'=>200,'category'=>$products]); 
}


public function get_prod_by_id_model(Request $request,Product $product){
  Log::info($request);

  $recentarrival = Product::with('featuredImage')->where('home_recent_arrivals', '1')->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();

  // $Product = Product::select("*")->get();

  // $category = DB::table('products')
  // ->join('media', 'media.product_id', 'products.id')
  // ->select('products.sku', 'media.type', 'media.url', 'products.model')
  // ->whereIn('products.sku', $request->sku)
  // ->where('media.type', 'featured')
  // ->get();

  $products = Product::with('featuredImage')->where('id', '=',$request->pid)->get();
  $products->load(['gallerImages']);

  // $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%VEGETABLE%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();

  $products[0]->productattributes =ProductAttribute::with('productattributemaster', 'productname')->select('id', 'p_id', 'patt_id', 'text')->where('p_id', $request->pid)->get();

  $reviewData = DB::table('review')
  ->join('users', 'users.id', 'review.user_id')
  ->select('review.*', 'users.name')
  ->where('review.product_id',$request->pid)
  ->where('review.approve',1)
  ->orderBy('review.id', 'desc')
  ->get();
  $no_review =    count($reviewData);

  $avg_stars = DB::table('review')
  ->where('approve',1)
  ->where('product_id',$request->pid)
  ->avg('rating');

  $percentage     =   $avg_stars*20;    


  return response()->json(['status'=>200,
    'reviewData'=>$reviewData,
    'no_review'=>$no_review,
    'avg_stars'=>$avg_stars,
    'percentage'=>$percentage,
    // 'details'=>$details,
    'product'=>$products[0],
    'recentarrival'=>$recentarrival
  ]); 
}

public function profile(Request $request)
{

  $user = User::where(['id'=>$request->user_id])->first();

        // $orders = auth()->user()->orders->withoutGlobalScope('paid_orders');
  $orders = Order::withoutGlobalScope('paid_orders')->where('user_id',$request->user_id)->get();
  return response()->json(['status'=>'200','user'=>$user,'orders'=>$orders]); 

        //return view('website.home', compact('orders'));
}
public function myorders(Request $request)
{

  $user = User::where(['id'=>$request->user_id])->first();

        // $orders = auth()->user()->orders->withoutGlobalScope('paid_orders');
  $orders = Order::withoutGlobalScope('paid_orders')->where('user_id',$request->user_id)->get();
  return response()->json(['status'=>'200','user'=>$user,'orders'=>$orders]); 

        //return view('website.home', compact('orders'));
}

public function repeateOrder(Request $request)
{
 $order = DB::table('orders')->where(['id'=>$request->order_id])->get();

 $l=  DB::table('orders')->orderBy('id', 'desc')->first();
 $newOrder = clone $order;

 $newOrder['0']->id=($l->id)+1;
 // $newOrder->exists = false;
 /*$newOrder->save();*/


 $user = User::where(['id'=>$request->user_id])->first();

        // $orders = auth()->user()->orders->withoutGlobalScope('paid_orders');
 $orders = Order::withoutGlobalScope('paid_orders')->where('user_id',$request->user_id)->get();
 return response()->json(['status'=>'200','user'=>$user,'orders'=>$orders]); 

}
public function product(Request $request)
{
  $product = Product::with('featuredImage')->where('id',$request->product_id)->get();
     //   return view('website.search_result',compact('q','products'));
  return response()->json(['status'=>200,'product'=>$product]);


}

public function checkout(){
  if (Cart::instance('cart')->count() == 0) {
    return response()->json(['status'=>'200','msg'=>'cart is empty.','cart'=>[]]);

  }
        // dd(Cart::content());
        //check if all cart prd qrt is less than prd qty;
  foreach (Cart::instance('cart')->content() as $key => $cart) {
    $product = Product::find($cart->id);
    if ($product) {
      if (intVal($product->in_stock) < $cart->qty) {
        return response()->json(['status'=>'200','msg'=>'product is in low qty.']);

                   /* return back()->with("stock_error_$product->id",
                   "Low on stock<br>try with ".intVal($product->in_stock)." qty");*/
                 }
               }
             }
             $cart=Cart::instance('cart')->content();


            //  $phoneno = $request->contact_number;
            //  $success    = "15 Days";
            //  $feedbackno = 9619049996;
            //  $message    =  "Dear Customer, Thank you for choosing us. This message is to confirm your recent order of My Upavan- {#".$order->order_id."#}. This is will get delivered before {#".$success."#}. In case you have any queries kindly connect us on {#".$feedbackno."#} -Big Dreams Team";
            //  $curl       = curl_init();
            //  curl_setopt_array($curl, array(
            //   CURLOPT_URL => "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=MYUPVN&number=".$phoneno."&message=".urlencode($message)."&format=json",
            //   CURLOPT_RETURNTRANSFER => true,
            //   CURLOPT_ENCODING => '',
            //   CURLOPT_MAXREDIRS => 10,
            //   CURLOPT_TIMEOUT => 0,
            //   CURLOPT_FOLLOWLOCATION => true,
            //   CURLOPT_SSL_VERIFYPEER => false,
            //   CURLOPT_SSL_VERIFYHOST => false,
            //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //   CURLOPT_CUSTOMREQUEST => 'GET',
            // ));

            //  $response = curl_exec($curl);
            //  curl_close($curl);

             return response()->json(['status'=>'200','msg'=>'cart not empty','cart'=>$cart]);

             /*return view('website.checkout');*/
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
    // old code

/*
  public function sendLoginOtp(Request $request)
    {
        $code = rand(1000, 9999);   
        $status = Otp::create([
            'code' => $code,
            'phone' => $request->phone,
        ]);
        
        if ($status) {

            $message = $code." is your one time password for login at ".env('APP_NAME');
         
           $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>$request->phone,'msg'=>$message);
    // Send the POST request with cURL
        $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $code_sent = curl_exec($ch);
        curl_close($ch);
            return response()->json(['status'=>true,'message' =>'Otp Sent, Please enter the same to login ']);
        }
        return response()->json(['status'=>false,'message' =>'Something went wrong, Please try again later']);
    }  

    */


    public function sendLoginOtp(Request $request)
    {

      $user = User::where('phone', $request->phone)->first();
      if($user){
        $code = rand(1000, 9999);   
        $status = Otp::create([
          'code' => $code,
          'phone' => $request->phone,
        ]);

        if ($status) {

                // $message = $code." is your one time password for login at ".env('APP_NAME');

          $message = "Dear User, Your OTP for login is ".$code.". Valid for 10 mins. Please do not share this OTP. Regards, Big Dreams Team";
        //         $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>$request->phone,'msg'=>$message);
        // // Send the POST request with cURL
        //         $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
        //         curl_setopt($ch, CURLOPT_POST, true);
        //         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //         $code_sent = curl_exec($ch);
        //         curl_close($ch);

          Log::info("SENDING THE SMS --->".$message."  phone -->".$request->phone);
          self::Init_curl_sms($message,$request->phone);


          return response()->json(['status'=>true,'message' =>'Otp Sent, Please enter the same to login ']);
        }

      }

      return response()->json(['status'=>false,'message' =>'Something went wrong, Please try again later']);
    } 


/* public function sendLoginOtp(Request $request){
      $user = User::where('phone', $request->phone)->first();
      if($user){
            return response()->json(['status'=>true,'message' =>'User Authentcated', 'user' => $user ]);

      }else{
        return response()->json(['status'=>false,'message' =>'User not available']);

      }

 }
*/

 public function sendCodOtp(Request $request)
 {
  $code = rand(1000, 9999);   
  $status = Otp::create([
    'code' => $code,
    'phone' => $request->phone,
  ]);

  if ($status) {

    $message = $code." is your one time password for placing Order at ".env('APP_NAME');
            //sendMessage($request->phone, $message);
 //$data = array('username'=>'novasell','password'=>'Novasell@123','senderid'=>'NOVASL','route'=>1,'number'=>$request->phone,'message'=>$message);  
    $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>$request->phone,'msg'=>$message);
    // Send the POST request with cURL
    $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
    // Send the POST request with cURL
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $code_sent = curl_exec($ch);
    curl_close($ch);
    return response()->json(['status'=>true,'message' =>'Otp Sent, Please enter the same to login ']);
  }
  return response()->json(['status'=>false,'message' =>'Something went wrong, Please try again later']);
}

public function VerifyCodOtp(Request $request)
{

  $status = Otp::where('phone',$request->phone)
  ->where('code', $request->otp)
  ->orderBy('id', 'desc')
  ->first();
                    //dd($status);
  if ($status) {

    return response()->json(['status'=>true,'message' =>'Otp Verified']);
  }
  return response()->json(['status'=>false,'message' =>'Invalid Otp, try again']);

}

public function loginWithOtp(Request $request){
  $status = Otp::where('phone',$request->phone)
  ->where('code', $request->otp)
  ->orderBy('id', 'desc')
  ->first();
                    // dd($status);
  if ($status) {
    $user = User::where('phone', $request->phone)->first();
    if ($user) {
      \Auth::loginUsingId($user->id);
    }
            // $status->delete();
    return response()->json(['status'=>true,'message' =>'Otp Verified','user'=>$user]);
  }
  return response()->json(['status'=>false,'message' =>'Invalid Otp, try again']);
}      

public function captureOrder(Request $request)
{

  $delevery_totaloption = 0;
  foreach (\Cart::instance('cart')->content() as $key => $products)
  {
    $delevery_totaloption += $products->options->delevery_charge;
  }

        //updating billing if changed
  DB::table('addresses')->insert(
    ['user_id' => auth()->user()->id],
    [
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

  foreach (Cart::instance('cart')->content() as $key => $product)
  {
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
            // if ($prod) {
            //     $prod->in_stock = intVal($prod->in_stock) - $product->qty;
            //     $prod->save();
            // }
  }


  if(!$request->retry_payment)
  {
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
      'payment_method' => $request->payment_method,
      'order_total_weight' => order_weight(),
      'delivery_time'=>$request->delivery_time,
      'order_from'=>"app", 

    ]);           
                // code by nandu for payment table
    $amount = (cart_grand_total() + $delevery_totaloption) * 100 ;

    $tid = time().rand(111,999);
    $razorpay_payment = [
      'tid' => $tid,
      'order_id' => $order->id,
      'invoice_no' => '',
      'amount' => $order->total +  $delevery_totaloption,
      'utr_no' => $request->utr_no ? $request->utr_no : "",
      'rp_payment_method' => $request->payment_method ? $request->payment_method : "",
      'merchant_param1' => $tid,
      'rp_payment_id'   => $request->rp_payment_id ? $request->rp_payment_id: "",
      'rp_payment_status'  => "captured",
      'invoice_no'         => invoiceNo(),
      'method'             => 'online',
      'status'     => 'paid',
    ];

    $payment = Payment::where('order_id', $order->id)->first();
    if($payment)
    {
      $payment->tid = $tid;
      $payment->order_id = $order->id;
      $payment->amount = $order->total +  $delevery_totaloption;
      $payment->utr_no = $request->utr_no ? $request->utr_no : "";
      $payment->rp_payment_method = $request->payment_method ? $request->payment_method : "";
      $payment->rp_payment_id   = $request->rp_payment_id ? $request->rp_payment_id: "";
      $payment->rp_payment_status  = "captured";
      $payment->invoice_no         = invoiceNo();
      $payment->method             = 'online';
      $payment->status     = 'paid';
      $payment->save();
    }
    else
    {
     $payment= Payment::create([
      'tid' => $tid,
      'order_id' => $order->id,
      'amount' => $order->total +  $delevery_totaloption,
      'utr_no' => $request->utr_no ? $request->utr_no : "",
      'rp_payment_method' => $request->payment_method ? $request->payment_method : "",
      'rp_payment_id'   => $request->rp_payment_id ? $request->rp_payment_id: "",
      'rp_payment_status'  => "captured",
      'invoice_no'         => invoiceNo(),
      'method'             => 'online',
      'status'     => 'paid',
    ]);
   }             
                // $payment = $order->payment()->updateOrCreate(['order_id'=> $order->id],$razorpay_payment);
   $order->is_paid = 'yes';
   $order->payment_method = $request->payment_method ? $request->payment_method : "";
   $order->delivery_time = $request->delivery_time;
   $order->save();
   $payment->invoice_no = invoiceNo();
            // $order->user->notify(
            //     new \App\Notifications\NewOrderPlaceNotification($order)
            // );
             //sms
   $msg='Dear '.$order->user->name.'.Your order '.$order->order_id.' is successfully placed, Thank you for shopping. Team FARMERCART';

   $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>$order->user->phone,'msg'=>$msg);
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
   $message = 'There is new order on farmercart.in of customer name '.Auth::user()->name.' order no. '.$order->order_id;


   $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>7715916266,'msg'=>$message);
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
 }
 else 
 {
            // $order = Order::find($request->retry_order);
   return response()->json(['status' => false]);
 }

}


public function addAddress(Request $request){
  Log::info($request);
    // $bd = new ShipToPincode;

    // if($bd->isShipmentAvailableToPincode($request->pincode) == 'No'){
    //     return response()->json(['status' => false,'msg' => 'Shipping Not Available To This Pincode']);

    //         //  return redirect()->back()->with(['ship_pin_error'=>'Shipping Not Available']);
    // }
  if(isset($request->userid)){
    $user = User::where("id",$request->userid)->update([
      'address_line_0' => $request->apartment,
      'address_line_1' => $request->street,
      'address_line_2' => $request->landmark,
      'pincode' => $request->pincode, 
      'city' => 'Mumbai',
      'state' => 'Maharshatra',
    ]);
    $data= [
      'apartment' => $request->apartment,
      'street' => $request->street,
      'landmark' => $request->landmark,
      'pincode' => $request->pincode, 
      'city' => 'Mumbai',
      'state' => 'Maharshatra',
    ];
    return response()->json(['status' => true,'msg' => 'Successfully updated..!','data' => $data]);
  }else{
    return response()->json(['status' => false,'msg' => 'Something is wrong..!' ]);

  }

} 
public function captureOrderapi(Request $request)
{


  $delevery_totaloption = 0;
            /* foreach (\Cart::instance('cart')->content() as $key => $products)
            {
            $delevery_totaloption += $products->options->delevery_charge;
          }*/

        //updating billing if changed
          /* dd($request->all());*/
          $user = User::where('id',$request->user_id)->first();
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
            DB::table('addresses')->insert(
              ['user_id' => $user->id,
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

          $products =$request->products;

        /*foreach (Cart::instance('cart')->content() as $key => $product)
        {
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
            // if ($prod) {
            //     $prod->in_stock = intVal($prod->in_stock) - $product->qty;
            //     $prod->save();
            // }
          }*/
          $p='';
          $paid='';
          if ($request->payment_method=="cod") {
            $p=NULL;
            $paid='pending';
          }
          else
          {
            $p='online';
            $paid='paid';
          }
          $p1=json_encode(array_column($products,'price'));
          $q1=json_encode(array_column($products,'qty'));

          $p2=json_decode($p1);
          $q2=json_decode($q1);

          $tot=0;
          for($i = 0; $i < count($p2); $i++)
          {
           $tot+=(int)($p2[$i]); 
           $p2[$i]=$p2[$i]/$q2[$i];
         }
         if ($tot<500) {
          $delevery_totaloption=30;
        }

        $user=auth()->loginUsingId($user->id);
        if(!$request->retry_payment)
        {

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
            'product_price' =>json_encode($p2),
            'product_image' => json_encode(array_column($products,'image')),
            'delevery_charge' => $delevery_totaloption,
            'bulk_purchase_discount' => cart_amount_saved(),
            'order_price' => $tot,
            'gst' => 0,
            'total' => $tot,
            'payment_method' => $p,
            'order_total_weight' => order_weight(),
            'delivery_time'=>$request->delivery_time,
            'order_from'=>"app", 

          ]);           
                // code by nandu for payment table
          $amount = (cart_grand_total() + $delevery_totaloption) * 100 ;

          $tid = time().rand(111,999);
          $razorpay_payment = [
            'tid' => $tid,
            'order_id' => $order->id,
            'invoice_no' => '',
            'amount' => $order->total +  $delevery_totaloption,
            'utr_no' => $request->utr_no ? $request->utr_no : "",
            'rp_payment_method' => $request->payment_method ? $request->payment_method : "",
            'merchant_param1' => $tid,
            'rp_payment_id'   => $request->rp_payment_id ? $request->rp_payment_id: "",
            'rp_payment_status'  => "captured",
            'invoice_no'         => invoiceNo(),
            'method'             => $request->payment_method,
            'status'     => $paid,
          ];

          $payment = Payment::where('order_id', $order->id)->first();
          if($payment)
          {
            $payment->tid = $tid;
            $payment->order_id = $order->id;
            $payment->amount = $order->total +  $delevery_totaloption;
            $payment->utr_no = $request->utr_no ? $request->utr_no : "";
            $payment->rp_payment_method = $request->payment_method ? $request->payment_method : "";
            $payment->rp_payment_id   = $request->rp_payment_id ? $request->rp_payment_id: "";
            $payment->rp_payment_status  = "captured";
            $payment->invoice_no         = invoiceNo();
            $payment->method             = 'online';
            $payment->status     = 'paid';
            $payment->save();
          }
          else
          {
           $payment= Payment::create([
            'tid' => $tid,
            'order_id' => $order->id,
            'amount' => $order->total +  $delevery_totaloption,
            'utr_no' => $request->utr_no ? $request->utr_no : "",
            'rp_payment_method' => $request->payment_method ? $request->payment_method : "",
            'rp_payment_id'   => $request->rp_payment_id ? $request->rp_payment_id: "",
            'rp_payment_status'  => "captured",
            'invoice_no'         => invoiceNo(),
            'method'             => $request->payment_method,
            'status'     => $paid,
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
         if ($paid=='pending') {
           $msg='Dear '.$order->user->name.'.Your order '.$order->order_id.' is successfully placed as COD, Thank you for shopping. Team FARMERCART';
         }
         else
         {
           $msg='Dear '.$order->user->name.'.Your order '.$order->order_id.' is successfully placed, Thank you for shopping. Team FARMERCART';
         }



// khurshid commented this

         $success    = "15 Days";
         $feedbackno = 9619049996;
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



    //                  //sms to admin
    //  $message = 'There is new order on farmercart.in of customer name '.Auth::user()->name.' order no. '.$order->order_id;

    //  $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>7715916266,'msg'=>$message);
    // // Send the POST request with cURL
    //  $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');

    //  curl_setopt($ch, CURLOPT_POST, true);
    //  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //  $code_sent = curl_exec($ch);
    //  curl_close($ch);            







         Cart::destroy();
         // return response()->json(['success'=>true,'url'=> route('order_placed', ['order' => $order ])]);

         return response()->json(['order' => $order,'status'=>true]);          
       }
       else 
       {
            // $order = Order::find($request->retry_order);
         return response()->json(['status' => false]);
       }

     }

     public function timeslot()
     {
      $seconds = time();

      $rounded_seconds = ceil($seconds / (30 * 60)) * (30 * 60);

        // echo "Original: " . date('h:i a', $seconds) . "\n";
        // echo "Rounded: " . date('H:i ', $rounded_seconds) . "\n";

      function seconds_from_time($time) {
        list($h, $m) = explode(':', $time);
        return ($h * 3600) + ($m * 60);
      }



      $roundtime = date('H:i', $rounded_seconds);
    // $roundtime = date('H:i',  + 60*60);

    // dump(strtotime($roundtime));


    // dump($roundtime);
    // dd(seconds_from_time($roundtime)+3600);
      $convertedToSecond=seconds_from_time($roundtime)+3600;
    // dump($convertedToSecond);


      function hoursRange( $lower = 32400, $upper = 75600, $step = 1800, $format = '' ) {
        $times = array();
        $i=0;
        if ( empty( $format ) ) {
          $format = 'g:i a';
        }

        foreach ( range( $lower, $upper, $step ) as $key => $increment ) {

          $increment = gmdate( 'H:i', $increment );

          list( $hour, $minutes ) = explode( ':', $increment );

          $date = new DateTime( $hour . ':' . $minutes );

          $times[$i] = $date->format( $format );
          $i++;

        }

        return $times;
      }


      if($convertedToSecond < 79200 && $convertedToSecond > 32400)
      {
       $range = hoursRange( $convertedToSecond , 79200, 60 * 30, 'h:i a' );
     }else
     {
      $range = hoursRange( 32400,79200, 60 * 30, 'h:i a' );

    }
                // dump($range);

    $between=array();
    $arraySize=count($range);

                // foreach($range as $key => $value)
                // {
                //     if($key<$arraySize)
                //     // $between[$key] = $value[$key];
                //     array_push($between,$value[$key]);

                // }
    $i=0;
    for($range;$i<$arraySize-1;$i++){
      array_push($between,$range[$i]. " - ".$range[$i+1]);                 
    }

    return response()->json(['timeslot' => $between,'status'=>true]);          

  }




  public function get_more_categ_name(Request $request){
    $valid = Validator::make($request->all(), [
      "categ_name" => "required"
    ]);

    if ($valid->fails()) {
      return response()->json(['status' => 400, 'error' => $valid->errors()]);
    } else { 
      $freshproducts=array();
      $freshfruitsproducts=array();
      Log::info($request->all());

      if ($request->categ_name =="recent arrivals"){
        $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%Plants%")->orderBy('updated_at','desc')->get();
        if (count($freshproducts) > 0){
          foreach ($freshproducts as $key => $proid) {
            $proid->productattributes =ProductAttribute::with('productattributemaster', 'productname')->select('id', 'p_id', 'patt_id', 'text')->where('p_id', $proid->id)->get();
          }
        }

      }else{
        $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%popular 2022%")->orderBy('updated_at','desc')->get();
        if (count($freshfruitsproducts) > 0){
          foreach ($freshfruitsproducts as $key => $proid) {
          // Log::info($proid);
            $proid->productattributes =ProductAttribute::with('productattributemaster', 'productname')->select('id', 'p_id', 'patt_id', 'text')->where('p_id', $proid->id)->get();
          }
        }
      }

      if ((count($freshproducts) > 0) || (count($freshfruitsproducts) > 0) ) {
        return response()->json(['status' => 200, 'data' => (count($freshproducts) > 0) ? $freshproducts : $freshfruitsproducts ]);
      } else {
        return response()->json(['status' => 400, 'data' => 'No data available']);
      }
    }
  }


  public function popular_2022(Request $request){
    $valid = Validator::make($request->all(), [
      "categ_name" => "required"
    ]);

    if ($valid->fails()) {
      return response()->json(['status' => 400, 'error' => $valid->errors()]);
    } else { 

      $category_name = str_replace("_", " ", $request->categ_name);
      $category = Category::where('name', $category_name)->firstOrFail();


    // $products = Product::InStock()->selectRaw('products.id ,products.sell_price,products.name,products.sku,products.model,products.category ,products.product_weight, media.product_id,media.url')->
    // leftjoin('media', 'media.product_id', '=', 'products.id')->
    // where('media.type', 'featured')->
    // Where('category', 'like', '%' . $category_name . '%')->
    // groupBy('products.id')->
    // orderBy('products.updated_at', 'desc')->get();


      $products = Product::with('featuredImage')->where('category', 'like', '%' . $category_name . '%')->orderBy('updated_at','desc')->get();

      if (count($products) > 0){
        foreach ($products as $key => $proid) {
          $proid->productattributes =ProductAttribute::with('productattributemaster', 'productname')->select('id', 'p_id', 'patt_id', 'text')->where('p_id', $proid->id)->get();
        }
      }


      if (count($products) > 0) {
        return response()->json(['status' => 200, 'data' =>$products]);
      } else {
        return response()->json(['status' => 400, 'data' => 'No data available']);
      }
    }
  }


  public function addtowishlist(Request $request){
    $valid = Validator::make($request->all(), [
      "prod_id" => "required",
      "user_id" => "required"
    ]);

    if ($valid->fails()) {
      return response()->json(['status' => 400, 'error' => $valid->errors()]);
    } else {

      $wishlist = new WishlistModel();
      $wishlist->p_id = $request->prod_id;
      $wishlist->cust_id = $request->user_id;
      $wishlist->created_at = Carbon::now();
      $wishlist->updated_at = Carbon::now();
      $wishlist->save();
      return response()->json(['status' => 200, 'data' => "added to whishlist"]);
    }
  }


  public function search_products(Request $request){
    $valid = Validator::make($request->all(), [
      "search" => "required",
    ]);

    if ($valid->fails()) {
      return response()->json(['status' => 400, 'error' => $valid->errors()]);
    } else {

      $is_product=false;

      $products = Product::with('featuredImage')->where('name', 'LIKE', "%$request->search%")->orWhere('alt_name', 'LIKE', "%$request->search%")->orderBy('updated_at', 'desc')->get();

      if (count($products) > 0){
        $is_product=true;
        $reviewData = DB::table('review')
        ->join('users', 'users.id', 'review.user_id')
        ->select('review.*','users.name')
        ->where('review.product_id',$products[0]->id)
        ->where('review.approve',1)
        ->orderBy('review.id', 'desc')
        ->get();
        $no_review =    count($reviewData);
      }

      if (!$is_product){
        return response()->json(['status' => 200, 'data' => $products
      ]);
      }else{
        return response()->json(['status' => 200, 'data' => $products,
          'reviewData' => $reviewData,'no_review' => $no_review
        ]);
      }
    }
  }


  public function confirmSubs(Request $request){
    $valid = Validator::make($request->all(), [
      "search" => "required",
    ]);

    if ($valid->fails()) {
      return response()->json(['status' => 400, 'error' => $valid->errors()]);
    } else {

      $delevery_total     =   $request->price;
      $pincode            =   DB::table('pincode_shippings')->get();

      return response()->json(['status' => 200, 'pincode' => $pincode, 'delivery_total' => $delevery_total]);
    }
  }

  public function subreview(Request $request){
    $valid = Validator::make($request->all(), [
      "user_id" => "required",
      "product_id" => "required",
    ]);

    if ($valid->fails()) {
      return response()->json(['status' => 400, 'error' => $valid->errors()]);
    } else {

      $user_id=$request->user_id;

      $create_date            =   date('Y-m-d');
      $data   =   DB::table('review')->where('product_id',$request->product_id)->where('user_id',$user_id)->get();
      $data   =   json_decode($data);

      if(empty($data)){
        $values = array('product_id' => $request->product_id,'user_id' => $user_id,'rating'=>$request->rating_data,'review'=>$request->review,'create_date'=>$create_date);
        $flag   = DB::table('review')->insert($values);
        if($flag){
          return response()->json(['status' => 200, 'message' => 'Your review submit successfully']);
        }
      }else{
        return response()->json(['status' => 400, 'message' => 'you have already give review on this product']);
      }
    }
  }

  public function display_my_wishlist(Request $request){
    $valid = Validator::make($request->all(), [
      "user_id" => "required"
    ]);

    if ($valid->fails()) {
      return response()->json(['status' => 400, 'error' => $valid->errors()]);
    } else {

      $cid=$request->user_id;

      $wishlists = Product::selectRaw('products.id ,products.sell_price,products.name,products.sku,products.model,products.category ,products.product_weight,media.product_id,media.url,tbl_wishlist.cust_id')->
      join('tbl_wishlist', 'tbl_wishlist.p_id', '=', 'products.id')->
      join('media', 'media.product_id', '=', 'products.id')->
      where('media.type', 'featured')->
      where('tbl_wishlist.cust_id', $cid)->
      groupBy('products.id')->
      orderBy('products.id', 'desc')->get();



    // $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%popular 2022%")->orderBy('updated_at','desc')->offset(0)->limit(10)->get()->toArray();

      if($wishlists){
        return response()->json(['status' => 200, 'data' =>$wishlists ]);
      }else{
        return response()->json(['status' => 400, 'message' => 'no wishlist present']);
      }


    }
  }


}