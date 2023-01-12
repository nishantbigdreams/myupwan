<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class PincodeShipping extends Model
{
    use CacheTrait;

    protected $fillable = ['pincode','block','cod_block','refund_block'];

    public $timestamps = false;
}
