<?php

namespace App\Http\Resources\Houses\Map;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    protected $city;

    public function setCity($value){
        $this->city = $value;
        return $this;
    }

    public function toArray(Request $request)
    {
        return $this->collection->map(function (ProductsResource $resource) use ($request) {
            return $resource->setCity($this->city)->toArray($request);
        })->all();
    }
}
