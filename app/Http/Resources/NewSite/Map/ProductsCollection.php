<?php

namespace App\Http\Resources\NewSite\Map;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    protected $locale;

    public function setLocale($value){
        $this->locale = $value;
        return $this;
    }

    public function toArray(Request $request)
    {
        return $this->collection->map(function (ProductsResource $resource) use ($request) {
            return $resource->setLocale($this->locale)->toArray($request);
        })->all();
    }
}
