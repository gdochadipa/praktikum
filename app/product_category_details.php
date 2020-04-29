<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_category_details extends Model
{
    public function product_categories()
    {
        return $this->belongsTo('App\product_categories', 'category_id', 'id');
    }
}
