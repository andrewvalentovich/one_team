<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\FilterParams\CitiesResource;
use App\Http\Resources\FilterParams\CountriesResource;
use App\Http\Resources\FilterParams\LocalesResource;
use App\Http\Resources\FilterParams\PeculiaritiesResource;
use App\Http\Resources\FilterParams\RoomsResource;
use App\Models\CountryAndCity;
use App\Models\Locale;
use App\Models\Peculiarities;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getParams(Request $request)
    {
        // Валидация
        $data = $request->validate([
            'locale' => 'nullable|string|max:2',
            'country_id' => 'nullable',
        ]);

        $locales = Locale::all();
        $locale = $locales->where('code', $data['locale'])->first();

        $countries = CountriesResource::collection(
            CountryAndCity::whereNull('parent_id')
                ->has('product_country')
                ->get()
        )->setLocale($locale->id);

        $cities = CitiesResource::collection(
            CountryAndCity::whereNotNull('parent_id')
                ->has('product_city')
                ->get()
        )->setLocale($locale->id);

        $peculiarities = Peculiarities::select('id', 'name', 'slug', 'type')
            ->with('locale_fields.locale')
            ->get();

        $types = PeculiaritiesResource::collection(
            Peculiarities::select('id', 'name', 'slug', 'type')
                ->with('locale_fields.locale')
                ->has('product')
                ->where('type', 'Типы')
                ->get()
        )->setLocale($locale->code);

        $bedrooms = RoomsResource::collection(
            $peculiarities->where('type', 'Спальни')
        )->setLocale($locale->code);

        $bathrooms = RoomsResource::collection(
            $peculiarities->where('type', 'Ванные')
        )->setLocale($locale->code);

        $to_sea = PeculiaritiesResource::collection(
            $peculiarities->where('type', 'До моря')
        )->setLocale($locale->code);

        $views = PeculiaritiesResource::collection(
            $peculiarities->where('type', 'Вид')
        )->setLocale($locale->code);

        $peculiarities = PeculiaritiesResource::collection(
            $peculiarities->where('type', 'Особенности')
        )->setLocale($locale->code);

        $locales_collection = LocalesResource::collection($locales);

        $currency = [
            0 => ["currency" => "EUR", "symbol" => "€"],
            1 => ["currency" => "USD", "symbol" => "$"],
            2 => ["currency" => "RUB", "symbol" => "₽"],
            3 => ["currency" => "TRY", "symbol" => "₺"],
            4 => ["currency" => "GBP", "symbol" => "₤"] // ₺
        ];

        $data = [
            "countries" => $countries,
            "cities" => $cities,
            "types" => $types,
            "bedrooms" => $bedrooms,
            "bathrooms" => $bathrooms,
            "peculiarities" => $peculiarities,
            "views" => $views,
            "to_sea" => $to_sea,
            "currency" => $currency,
            "locales" => $locales_collection,
            "sale_or_rent" => ["sale", "rent"],
            'dictionary' => [
                'all_countries'     => __('Все страны', [], $locale->code),
                'all_regions'       => __('Все регионы', [], $locale->code),
                'all_types'         => __('Все типы', [], $locale->code),
                'doesnt_matter'     => __('Неважно', [], $locale->code),
                'cheap-first'       => __('Сначала дешёвые', [], $locale->code),
                'expensive-first'   => __('Сначала дорогие', [], $locale->code),
                'new-first'         => __('Сначала новые', [], $locale->code)
            ]
        ];

        return response()->json($data);
    }
}
