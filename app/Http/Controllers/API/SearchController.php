<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\FilterParams\CitiesResource;
use App\Http\Resources\FilterParams\CountriesResource;
use App\Models\CountryAndCity;
use App\Models\Locale;
use App\Models\Peculiarities;
use Illuminate\Http\Request;
use function Symfony\Component\Routing\Loader\Configurator\collection;

class SearchController extends Controller
{
    public function getParams(Request $request)
    {
        // Валидация
        $data = $request->validate([
            'locale' => 'nullable|string|max:2',
            'country_id' => 'nullable',
        ]);

        $locale = Locale::where('code', $data['locale'])->first();
//        $nameField = (isset($data['locale']) && $data['locale'] !== 'ru') ? 'name_'.$data['locale'] : 'name';

//        $countries = CountryAndCity::where('parent_id', null)
//            ->has('product_country')
//            ->with('locale_fields.locale')
//            ->get();


//        $regions = CountryAndCity::select('id', 'name', 'slug', 'parent_id', 'lat', 'long')
//            ->has('product_city')
//            ->whereNotNull('parent_id')
//            ->get()
//            ->transform(function ($row) use ($data) {
//                return [
//                    'id' => $row->id,
//                    'parent_id' => $row->parent_id,
//                    'name' => $row->locale_fields->where("code", $data['locale'])->first(),
//                    'slug' => $row->slug,
//                ];
//            });

        $collections = Peculiarities::select('id', 'name', 'name_en', 'type')
            ->get()
            ->transform(function ($row) {
                return [
                    'id' => $row->id,
                    'name' => $row->name,
                    'name_en' => strtolower(str_replace(' ', '_', $row->name_en)),
                    'type' => $row->type
                ];
            });

        $types = Peculiarities::select('id', 'name', 'name_en', 'type')
            ->where('type', "Типы")
            ->has('product')
            ->get()
            ->transform(function ($row) {
                return [
                    'id' => $row->id,
                    'name' => $row->name,
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
            "countries" => CountriesResource::collection(
                CountryAndCity::whereNull('parent_id')
                    ->has('product_country')
                    ->get()
            )->setLocale($locale->id),
            "cities" => CitiesResource::collection(
                CountryAndCity::whereNotNull('parent_id')
                    ->has('product_city')
                    ->get()
            )->setLocale($locale->id),
            "types" => $types,
            "bedrooms" => $collections->whereIn('type', "Спальни")->values()->all(),
            "bathrooms" => $collections->whereIn('type', "Ванные")->values()->all(),
            "peculiarities" => $collections->whereIn('type', "Особенности")->values()->all(),
            "views" => $collections->whereIn('type', "Вид")->values()->all(),
            "to_sea" => $collections->whereIn('type', "До моря")->values()->all(),
            "currency" => $currency,
            "sale_or_rent" => ["sale", "rent"],
        ];

        return response()->json($data);
    }
}
