<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
	use CacheTrait;

    protected $guarded = [];
}
