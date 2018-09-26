<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'obj_id', 'subject', 'body'];

    protected $hidden = ['id', 'user_id', 'object_id', 'status'];

    public function object()
    {
        return $this->belongsTo(BasicObject::class, 'object_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
