<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    use CacheTrait;
    
    protected $fillable = [
        'tid', 'method', 'utr_no', 'invoice_no', 'amount' , 'rp_payment_status','rp_payment_id','rp_payment_method','order_id','status',
    ];

    public function getInvoiceNoAttribute($value)
    {
        return strtoupper($value);
    }
}
