<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
   // protected $connection = 'mysql1';
	protected $guarded = [];

	/**
     * Set the Date.
     *
     * @param  string  $value
     * @return void
     */
    public function setJoinDateAttribute($value)
    {
        $this->attributes['join_date'] = date('Y-m-d',strtotime($value));
    }

    public function getJoinDateAttribute($value)
    {
        return date('D d M, Y', strtotime($value));
    }

    public function pendingService(){
        return $this->hasMany(Service::class)->where('status','pending')->orderBy('date','asc');
    }

}
