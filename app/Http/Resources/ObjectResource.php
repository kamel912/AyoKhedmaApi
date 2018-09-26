<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class ObjectResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phones' => PhonesResource::collection($this->phones),
            'beside' => $this->beside,
            'description' => $this->description,
            'business_hours' => BusinessHoursResource::collection($this->businessHours),
            'holiday' => new HolidayResource($this->holiday),
            'category' => new CategoriesResource($this->category),
            'region' => new RegionResource($this->region),
            'street' => new StreetResource($this->street),
            'rate' => $this->rate,
            'rate_count' => $this->rate_count,
            'comments' => CommentsResource::collection($this->comments),
            'created_at' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'updated_at' => Carbon::parse($this->updated_at)->toDayDateTimeString(),
        ];
    }
}
