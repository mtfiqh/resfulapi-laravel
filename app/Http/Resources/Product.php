<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'categories' => Category::collection($this->categories),
            'images' => Image::Collection($this->images),
        ];
    }

    public function with($request){
        return [
            'meta' =>[
                'version' => '1.0.0',
                'Creator' => 'Muhammad Taufiq Hidayat',
                'table' => 'Product',
            ],
        ];
    }
}
