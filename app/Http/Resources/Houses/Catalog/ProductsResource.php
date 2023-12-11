<?php

namespace App\Http\Resources\Houses\Catalog;

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
        return [
            'id' => $this->id,
            'min_price' => number_format($this->min_price, 0, '.', ' '),
            'size' => $this->size ?? null,
            'vanie' => !empty($this->peculiarities->whereIn('type', "Ванные")->first()) ? $this->peculiarities->whereIn('type', "Ванные")->first()->name : null,
            'spalni' => !empty($this->peculiarities->whereIn('type', "Спальни")->first()) ? $this->peculiarities->whereIn('type', "Спальни")->first()->name : null,
            'number_rooms_unique' => $this->number_rooms_unique,
            'address' => $this->address,
            'tags' => $this->tags,
            'favorite' => $this->favorite,
            'layouts_count' => count($this->layouts),
            'photo' => $this->photo
        ];
    }

    public static function collection($resource)
    {
        return new ProductsCollection($resource);
    }
}
