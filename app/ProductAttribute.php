<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected  $table="product_attribute";
    protected $guarded=['id'];

    public function productname()
    {
        //id = foriegn key in same table
        return $this->belongsTo('App\Product','p_id');
    }
    public function productattributemaster()
    {
        //id = foriegn key in same table
        return $this->belongsTo('App\ProductAttributeMaster','patt_id');
    }
}
