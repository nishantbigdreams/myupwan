<?php

namespace App\Repository;

use App\Product;
use Illuminate\Http\Request;
use Cache;
use Gloudemans\Shoppingcart\Facades\Cart;

class FilterProduct
{

    protected $request;
    protected $category;
    protected $filter_array;
    protected $min_price;
    protected $max_price;
    protected $sort;

    function __construct(Request $request)
    {
        $this->category = $request->category;
        $this->min_price = $request->min_price;
        $this->max_price = $request->max_price;
        $this->sort = $request->sort;
        $this->request = $request->except(['_token','category','min_price','max_price']);
        $this->mapFilterArray();
    }

    protected function mapFilterArray()
    {
        $this->filter_array = [];
        foreach ($this->request as $key => $category) {
            array_push($this->filter_array, array('attribute' => $key, 'values' => $category));
        }
    }

    public function filteredProducts()
    {
        Cache::flush();
        $filter_query_count = 0;
        $products = Product::with('featuredImage')
        ->when(count($this->filter_array), function($query) use ($filter_query_count){
            foreach ($this->filter_array as $key => $filter) {
                $query->where(function($query) use($filter,$filter_query_count){
                    if (is_array($filter['values'])) {
                    if(count($filter['values']) > 1 )
                    {
                        foreach ($filter['values'] as $key => $value) {
                        $filter_query_count++;
                            if($key == 0)
                            {
                                $query->where('data->'.str_replace("_", " ", $filter['attribute']), $value);
                            }
                            else
                            {
                                 $query->orWhere('data->'.str_replace("_", " ", $filter['attribute']), $value);
                            }
                       
                        }
                    }
                    else
                    {
                        foreach ($filter['values'] as $key => $value) {
                        $filter_query_count++;
                        $query->where('data->'.str_replace("_", " ", $filter['attribute']), $value);
                        }
                    }
                }
                });
                
                    
                
            }
        })
        ->when($this->min_price && $this->max_price, function($query){
            $query->whereBetween('price_without_gst', [intVal($this->min_price), intVal($this->max_price)]);
        })
        ->when($this->sort == 'lowest', function($query){
            $query->orderBy('price_without_gst', 'asc');
        })
        ->when($this->sort == 'highest', function($query){
            $query->orderBy('price_without_gst', 'desc');
        })
        ->when(!$filter_query_count, function($query){
            $query->where('category', $this->category);
        })
        ->orderBy('updated_at','desc')
        ->get();

        foreach($products as $key => $value)
        {
            
            foreach (Cart::content() as $key1 => $cart) 
            {
             
                if ($cart->id == $value->id) 
                {
                
                   Cart::update($cart->rowId, ['price' => $value->price_without_gst]);
                
                }
            
            }            

        }


        return $products;
    }
}
