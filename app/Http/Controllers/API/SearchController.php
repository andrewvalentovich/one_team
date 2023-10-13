<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\House\FilterRequest;
use App\Models\CountryAndCity;
use App\Models\Peculiarities;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SearchController extends Controller
{
    public function getParams(Request $request)
    {
        // Валидация
        $data = $request->validate([
            'locale' => 'nullable|string|max:5',
            'country_id' => 'nullable',
        ]);

        $nameField = (isset($data['locale']) && $data['locale'] !== 'ru') ? 'name_'.$data['locale'] : 'name';

        $countries = CountryAndCity::select('id', $nameField)
            ->where('parent_id', null)
            ->get()
            ->transform(function ($row) use ($nameField) {
                return [
                    'id' => $row->id,
                    'name' => $row[$nameField],
                ];
            });

        $regions = CountryAndCity::select('id', $nameField, 'parent_id')
            ->has('product_city')
            ->whereNotNull('parent_id')
            ->get()
            ->transform(function ($row) use ($nameField) {
                return [
                    'id' => $row->id,
                    'parent_id' => $row->parent_id,
                    'name' => $row[$nameField],
                ];
            });

        $collections = Peculiarities::select('id', $nameField, 'type')
            ->get()
            ->transform(function ($row) use ($nameField) {
                return [
                    'id' => $row->id,
                    'name' => $row[$nameField],
                    'type' => $row->type
                ];
            });

        $types = Peculiarities::select('id', $nameField, 'type')
            ->where('type', "Типы")
            ->has('product')
            ->get()
            ->transform(function ($row) use ($nameField) {
                return [
                    'id' => $row->id,
                    'name' => $row[$nameField],
                    'type' => $row->type
                ];
            });

        $currency = ["EUR" => "€", "USD" => "$", "RUB" => "₽", "TRY" => "₤"]; // ₺

        $data = [
            "countries" => $countries,
            "cities" => (isset($data['country_id'])) ? $regions->where('parent_id', $data['country_id'])->all() : $regions,
            "types" => $types,
            "bedrooms" => $collections->whereIn('type', "Спальни")->where('name', "!=", "Неважно")->all(),
            "bathrooms" => $collections->whereIn('type', "Ванные")->where('name', "!=", "Неважно")->all(),
            "peculiarities" => $collections->whereIn('type', "Особенности")->all(),
            "views" => $collections->whereIn('type', "Вид")->all(),
            "to_sea" => $collections->whereIn('type', "До моря")->all(),
            "currency" => $currency,
        ];

        return response()->json($data);
    }
}
