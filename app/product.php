<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public function product_review()
    {
        return $this->hasMany('App\product_review');
    }

    public function discount()
    {
        return $this->hasMany('App\discount');
    }
    
    public function transaction_detail()
    {
        return $this->hasMany('App\transaction_detail');
    }
}
