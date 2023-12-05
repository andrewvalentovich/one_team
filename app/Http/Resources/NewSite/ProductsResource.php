<?php

namespace App\Http\Resources\NewSite;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'min_price' => $this->min_price,
            'slug' => $this->slug,
            'country' => [
                'id' => $this->country->id,
                'slug' => $this->country->slug,
                'name' => $this->country->name
            ],
            'city' => [
                'id' => $this->city->id,
                'slug' => $this->city->slug,
                'name' => $this->city->name
            ],
            'price_size' => $this->price_size,
            'size_min' => $this->size_min,
            'size_max' => $this->size_max,
            'photos' => $this->photo,
            'layouts' => $this->layouts
        ];
    }

    public static function collection($resource){
        return new ProductsCollection($resource);
    }
}
