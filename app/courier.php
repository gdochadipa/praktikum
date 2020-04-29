<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class courier extends Model
{
    public function transaction()
    {
        return $this->hasMany('App\transaction');
    }
}
