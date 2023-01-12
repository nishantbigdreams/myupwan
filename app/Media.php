<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use CacheTrait;

    protected $guarded = [];

    public function getUrlAttribute($value)
    {
/*        return str_replace('public/', '', url('storage/'.$value));*/
        return url('/'.$value);
    }
    public function getFeaturedImageAttribute()
    {
        $img=Media::where('product_id',$this->product_id)->get('url')->pluck(1);
        return $img->url;
    }

}
