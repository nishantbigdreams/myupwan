<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class CategoriesSeo extends Model
{
    use CacheTrait;

    protected $table = 'categories_seo';

    protected $fillable = [
    	'category_id',
    	'focus_keyword',
    	'lsi_keyword',
    	'content_section',
    	'title_tag',
    	'meta_description_tag',
    	'heading_tag'
    ];
}