<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','phone','street','address','city','state','pincode',
        'subcribe_to_newsletter','password','restaurant_name','restaurant_logo','licence','licence_image','certificate_no','certificate_image','restaurant_phone','owner_name','owner_mobile_no','owner_email','manager_name','manager_mobile_no','gst','restaurant_address','billing_address' ,'firstlogin','usertype','address_line_0','address_line_1','address_line_2', 'city' , 'state','licence_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class)->orderBy('id','desc');
    }

    public function shippingAddress()
    {
        return $this->hasOne(Address::class)->where('type','shipping');
    }

    public function billingAddress()
    {
        return $this->hasOne(Address::class)->where('type','billing');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
