<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_review extends Model
{
    public function product()
    {
        return $this->belongsTo('App\product','product_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\user','user_id','id');
    }

    public function response()
    {
        return $this->hasMany('App\response');
    }
}
