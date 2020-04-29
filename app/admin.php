<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'username', 'password','profile_image','phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function response()
    {
        return $this->hasMany('App\response');
    }
}
