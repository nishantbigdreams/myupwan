<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use CacheTrait;

	protected $fillable = ['data', 'name', 'sku_initial','parent_category_id'];

	public function last_product()
	{
		return Product::where('category', $this->name)->orderBy('id','desc')->first();
	}

	public function parentCategory()
	{
		return $this->belongsTo(parentCategory::class);
	}

	public function totalProducts($value)
	{
		return Product::where('category',$value)->count() ?? '0';
	}

	public function subCategories()
    {
        return $this->hasMany('App\categories_seo', 'parent_category_id');
    }

    public function getProducts()
    {
        return $this->hasMany('App\product', 'name');
        
    }
	
}
