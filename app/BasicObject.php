<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BasicObject extends Model
{
    protected $table = 'objects';
    protected $fillable = ['name', 'beside', 'description', 'holiday_id', 'category_id', 'region_id', 'street_id'];

    public function phones()
    {
        return $this->hasMany(Phone::class, 'object_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function street()
    {
        return $this->belongsTo(Street::class, 'street_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'object_id', 'id');
    }

    public function holiday()
    {
        return $this->belongsTo(Day::class, 'holiday_id', 'id');
    }

    public function businessHours()
    {
        return $this->hasMany(BusinessHours::class, 'object_id', 'id');
    }

    public function status()
    {
        $status = 'close';
        $businessHours = $this->businessHours;
        foreach ($businessHours as $business_hours) {
            if ($this->isOpen($business_hours)) {
                $status = 'open';
                break;
            }
        }
        return $status;
    }


    private function isOpen(BusinessHours $businessHours)
    {
        $afterMidNight = false;
        $holiday = null;
        if ($this->holiday != null) {
            $holiday = Carbon::parse($this->holiday->long_name);
        } else {
            $holiday = Carbon::yesterday();
        }

        $open_time = Carbon::createFromFormat('H:i:s', $businessHours->open_time);
        $close_time = Carbon::createFromFormat('H:i:s', $businessHours->close_time);
        $current_time = Carbon::now();
        $today = Carbon::today();
        if ($close_time->lt($open_time)) {
            if ($current_time->between($today, $close_time)) {
                $open_time->subDay();
                $afterMidNight = true;
            } else {
                $close_time->addDay();
            }
        }
        if ($current_time->between($open_time, $close_time)) {
            if ( $holiday->ne($today)) {
                return true;
            }else{
                if ($afterMidNight){
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }

    }


}
