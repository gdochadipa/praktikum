<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'profile_image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function product_review()
    {
        return $this->hasMany('App\product_review');
    }

    public function transaction()
    {
        return $this->hasMany('App\transaction');
    }

    public function notifications()
    {
        return $this->morphMany(userNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
