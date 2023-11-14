<?php

namespace App\Http\Resources\Map;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitiesResource extends JsonResource
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
            'coordinate' => [$this->lat, $this->long],
            'name' => $this->locale_fields->where('locale.code', $this->locale)->first()->name,
            'link' => '/' . $this->country->slug . '/' . $this->slug,
            'count' => $this->product_city->count() . " " . __('объектов', [], $this->locale),
        ];
    }

    public static function collection($resource)
    {
        return new CitiesCollection($resource);
    }
}
