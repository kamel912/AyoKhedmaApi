<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property id
 * @property name
 * @Carbon created_at
 * @Carbon updated_at
 */
class Street extends Model
{
    protected $table = 'streets';
    protected $fillable = ['name', 'region_id'];
    public function objects(){
        return $this->hasMany(BasicObject::class,'street_id','id');
    }
    public function region(){
        return $this->belongsTo(Region::class,'region_id', 'id');
    }
}
