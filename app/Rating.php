<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function object(){
        return $this->belongsTo(BasicObject::class);
    }
}
