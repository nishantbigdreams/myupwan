<?php

namespace App\Http\Controllers;

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




class OrderController extends Controller
{

    public function getOrderByType($type = 'active')
    {
        if($type == 'return')
        {
           $orders = Order::withoutGlobalScope('paid_orders')->with('user')->status($type)->newest()->get();

           return view ('admin.order.return_order_request',compact('orders'));
        }
        if ($type != 'active') {
            $orders = Order::withoutGlobalScope('paid_orders')->with('user')->status($type)->newest()->get();
            return view ('admin.order.orders', compact('orders'));
        }

        Cache::flush();

        $orders = Order::withoutGlobalScope('paid_orders')->with('user')->activeOrders()->newest()->get();
        return view ('admin.order.active_orders',compact('orders'));
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
        $delevery_totaloption = 0;
             foreach (\Cart::content() as $key => $products)
            {
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


        if($request->has('pincode') && isset($request->pincode))
        {

            if($bd->isShipmentAvailableToPincode($request->pincode) == 'No')
            {

              return redirect()->back()->with(['ship_pin_error'=>'Shipping Not Available']);
            }
        }
        elseif($request->has('ship_pincode') && isset($request->ship_pincode))
        {
    
            if($bd->isShipmentAvailableToPincode($request->bill_pincode) == 'No')
            {

              return redirect()->back()->with(['bill_pin_error'=>'Shipping Not Available']);
            }
        }


        if ($request->payment_method == 'cod') {
            $code = Otp::where('code', $request->otp)
                        ->where('phone', auth()->user()->phone)
                        ->orderBy('id', 'desc')
                        ->first();

            if (!$code) {
                return back()->withInput()->with('otp_error','Invalid Otp, Please try again');
            }
            if (now()->diffInMinutes($code->created_at) > 10) {
                return back()->withInput()->with('otp_error','Invalid Otp, Please try again');
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
                'weight' => $product->options->product_weight,
                'price' => $product->price,
                'image'=> $product->options->image,
                'delivery_charge'=> $product->options->delivery_charge,
                'gst'  => $product->options->gst,
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
                'product_gst' => json_encode(array_column($products,'gst')),
                'product_sku' => json_encode(array_column($products,'sku')),
                'product_qty' => json_encode(array_column($products,'qty')),
                'product_weight' => json_encode(array_column($products,'weight')),
                'product_name' => json_encode(array_column($products,'name')),
                'product_price' => json_encode(array_column($products,'price')),
                'product_image' => json_encode(array_column($products,'image')),
                'bulk_purchase_discount' => cart_amount_saved(),
                'order_price' => cart_total(),
                'gst' => cart_gst(),
                'total' => cart_grand_total(),
                'delevery_charge' => $delevery_totaloption,
                'order_total_weight' => order_weight(),

            ]);
        }else {
                    Cache::flush();

            $order = Order::find($request->retry_order);
        }

               if ($request->payment_method == 'neft') {
            $order->discount = $order->total * 0.01;//1% off
            $order->discount_reason = '1% OFF on UTR Payment';
            $order->save();
        }

        $tid = time().rand(111,999);
        $cc_payment = [
            'tid' => $tid,
            'order_id' => $order->id,
            'invoice_no' => '',
            'amount' => $order->total,
            'utr_no' => $request->utr_no,
            'method' => $request->payment_method,
            'merchant_param1' => $tid,
            'amount' => $order->total,
        ];
        $payment = $order->payment()
                    ->updateOrCreate(['order_id'=> $order->id],$cc_payment);


        $order->save();
        $payment->invoice_no = invoiceNo();
        $payment->save();

        $order->user->notify(
            new \App\Notifications\NewOrderPlaceNotification($order)
        );
        //sms

        
        sendMessage($order->user->phone, 'Dear '.$order->user->name.'.Your order '.$order->order_id.' is successfully placed, Thank you for shopping. Team Novasell');

        //mail
         \Mail::to($order->user->email)->send(new OrderPlaceMail($order->user, $order));

                if($request->payment_method == 'cod' || $request->payment_method == 'neft'){
             $message = 'There is new order on novasell.in of customer name '.Auth::user()->name.' order no. '.$order->order_id;
         sendMessage('8928205265',$message);
        }
        Cart::destroy();
        return view('website.empty_cart',compact('order'));

    }

        public function storeGuest(OrderPlaceRequest $request)
    {
        $delevery_totaloption = 0;
             foreach (\Cart::content() as $key => $products)
            {
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


        if($request->has('pincode') && isset($request->pincode))
        {

            if($bd->isShipmentAvailableToPincode($request->pincode) == 'No')
            {

              return redirect()->back()->with(['ship_pin_error'=>'Shipping Not Available']);
            }
        }
        elseif($request->has('ship_pincode') && isset($request->ship_pincode))
        {
    
            if($bd->isShipmentAvailableToPincode($request->bill_pincode) == 'No')
            {

              return redirect()->back()->with(['bill_pin_error'=>'Shipping Not Available']);
            }
        }


        if ($request->payment_method == 'cod') {
            $code = Otp::where('code', $request->otp)
                        ->where('phone', auth()->user()->phone ?? \Session::get('guest_phone_text'))
                        ->orderBy('id', 'desc')
                        ->first();

            if (!$code) {
                return back()->withInput()->with('otp_error','Invalid Otp, Please try again');
            }
            if (now()->diffInMinutes($code->created_at) > 10) {
                return back()->withInput()->with('otp_error','Invalid Otp, Please try again');
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
        foreach (Cart::content() as $key => $product){
            array_push($products, array(
                'id' => $product->id,
                'sku' => $product->options->sku,
                'name' => $product->name,
                'qty' => $product->qty,
                'weight' => $product->options->product_weight,
                'price' => $product->price,
                'image'=> $product->options->image,
                'delivery_charge'=> $product->options->delivery_charge,
                'gst'  => $product->options->gst,
            ));
            //deduct product stock
            $prod = Product::find($product->id);
            if ($prod) {
                $prod->in_stock = intVal($prod->in_stock) - $product->qty;
                $prod->save();
            }
        }
        if(!$request->retry_payment){
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
                'product_id' => json_encode(array_column($products,'id')),
                'product_gst' => json_encode(array_column($products,'gst')),
                'product_sku' => json_encode(array_column($products,'sku')),
                'product_qty' => json_encode(array_column($products,'qty')),
                'product_weight' => json_encode(array_column($products,'weight')),
                'product_name' => json_encode(array_column($products,'name')),
                'product_price' => json_encode(array_column($products,'price')),
                'product_image' => json_encode(array_column($products,'image')),
                'bulk_purchase_discount' => cart_amount_saved(),
                'order_price' => cart_total(),
                'gst' => cart_gst(),
                'total' => cart_grand_total(),
                'delevery_charge' => $delevery_totaloption,
                'order_total_weight' => order_weight(),

            ]);
        }else {
                    Cache::flush();

            $order = Order::find($request->retry_order);
        }

               if ($request->payment_method == 'neft') {
            $order->discount = $order->total * 0.01;//1% off
            $order->discount_reason = '1% OFF on UTR Payment';
            $order->save();
        }

        $tid = time().rand(111,999);
        $cc_payment = [
            'tid' => $tid,
            'order_id' => $order->id,
            'invoice_no' => '',
            'amount' => $order->total,
            'utr_no' => $request->utr_no,
            'method' => $request->payment_method,
            'merchant_param1' => $tid,
            'amount' => $order->total,
        ];
        $payment = $order->payment()
                    ->updateOrCreate(['order_id'=> $order->id],$cc_payment);


        $order->save();
        $payment->invoice_no = invoiceNo();
        $payment->save();

        // $order->user->notify(
        //     new \App\Notifications\NewOrderPlaceNotification($order)
        // );
        //sms

        $url = "http://workfarmtoresto.bigdreams.in/get_order/".$order->order_id;
       
        sendMessage($request->guest_phone_text, 'Dear '.$request->contact_person.'.Your order '.$order->order_id.' is successfully placed. Check status : '.$url.'. Team Novasell');

        //mail
         // \Mail::to($order->user->email)->send(new OrderPlaceMail($order->user, $order));

        if($request->payment_method == 'cod' || $request->payment_method == 'neft'){
             $message = 'There is new order on novasell.in of customer name '.$request->contact_person.' order no. '.$order->order_id;
         sendMessage('8928205265',$message);
        }
        Cart::destroy();
        return view('website.empty_cart',compact('order'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        $order->load(['user']);
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
        return back()->withStatus('Error!!<br>'.$product->name. ' is running out of stock.');
    }

    public function packOrder($order)
    {
        $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        $order->status = 'packed';
        $order->save();
        return back()->withStatus('Order Packed Successfully')->withTab('pack');
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
        return back()->withStatus('Order Moved to out for delivery Successfully')->withTab('registered');
    }

     public function cancelOrder($id)
    {

        $order =  Order::withoutGlobalScope('paid_orders')->find($id);

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
        $order->save();
        return back()->withStatus('Order Cancelled Successfully')->withTab('undelivered');
    }

    public function allToTransit()
    {
        Cache::flush();
        Order::withoutGlobalScope('paid_orders')->where('status', 'registered')->update(['status' => 'in_transit']);
        return back()->withStatus('Orders Moved to out for delivery Successfully')->withTab('registered');
    }

    public function pdf($order)
    {
         $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        $order->load(['user','user.shippingAddress','BdOrder']);

        return PDF::loadView('pdf.invoice', compact('order'))
                ->stream();
    }

    public function downloadManifest()
    {
        Cache::flush();

        $orders = Order::withoutGlobalScope('paid_orders')->with('BdOrder')->whereHas('BdOrder', function($query){
                    $query->where('status','registered');
                })->get();

        return PDF::loadView('pdf.manifest', compact('orders'))
                ->stream();
    }

    public function refundOnCancel($id){
                Cache::flush();

        $order = Order::withoutGlobalScope('paid_orders')->findOrFail($id);

            
            $api = new Api('rzp_live_2lc8DI76YEjgcA', 'U20zruKEtTGOvwdsIKmWQEmP'); //razorpay config

            //refund

            $refund = $api->refund->create(array('payment_id' => $order->payment->rp_payment_id));

            if($refund)
            {
                $order->status = 'refund';
                $order->refund_id = $refund->id;
                $order->refund_date = date('Y-m-d',$refund->created_at);
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

    public function productReceived(Request $request,$id){

        $order = ReturnOrder::find($id);
        $order->is_product_received = 1;
        $order->product_received_date =  Carbon::parse($request->receive_date);
        $order->product_received_remark = $request->receive_ramark;
        $order->save();

        return response()->json(['msg','Product Received']);
    }

    public function refundOrder(Request $request, $id){

        if(intVal($request->refund_amount) <= 0){

            return response()->json(['error'=>'Amount should be greater than zero']);
        }
       
       $returnOrder =  ReturnOrder::find($id);

       $status = $returnOrder->order->payment->method;


       if($returnOrder->order->payment->method == 'cod' || $returnOrder->order->payment->method == 'neft'){

            $returnOrder->refund_date = Carbon::parse($request->refund_date);
            $returnOrder->mode_of_refund = $request->refund_mode;
            $returnOrder->refund_amount = $request->refund_amount;
            $returnOrder->refund_remark = $request->refund_remark;
            $returnOrder->order->status = 'refund';
            $returnOrder->order->save();
            $returnOrder->save();

            return response()->json(['msg'=>'Refund Initialed Successfully']);
       }elseif($returnOrder->order->payment->method == 'online' && isset($returnOrder->order->payment->rp_payment_id) && $returnOrder->order->payment->rp_payment_status == 'captured' ){

            $api = new Api('rzp_live_2lc8DI76YEjgcA', 'U20zruKEtTGOvwdsIKmWQEmP'); //razorpay config

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

            return response()->json(['msg'=>'Refund Initialed Successfully']);



       }

    
    }

}
