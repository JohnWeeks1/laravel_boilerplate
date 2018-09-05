<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function users() 
    {
        return $this->hasMany('App\User', 'id', 'user_receiveing_friendship_id');
    }
}
