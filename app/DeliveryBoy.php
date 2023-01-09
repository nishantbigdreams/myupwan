<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DeliveryBoy extends Model
{
    use CacheTrait;

    protected $fillable = ['name','mobile_no','email','vehicle_no','vehicle_type','profile','created_at','updated_at','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function BdOrder()
    {
        return $this->hasOne(BlueDartOrder::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function complains()
    {
        return $this->hasMany(Complain::class);
    }

    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] = date('Y-m-d', strtotime($value));
    }

    public function getContactPersonAttribute($value)
    {
        return strtoupper($value);
    }

    public function gstAmount()
    {
        $price_without_gst = round($this->total/1.18, 2);
        return round($price_without_gst * 0.18, 2);
    }

    /**
     * Scope a query to newest.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveOrders($query)
    {
        return $query->where('status', '!=', 'cancelled')
                    ->where('status','!=', 'delivered');
    }

    /**
     * Scope a query to only include order of a given status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $type)
    {
        return $query->where('status', $type);
    }

    /**
     * Scope a query to newest.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('id', 'desc');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('paid_orders', function (Builder $builder) {
            $builder->where('is_paid', 'yes');
        });
    }

    public function returnOrder(){
        return $this->hasOne(ReturnOrder::class);
    }
}
