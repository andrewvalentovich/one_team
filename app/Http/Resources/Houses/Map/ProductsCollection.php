<?php

namespace App\Http\Resources\Houses\Map;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    protected $filter_city;

    public function setCity($value = null){
        $this->filter_city = $value;
        return $this;
    }

    public function toArray(Request $request)
    {
        return $this->collection->map(function (ProductsResource $resource) use ($request) {
            return $resource->setCity($this->filter_city)->toArray($request);
        })->all();
    }
}
