<?php
namespace App\Http\Controllers;
//use Excel;
use App\User;
use PDF;
use Cart;
use App\Otp;
use App\Order;
use Cache;
use App\Product;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use App\Http\Requests\OrderPlaceRequest;
use App\ReturnOrder;
use Razorpay\Api\Api;
use  Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use App\Repository\BlueDart\ShipToPincode;
use App\Mail\OrderPlaceMail;
use Session;
use Mail;
use Illuminate\Support\Facades\DB;
use App\Exports\Template_Download;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PurchaseExport;
class OrderController extends Controller
{
    public function getOrderByType($type = 'active')
    {
        if ($type == 'return') {
            $orders = Order::withoutGlobalScope('paid_orders')->with('user')->status($type)->newest()->get();

            return view('admin.order.return_order_request', compact('orders'));
        }
        if ($type != 'active') {
            $orders = Order::withoutGlobalScope('paid_orders')->with('user')->status($type)->newest()->get();
            return view('admin.order.orders', compact('orders'));
        }
        Cache::flush();
        $orders = Order::withoutGlobalScope('paid_orders')->with('user')->activeOrders()->newest()->get();
        $delivery_boy = DB::select('select * from admins where  usertype="DeliveryBoy"');
        return view('admin.order.active_orders', compact('orders', 'delivery_boy'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderPlaceRequest $request)
    {
        // if ($request->coupon_code) {
        //     $coupon_id = DB::table('coupen_code')->where('name', $request->coupon_code)->where('infinite_pro', true)->first();
        //     $coupon_id = DB::table('coupen_code')->where('name', $request->coupon_code)->where('infinite_pro', false)->first();

        //     $coupon_amount_value = $coupon_id->min_amount;
        // }
        $user_id = auth::user()->id;

        $delevery_totaloption = 0;
        \Cart::content();

        $subtotal = str_replace(',', '', \Cart::subtotal());

        if ($subtotal < 999) {
            if ($request->flag_coupen != 0) {
                $delevery_totaloption += 60;
            } else {
                $delevery_totaloption += 60;
            }
        }
        
      
    
    
        if ($request->flag_coupen == 1) {
            $payable_amount  =  $delevery_totaloption + 0;
        } 
        elseif($request->flag_coupen == 2){
            if($request->redeem_code){
            $user_redeem_point=auth::user()->redeem_point;
            $redeem_point=$request->grand_total/100;
            $redeem_ceil=(int)$redeem_point;
            $total_red_point=$redeem_ceil-$request->redeem_code;
            $user_red_poi=  $user_redeem_point-$request->redeem_code;
            $user = Auth::user();
            $user->redeem_point=$user_red_poi;
            $user->save();

            $payable_amount  =  $redeem_point+$delevery_totaloption - $total_red_point;
        }
                // dd('i m here',$payment);

        }
        else {
            $payable_amount  =  cart_total() + $delevery_totaloption;
        }


        if(auth::user()->redeem_point==0){
            $redeem_point=$request->grand_total/100;
            $redeem_ceil=(int)$redeem_point;
            $user = Auth::user();
            $user->redeem_point=$redeem_ceil;
            $user->save();
        }
        else{
            $user_redeem_point=auth::user()->redeem_point;
            $redeem_point=$request->grand_total/100;
            $redeem_ceil=(int)$redeem_point;
            $user_tot_red=$redeem_ceil+$user_redeem_point;
            $user = Auth::user();
            $user->redeem_point=$user_tot_red;
            $user->save();
        }



        if (\Cart::count() == 0) {
            return redirect('account');
        }
        $request->validate([
            'pincode' => 'sometimes|nullable|min:6|max:6',
            'bill_pincode' => 'sometimes|nullable|min:6|max:6',

        ]);
        $bd = 'Yes';
        if ($request->has('pincode') && isset($request->pincode)) {
            if ($bd == 'No') {
                return redirect()->back()->with(['ship_pin_error' => 'Shipping Not Available']);
            }
        } elseif ($request->has('ship_pincode') && isset($request->ship_pincode)) {

            if ($bd == 'No') {

                return redirect()->back()->with(['bill_pin_error' => 'Shipping Not Available']);
            }
        }


        if ($request->payment_method == 'cod') {
            $code = Otp::where('code', $request->otp)
                ->where('phone', auth()->user()->phone)
                ->orderBy('id', 'desc')
                ->first();

            if (!$code) {
                return back()->withInput()->with('otp_error', 'Invalid Otp, Please try again');
            }
            if (now()->diffInMinutes($code->created_at) > 10) {
                return back()->withInput()->with('otp_error', 'Invalid Otp, Please try again');
            }
            $code->delete();
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
                'city' => $request->city ?? 'mumbai',
                'pincode' => $request->pincode,
                'state' => $request->state ?? 'maharashtra',
            ]
        );
        // dd($delevery_totaloption);
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
                ]
            );
        }

        $products = [];
        foreach (\Cart::content() as $key => $product) {
            array_push($products, array(
                'id' => $product->id,
                'sku' => $product->options->sku,
                'name' => $product->name,
                'qty' => $product->qty,
                'weight' => $product->options->product_weight,
                'price' => $product->price,
                'image' => $product->options->image,
                'delivery_charge' => $product->options->delivery_charge,
                'gst'  => $product->options->gst,
            ));
            //deduct product stock
            $prod = Product::find($product->id);
            if ($prod) {
                $prod->in_stock = intVal($prod->in_stock) - $product->qty;
                $prod->save();
            }
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
                'product_gst' => json_encode(array_column($products, 'gst')),
                'product_sku' => json_encode(array_column($products, 'sku')),
                'product_qty' => json_encode(array_column($products, 'qty')),
                'product_weight' => json_encode(array_column($products, 'weight')),
                'product_name' => json_encode(array_column($products, 'name')),
                'product_price' => json_encode(array_column($products, 'price')),
                'product_image' => json_encode(array_column($products, 'image')),
                'coupen_id'     => $request->coupen_id,
                'coupen_apply'  => $request->flag_coupen,
                'pay_amount' => $payable_amount,
                'bulk_purchase_discount' => cart_amount_saved(),
                'order_price' => cart_total(),
                'gst' => cart_gst(),
                'total' => cart_total(),
                'delevery_charge' => cart_total() > 999 ?   0 : 60,
                'order_total_weight' => order_weight(),
                'delivery_time' => $request->delivery_time,
            ]);
            /*   if($order->total < 499)
            {
                $order->delevery_charge=30;
                 $order->save();
            }
            else
            {
             $order->delevery_charge=0; 
              $order->save();  
            }*/
        } else {
            \Cache::flush();

            $order = Order::find($request->retry_order);
        }

        if ($request->payment_method == 'neft') {
            $order->discount = $order->total * 0.01; //1% off
            $order->discount_reason = '1% OFF on UTR Payment';
            $order->save();
        }

        $tid = time() . rand(111, 999);
        $cc_payment = [
            'tid' => $tid,
            'order_id' => $order->id,
            'invoice_no' => '',
            'amount' => $order->total > 999 ?   $order->total : $order->total + 60,
            'utr_no' => $request->utr_no,
            'method' => $request->payment_method,
            'merchant_param1' => $tid,
            'amount' => $order->total,
        ];
        $payment = $order->payment()->updateOrCreate(['order_id' => $order->id], $cc_payment);

        $order->save();
        $payment->invoice_no = invoiceNo();
        $payment->save();

        DB::table('orders')
            ->where('user_id', $user_id);
            // ->update(array('coupon_value' => $coupon_amount_value));


        DB::table('coupen_code')->where('name', $request->coupon_code)->where('infinite_pro', true)->delete();
        DB::table('coupen_code')->where('name', $request->coupon_code)->where('infinite_pro', false)->delete();


        $userupdate = User::where('id', $user_id)->update(['pincode' => $order->pincode, 'address_line_0' => $order->address_line_0, 'address_line_1' => $order->address_line_1, 'address_line_2' => $order->address_line_2, 'city' => $order->city, 'state' => $order->state]);
        Session::put('order_id', $order->order_id);

        /*   $order->user->notify(
            new \App\Notifications\NewOrderPlaceNotification($order)
        );*/
        //sms


        /*        $message='Dear '.$order->user->name.'.Your order '.$order->order_id.' is successfully placed as COD, Thank you for shopping. Team FARMERCART';*/



        /*        $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>$order->user->phone,'msg'=>$message);*/
        // Send the POST request with cURL
        /*$ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $code_sent = curl_exec($ch);
        curl_close($ch);*/


        //mail
        \Mail::to($order->user->email)->send(new OrderPlaceMail($order->user, $order));

        /*        if($request->payment_method == 'cod' || $request->payment_method == 'neft'){
             $message1 = 'There is new order on farmercart.in of customer name '.Auth::user()->name.' order no. '.$order->order_id;
        // sendMessage('8928205265',$message);

        $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>7715916266,'msg'=>$message1);
    // Send the POST request with cURL
        $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $code_sent = curl_exec($ch);
        curl_close($ch);

        }*/
        \Cart::destroy();
        session(['user.cart.total' => 0]);
        //done by sidd
        $phoneno = $request->contact_number;
        // $otp = "0000";
        /*$success = "thank you";
         $message = "Dear User, your order has been successfully completed ".$success.". Valid for 10 mins. Please do not share this OTP. Regards, Big Dreams Team";
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
        ));*/
        $success    = "15 Days";
        $feedbackno = 9619049996;
        //$message    = "Dear Customer, Kindly note your order will get delivered within {#".$success."#}. Please stay available for the same or if you want to reschedule the delivery, give us a call on {#".$feedbackno."#} -Big Dreams Team";

        $message    =  "Dear Customer, Thank you for choosing us. This message is to confirm your recent order of My Upavan- {#" . $order->order_id . "#}. This is will get delivered before {#" . $success . "#}. In case you have any queries kindly connect us on {#" . $feedbackno . "#} -Big Dreams Team";
       
        $curl       = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=MYUPVN&number=" . $phoneno . "&message=" . urlencode($message) . "&format=json",
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

        //end here 
        return view('website.thank_you', compact('order'));
    }

    public function verify_coupen(Request $request)
    {

        /*$check_coupen =    DB::table('coupen_code')->where('name',$request->code)->where('min_amount','<=',$request->grand_total)->where('expiry',0)->get();
        
        
        
        $user_id      = auth::user()->id;
        
        
        
        if(count($check_coupen)>0){
            
            $data         =    json_decode($check_coupen);
            $coupen_id    =     $data[0]->id;
            $order        =    DB::table('orders')->where('coupen_id',$coupen_id)->where('user_id',$user_id)->get();

            if(count($order)>0){
                $response       =   array('status'=>0,'message'=>'You have already use this  coupen code');
            }else{
                $response       =   array('status'=>1,'message'=>'coupen code is successfully applied');

            }   

        }else{
            $response           =   array('status'=>0,'message'=>'Invalid coupen code');
        }
        $response               =   json_encode($response,true);

        print_r($response);*/

        $grand_total            =    $request->grand_total / 100;


        $check_coupen           =    DB::table('coupen_code')->where('name', $request->code)->where('expiry', 0)->get();
        $user_id                =    auth::user()->id;
        $product_match          =    [];

        if (count($check_coupen) > 0) {
            $data         =    json_decode($check_coupen);
            $coupen_id    =     $data[0]->id;
            $order        =    DB::table('orders')->where('coupen_id', $coupen_id)->where('user_id', $user_id)->get();
            if (count($order) > 0) {
                $response        =   array('status' => 0, 'message' => 'You have already use this  coupen code');
            } else {


                foreach (Cart::content() as $key => $product) {


                    $product_coupon     = DB::table('coupen_code')->where('id', $coupen_id)->Where('product', 'like', '%' . $product->id . '%')->get();
                    $infi_product_coupon     = DB::table('coupen_code')->where('id', $coupen_id)->where('infinite_pro', true)->get();
                    if (count($product_coupon) > 0) {
                        $product_match[]  =   1;
                    }

                    if (count($infi_product_coupon) > 0) {
                        $product_match[]  =   1;
                    }
                }

                if (!empty($product_match)) {
                    if ($grand_total <= $data[0]->min_amount) {
                        $grand_total  =     0;
                        $response         =     array('status' => 1, 'message' => 'Coupen is successfully applied', 'grand_total' => $grand_total, 'coupen_id' => $coupen_id);
                        // DB::table('coupen_code')->where('id', $coupen_id)->where('infinite_pro',true)->delete();

                    } else {
                        $response         =     array('status' => 0, 'message' => 'Coupen code is not applicable for this amount');
                    }
                } else {
                    $response         =     array('status' => 0, 'message' => 'Coupen code is not applicable for this product');
                }
            }
        } else {
            $response                   =   array('status' => 0, 'message' => 'Invalid coupen code');
        }
        $response                       =   json_encode($response, true);
        print_r($response);
    }

    public function verify_redeem_points(Request $request)
    {
        $grand_total            =    $request->grand_total / 100;
        $redeem_point            =    $request->redeem_code;
        // $check_redeem_point     =    DB::table('redeem_code')->where('points', $request->redeem_code)->get();
        $user_id                =    auth::user()->id;
        $user_redeem_point      =    auth::user()->redeem_point;

        $product_match          =    [];

       if($user_redeem_point >= $request->redeem_code && $request->redeem_code!=0 && $request->redeem_code>0){
        $grand_total=$grand_total - $request->redeem_code ;
        $response         =     array('status' => 1, 'message' => 'Redeem point is successfully applied', 'grand_total' => $grand_total,'redeem_point'=>$redeem_point);
                // $response        =   array('status' => 0, 'message' => 'You have already use this coupen code');

       }else{
        $response                   =   array('status' => 0, 'message' => 'Please Enter Valid Redeem Point');

       }
        // if (count($check_redeem_point) > 0) {
          
        //     $data         =    json_decode($check_redeem_point);
        //     $redeem_id    =     $data[0]->id;
        //     $order        =    DB::table('orders')->where('redeem_points_id', $redeem_id)->where('user_id', $user_id)->get();
      
        //     if (count($order) > 0) {
        //         $response        =   array('status' => 0, 'message' => 'You have already use this coupen code');
        //     } else {
        //         foreach (Cart::content() as $key => $product) {
        //         $redeem_code     = DB::table('redeem_code')->where('id', $redeem_id)->get();
        //         if (count($redeem_code) > 0) {
        //             $product_match[]  =   1;
        //         }

        
        //         }

        //         if (!empty($product_match)) {
        //             $redeem_code_apply=$data[0]->points	;
        //             if($grand_total>0){
        //                 $grand_total=$grand_total - $redeem_code_apply ;
        //                 $response         =     array('status' => 1, 'message' => 'Coupen is successfully applied', 'grand_total' => $grand_total, 'redeem_point' => $redeem_code_apply,'redeem_id'=> $redeem_id);
        //             }
        //             // if ($grand_total <= $data[0]->min_amount) {
        //             //     $grand_total  =     0;
        //             //     $response         =     array('status' => 1, 'message' => 'Coupen is successfully applied', 'grand_total' => $grand_total, 'coupen_id' => $coupen_id);
        //             //     // DB::table('coupen_code')->where('id', $coupen_id)->where('infinite_pro',true)->delete();

        //             // } 
        //         } 
        //     }
        // } else {
          
        //     $response                   =   array('status' => 0, 'message' => 'Please Enter Valid Point');
        // }
        $response                       =   json_encode($response, true);
        print_r($response);
    }

    public function storeGuest(OrderPlaceRequest $request)
    {
        $delevery_totaloption = 0;
        foreach (\Cart::content() as $key => $products) {
            $delevery_totaloption += $products->options->delevery_charge;
        }

        if (Cart::count() == 0) {
            return redirect()->route('home');
        }

        $request->validate([
            'pincode' => 'sometimes|nullable|min:6|max:6',
            'bill_pincode' => 'sometimes|nullable|min:6|max:6',

        ]);


        $bd = new ShipToPincode;


        if ($request->has('pincode') && isset($request->pincode)) {

            if ($bd->isShipmentAvailableToPincode($request->pincode) == 'No') {

                return redirect()->back()->with(['ship_pin_error' => 'Shipping Not Available']);
            }
        } elseif ($request->has('ship_pincode') && isset($request->ship_pincode)) {

            if ($bd->isShipmentAvailableToPincode($request->bill_pincode) == 'No') {

                return redirect()->back()->with(['bill_pin_error' => 'Shipping Not Available']);
            }
        }


        if ($request->payment_method == 'cod') {
            $code = Otp::where('code', $request->otp)
                ->where('phone', auth()->user()->phone ?? \Session::get('guest_phone_text'))
                ->orderBy('id', 'desc')
                ->first();

            if (!$code) {
                return back()->withInput()->with('otp_error', 'Invalid Otp, Please try again');
            }
            if (now()->diffInMinutes($code->created_at) > 10) {
                return back()->withInput()->with('otp_error', 'Invalid Otp, Please try again');
            }
            $code->delete();
        }
        //updating billing if changed
        // auth()->user()->billingAddress()->updateOrCreate(
        //     ['user_id' => auth()->user()->id],
        //     [
        //     'contact_person' => $request->contact_person,
        //     'contact_number' => $request->contact_number,
        //     'type' => 'billing',
        //     'is_company' => $request->isCompany ? 1 : 0,
        //     'gst_no' => $request->gst,
        //     'pan_no' => $request->pan,
        //     'tin_no' => $request->tin_no,
        //     'address_line_0' => $request->address_line_0,
        //     'address_line_1' => $request->address_line_1,
        //     'address_line_2' => $request->address_line_2,
        //     'city' => $request->city,
        //     'pincode' => $request->pincode,
        //     'state' => $request->state,
        // ]);

        //updating shipping address
        // if ($request->ship_to_diff_add) {
        //     auth()->user()->shippingAddress()->updateOrCreate(
        //         ['user_id' => auth()->user()->id],
        //         [
        //         'contact_person' => $request->ship_contact_person,
        //         'contact_number' => $request->ship_contact_number,
        //         'type' => 'shipping',
        //         'is_company' => $request->isCompany ? 1 : 0,
        //         'gst_no' => $request->gst,
        //         'pan_no' => $request->pan,
        //         'tin_no' => $request->tin_no,
        //         'address_line_0' => $request->ship_address_line_0,
        //         'address_line_1' => $request->ship_address_line_1,
        //         'address_line_2' => $request->ship_address_line_2,
        //         'city' => $request->ship_city,
        //         'pincode' => $request->ship_pincode,
        //         'state' => $request->ship_state,
        //     ]);
        // }

        $products = [];
        foreach (Cart::instance('cart')->content() as $key => $product) {
            array_push($products, array(
                'id' => $product->id,
                'sku' => $product->options->sku,
                'name' => $product->name,
                'qty' => $product->qty,
                'weight' => $product->options->product_weight,
                'price' => $product->price,
                'image' => $product->options->image,
                'delivery_charge' => $product->options->delivery_charge,
                'gst'  => $product->options->gst,
            ));
            //deduct product stock
            $prod = Product::find($product->id);
            if ($prod) {
                $prod->in_stock = intVal($prod->in_stock) - $product->qty;
                $prod->save();
            }
        }
        if (!$request->retry_payment) {
            $order = Order::create([
                'user_id' => null,
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
                'product_gst' => json_encode(array_column($products, 'gst')),
                'product_sku' => json_encode(array_column($products, 'sku')),
                'product_qty' => json_encode(array_column($products, 'qty')),
                'product_weight' => json_encode(array_column($products, 'weight')),
                'product_name' => json_encode(array_column($products, 'name')),
                'product_price' => json_encode(array_column($products, 'price')),
                'product_image' => json_encode(array_column($products, 'image')),
                'bulk_purchase_discount' => cart_amount_saved(),
                'order_price' => cart_total(),
                'gst' => cart_gst(),
                'total' => cart_total(),
                'delevery_charge' => cart_total() > 999 ?   0 : 60,
                'order_total_weight' => order_weight(),
                'payment_method' => 'cod'

            ]);
        } else {
            Cache::flush();

            $order = Order::find($request->retry_order);
        }

        if ($request->payment_method == 'neft') {
            $order->discount = $order->total * 0.01; //1% off
            $order->discount_reason = '1% OFF on UTR Payment';
            $order->save();
        }

        $tid = time() . rand(111, 999);
        $cc_payment = [
            'tid' => $tid,
            'order_id' => $order->id,
            'invoice_no' => '',
            'amount' => $order->total > 999 ?   $order->total : $order->total + 60,
            'utr_no' => $request->utr_no,
            'method' => $request->payment_method,
            'merchant_param1' => $tid,
            'amount' => $order->total,
        ];
        $payment = $order->payment()
            ->updateOrCreate(['order_id' => $order->id], $cc_payment);


        $order->save();
        $payment->invoice_no = invoiceNo();
        $payment->save();

        // $order->user->notify(
        //     new \App\Notifications\NewOrderPlaceNotification($order)
        // );
        //sms

        $url = "http://farmercart.in/get_order/" . $order->order_id;

        $msg = 'Dear ' . $request->contact_person . '.Your order ' . $order->order_id . ' is successfully placed. Check status : ' . $url . '. Team FARMERCART';



        $data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => $request->guest_phone_text, 'msg' => $msg);
        // Send the POST request with cURL
        $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $code_sent = curl_exec($ch);
        curl_close($ch);
        //mail
        // \Mail::to($order->user->email)->send(new OrderPlaceMail($order->user, $order));

        if ($request->payment_method == 'cod' || $request->payment_method == 'neft') {
            $message = 'There is new order on farmercart.in of customer name ' . $request->contact_person . ' order no. ' . $order->order_id;
            /* sendMessage('8928205265',$message);*/



            $data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => 7715916266, 'msg' => $message);
            // Send the POST request with cURL
            $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $code_sent = curl_exec($ch);
            curl_close($ch);
        }
        Cart::destroy();
        return view('website.empty_cart', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function ordercomplete(Request $request)
    {
        cache::flush();
        $o_id = session()->get('order_id');
        if ($o_id == null) {
            $orderdetail = Order::withoutGlobalScopes()->where('order_id', 0)->get();
        } else {
            $orderdetail = Order::withoutGlobalScopes()->where('order_id', session()->get('order_id'))->get();
        }
        return view('website.order', compact('orderdetail'));
    }
    public function show($order)
    {
        $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        $order->load(['user']);
        // dd($order);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function confirmOrder($order)
    {
        Cache::flush();
        $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        $order->status = 'confirm';
        $order->save();
        $qty = json_decode($order->product_qty);
        foreach (json_decode($order->product_id) as $key => $product_id) {
            $product = Product::find($product_id);
            if ($product) {
                if ($qty[$key] > intVal($product->in_stock)) {
                    return $this->rollback_stock($order, $product);
                }
                $product->in_stock = intVal($product->in_stock) - $qty[$key];
                $product->save();
            }
        }
        return back()->withStatus('Order Confirm Successfully')->withTab('new');;
    }

    // rollback stock which was dedcuted
    protected function rollback_stock(Order $order, Product $product)
    {
        $qty = json_decode($order->product_qty);
        foreach (json_decode($order->product_id) as $key => $product_id) {
            $prod = Product::find($product_id);
            if ($prod && $prod->id != $product->id) {
                $prod->in_stock = intVal($prod->in_stock) + $qty[$key];
                $prod->save();
            }
        }
        $order->status = 'processing';
        $order->save();
        return back()->withStatus('Error!!<br>' . $product->name . ' is running out of stock.');
    }

    public function packOrder($order, $qty)
    {
        // dd("Hello");
        $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        $order->status = 'packed';
        $order->packed_box = $qty;

        $order->save();
        /* $message="For Thanking your order is successfully accepted.";
    //    // $data = array('username'=>'novasell','password'=>'Novasell@123','senderid'=>'NOVASL','route'=>1,'number'=>$order->contact_number,'message'=>$message); 
     

        $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>$order->contact_number,'msg'=>$message);
    // Send the POST request with cURL
        $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $code_sent = curl_exec($ch);
        curl_close($ch);*/

        return back()->withStatus('Order Packed Successfully')->withTab('pack');
    }

    public function handoverOrder($order, $qty)
    {
        $qty                            =  0;
        $order                          =  Order::withoutGlobalScope('paid_orders')->find($order);
        $order->status                  = 'registered';
        $order->delivery_boy_id         = $qty;
        $order->save();
        $success    = "15 Days";
        $feedbackno = 9619049996;
        $message    = "Dear Customer, Kindly note your order will get delivered within {#" . $success . "#}. Please stay available for the same or if you want to reschedule the delivery, give us a call on {#" . $feedbackno . "#} -Big Dreams Team";

        //$message    =  "Dear Customer, Thank you for choosing us. This message is to confirm your recent order of My Upavan- {#".$order->order_id."#}. This is will get delivered before {#".$success."#}. In case you have any queries kindly connect us on {#".$feedbackno."#} -Big Dreams Team";
        $curl       = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://mysmsshop.in/V2/http-api.php?apikey=lc82hrEQn77FnGrw&senderid=MYUPVN&number=" . $order->contact_number . "&message=" . urlencode($message) . "&format=json",
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
        return back()->withStatus('Order Assign Successfully')->withTab('registered');
    }

    public function packAll(Request $request)
    {
        Order::withoutGlobalScope('paid_orders')->where('status', 'processing')->update(['status' => 'packed']);
        return back()->withStatus('Orders Packed Successfully')->withTab('pack');
    }

    public function outForDelivery($order)
    {
        $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        $order->status = 'in_transit';
        $order->save();
        /*$message=" Your order is ready for delivery.";
      //  $data = array('username'=>'novasell','password'=>'Novasell@123','senderid'=>'NOVASL','route'=>1,'number'=>$order->contact_number,'message'=>$message); 
       
        $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>$order->contact_number,'msg'=>$message);
    // Send the POST request with cURL
        $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $code_sent = curl_exec($ch);
        curl_close($ch);*/
        return back()->withStatus('Order Moved to out for delivery Successfully')->withTab('registered');
    }

    public function cancelOrder($id)
    {

        $order =  Order::withoutGlobalScope('paid_orders')->find($id);

        $product_id = json_decode($order->product_id, true);

        $product_qty = json_decode($order->product_qty, true);

        foreach ($product_id as $key1 => $value1) {
            $product = Product::find($value1);
            $stock = ((int)$product->in_stock + $product_qty[$key1]);
            $product->in_stock = $stock;
            $product->save();
        }

        $order->status = 'cancelled';
        $order->save();
        return back()->withStatus('Order Cancelled Successfully')->withTab('undelivered');
    }

    public function allToTransit()
    {
        exit("here");
        Cache::flush();
        $or = DB::table('orders')->where('status', 'registered')->get();
        /*foreach ($or as $value) {
        $message=" Your order is ready for delivery.";
      //  $data = array('username'=>'novasell','password'=>'Novasell@123','senderid'=>'NOVASL','route'=>1,'number'=>$value->contact_number,'message'=>$message); 
        $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>$value->contact_number,'msg'=>$message);
    // Send the POST request with cURL
        $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $code_sent = curl_exec($ch);
        curl_close($ch);
        }*/
        Order::withoutGlobalScope('paid_orders')->where('status', 'registered')->update(['status' => 'in_transit']);
        return back()->withStatus('Orders Moved to out for delivery Successfully')->withTab('registered');
    }

    public function pdf($order)
    {
        $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        $order->load(['user', 'payment', 'user.shippingAddress', 'BdOrder']);
        $data = \PDF::loadView('pdf.invoice', compact('order'));
        return $data->stream();
    }

    public function downloadManifest()
    {
        Cache::flush();

        $orders = Order::withoutGlobalScope('paid_orders')->with('BdOrder')->whereHas('BdOrder', function ($query) {
            $query->where('status', 'registered');
        })->get();

        $data = PDF::loadView('pdf.manifest', compact('orders'))
            ->stream();

        dd($data);
    }

    public function refundOnCancel($id)
    {
        Cache::flush();

        $order = Order::withoutGlobalScope('paid_orders')->findOrFail($id);


        $api = new Api('rzp_live_m9yzX3wLfAYFE7', 'vsnXWQKU4mtsI0paen1A7FXV'); //razorpay config

        //refund

        $refund = $api->refund->create(array('payment_id' => $order->payment->rp_payment_id));

        if ($refund) {
            $order->status = 'refund';
            $order->refund_id = $refund->id;
            $order->refund_date = date('Y-m-d', $refund->created_at);
            $order->save();

            //add product stock
            $product_id = json_decode($order->product_id);
            $product_qty = json_decode($order->product_qty);
            $prod = Product::find($product_id[0]);
            if ($prod) {
                $prod->in_stock = intVal($prod->in_stock) + $product_qty[0];
                $prod->save();
            }


            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);

        // After a refund is initiated, it is completed in 5-7 working days. The transaction fee and GST
        //  charged on successful transactions will not be reversed in case of refunds.

        // if($order->BdOrder->exists())
        // {
        //     $order->BdOrder->delete();
        // }
        // if($order->payment->exists())
        // {
        //     $order->payment->delete();
        // }
    }

    public function awbReturnOrder($id)
    {
        $order = ReturnOrder::find($id);

        $data = utf8_decode($order->awb_pdf);

        return response($data)->header('Content-Type', 'application/pdf');
    }

    public function productReceived(Request $request, $id)
    {

        $order = ReturnOrder::find($id);
        $order->is_product_received = 1;
        $order->product_received_date =  Carbon::parse($request->receive_date);
        $order->product_received_remark = $request->receive_ramark;
        $order->save();

        return response()->json(['msg', 'Product Received']);
    }

    public function refundOrder(Request $request, $id)
    {

        if (intVal($request->refund_amount) <= 0) {

            return response()->json(['error' => 'Amount should be greater than zero']);
        }

        $returnOrder =  ReturnOrder::find($id);

        $status = $returnOrder->order->payment->method;


        if ($returnOrder->order->payment->method == 'cod' || $returnOrder->order->payment->method == 'neft') {

            $returnOrder->refund_date = Carbon::parse($request->refund_date);
            $returnOrder->mode_of_refund = $request->refund_mode;
            $returnOrder->refund_amount = $request->refund_amount;
            $returnOrder->refund_remark = $request->refund_remark;
            $returnOrder->order->status = 'refund';
            $returnOrder->order->save();
            $returnOrder->save();

            return response()->json(['msg' => 'Refund Initialed Successfully']);
        } elseif ($returnOrder->order->payment->method == 'online' && isset($returnOrder->order->payment->rp_payment_id) && $returnOrder->order->payment->rp_payment_status == 'captured') {

            $api = new Api('rzp_live_m9yzX3wLfAYFE7', 'vsnXWQKU4mtsI0paen1A7FXV'); //razorpay config

            $rp_payment_id = $returnOrder->order->payment->rp_payment_id;

            $amount = $returnOrder->order->payment->amount;

            $payment = $api->payment->fetch($rp_payment_id);  //fetch payment

            $refund = $payment->refund();  //refund

            $returnOrder->refund_date = Carbon::parse($request->refund_date);
            $returnOrder->mode_of_refund = $request->refund_mode;
            $returnOrder->refund_amount = $request->refund_amount;
            $returnOrder->refund_remark = $request->refund_remark;
            $returnOrder->order->status = 'refund';
            $returnOrder->refund_id = $refund->id;
            $returnOrder->order->save();
            $returnOrder->save();

            return response()->json(['msg' => 'Refund Initialed Successfully']);
        }
    }

    public function orderdelivered(Request $request)
    {

        // dd($request);
        Session::flash('success', 'Successfully delivered thank you.!');
        /*$order=  Order::withoutGlobalScope('paid_orders')->select('id', 'status','contact_number')->find($request->orderid);*/
        $order =  Order::withoutGlobalScope('paid_orders')->find($request->orderid);



        $order->status = 'delivered';
        $order->delivery_feedback = $request->message;
        $order->delivery_date = date("Y-m-d h:i:s");
        if ($order->save()) {
            $message = "Your order has been Successfully delivered. ";
            //  $data = array('username'=>'novasell','password'=>'Novasell@123','senderid'=>'NOVASL','route'=>1,'number'=>$order->contact_number,'message'=>$message); 

            $data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => $order->contact_number, 'msg' => $message);
            // Send the POST request with cURL
            $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $code_sent = curl_exec($ch);
            curl_close($ch);

            Session::put('success', 'Successfully delivered thank you.!');
            return redirect()->route('orderdetails', $request->orderid);
        }
        // else{
        //   Session::put('failed', 'Sorry could not save.!');
        //            return redirect()->route('orderdetails', $request->orderid);
        // }


    }


    public function orderrejection(Request $request)
    {

        // dd($request);
        Session::flash('success', 'Successfully Rejected thank you.!');
        $order =  Order::withoutGlobalScope('paid_orders')->select('id', 'status')->find($request->orderid);

        $order->status = 'return';
        $order->cancelled_reason = $request->message;
        $order->cancelled_at = date("Y-m-d h:i:s");
        if ($order->save()) {
            Session::put('success', 'Successfully Rejected thank you.!');
            return redirect()->route('orderdetails', $request->orderid);
        }
        // else{
        //   Session::put('failed', 'Sorry could not save.!');
        //            return redirect()->route('orderdetails', $request->orderid);
        // }


    }

    public function purchaseorder()
    {

        $orders =  DB::table('orders')->where(['status' => 'processing'])->get();
        // dd($orders);

        return view('admin.reports.purchaseorder', compact('orders'));
    }
    /* public function export()
     {
         $orders =  DB::table('orders')->where(['status'=>'processing'])->get();
          $count=1; $product1=[];  $qty1=[];
                    foreach($orders as $order)
                   {
                    $product=explode('","',$order->product_name);
                    $product[0]=explode('["',$product[0])[1];
                    $product[count($product)-1]=explode('"]',$product[count($product)-1])[0];
                    $qty=explode('","',$order->product_qty);
                    $qty[0]=explode('["',$qty[0])[1];
                    $qty[count($qty)-1]=explode('"]',$qty[count($qty)-1])[0];
                      $product1= array_merge($product1,$product);
                      $qty1= array_merge($qty1,$qty);
                    
                   }
                   
                    $unproduct=array_unique($product1);
                    $unqty=[];
                    foreach ($unproduct as $ukey => $uvalue) 
                    {
                        foreach ($product1 as $pkey => $pvalue) {
                            if($uvalue==$pvalue)
                            {
                                if($ukey==$pkey)
                                {
                                    array_push($unqty, $qty1[$pkey]);
                                }
                                else
                                {
                                   $unqty[$ukey]=$unqty[$ukey]+$qty1[$pkey];
                                }
                            }
                        }
                    } 
            $this->exportPurchaseReport($unqty,$unproduct);
     }*/
    //public function exportPurchaseReport($unqty,$unproduct){
    /*Excel::create('Purchase Report', function($excel) use($unqty,$unproduct) {

            $excel->sheet("Purchase Report", function($sheet) use($unqty,$unproduct) {

                $sheet->mergeCells('A2:C2');
                $sheet->row(2,array('Purchase Order'));

                $sheet->row(4,['Sr No.','Name','Qty']);
                $data = array();
                $count = 1;
                foreach($unproduct as $order)
                {
                    array_push($data,array(
                        $count++,
                        $order,
                        $unqty[$count-2]
                    ));                   
                }
                $sheet->rows($data);
                $sheet->appendRow(array(''));//empty row
                $sheet->setAutoSize(true);
            });
        })->download('xls');*/
    //        return Excel::download(new PurchaseExport, 'purchase.xlsx');
    //}


}
