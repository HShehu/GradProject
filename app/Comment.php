<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable =
    [
        'user_id',
        'parent_id',
        'body',
        'commentable_id',
        'commentable_type'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
