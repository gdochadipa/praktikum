<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class adminNotification  extends DatabaseNotification
{
    
    protected $table = 'admin_notifications';
    protected $guarded = [];
}
