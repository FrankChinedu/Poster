<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments(){
        return $this->hasMany('App\Model\Comment');
    }
}
