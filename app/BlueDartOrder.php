<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class BlueDartOrder extends Model
{
    use CacheTrait;

     protected $fillable = [
        'token','reference_no','remark','pickup_date','pickup_time','reg_error','registered_at'
    ];

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public function setExpectedDeliveryDateAttribute($value)
    {
    	$this->attributes['expected_delivery_date'] = date('Y-m-d', strtotime($value));
    }
}
