<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['text', 'user_id'];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
