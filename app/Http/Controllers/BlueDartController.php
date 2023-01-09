<?php

namespace App\Http\Controllers;

use App\Order;
use App\Jobs\RegisterOrder as RegisterOrderJob;
use Illuminate\Http\Request;
use App\Repository\BlueDart\Awb;
use App\Repository\BlueDart\RegisterOrder;
use App\Repository\BlueDart\ReturnOrder;
use App\Repository\BlueDart\ShipToPincode;
use App\Repository\BlueDart\CancelOrderPickup;
use App\BlueDartOrder;
use App\PincodeShipping;
use App\Repository\BlueDart\Tracking;
use DB;

class BlueDartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function registerOrder(Request $request)
    {
        $order = Order::withoutGlobalScope('paid_orders')->with(['user','user.shippingAddress'])->findOrFail($request->order);
        $bd = new RegisterOrder;
        $result = $bd->register($order, $request->all()); 
        if ($result['status']) {
            $order->status = 'registered';
            $order->save();
            $order->BdOrder()->updateOrCreate(['order_id' => $order->id],[
                'token' => $result['message'],
                'pickup_date' => date('Y-m-d', strtotime($request->pickup_date)),
                'pickup_time' => date('h:i', strtotime($request->pickup_time)),
                'reference_no' => $order->payment->tid ?? null,
                'remark' => $request->remark,
                'registered_at' => now(),
            ]);
            return back()->withStatus('Order Registered Successfully with BlueDart')->withTab('handover');
        }

        $order->BdOrder()->updateOrCreate(['order_id' => $order->id],[
            'pickup_date' => date('Y-m-d', strtotime($request->pickup_date)),
            'pickup_time' => date('h:i', strtotime($request->pickup_time)),
            'reg_error' => $result['message'],
        ]);

        return back()->withStatus($result['message'])->withTab('handover');
    }

    public function registerAllOrders(Request $request)
    {
        RegisterOrderJob::dispatch($request->all());
        return back()->withStatus('Orders will be registered shortly')->withTab('handover');
    }

    public function awbDownload($order)
    {
        $order =  Order::withoutGlobalScope('paid_orders')->find($order);
        if($order->BdOrder && is_null($order->BdOrder->awb_pdf)){
            $bd = new Awb;
            $bd->download($order);
        }

        $data = utf8_decode($order->BdOrder->awb_pdf);

        return response($data)->header('Content-Type', 'application/pdf');
    }

    public function cancelPickup(Order $order)
    {
    //     $bd = new CancelOrderPickup;
    //     $status = $bd->cancelPickup($order);
    //     if ($status) {
    //         // $order->status = 'packed';
    //         // $order->save();
    //         return back()->withStatus('Order Pickup cancelled Successfully')->withTab('transit');
    //     }
    //     // dd($order);
    //     return back()->withStatus('Error! Occurred, Try again later.')->withTab('transit');
    }

    public function checkShippingAvailability(Request $request)
    {

        
        // dd($request->all());

        /*$pincode  = PincodeShipping::where("pincode",$request->pincode)->first();
            // dd($pincode);
        $extra_message = "";

        try
        {
            if($pincode->block == "1")
            {
                return '<small class="text-danger"> Shipping Not Available <i class="fa fa-times"></i></small>';
            }

             if($pincode->cod_block == "1")
            {
                $extra_message = " . Cash on Delivery not Available.";
            }

             if($pincode->refund_block == "1")
            {
                $extra_message = " . Refund not Available.";
            }

        }
        catch(Exception $e)
        {
            
                // return '<small class="text-danger"> Shipping Not Available <i class="fa fa-times"></i></small>';
        }*/


        //$bd = new ShipToPincode;

        $extra_message = " For this pincode ".$request->pincode;
        $results = DB::select('select * from pincode_shippings where pincode = :pincode', ['pincode' => $request->pincode]);

        if(count($results)>0){
            $bd = 'Yes';

        }else{
            $bd = 'No';
        }
        

        switch($bd){
            case 'Yes':
                return '<small class="text-success"> Shipping Available'.$extra_message.' <i class="fa fa-check"></i></small>';
            break;

            case 'No':
                return '<small class="text-danger"> Shipping Not Available <i class="fa fa-times"></i></small>';
            break;

            default:
                return '<small class="text-danger"> Invalid Pincode <i class="fa fa-times"></i></small>';
            break;

        }
    }

    public function returnOrder(Request $request,$order)
    {

        $order = Order::with(['user','user.shippingAddress'])->findOrFail($order);
        $bd = new ReturnOrder;
        return response()->json($bd->returnOrder($order,$request->all()));


    }

    public function updateOrderStatus()
    {

        $awb_nos = BlueDartOrder::whereHas('order', function ($query) {
                            $query->withoutGlobalScope('paid_orders')->where('status', 'in_transit');
                        })->pluck('awb_no')->toArray();

        if(isset($awb_nos))
        {   
            if(count($awb_nos) >= 1)
            {

            $track = new Tracking($awb_nos);
            $track->track();
            return back()->withStatus('Order Status Succesfully Updated')->withTab('in_transit');

            }
        }
            return back()->withStatus('No Order to update')->withTab('in_transit');

    }
    
}
