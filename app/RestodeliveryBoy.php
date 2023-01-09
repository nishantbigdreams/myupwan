<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestodeliveryBoy extends Model
{
    protected $table = 'restodeliveryboy';

     protected $fillable = [
      'deliveryboyname',
      'deliveryboynumber',
      'email',
      'vehicleno',
      'restrodeliveryboy',
      'selectfile'

 ];

}
