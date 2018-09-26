<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    protected $fillable = ['open_time', 'close_time'];
}
