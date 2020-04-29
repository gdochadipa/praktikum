<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class response extends Model
{
    public function product_review()
    {
        return $this->belongsTo('App\product_review', 'review_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\admin', 'admin_id', 'id');
    }
}
