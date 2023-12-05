<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\NewSite\CitiesResource;
use App\Http\Resources\NewSite\CountriesResource;
use App\Models\CountryAndCity;
use App\Models\Locale;
use App\Models\Peculiarities;
use App\Models\Request;
use App\Services\CurrencyService;
use App\Services\LayoutService;

class NewSiteController extends Controller
{
    private $peculiarities;
    private $currencyService;
    private $layoutService;

    public function __construct(CurrencyService $currencyService, LayoutService $layoutService)
    {
        $this->peculiarities = Peculiarities::all();
        $this->currencyService = $currencyService;
        $this->layoutService = $layoutService;
    }

    public function index(Request $request)
    {
        $locale = Locale::where('code', 'ru')->first();

        $countries = CountriesResource::collection(
            CountryAndCity::whereNull('parent_id')
                ->with('cities')
                ->get()
        )->setLocale($locale->id);

        $cities = CitiesResource::collection(
            CountryAndCity::whereNotNull('parent_id')
                ->has('product_city')
                ->get()
        )->setLocale($locale->id);

        $data = [
            'countries' => $countries,
            'cities' => $cities
        ];

        return response()->json($data);
    }
}
