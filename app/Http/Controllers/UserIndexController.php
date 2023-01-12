<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategories;
class UserIndexController extends Controller
{
    public function DisplayCategory(){
        $category = Subcategories::select('id', 'name', 'parent_category_id', 'sku_initial', 'data')->orderBy('id', 'asc')->get();
        // dd($category);

        return view('website.index')->with(['categorydata' => $category]);


    }

}
