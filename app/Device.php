<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //set primary key to be device_id
    //public $primaryKey = 'device_id';

    public function user() {
        return $this->belongsTo('App\User');
    }
}
