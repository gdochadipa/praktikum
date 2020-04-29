<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    public function user()
    {
        return $this->belongsTo('App\user', 'user_id', 'id');
    }

    public function courier()
    {
        return $this->belongsTo('App\courier', 'courier_id', 'id');
    }

    public function transaction_detail()
    {
        return $this->hasMany('App\transaction_detail');
    }
}
