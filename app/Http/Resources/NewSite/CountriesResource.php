<?php

namespace App\Http\Resources\NewSite;

use App\Http\Resources\NewSite\CitiesResource;
use App\Models\CountryAndCity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountriesResource extends JsonResource
{
    protected $locale_id;

    public function setLocale($value){
        $this->locale_id = $value;
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
            'name' => $this->locale_fields->where('locale_id', $this->locale_id)->first()->name,
            'photo' => $this->photo,
            'cities' => $this->cities
        ];
    }

    public static function collection($resource){
        return new CountriesCollection($resource);
    }
}
