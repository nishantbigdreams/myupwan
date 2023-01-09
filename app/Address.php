<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use CacheTrait;

    protected $fillable = [
    'type','contact_person','contact_number','is_company','gst_no','pan_no','tin_no','address_line_0', 'address_line_1', 'address_line_2', 'city', 'pincode','state',
    ];
}
