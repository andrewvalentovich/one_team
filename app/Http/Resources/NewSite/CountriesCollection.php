<?php

namespace App\Http\Resources\NewSite;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountriesCollection extends ResourceCollection
{
    protected $locale_id;

    public function setLocale($value){
        $this->locale_id = $value;
        return $this;
    }

    public function toArray(Request $request)
    {
        return $this->collection->map(function (CountriesResource $resource) use ($request) {
            return $resource->setLocale($this->locale_id)->toArray($request);
        })->all();
    }
}
