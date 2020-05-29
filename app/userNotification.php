<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class userNotification extends DatabaseNotification
{
    protected $table = 'user_notifications';
    protected $guarded = [];
}
