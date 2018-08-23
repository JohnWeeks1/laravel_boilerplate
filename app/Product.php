<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','path','cost','product_path'];

    public function user()
    {
        return $this->hasOne("App\User","id","user_id");
    }
}
