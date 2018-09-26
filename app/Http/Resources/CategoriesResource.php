<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CategoriesResource extends Resource
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
            'single_unit' => $this->single_unit,
            'image' => $this->image
        ];
    }
}
