<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $fillable = ['id','name'];
    public function objects(){
        return $this->hasMany(BasicObject::class, 'street_id', 'id');
    }
    public function streets(){
        return $this->hasMany(Street::class, 'region_id', 'id');
    }
}
