<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_categories extends Model
{
    public function product_category_details()
    {
        return $this->hasMany('App/product_category_details');
    }

}
