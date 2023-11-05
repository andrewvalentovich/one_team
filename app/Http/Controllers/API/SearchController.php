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

        $countries = CountryAndCity::select('id', $nameField, 'name_en', 'lat', 'long')
            ->where('parent_id', null)
            ->has('product_country')
            ->with('cities', function ($query) {
                $query->has('product_city');
            })
            ->get()
            ->transform(function ($row) use ($nameField) {
                return [
                    'id' => $row->id,
                    'name' => $row[$nameField],
                    'name_en' => str_replace(' ', '_', mb_strtolower($row->name_en)),
                    'cities' => $row->cities
                ];
            });

        $regions = CountryAndCity::select('id', $nameField, 'name_en', 'parent_id', 'lat', 'long')
            ->has('product_city')
            ->whereNotNull('parent_id')
            ->get()
            ->transform(function ($row) use ($nameField) {
                return [
                    'id' => $row->id,
                    'parent_id' => $row->parent_id,
                    'name' => $row[$nameField],
                    'name_en' => strtolower($row->name_en),
                ];
            });

        $collections = Peculiarities::select('id', $nameField, 'name_en', 'type')
            ->get()
            ->transform(function ($row) use ($nameField) {
                return [
                    'id' => $row->id,
                    'name' => $row[$nameField],
                    'name_en' => strtolower(str_replace(' ', '_', $row->name_en)),
                    'type' => $row->type
                ];
            });

        $types = Peculiarities::select('id', $nameField, 'name_en', 'type')
            ->where('type', "Типы")
            ->has('product')
            ->get()
            ->transform(function ($row) use ($nameField) {
                return [
                    'id' => $row->id,
                    'name' => $row[$nameField],
                    'name_en' => strtolower($row->name_en),
                    'type' => $row->type
                ];
            });

        $currency = [
            0 => ["currency" => "EUR", "symbol" => "€"],
            1 => ["currency" => "USD", "symbol" => "$"],
            2 => ["currency" => "RUB", "symbol" => "₽"],
            3 => ["currency" => "TRY", "symbol" => "₺"],
            4 => ["currency" => "GBP", "symbol" => "₤"] // ₺
        ];

        $data = [
            "countries" => $countries,
            "cities" => $regions,
            "types" => $types,
            "bedrooms" => $collections->whereIn('type', "Спальни")->where('name', "!=", "Неважно")->values()->all(),
            "bathrooms" => $collections->whereIn('type', "Ванные")->where('name', "!=", "Неважно")->values()->all(),
            "peculiarities" => $collections->whereIn('type', "Особенности")->values()->all(),
            "views" => $collections->whereIn('type', "Вид")->values()->all(),
            "to_sea" => $collections->whereIn('type', "До моря")->values()->all(),
            "currency" => $currency,
            "sale_or_rent" => ["sale", "rent"],
        ];

        return response()->json($data);
    }
}
