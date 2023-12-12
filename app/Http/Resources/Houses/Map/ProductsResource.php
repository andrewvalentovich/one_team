<?php

namespace App\Http\Resources\Houses\Map;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    protected $city;

    public function setCity($value){
        $this->city = $value;
        return $this;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $current_region = 0;

        if (!is_null($this->city)) {
            if (!is_null($this->city)) {
                $current_region = $this->city->slug === $this->city ? 1 : 0;
            } else {
                $current_region = 0;
            }
        } else {
            $current_region = 0;
        }

        return [
            'id' => $this->id,
            'lat' => $this->lat,
            'long' => $this->long,
            'price' => (count($this->layouts) > 0) ? number_format($this->min_price, 0, '.', ' ') . ' +' : number_format($this->min_price, 0, '.', ' '),
            'vanie' => !empty($this->peculiarities->whereIn('type', "Ванные")->first()) ? $this->peculiarities->whereIn('type', "Ванные")->first()->name : null,
            'spalni' => !empty($this->peculiarities->whereIn('type', "Спальни")->first()) ? $this->peculiarities->whereIn('type', "Спальни")->first()->name : null,
            'kv' => $this->size,
            'name' => $this->name,
            'address' => $this->address,
            'image' => $this->photo,
            'current_region' => $current_region
        ];
    }

    public static function collection($resource)
    {
        return new ProductsCollection($resource);
    }
}
