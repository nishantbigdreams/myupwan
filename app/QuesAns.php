<?php

namespace App;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;

class QuesAns extends Model
{
    use CacheTrait;

    protected $fillable = ['question', 'asked_by'];

    public function askBy()
    {
        return $this->belongsTo(User::class, 'asked_by');
    }
}
