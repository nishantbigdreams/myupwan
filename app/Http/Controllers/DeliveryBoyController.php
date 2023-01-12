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
use App\DeliveryBoy;
use App\Admin;

class DeliveryBoyController extends Controller
{
    
    public function index(){
    $data = New_data::create ([
			'deliveryboyname'         => $request->deliveryboyname,
			'deliveryboynumber'       => $request->deliveryboynumber,
			'email'                   => $request->email,
			'vehicleno'               => $request->vehicleno,
			'vehicletype'             => $request->vehicletype,
			'selectfile'              => $request->selectfile
			]);


    return view('website.restodeliveryboy',compact('restodeliveryboy'));

}

	public function save_delivery_boy_details(Request $request){
		// dd($request->hasFile('profile'));
		 $fileName = null;

        if($request->hasFile('profile')){
              $fileName = time()."_delivery_boy_".$request->profile->getClientOriginalName();
            
              $request->profile->storeAs('/restaurant', $fileName);
              // $request->file('restaurant')->move(public_path("/restaurant"), $fileName);
              // $request->file->store('public/'.$request->type),

        }

        $password ="123456";
         $user = Admin::create([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'password' =>  \Hash::make($password),
            'vehicle_no' => $request->vehicle_no,
            'vehicle_type' => $request->vehicle_type,
            'profile' => $fileName,
            'role' => '1',
            'usertype' => 'DeliveryBoy',
        ]);


           
        Session::flash('success','Delivery Boy Succuessfully added..!');

         return view('admin.deliveryboy.index');
	}

	public function show($id)
    {

        $user = Admin::find($id);
        // dd($user);
        return view('admin.deliveryboy.show', compact('user'));
    }

    public function deliveryboydashboard(){
       $id=  Auth::guard('admin')->user()->id;


        return view('admin.deliveryboy.dashboard');
    }


    public function orderdetails($id){
        $order = DB::table('orders')->where('id', $id)->first();
        return view('website.orderdetails', compact('order'));
    }

	


}
