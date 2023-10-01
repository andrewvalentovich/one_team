<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\API\Houses\GetOneRequest;
use App\Http\Requests\House\FilterRequest;
use App\Models\Product;
use App\Models\Peculiarities;
use App\Services\CurrencyService;
use App\Services\SortService;
use Illuminate\Support\Facades\App;

class HousesController extends Controller
{
    private $peculiarities;
    private $currencyService;
    private $sortService;

    public function __construct(CurrencyService $currencyService, SortService $sortService)
    {
        $this->peculiarities = Peculiarities::all();
        $this->currencyService = $currencyService;
        $this->sortService = $sortService;
    }

    public function getByCoordinatesWithFilter(FilterRequest $request)
    {
        $data = $request->validated();
        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data]);
        $houses = Product::filter($filter)->with('photo')->with('peculiarities')->with(['favorite' => function ($query) use ($data) {
            $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
        }])->orderBy('created_at', 'desc')->paginate(12)->through(function ($row) {
            $objects = [];
            $layouts_result = null;
            $min_price = null;

            if (is_countable(json_decode($row->objects))) {

                // Создаём индекс
                $i = 0;
                foreach (json_decode($row->objects) as $object) {
                    // Формируем новое поле price_size
                    $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->price, (int)$object->size);

                    // Ищем минимальную цену
                    if ($i === 0) {
                        $min_price = $object->price;
                    } else {
                        $min_price = $object->price < $min_price ? $object->price : $min_price;
                    }

                    // Меняем цену
                    $price = $object->price;
                    $object->price = $this->currencyService->getPriceFromDB($price);
                    unset($price);

                    // Присваиваем объект временной переменой
                    $objects[] = $object;

                    // Увеличиваем индекс
                    $i++;
                }
                // Очищаем индекс
                unset($i);

                // Возвращаем минимальную цену с валютами
                $min_price = $this->currencyService->getPriceFromDB($min_price);

                // Оставляем только уникальные планировки (1+2, 2+2 и т.д.)
                $layouts = array_unique(array_column(json_decode($row->objects), 'apartment_layout'), SORT_STRING);

                // массив для сортировки
                $layouts_sort_arr = [];
                foreach ($layouts as $layout) {
                    if($layout === "" || $layout === " ") {
                        continue;
                    } else {
                        $layouts_sort_arr[] = explode("+", $layout);
                    }
                }

                // Сортировка
                $sort = $this->sortService->quicksort($layouts_sort_arr);

                // Вывод планировок (1+2, 2+2 и пр.)
                foreach ($sort as $layout) {
                    $layouts_result .= !next($sort) ? implode("+", $layout) : implode("+", $layout) . ", ";
                }
                unset($layouts);


                $row->objects = json_encode($objects, JSON_UNESCAPED_UNICODE);
            }

            return [
                "id" => $row->id,
                "country_id" => $row->country_id,
                "city_id" => $row->city_id,
                "sale_or_rent" => $row->sale_or_rent,
                "name" => $row->name,
                "address" => $row->address,
                "size" => $row->size,
                "size_home" => $row->size_home,
                "layouts" => $layouts_result,
                "layouts_count" => is_countable($objects) ? count($objects) : 0,
                "price_size" => $this->currencyService->getPriceSizeFromDB((int)$row->price, (int)$row->size),
                "price" => $this->currencyService->getPriceFromDB($row->price),
                "min_price" => is_countable($objects) ? $min_price : 0,
                "price_code" => $row->price_code,
                "description" => $row->description,
                "description_en" => $row->description_en,
                "description_tr" => $row->description_tr,
                "lat" => $row->lat,
                "long" => $row->long,
                "citizenship" => $row->citizenship,
                "photo" => $row->photo,
                "status" => $row->status,
                "disposition" => $row->disposition,
                "disposition_en" => $row->disposition_en,
                "disposition_tr" => $row->disposition_tr,
                "created_at" => $row->created_at,
                "updated_at" => $row->updated_at,
                "parking" => $row->parking,
                "vnj" => $row->vnj,
                "commissions" => $row->commissions,
                "cryptocurrency" => $row->cryptocurrency,
                "owner" => $row->owner,
                "grajandstvo" => $row->grajandstvo,
                "complex_or_not" => $row->complex_or_not,
                "objects" => $row->objects,
                "gostinnie" => !empty($row->peculiarities->whereIn('type', "Гостиные")->first()) ? $row->peculiarities->whereIn('type', "Гостиные")->first()->name : null,
                "vanie" => !empty($row->peculiarities->whereIn('type', "Ванные")->first()) ? $row->peculiarities->whereIn('type', "Ванные")->first()->name : null,
                "spalni" => !empty($row->peculiarities->whereIn('type', "Спальни")->first()) ? $row->peculiarities->whereIn('type', "Спальни")->first()->name : null,
                "do_more" => !empty($row->peculiarities->whereIn('type', "До моря")->first()) ? $row->peculiarities->whereIn('type', "До моря")->first()->name : null,
                "type_vid" => !empty($row->peculiarities->whereIn('type', "Вид")->first()) ? $row->peculiarities->whereIn('type', "Вид")->first()->name : null,
                "peculiarities" => !empty($row->peculiarities->whereIn('type', "Особенности")->all()) ? $row->peculiarities->whereIn('type', "Особенности")->all() : null,
                "favorite" => $row->favorite,
            ];
        });


        return response()->json($houses);
    }

    public function getOne(GetOneRequest $request)
    {
        $data = $request->validated();
        // Фильтр элементов
        $house = Product::whereId($data['id'])
            ->with('photo')
            ->with('peculiarities')
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
            }])->get()->first();

            $objects = [];
            $layouts_result = null;
            $min_price = null;
            if (is_countable(json_decode($house->objects))) {

                // Создаём индекс
                $i = 0;
                foreach (json_decode($house->objects) as $object) {
                    // Формируем новое поле price_size
                    $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->price, (int)$object->size);

                    // Ищем минимальную цену
                    if ($i === 0) {
                        $min_price = $object->price;
                    } else {
                        $min_price = $object->price < $min_price ? $object->price : $min_price;
                    }

                    // Меняем цену
                    $price = $object->price;
                    $object->price = $this->currencyService->getPriceFromDB($price);
                    unset($price);

                    // Присваиваем объект временной переменой
                    $objects[] = $object;

                    // Увеличиваем индекс
                    $i++;
                }
                // Очищаем индекс
                unset($i);

                // Возвращаем минимальную цену с валютами
                $min_price = $this->currencyService->getPriceFromDB($min_price);

                // Оставляем только уникальные планировки (1+2, 2+2 и т.д.)
                $layouts = array_unique(array_column(json_decode($house->objects), 'apartment_layout'), SORT_STRING);

                // массив для сортировки
                $layouts_sort_arr = [];
                foreach ($layouts as $layout) {
                    if ($layout === "" || $layout === " ") {
                        continue;
                    } else {
                        $layouts_sort_arr[] = explode("+", $layout);
                    }
                }

                // Сортировка
                $sort = $this->sortService->quicksort($layouts_sort_arr);

                // Вывод планировок (1+2, 2+2 и пр.)
                foreach ($sort as $layout) {
                    $layouts_result .= !next($sort) ? implode("+", $layout) : implode("+", $layout) . ", ";
                }
                unset($layouts);

                $house->objects = json_encode($objects, JSON_UNESCAPED_UNICODE);
            }

        return response()->json([
            "id" => $house->id,
            "country_id" => $house->country_id,
            "city_id" => $house->city_id,
            "sale_or_rent" => $house->sale_or_rent,
            "name" => $house->name,
            "address" => $house->address,
            "size" => $house->size,
            "size_home" => $house->size_home,
            "layouts" => $layouts_result,
            "layouts_count" => is_countable($objects) ? count($objects) : 0,
            "price_size" => $this->currencyService->getPriceSizeFromDB((int)$house->price, (int)$house->size),
            "price" => $this->currencyService->getPriceFromDB($house->price),
            "min_price" => is_countable($objects) ? $min_price : 0,
            "price_code" => $house->price_code,
            "description" => $house->description,
            "description_en" => $house->description_en,
            "description_tr" => $house->description_tr,
            "lat" => $house->lat,
            "long" => $house->long,
            "citizenship" => $house->citizenship,
            "photo" => $house->photo,
            "status" => $house->status,
            "disposition" => $house->disposition,
            "disposition_en" => $house->disposition_en,
            "disposition_tr" => $house->disposition_tr,
            "created_at" => $house->created_at,
            "updated_at" => $house->updated_at,
            "parking" => $house->parking,
            "vnj" => $house->vnj,
            "commissions" => $house->commissions,
            "cryptocurrency" => $house->cryptocurrency,
            "owner" => $house->owner,
            "grajandstvo" => $house->grajandstvo,
            "complex_or_not" => $house->complex_or_not,
            "objects" => $house->objects,
            "gostinnie" => !empty($house->peculiarities->whereIn('type', "Гостиные")->first()) ? $house->peculiarities->whereIn('type', "Гостиные")->first()->name : null,
            "vanie" => !empty($house->peculiarities->whereIn('type', "Ванные")->first()) ? $house->peculiarities->whereIn('type', "Ванные")->first()->name : null,
            "spalni" => !empty($house->peculiarities->whereIn('type', "Спальни")->first()) ? $house->peculiarities->whereIn('type', "Спальни")->first()->name : null,
            "do_more" => !empty($house->peculiarities->whereIn('type', "До моря")->first()) ? $house->peculiarities->whereIn('type', "До моря")->first()->name : null,
            "type_vid" => !empty($house->peculiarities->whereIn('type', "Вид")->first()) ? $house->peculiarities->whereIn('type', "Вид")->first()->name : null,
            "peculiarities" => !empty($house->peculiarities->whereIn('type', "Особенности")->all()) ? $house->peculiarities->whereIn('type', "Особенности")->all() : null,
            "favorite" => $house->favorite,
        ]);
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
