<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use CacheTrait;

    protected $fillable = ['type', 'body'];

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
}
