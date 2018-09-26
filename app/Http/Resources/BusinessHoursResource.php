<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class BusinessHoursResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        Carbon::setWeekStartsAt(Carbon::SATURDAY);
        return [
            'id' => $this->id,
            'open_time' => Carbon::createFromFormat('H:i:s', $this->open_time)->format('g:i a'),
            'close_time' => Carbon::createFromFormat('H:i:s', $this->close_time)->format('g:i a'),
        ];
    }
}
