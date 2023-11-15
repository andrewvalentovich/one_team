<?php

namespace App\Http\Resources\FilterParams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomsResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type
        ];
    }

    public static function collection($resource){
        return new PeculiaritiesCollection($resource);
    }
}
