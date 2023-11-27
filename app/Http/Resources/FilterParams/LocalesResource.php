<?php

namespace App\Http\Resources\FilterParams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalesResource extends JsonResource
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
            'code' => $this->code,
        ];
    }
}
