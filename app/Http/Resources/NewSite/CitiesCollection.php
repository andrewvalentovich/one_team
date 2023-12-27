<?php

namespace App\Http\Resources\NewSite;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CitiesCollection extends ResourceCollection
{
    protected $locale_id;
    protected $user_id;

    public function setLocale($value){
        $this->locale_id = $value;
        return $this;
    }

    public function setUserId($value)
    {
        $this->user_id = $value;
        return $this;
    }

    public function toArray(Request $request)
    {
        return $this->collection->map(function (CitiesResource $resource) use ($request) {
            return $resource->setLocale($this->locale_id)->setUserId($this->user_id)->toArray($request);
        })->all();
    }
}
