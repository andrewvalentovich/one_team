<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\Map\ProductsResource;
use App\Models\CountryAndCity;
use Illuminate\Http\Request;

class MapCityController extends Controller
{
    public function getCities(Request $request)
    {
        $data = $request->validate([
           'locale' => 'nullable|string|max:2',
           'country_id' => 'nullable|min:1'
        ]);

        // 17 - id страны (Турции)
        $id = !isset($data['country_id']) ? 17 : $data['country_id'];
        unset($data['country_id']);

        // Получаем города выбранной страны
        $cities = CountryAndCity::where('parent_id', $id)->with('locale_fields.locale')->has('product_city')->get();

        return response()->json([
            'status' => true,
            'data' => ProductsResource::collection($cities)->setLocale($data['locale']),
        ],200);
    }
}
