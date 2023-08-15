<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\House\FilterRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    public function getByCoordinatesWithFilter(FilterRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data]);
        $houses = Product::filter($filter)->with('photo')->with('favorite')->paginate(10);
//            ->transform(function ($row) {
//                return [
//                    'id' => (int) $row->id,
//                    'country_id' => (int) $row->country_id,
//                    'city_id' => (int) $row->city_id,
//                    'sale_or_rent' => (string) $row->sale_or_rent,
//                    'name' => (string) $row->name,
//                    'address' => (string) $row->address,
//                    'size' => (string) $row->size,
//                    'size_home' => (string) $row->size_home,
//                    'price' => (int) $row->price,
//                    'description' => (string) $row->description,
//                    'description_en' => (string) $row->description_en,
//                    'description_tr' => (string) $row->description_tr,
//                    'lat' => (string) $row->lat,
//                    'long' => (string) $row->long,
//                    'citizenship' => (string) $row->citizenship,
//                    'status' => (string) $row->status,
//                    'disposition' => (string) $row->disposition,
//                    'disposition_en' => (string) $row->disposition_en,
//                    'disposition_tr' => (string) $row->disposition_tr,
//                    'parking' => (string) $row->parking,
//                    'vnj' => (string) $row->vnj,
//                    'commissions' => (string) $row->commissions,
//                    'cryptocurrency' => (string) $row->cryptocurrency,
//                    'owner' => (string) $row->owner,
//                    'grajdandstvo' => (string) $row->grajdandstvo,
//                    'complex_or_not' => (string) $row->complex_or_not,
//                    'objects' => $row->objects,
//                ];
//            })
//        ->toArray();

        return response()->json($houses);
    }
}
