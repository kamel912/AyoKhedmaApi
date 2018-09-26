<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;

class objectsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'beside' => $this->beside,
            'status' => $this->status(),
            'region' => new RegionResource($this->region),
            'street' => new StreetResource($this->street),
            'rate' => $this->rate,
            'rate_count' => $this->rate_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }


}
