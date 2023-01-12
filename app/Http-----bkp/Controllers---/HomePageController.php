<?php

namespace App\Http\Controllers;

use App\Product;
use App\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{

    public function index()
    {
    	return view('admin.web_homepage')->withSetting(HomePage::first());
    }

    public function sectionUpdate(Request $request)
    {
    	if (!$request->title || count($request->title) == 0 ) {
    		HomePage::find(1)->delete();
            return back()->withStatus('Success! These is no section to display on homepage')->withInput();
    	}
    	$data = [];
    	for($i = 0; $i < count($request->title); $i++){
    		$products = Product::withTrashed()
    					->whereIn('sku', explode(',', $request->section_products[$i]))
    					->pluck('id')->toArray();
    	
    		if (count($products)) {
    			array_push($data, array(
    				'section' => $request->title[$i],
    				'sku' => json_encode($request->section_products[$i]),
    				'products' => json_encode($products)
    			));
    		}
    	}

    	if (count($data) == 0) {
    		return back()->withStatus('Error! No Products found matching given sku code')->withInput();
    	}
    	// exit();
		HomePage::updateOrCreate(['id' => 1],[
			'section' => json_encode($data)
		]);
    	return back()->withStatus('Section Saved Successfully');
    }

    public function get_products()
    {
        return response($request->all());
    }
}
