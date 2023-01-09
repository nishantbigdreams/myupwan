<?php

namespace App\Http\ViewComposers;

use App\Product;
use App\HomePage;
use App\Category;
use App\parentCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryViewComposer
{
    public function compose(View $view) {

        //navbar categories listing
        if (strpos(url()->current(), 'admin') == false) {
            $categories = parentCategory::has('subCategories')->with('subCategories')->get();
            $view->with('categories', $categories);
        }

        //footer listing, new categories
        $product_categories = Category::orderBy('id','desc')->limit(5)->get();
        $view->with('product_categories', $product_categories);

        //popular tags
        $popular_tags = parentCategory::has('subCategories')
                                        ->withCount('subCategories')
                                        ->orderBy('sub_categories_count','desc')
                                        ->limit(5)
                                        ->get();
                                        
        $view->with('popular_tags', $popular_tags);

        $sections = [];
        if (url()->current() == env('APP_URL')) {
        	$setting = HomePage::first();
        	if ($setting) {
        		foreach (json_decode($setting->section) as $key => $data) {
        			$sections[] = [
        				'title' => $data->section,
        				'products' => Product::whereIn('id',json_decode($data->products))->get(),
        			];
        		}
        	}
        }
        view()->share('sections',$sections);
    }
}

?>
