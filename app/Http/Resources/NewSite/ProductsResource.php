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
            'country_id' => $this->country_id,
            'country' => $this->country->name,
            'city_id' => $this->city_id,
            'city' => $this->city->name,
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
