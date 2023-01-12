<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model
{
    protected $table="tbl_wishlist";
    protected $guarded=['id'];

    public function customer()
    {
        //id = foriegn key in same table
        return $this->belongsTo('App\User','cust_id');
    }

}
