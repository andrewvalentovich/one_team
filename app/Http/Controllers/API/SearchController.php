<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\House\FilterRequest;
use App\Models\CountryAndCity;
use App\Models\Peculiarities;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getParams()
    {
        $countries = CountryAndCity::select('id','name')->where('parent_id', null)->get();
        $collections = Peculiarities::select('id','name', 'type')->get();
        $currency = ["EUR" => "€", "USD" => "$", "RUB" => "₽", "TRY" => "₤"]; // ₺

        $data = [
            "countries" => $countries,
            "types" => $collections->whereIn('type', "Типы")->all(),
            "bedrooms" => $collections->whereIn('type', "Спальни")->all(),
            "bathrooms" => $collections->whereIn('type', "Ванные")->all(),
            "peculiarities" => $collections->whereIn('type', "Особенности")->all(),
            "views" => $collections->whereIn('type', "Вид")->all(),
            "to_sea" => $collections->whereIn('type', "До моря")->all(),
            "currency" => $currency,
        ];

        return response()->json($data);
    }
}
