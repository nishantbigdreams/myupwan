<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnOrder extends Model
{
        use SoftDeletes;

        protected $fillable = [
        	'order_id',
        	'reason',
        	'bank',
        	'account_no',
        	'ifsc_code',
        	'mobile',
        	'email',
                'invoice_no',
        	'return_order_pickup_date',
                'pickup_time',
                'status',
                'remark',
        	'is_refunded',
        	'mode_of_refund',
        	'refund_amount',
        	'refund_date',
                'awb_no',
                'awb_pdf',
                'CCRCRDREF',
                'token_no',
                'product_received_remark',
                'refund_remark',
                'refund_id',

        ];

        public function order()
        {
        	return $this->belongsTo(Order::class,'order_id');
        }

}
