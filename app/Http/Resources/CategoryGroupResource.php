<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
        //     'id' => $this->id,
        //     'name' => $this->name,
        //     // 'category' => new CategoryResource($this->category())
        // ];
    }
    public function with($request)
    {
        return [
            'author' => 'Diêu!'
        ];
    }
}
