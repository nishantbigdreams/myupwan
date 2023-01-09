<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'parent_category_id',
        'name',
        'sku_initial',
        'data'
    ];


}
