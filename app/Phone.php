<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['id','number', 'object_id'];

    public function object(){
        return $this->belongsTo(BasicObject::class, 'object_id');
    }
    protected $hidden = ['id','object_id','created_at','updated_at'];
}
