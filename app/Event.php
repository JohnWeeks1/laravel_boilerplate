<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'description', 'image',
    ];

    public function location()
    {
        return $this->hasOne('App\Location');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function attending()
    {
        return $this->hasOne('App\Attend', 'event_id', 'id');
    }    

    public function users_attend()
    {
        return $this->hasManyThrough('App\User', 'App\Attend', 'event_id', 'id');
    }  
}