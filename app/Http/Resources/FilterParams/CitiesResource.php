<?php

namespace App\Http\Resources\FilterParams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitiesResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'name' => $this->locale_fields->where('locale_id', $this->locale_id)->first()->name,
            'slug' => $this->slug,
        ];
    }

    public static function collection($resource){
        return new CitiesCollection($resource);
    }
}
