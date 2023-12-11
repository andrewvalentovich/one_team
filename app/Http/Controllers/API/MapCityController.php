<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\Map\CitiesResource;
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

//        // 17 - id страны (Турции)
//        $id = !isset($data['country_id']) ? 17 : $data['country_id'];
//        unset($data['country_id']);

        // Получаем города выбранной страны
//        $cities = CountryAndCity::with('locale_fields.locale');
        if (isset($data['country_id'])) {
            $cities = CountryAndCity::where('parent_id', $data['country_id'])->with('locale_fields.locale')->has('product_city')->get();
        } else {
            $cities = CountryAndCity::with('locale_fields.locale')->has('product_city')->get();
        }

        $cities_data = [];
        foreach ($cities as $city) {
            $cities_data[] = [
                'id' => $city->id,
                'coordinate' => [$city->lat, $city->long],
                'name' => $city->locale_fields->where('locale.code', $data['locale'])->first()->name,
                'link' => '/' . $data['locale'] . '/' . $city->country->slug . '/' . $city->slug,
                'count' => $city->product_city->count() . " " . __('объектов', [], $data['locale']),
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $cities_data,
        ],200);
    }
}
