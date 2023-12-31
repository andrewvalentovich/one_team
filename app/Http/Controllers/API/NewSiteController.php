<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\CatalogFilter;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\API\Houses\GetSimpleRequest;
use App\Http\Requests\API\NewSite\IndexRequest;
use App\Http\Requests\House\CatalogRequest;
use App\Http\Resources\NewSite\CitiesResource;
use App\Http\Resources\NewSite\CountriesResource;
use App\Http\Resources\NewSite\ProductsResource;
use App\Models\CountryAndCity;
use App\Models\Locale;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Services\CurrencyService;
use App\Services\LayoutService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

    public function index(IndexRequest $request)
    {
        $data = $request->validated();

        if (!isset($data['locale'])) {
            $data['locale'] = 'ru';
        }
        if (!isset($data['user_id'])) {
            $data['user_id'] = null;
        }

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
        )->setLocale($locale->id)->setUserId($data['user_id']);

        $data = [
            'countries' => $countries,
            'cities' => $cities
        ];

        return response()->json($data);
    }

    public function catalog(CatalogRequest $request)
    {
        $data = $request->validated();

        if (!isset($data['locale'])) {
            $data['locale'] = 'ru';
        }
        if (!isset($data['user_id'])) {
            $data['user_id'] = null;
        }
        if (!isset($data['order_by'])) {
            $data['order_by'] = 'new-first';
        }

        if (isset($data['price'])) {
            if (isset($data['price']['min'])) {
                $data['price']['min'] = $this->currencyService->convertPriceToEur($data['price']['min'], $data['price']['currency'] ?? null);
            }
            if (isset($data['price']['max'])) {
                $data['price']['max'] = $this->currencyService->convertPriceToEur($data['price']['max'], $data['price']['currency'] ?? null);
            }
        }

        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data]);
        $houses = Product::catalog($data['price'] ?? null)
            // получаем одно фото
            ->addSelect(DB::raw('(select photo from photo_tables where parent_id = products.id order by photo_tables.id asc limit 1) as photo'))
            ->with(['peculiarities' => function($query) use ($data) {
                $query->with(['locale_fields' => function($query) use ($data) {
                    $query->whereHas('locale', function($query) use ($data) {
                        $query->where('code', $data['locale']);
                    })->orderByDesc('id');
                }]);
            }])
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
            }])
            ->filter($filter)
            ->paginate(10);

        return ProductsResource::collection($houses);
    }

    public function detail(GetSimpleRequest $request)
    {
        $data = $request->validated();

        if (!isset($data['locale'])) {
            $data['locale'] = 'ru';
        }

        if (!isset($data['user_id'])) {
            $data['user_id'] = null;
        }

        // Фильтр элементов
        $product = Product::whereId($data['id'])
            ->with(['layouts' => function($query) use ($data) {
                // Ограничиваем вывод, только те у которых цена соответствует
                if (isset($data['price']['min'])) {
                    $query->where('layouts.base_price', '>=', $this->currencyService->convertPriceToEur($data['price']['min'], $data['price']['currency'] ?? null));
                }
                if (isset($data['price']['max'])) {
                    $query->where('layouts.base_price', '<=', $this->currencyService->convertPriceToEur($data['price']['max'], $data['price']['currency'] ?? null));
                }
                $query->with('photos');
                $query->orderBy('base_price', 'asc');
            }])
            ->with('photo')
            ->with('country')
            ->with(['peculiarities' => function($query) use ($data) {
                $query->with(['locale_fields' => function($query) use ($data) {
                    $query->whereHas('locale', function($query) use ($data) {
                        $query->where('code', $data['locale']);
                    })->orderByDesc('id');
                }]);
            }])
            ->with(['locale_fields' => function($query) use ($data) {
                $query->whereHas('locale', function($query) use ($data) {
                    $query->where('code', $data['locale']);
                })->orderByDesc('id');
            }])
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', $data['user_id']);
            }])
            ->get()
            ->first();

        // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
        if (isset($product->layouts) && count($product->layouts) > 0) {
            $product->price = $product->layouts[0]->price;
            $product->price_code = $product->layouts[0]->price_code;
        }

        // Меняем параметры (для фронта)
        $product->size = $this->currencyService->getPriceSizeFromDB((int)$product->base_price, (int)$product->size);
        $product->price = $this->currencyService->exchangeGetAll((int)$product->price, $product->price_code);
        if(isset($product->country)) {
            $product->price_credit = $this->currencyService->getCreditPrice((int)$product->base_price, $product->country->inverse_credit_ratio);
        }

        // Получаем уникальные планировки
        $product->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($product->layouts);

        // Цена за квартиру и за метр для планировок
        if (isset($product->layouts)) {
            foreach ($product->layouts as $index => $layout) {
                $layout->price_size = $this->currencyService->getPriceSizeFromDB((int)$layout->base_price, (int)$layout->total_size);
                $layout->price = $this->currencyService->exchangeGetAll($layout->price, $layout->price_code);
                if(isset($product->country)) {
                    $layout->price_credit = $this->currencyService->getCreditPrice((int)$layout->base_price, $product->country->inverse_credit_ratio);
                }
            }
        }

        $data['locale'] = isset($data['locale']) ? $data['locale'] : 'ru';
        if (!is_null($product->locale_fields->where('locale.code', $data['locale'])->first())) {
            $product->description = !is_null($product->locale_fields->where('locale.code', $data['locale'])->first()->description) ? $product->locale_fields->where('locale.code', $data['locale'])->first()->description : null;
            $product->disposition = !is_null($product->locale_fields->where('locale.code', $data['locale'])->first()->diposition) ? $product->locale_fields->where('locale.code', $data['locale'])->first()->disposition : null;
            $product->deadline = !is_null($product->locale_fields->where('locale.code', $data['locale'])->first()->deadline) ? $product->locale_fields->where('locale.code', $data['locale'])->first()->deadline : null;
        }

        // Особенности
        $product->gostinnie = $product->living_rooms();
        $product->vanie = $product->bathrooms();
        $product->spalni = $product->bedrooms();
        $product->do_more = $product->to_sea();
        $product->type_vid = $product->view();
        $product->peculiarities = $product->peculiarities->whereIn('type', "Особенности")->all();

        return [
            'detail' => $product,
            'the_best' => $this->getTheBest($data['locale']),
            'commissioned' => $this->getCommissioned($data['locale'])
        ];
    }

    public function map(Request $request)
    {
        $data = $request->validate([
            'country' => 'nullable|string|max:255',
            'locale' => 'nullable|string|max:255',
        ]);

        if (!isset($data['locale'])) {
            $data['locale'] = 'ru';
        }

        $products = Product::catalog()
            ->withCountryBySlug($data['country'] ?? null)
            ->with(['locale_fields' => function($query) use ($data) {
                $query->whereHas('locale', function($query) use ($data) {
                    $query->where('code', $data['locale']);
                })->orderByDesc('id')->limit(1);
            }])
            ->addSelect(DB::raw('(select photo from photo_tables where parent_id = products.id order by photo_tables.id desc limit 1) as photo'))
            ->orderBy('products.created_at', 'desc')
            ->get();

        return \App\Http\Resources\NewSite\Map\ProductsResource::collection($products)->setLocale($data['locale']);
    }

    public function getTheBest($data)
    {
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
            ->with(['layouts' => function($query) {
                $query->with('photos');
            }])
            ->with(['country' => function($query) {
                $query->select('id', 'name', 'slug');
            }])
            ->with(['city' => function($query) {
                $query->select('id', 'name', 'slug');
            }])
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
            }])
            ->with('photo')
            ->with('locale_fields.locale')
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return ProductsResource::collection($houses);
    }

    public function getCommissioned($data)
    {
        $locale = Locale::where('code', 'ru')->first();

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
            ->with(['layouts' => function($query) {
                $query->with('photos');
            }])
            ->with(['country' => function($query) {
                $query->select('id', 'name', 'slug');
            }])
            ->with(['city' => function($query) {
                $query->select('id', 'name', 'slug');
            }])
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
            }])
            ->with('photo')
            ->with('locale_fields.locale')
            ->whereHas('locale_fields', function($query) use ($locale) {
                $query->where('locale_id', $locale->id)
                    ->whereNotNull('deadline');
            })
            ->limit(6)
            ->get();

        return ProductsResource::collection($houses);
    }

    public function favorite(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable|numeric|min:1',
            'locale' => 'nullable|string|max:255',
        ]);

        if (!isset($data['locale'])) {
            $data['locale'] = 'ru';
        }
        if (!isset($data['user_id'])) {
            $data['user_id'] = null;
        }

        $houses = Product::catalog($data['price'] ?? null)
            // получаем одно фото
            ->addSelect(DB::raw('(select photo from photo_tables where parent_id = products.id order by photo_tables.id asc limit 1) as photo'))
            ->with(['peculiarities' => function($query) use ($data) {
                $query->with(['locale_fields' => function($query) use ($data) {
                    $query->whereHas('locale', function($query) use ($data) {
                        $query->where('code', $data['locale']);
                    })->orderByDesc('id');
                }]);
            }])
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
            }])
            ->whereHas('favorite', function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
            })
            ->get();

        return ProductsResource::collection($houses);
    }
}
