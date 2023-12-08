<?php

namespace App\Http\Resources\NewSite\Map;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    protected $locale;

    public function setLocale($value){
        $this->locale = $value;
        return $this;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lat' => $this->lat,
            'long' => $this->long,
            'country' => $this->country->slug,
            'photo' => $this->photo,
            'name' => $this->name,
            'price' => $this->base_price,
        ];
    }

    public static function collection($resource)
    {
        return new ProductsCollection($resource);
    }
}
