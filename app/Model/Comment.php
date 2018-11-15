<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [ 'user_id'];

    public function user()
    {
        return $this->belongsTo("App\Model\User");
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
