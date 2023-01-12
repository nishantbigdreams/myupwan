<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Charge;
use App\Payment;
use App\Complain;
use Illuminate\Http\Request;
use Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Cache::flush();
        $sales_graph_data = [];
        $unit_graph_data = [];

        for($i = 7; $i >= 0; $i--){
            $date = now()->subMonths($i);
            array_push($sales_graph_data,[
                'month' => $date->format('M').','.$date->format('y'),
                'value' => Payment::whereMonth('payments.created_at', $date->month)
                            ->whereYear('payments.created_at', $date->year)
                            ->where('orders.status','!=', 'cancelled')
                            ->where('orders.status','!=', 'return')
                            ->where('orders.status','!=', 'refund')
                            ->where('orders.status','!=', 'refunded')
                            ->where('orders.status','!=', 'return_registered')
                            ->join("orders","payments.order_id","=","orders.id")
                            ->sum('amount')
            ]);

            $orders = Order::withoutGlobalScope('paid_orders')->whereMonth('created_at', $date->month)
                            ->whereYear('created_at', $date->year)
                            ->where('status','!=', 'cancelled')
                            ->where('status','!=', 'return')
                            ->where('status','!=', 'refund')
                            ->where('status','!=', 'refunded')
                            ->where('status','!=', 'return_registered')
                            ->get();
            $unit_count = 0;
            foreach ($orders as $key => $order) {
                $unit_count += array_sum(json_decode($order->product_qty));
            }
            array_push($unit_graph_data,[
                'month' => $date->format('M').','.$date->format('y'),
                'value' => $unit_count,
            ]);
        }

        $data = array(
            
            'new_order' => Order::withoutGlobalScope('paid_orders')->where('status','new')->orWhere('status','processing')->count(),
            'todays_sale' => Payment::where(DB::raw('Date_Format(payments.created_at,"%Y-%m-%d")'), date('Y-m-d'))
                            ->where('orders.status','!=', 'cancelled')
                            ->where('orders.status','!=', 'return')
                            ->where('orders.status','!=', 'refund')
                            ->where('orders.status','!=', 'refunded')
                            ->where('orders.status','!=', 'return_registered')
                            ->join("orders","payments.order_id","=","orders.id")
                            ->sum('amount'),
            'month_sale'=> Payment::whereMonth('payments.created_at',date('m'))->whereYear('payments.created_at',date('Y'))
                            ->where('orders.status','!=', 'cancelled')
                            ->where('orders.status','!=', 'return')
                            ->where('orders.status','!=', 'refund')
                            ->where('orders.status','!=', 'refunded')
                            ->where('orders.status','!=', 'return_registered')
                            ->join("orders","payments.order_id","=","orders.id")
                            ->sum('amount'),
            'user_count' => User::count(), 
        
        );

        return view('admin.home', compact('data', 'sales_graph_data', 'unit_graph_data'));

    }

    public function notification($type)
    {
        auth()->guard('admin')->user()->notifications->markAsRead();
        switch ($type) {
            case 'complains':
                return view('admin.notifications.complain_index');
                break;

            default:
                // code...
                break;
        }
        return back();
    }

    public function updateComplainStatus(Request $request)
    {
        $complain = Complain::find($request->complain);
        if ($complain) {
            $complain->status = $complain->status == 'pending' ? 'solved' : 'pending';
            $complain->save();
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function calculatorIndex()
    {
        $charges = Charge::take(3)->get();
        return view('admin.calculator.index', compact('charges'));
    }

    public function calculatorSetting(Request $request)
    {
        for($i = 0; $i < count($request->zone); $i++){
            Charge::updateOrCreate(['id' => $i+1],
            [
                'zone' => $request->zone[$i],
                'shipping_charge' => $request->shipping_charge[$i] ?? 0,
                'shipping_tax' => $request->shipping_tax[$i] ?? 0,
                'collection_charge' => $request->collection_charge[$i] ?? 0,
                'collection_tax' => $request->collection_tax[$i] ?? 0,
            ]);
        }
        return back()->withStatus('Setting saved successfully');
    }
}
