<?php

namespace App\Http\Resources\NewSite;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return $this->collection->map(function (ProductsResource $resource) use ($request) {
            return $resource->toArray($request);
        })->all();
    }
}
