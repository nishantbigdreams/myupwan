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

class RegionController extends Controller
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
		// dd($request);
		 $fileName = null;

        if($request->hasFile('profile')){
              $fileName = time()."_delivery_boy_".$request->profile->getClientOriginalName();
            
              $request->profile->storeAs('restaurant', $fileName);

        }

         $user = DeliveryBoy::create([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'vehicle_no' => $request->vehicle_no,
            'vehicle_type' => $request->vehicle_type,
            'profile' => $fileName,
        ]);


           
        Session::flash('success','Delivery Boy Succuessfully added..!');

        return redirect()->route('admin.all_delivery_boy');
	}

        public function show(User $user)
    {
        $user->load(['orders']);

        return view('admin.regin.show', compact('user'));
    }


	


}
