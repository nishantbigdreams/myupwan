<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RestodeliveryBoy;

class RestodeliveryBoy extends Controller{

public function index(){
    $RestodeliveryBoy = RestodeliveryBoy::create ([
			'deliveryboyname'         => $request->deliveryboyname,
			'deliveryboynumber'       => $request->deliveryboynumber,
			'email'                   => $request->email,
			'vehicleno'               => $request->vehicleno,
			'vehicletype'             => $request->vehicletype,
			'selectfile'              => $request->selectfile
			]);


    return view('website.restodeliveryboy',compact('restodeliveryboy'));


}

}
