<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class parentCategory extends Model
{
	use CacheTrait;
	
	protected $fillable = ['name','category_image'];

    public function subCategories()
    {
    	return $this->hasMany(Category::class);
    }

    
}
