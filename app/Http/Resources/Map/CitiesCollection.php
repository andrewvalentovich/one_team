<?php

namespace App\Http\Resources\Map;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CitiesCollection extends ResourceCollection
{
    protected $locale;

    public function setLocale($value){
        $this->locale = $value;
        return $this;
    }

    public function toArray(Request $request)
    {
        return $this->collection->map(function (CitiesResource $resource) use ($request) {
            return $resource->setLocale($this->locale)->toArray($request);
        })->all();
    }
}
