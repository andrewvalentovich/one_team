<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\CatalogFilter;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\API\Houses\GetSimpleRequest;
use App\Http\Requests\House\CatalogRequest;
use App\Http\Requests\House\FilterRequest;
use App\Http\Resources\Houses\Map\ProductsResource;
use App\Models\CountryAndCity;
use App\Models\Locale;
use App\Models\Product;
use App\Models\Peculiarities;
use App\Models\Request;
use App\Services\CurrencyService;
use App\Services\LayoutService;
use App\Services\TitleGenerateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HousesController extends Controller
{
    private $peculiarities;
    private $currencyService;
    private $layoutService;
    private $titleGenerateService;

    public function __construct(
        CurrencyService $currencyService,
        LayoutService $layoutService,
        TitleGenerateService $titleGenerateService
    )
    {
        $this->peculiarities = Peculiarities::all();
        $this->currencyService = $currencyService;
        $this->layoutService = $layoutService;
        $this->titleGenerateService = $titleGenerateService;
    }

//    public function getByCoordinatesWithFilter(FilterRequest $request)
//    {
//        $countries = CountryAndCity::all();
//        $data = $request->validated();
//        $locale = Locale::where('code', isset($data['locale']) ? $data['locale'] : 'ru')->first();
//
//        // Число отображаемых записей (пока что магическое число)
//        $limit = 12;
//        // Отступ для выборки записей
//        $offset = isset($data['page']) ? (int)$data['page'] * $limit : 0;
//
//        // Фильтр элементов
//        $filter = app()->make(HousesFilter::class, ['queryParams' => $data, 'currencyService' => $this->currencyService]);
//
//        // Выбор объектов, запрос к базе через Eloquent
////        $houses = Product::addSelect('products.*', DB::raw('(CASE WHEN complex_or_not = "Да" THEN min(layouts.base_price) ELSE products.base_price END) as base_price'))
////            ->leftJoin('layouts', function ($join) {
////                $join->on('products.id', '=', 'layouts.complex_id')
////                    ->where('products.complex_or_not', "Да")
////                    ->orderBy('layouts.base_price', 'asc');
////            })
////            ->with(['layouts' => function($query) use ($data) {
////            // Ограничиваем вывод, только те у которых цена соответствует
////                if (isset($data['price']['min'])) {
////                    $query->where('layouts.base_price', '>=', $this->currencyService->convertPriceToEur($data['price']['min'], $data['price']['code'] ?? null));
////                }
////                if (isset($data['price']['max'])) {
////                    $query->where('layouts.base_price', '<=', $this->currencyService->convertPriceToEur($data['price']['max'], $data['price']['code'] ?? null));
////                }
////                $query->with('photos');
////                $query->orderBy('base_price', 'asc');
////            }])
////            ->groupBy('products.id')
//////            ->with('photo')
//////            ->with('peculiarities')
//////            ->with(['favorite' => function ($query) use ($data) {
//////                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
//////            }])
////            ->filter($filter)
////            ->get();
////
////        // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
////        for ($i = 0; $i < count($houses); $i++) {
////            $houses[$i]->price = $houses[$i]->min_price;
////        }
////
////        // Меняем параметры (для фронта)
////        foreach ($houses as $key => $object) {
//////            $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->price, (int)$object->size);
//////            $object->price = $this->currencyService->getPriceFromDB((int)$object->price);
//////
//////            // Получаем уникальные планировки
//////            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);
//////
//////            // Цена за квартиру и за метр для планировок
//////            if (isset($object->layouts)) {
//////                foreach ($object->layouts as $index => $layout) {
//////                    $layout->price_credit   = is_array($layout->price_credit) ? $layout->price_credit : $this->currencyService->getPriceCreditFromDB((int)$layout->price);
//////                    $layout->price_size     = is_array($layout->price_size) ? $layout->price_size : $this->currencyService->getPriceSizeFromDB((int)$layout->price, (int)$layout->total_size);
//////                    $layout->price          = is_array($layout->price) ? $layout->price : $this->currencyService->getPriceFromDB((int)$layout->price);
//////                }
//////            }
////
////            // Особенности
////            // Можно использовать Scopes!!!
//////            $object->gostinnie = !empty($object->peculiarities->whereIn('type', "Гостиные")->first()) ? $object->peculiarities->whereIn('type', "Гостиные")->first()->name : null;
//////            $object->vanie = !empty($object->peculiarities->whereIn('type', "Ванные")->first()) ? $object->peculiarities->whereIn('type', "Ванные")->first()->name : null;
//////            $object->spalni = !empty($object->peculiarities->whereIn('type', "Спальни")->first()) ? $object->peculiarities->whereIn('type', "Спальни")->first()->name : null;
//////            $object->do_more = !empty($object->peculiarities->whereIn('type', "До моря")->first()) ? $object->peculiarities->whereIn('type', "До моря")->first()->name : null;
//////            $object->type_vid = !empty($object->peculiarities->whereIn('type', "Вид")->first()) ? $object->peculiarities->whereIn('type', "Вид")->first()->name : null;
//////            $object->peculiarities = !empty($object->peculiarities->whereIn('type', "Особенности")->all()) ? $object->peculiarities->whereIn('type', "Особенности")->all() : null;
////        }
////
////        return response()->json($houses);
//        $houses = Product::with(['layouts' => function($query) use ($data) {
//                // Ограничиваем вывод, только те у которых цена соответствует
//                if (isset($data['price']['min'])) {
//                    $query->where('layouts.base_price', '>=', $this->currencyService->convertPriceToEur($data['price']['min'], $data['price']['currency'] ?? null));
//                }
//                if (isset($data['price']['max'])) {
//                    $query->where('layouts.base_price', '<=', $this->currencyService->convertPriceToEur($data['price']['max'], $data['price']['currency'] ?? null));
//                }
//                $query->with('photos');
//                $query->orderBy('base_price', 'asc');
//            }])
//            ->with('photo')
//            ->with('peculiarities.locale_fields.locale')
//            ->with('country.locale_fields.locale')
//            ->with('city.locale_fields.locale')
//            ->with('locale_fields.locale')
//            ->with(['favorite' => function ($query) use ($data) {
//                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
//            }])
//            ->filter($filter)
//            ->get();
//
//        // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
//        for ($i = 0; $i < count($houses); $i++) {
//            if (isset($houses[$i]->layouts) && count($houses[$i]->layouts) > 0) {
//                $houses[$i]->price = $houses[$i]->layouts[0]->price;
//                $houses[$i]->price_code = $houses[$i]->layouts[0]->price_code;
//                $houses[$i]->base_price = $houses[$i]->layouts[0]->base_price;
//            }
//        }
//
//        // Сортировка элементов
//        if (isset($data['order_by'])) {
//            // Получаем $value = 'price-asc' -> $val_arr[0] = 'price', $val_arr[1] = 'asc';
//            $value = explode('-', $data['order_by']);
//            if ($value[0] === 'price') {
//                $value[0] = 'base_price';
//            }
//
//            if ($value[1] === 'desc') {
//                $sorted = $houses->sortByDesc($value[0])->values()->all();
//            } else {
//                $sorted = $houses->sortBy($value[0])->values()->all();
//            }
//        } else {
//            $sorted = $houses->sortByDesc('created_at')->values()->all();
//        }
//
//        // Меняем параметры (для фронта)
//        foreach ($sorted as $key => $object) {
//            // Тэги
//            $object->getTags($locale->code);
//
//            $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->base_price, (int)$object->size);
//            $object->price = $this->currencyService->exchangeGetAll($object->price, $object->price_code);
//            if(isset($object->country)) {
//                $object->price_credit = $this->currencyService->getCreditPrice((int)$object->base_price, $object->country->inverse_credit_ratio);
//            }
//
//            if (!is_null($object->locale_fields->where('locale_id', $locale->id)->first())) {
//                $object->description = !is_null($object->locale_fields->where('locale_id', $locale->id)->first()->description) ? $object->locale_fields->where('locale_id', $locale->id)->first()->description : null;
//                $object->disposition = !is_null($object->locale_fields->where('locale_id', $locale->id)->first()->diposition) ? $object->locale_fields->where('locale_id', $locale->id)->first()->disposition : null;
//                $object->deadline = !is_null($object->locale_fields->where('locale_id', $locale->id)->first()->deadline) ? __('Срок сдачи', [], $locale->code) . ': ' . $object->locale_fields->where('locale_id', $locale->id)->first()->deadline : null;
//            }
//
//            // Получаем уникальные планировки
//            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);
//
//            // Цена за квартиру и за метр для планировок
//            if (isset($object->layouts)) {
//                foreach ($object->layouts as $index => $layout) {
//                    if(isset($object->country)) {
//                        $layout->price_credit = $this->currencyService->getCreditPrice((int)$layout->base_price, $object->country->inverse_credit_ratio);
//                    }
//                    $layout->price_size = $this->currencyService->getPriceSizeFromDB((int)$layout->base_price, (int)$layout->total_size);
//                    $layout->price = $this->currencyService->exchangeGetAll($layout->price, $layout->price_code);
//                }
//            }
//
//            // Особенности
//            $object->gostinnie = $object->living_rooms();
//            $object->vanie = $object->bathrooms();
//            $object->spalni = $object->bedrooms();
//            $object->do_more = $object->to_sea();
//            $object->type_vid = $object->view();
//            $object->peculiarities = $object->peculiarities->whereIn('type', "Особенности")->all();
//        }
//
//        return response()->json(array_slice($sorted, $offset, $limit));
//    }

    public function getByCoordinatesWithFilter(FilterRequest $request)
    {
        $data = $request->validated();

        // Если нет параметра для сортировки, создаём его
        if (!isset($data['order_by'])) {
            $data['order_by'] = 'new-first';
        }

        $title = null;
        $title_catalog = null;
        // Генерация заголовков
        if (isset($data['country'])) {
            $title = $this->titleGenerateService->handle('Покупка недвижимости в регионе :name', CountryAndCity::where('slug', $data['city'])->first());
            $title_catalog = $this->titleGenerateService->handle('Недвижимость в регионе :name', CountryAndCity::where('slug', $data['city'])->first());
        }


        // Число отображаемых записей (пока что магическое число)
        $limit = 12;
        // Отступ для выборки записей
        $offset = isset($data['page']) ? (int)$data['page'] * $limit : 0;

        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data, 'currencyService' => $this->currencyService]);
        $products = Product::realty($data['price'] ?? null)
            ->withCount('photo')
            ->with(['photo' => function($query) {
                $query->orderBy('id', 'asc')->limit(5);
            }])
            ->with('peculiarities.locale_fields.locale')
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
            }])
            ->with(['locale_fields' => function($query) use ($data) {
                $query->whereHas('locale', function($query) use ($data) {
                    $query->where('code', $data['locale']);
                })->orderByDesc('id')->limit(1);
            }])
            ->offset($offset)
            ->limit($limit)
            ->filter($filter)
            ->get();

        // Меняем параметры (для фронта)
        foreach ($products as $key => $object) {
            // Тэги
            $object->getTags('ru');

            // Получаем уникальные планировки
            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);

            // Особенности
            $object->gostinnie = $object->living_rooms();
            $object->vanie = $object->bathrooms();
            $object->spalni = $object->bedrooms();
            $object->do_more = $object->to_sea();
            $object->type_vid = $object->view();
        }

        return [
            'title' => '',
            'catalog_title' => '',
            'data' => \App\Http\Resources\Houses\Catalog\ProductsResource::collection($products)
        ];
    }

    public function getSimple(GetSimpleRequest $request)
    {
        $data = $request->validated();
        // Фильтр элементов
        // Выбор объектов, запрос к базе через Eloquent
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
            ->with('peculiarities.locale_fields.locale')
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
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

        return response()->json($product);
    }

//    public function getSimple(GetSimpleRequest $request)
//    {
//        $data = $request->validated();
//        // Фильтр элементов
//        // Выбор объектов, запрос к базе через Eloquent
//        $product = Product::simple($data['id'])
//            ->with('peculiarities.locale_fields.locale')
//            ->with(['favorite' => function ($query) use ($data) {
//                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
//            }])
//            ->get()
//            ->first();
//
//        // Меняем параметры (для фронта)
//        $product->size = $this->currencyService->getPriceSizeFromDB((int)$product->base_price, (int)$product->size);
//        $product->price = $this->currencyService->exchangeGetAll((int)$product->price, $product->price_code);
//        if(isset($product->country)) {
//            $product->price_credit = $this->currencyService->getCreditPrice((int)$product->base_price, $product->country->inverse_credit_ratio);
//        }
//
//        // Получаем уникальные планировки
//        $product->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($product->layouts);
//
//        // Цена за квартиру и за метр для планировок
//        if (isset($product->layouts)) {
//            foreach ($product->layouts as $index => $layout) {
//                $layout->price_size = $this->currencyService->getPriceSizeFromDB((int)$layout->base_price, (int)$layout->total_size);
//                $layout->price = $this->currencyService->exchangeGetAll($layout->price, $layout->price_code);
//                if(isset($product->country)) {
//                    $layout->price_credit = $this->currencyService->getCreditPrice((int)$layout->base_price, $product->country->inverse_credit_ratio);
//                }
//            }
//        }
//
//        $data['locale'] = isset($data['locale']) ? $data['locale'] : 'ru';
//        if (!is_null($product->locale_fields->where('locale.code', $data['locale'])->first())) {
//            $product->description = !is_null($product->locale_fields->where('locale.code', $data['locale'])->first()->description) ? $product->locale_fields->where('locale.code', $data['locale'])->first()->description : null;
//            $product->disposition = !is_null($product->locale_fields->where('locale.code', $data['locale'])->first()->diposition) ? $product->locale_fields->where('locale.code', $data['locale'])->first()->disposition : null;
//            $product->deadline = !is_null($product->locale_fields->where('locale.code', $data['locale'])->first()->deadline) ? $product->locale_fields->where('locale.code', $data['locale'])->first()->deadline : null;
//        }
//
//        // Особенности
//        $product->gostinnie = $product->living_rooms();
//        $product->vanie = $product->bathrooms();
//        $product->spalni = $product->bedrooms();
//        $product->do_more = $product->to_sea();
//        $product->type_vid = $product->view();
//        $product->peculiarities = $product->peculiarities->whereIn('type', "Особенности")->all();
//
//        return response()->json($product);
//    }

    public function getAll(FilterRequest $request)
    {
        $data = $request->validated();

        $filter_city = isset($data['city']) ? $data['city'] : null;
        unset($data['city']);

        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data]);

        $houses = Product::realty($data['price'] ?? null)
            ->addSelect(DB::raw('(select preview from photo_tables where parent_id = products.id order by photo_tables.id asc limit 1) as photo'))
            ->with('city')
            ->with('peculiarities')
            ->filter($filter)
            ->get();

        return ProductsResource::collection($houses)->setCity($filter_city);
    }
}
