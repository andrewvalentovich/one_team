<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\CatalogFilter;
use App\Http\Requests\House\CatalogRequest;
use App\Http\Resources\NewSite\CitiesResource;
use App\Http\Resources\NewSite\CountriesResource;
use App\Models\CountryAndCity;
use App\Models\Locale;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Models\Request;
use App\Services\CurrencyService;
use App\Services\LayoutService;
use Illuminate\Support\Facades\DB;

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

    public function catalog(CatalogRequest $request)
    {
        $data = $request->validated();

        // Фильтр элементов
        $filter = app()->make(CatalogFilter::class, ['queryParams' => $data, 'currencyService' => $this->currencyService]);
        $houses = Product::leftJoin('layouts', function ($join) {
            $join->on('products.id', '=', 'layouts.complex_id')
                ->where('products.complex_or_not', 'Да')
                ->addSelect(DB::raw('id, price, base_price, price_code, total_size'));
        })
            ->addSelect('products.id', 'products.name', 'products.city_id', 'products.country_id', 'products.price', 'products.base_price', 'products.price_code', 'products.size')
            ->groupBy('products.id')
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(min(layouts.base_price)) ELSE products.base_price END) as min_price'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(min(layouts.total_size)) ELSE products.size END) as min_size'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(max(layouts.total_size)) ELSE products.size END) as max_size'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(min(products.base_price) / min(products.size)) ELSE products.base_price / products.size END) as price_size'))

            ->with(['layouts' => function($query) use ($data) {
                $query->with('photos');
            }])
            ->with(['country' => function($query) use ($data) {
                $query->select('id', 'name', 'slug');
            }])
            ->with(['city' => function($query) use ($data) {
                $query->select('id', 'name', 'slug');
            }])
            ->with('photo')
            ->with('locale_fields.locale')
            ->filter($filter)
            ->paginate(10);

        foreach ($houses as $house) {

            $house->to_sea = $house->to_sea();
            $house->is_swimming = $house->is_swimming();
        }

        return response()->json($houses);
    }
}
