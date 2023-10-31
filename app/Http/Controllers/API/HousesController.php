<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\API\Houses\GetSimpleRequest;
use App\Http\Requests\House\FilterRequest;
use App\Models\Product;
use App\Models\Peculiarities;
use App\Services\CurrencyService;
use App\Services\LayoutService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HousesController extends Controller
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

    public function getByCoordinatesWithFilter(FilterRequest $request)
    {
        $data = $request->validated();

        // Число отображаемых записей (пока что магическое число)
        $limit = 12;
        // Отступ для выборки записей
        $offset = isset($data['page']) ? (int)$data['page'] * $limit : 0;

        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data, 'currencyService' => $this->currencyService]);

        // Выбор объектов, запрос к базе через Eloquent
//        $houses = Product::addSelect('products.*', DB::raw('(CASE WHEN complex_or_not = "Да" THEN min(layouts.price) GROUP BY layouts.id ELSE products.price END) as min_price'))
//            ->leftJoin('layouts', function ($join) {
//                $join->on('products.id', '=', 'layouts.complex_id')
//                    ->where('products.complex_or_not', 'Да')
//                    ->orderBy('layouts.price', 'asc');
//            })
//            ->with(['layouts' => function($query) use ($data) {
//            // Ограничиваем вывод, только те у которых цена соответствует
//                if (isset($data['price']['min_price'])) {
//                    $query->where('layouts.price', '>=', $this->currencyService->convertPriceToEur($data['price']['min_price'], $data['price']['code'] ?? null));
//                }
//                if (isset($data['price']['max_price'])) {
//                    $query->where('layouts.price', '<=', $this->currencyService->convertPriceToEur($data['price']['max_price'], $data['price']['code'] ?? null));
//                }
//                $query->with('photos');
//                $query->orderBy('price', 'asc');
//            }])
//            ->with('photo')
//            ->with('peculiarities')
//            ->with(['favorite' => function ($query) use ($data) {
//                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
//            }])
//            ->filter($filter)
//            ->get();
//
//        // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
//        for ($i = 0; $i < count($houses); $i++) {
//            $houses[$i]->price = $houses[$i]->min_price;
//        }
//
//        // Меняем параметры (для фронта)
//        foreach ($houses as $key => $object) {
//            $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->price, (int)$object->size);
//            $object->price = $this->currencyService->getPriceFromDB((int)$object->price);
//
//            // Получаем уникальные планировки
//            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);
//
//            // Цена за квартиру и за метр для планировок
//            if (isset($object->layouts)) {
//                foreach ($object->layouts as $index => $layout) {
//                    $layout->price_credit   = is_array($layout->price_credit) ? $layout->price_credit : $this->currencyService->getPriceCreditFromDB((int)$layout->price);
//                    $layout->price_size     = is_array($layout->price_size) ? $layout->price_size : $this->currencyService->getPriceSizeFromDB((int)$layout->price, (int)$layout->total_size);
//                    $layout->price          = is_array($layout->price) ? $layout->price : $this->currencyService->getPriceFromDB((int)$layout->price);
//                }
//            }
//
//            // Особенности
//            // Можно использовать Scopes!!!
//            $object->gostinnie = !empty($object->peculiarities->whereIn('type', "Гостиные")->first()) ? $object->peculiarities->whereIn('type', "Гостиные")->first()->name : null;
//            $object->vanie = !empty($object->peculiarities->whereIn('type', "Ванные")->first()) ? $object->peculiarities->whereIn('type', "Ванные")->first()->name : null;
//            $object->spalni = !empty($object->peculiarities->whereIn('type', "Спальни")->first()) ? $object->peculiarities->whereIn('type', "Спальни")->first()->name : null;
//            $object->do_more = !empty($object->peculiarities->whereIn('type', "До моря")->first()) ? $object->peculiarities->whereIn('type', "До моря")->first()->name : null;
//            $object->type_vid = !empty($object->peculiarities->whereIn('type', "Вид")->first()) ? $object->peculiarities->whereIn('type', "Вид")->first()->name : null;
//            $object->peculiarities = !empty($object->peculiarities->whereIn('type', "Особенности")->all()) ? $object->peculiarities->whereIn('type', "Особенности")->all() : null;
//        }
//
//        return response()->json($houses);
        $houses = Product::with(['layouts' => function($query) use ($data) {
                // Ограничиваем вывод, только те у которых цена соответствует
                if (isset($data['price']['min_price'])) {
                    $query->where('layouts.price', '>=', $this->currencyService->convertPriceToEur($data['price']['min_price'], $data['price']['code'] ?? null));
                }
                if (isset($data['price']['max_price'])) {
                    $query->where('layouts.price', '<=', $this->currencyService->convertPriceToEur($data['price']['max_price'], $data['price']['code'] ?? null));
                }
                $query->with('photos');
                $query->orderBy('price', 'asc');
            }])
            ->with('photo')
            ->with('peculiarities')
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
            }])
            ->filter($filter)
            ->get();

        // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
        for ($i = 0; $i < count($houses); $i++) {
            if (isset($houses[$i]->layouts) && count($houses[$i]->layouts) > 0) {
                $houses[$i]->price = $houses[$i]->layouts[0]->price;
            }
        }

        // Сортировка элементов
        if (isset($data['order_by'])) {
            // Получаем $value = 'price-asc' -> $val_arr[0] = 'price', $val_arr[1] = 'asc';
            $value = explode('-', $data['order_by']);

            if ($value[1] === 'desc') {
                $sorted = $houses->sortByDesc($value[0])->values()->all();
            } else {
                $sorted = $houses->sortBy($value[0])->values()->all();
            }
        } else {
            $sorted = $houses->sortByDesc('created_at')->values()->all();
        }

        // Меняем параметры (для фронта)
        foreach ($sorted as $key => $object) {
            $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->price, (int)$object->size);
            $object->price = $this->currencyService->getPriceFromDB((int)$object->price);

            // Получаем уникальные планировки
            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);

            // Цена за квартиру и за метр для планировок
            if (isset($object->layouts)) {
                foreach ($object->layouts as $index => $layout) {
                    $layout->price_credit = $this->currencyService->getPriceCreditFromDB((int)$layout->price);
                    $layout->price_size = $this->currencyService->getPriceSizeFromDB((int)$layout->price, (int)$layout->total_size);
                    $layout->price = $this->currencyService->getPriceFromDB((int)$layout->price);
                }
            }

            // Особенности
            // Можно использовать Scopes!!!
            $object->gostinnie = !empty($object->peculiarities->whereIn('type', "Гостиные")->first()) ? $object->peculiarities->whereIn('type', "Гостиные")->first()->name : null;
            $object->vanie = !empty($object->peculiarities->whereIn('type', "Ванные")->first()) ? $object->peculiarities->whereIn('type', "Ванные")->first()->name : null;
            $object->spalni = !empty($object->peculiarities->whereIn('type', "Спальни")->first()) ? $object->peculiarities->whereIn('type', "Спальни")->first()->name : null;
            $object->do_more = !empty($object->peculiarities->whereIn('type', "До моря")->first()) ? $object->peculiarities->whereIn('type', "До моря")->first()->name : null;
            $object->type_vid = !empty($object->peculiarities->whereIn('type', "Вид")->first()) ? $object->peculiarities->whereIn('type', "Вид")->first()->name : null;
            $object->peculiarities = !empty($object->peculiarities->whereIn('type', "Особенности")->all()) ? $object->peculiarities->whereIn('type', "Особенности")->all() : null;
        }

        return response()->json(array_slice($sorted, $offset, $limit));
    }

    public function getSimple(GetSimpleRequest $request)
    {
        $data = $request->validated();
        // Фильтр элементов
        // Выбор объектов, запрос к базе через Eloquent
        $product = Product::whereId($data['id'])
            ->with(['layouts' => function($query) use ($data) {
                // Ограничиваем вывод, только те у которых цена соответствует
                if (isset($data['price']['min_price'])) {
                    $query->where('layouts.price', '>=', $this->currencyService->convertPriceToEur($data['price']['min_price'], $data['price']['code'] ?? null));
                }
                if (isset($data['price']['max_price'])) {
                    $query->where('layouts.price', '<=', $this->currencyService->convertPriceToEur($data['price']['max_price'], $data['price']['code'] ?? null));
                }
                $query->with('photos');
                $query->orderBy('price', 'asc');
            }])
            ->with('photo')
            ->with('peculiarities')
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
            }])
            ->get()
            ->first();

        // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
        if (isset($product->layouts) && count($product->layouts) > 0) {
            $product->price = $product->layouts[0]->price;
        }

        // Меняем параметры (для фронта)
        $product->size = $this->currencyService->getPriceSizeFromDB((int)$product->price, (int)$product->size);
        $product->price = $this->currencyService->getPriceFromDB((int)$product->price);

        // Получаем уникальные планировки
        $product->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($product->layouts);

        // Цена за квартиру и за метр для планировок
        if (isset($product->layouts)) {
            foreach ($product->layouts as $index => $layout) {
                $layout->price_credit = $this->currencyService->getPriceCreditFromDB((int)$layout->price);
                $layout->price_size = $this->currencyService->getPriceSizeFromDB((int)$layout->price, (int)$layout->total_size);
                $layout->price = $this->currencyService->getPriceFromDB((int)$layout->price);
            }
        }

        // Особенности
        // Можно использовать Scopes!!!
        $product->gostinnie = !empty($product->peculiarities->whereIn('type', "Гостиные")->first()) ? $product->peculiarities->whereIn('type', "Гостиные")->first()->name : null;
        $product->vanie = !empty($product->peculiarities->whereIn('type', "Ванные")->first()) ? $product->peculiarities->whereIn('type', "Ванные")->first()->name : null;
        $product->spalni = !empty($product->peculiarities->whereIn('type', "Спальни")->first()) ? $product->peculiarities->whereIn('type', "Спальни")->first()->name : null;
        $product->do_more = !empty($product->peculiarities->whereIn('type', "До моря")->first()) ? $product->peculiarities->whereIn('type', "До моря")->first()->name : null;
        $product->type_vid = !empty($product->peculiarities->whereIn('type', "Вид")->first()) ? $product->peculiarities->whereIn('type', "Вид")->first()->name : null;
        $product->peculiarities = !empty($product->peculiarities->whereIn('type', "Особенности")->all()) ? $product->peculiarities->whereIn('type', "Особенности")->all() : null;

        return response()->json($product);
    }

    public function getAll(FilterRequest $request)
    {
        $data = $request->validated();
        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data]);
        $houses = Product::filter($filter)->with('photo')->with('peculiarities')->get()->transform(function ($row) {
            return [
                'id' => $row->id,
                'coordinate' => $row->lat.','.$row->long,
                "price" => $this->currencyService->getPriceFromDB($row->price),
                "vanie" => !empty($row->peculiarities->whereIn('type', "Ванные")->first()) ? $row->peculiarities->whereIn('type', "Ванные")->first()->name : null,
                "spalni" => !empty($row->peculiarities->whereIn('type', "Спальни")->first()) ? $row->peculiarities->whereIn('type', "Спальни")->first()->name : null,
                'kv' => $row->size,
                'address' => $row->address,
                'image' => count($row->photo) > 0 ? $row->photo[0]->preview : null,
            ];
        });

        return response()->json($houses);
    }
}
