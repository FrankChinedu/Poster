<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $fillable = ['url', 'user_id'];
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
