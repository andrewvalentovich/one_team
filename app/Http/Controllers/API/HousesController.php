<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\House\FilterRequest;
use App\Models\Product;
use App\Models\Peculiarities;
use App\Services\CurrencyService;
use App\Services\SortService;
use Illuminate\Support\Facades\App;

class HousesController extends Controller
{
    private $peculiarities;
    private $currency;
    private $sort;

    public function __construct(CurrencyService $currency, SortService $sort)
    {
        $this->peculiarities = Peculiarities::all();
        $this->currency = $currency;
        $this->sort = $sort;
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

            if (isset($row->objects) && count(json_decode($row->objects)) > 0) {
                foreach (json_decode($row->objects) as $object) {
                    // Формируем новое поле price_size
                    $object->price_size = $this->currency->getPriceSize((int)$object->price, (int)$object->size, $object->price_code);

                    // Меняем цену
                    $price = $object->price;
                    $object->price = $this->currency->getPrice($price, $object->price_code);
                    unset($price);
                    unset($price_code);

                    // Присваиваем объект временной переменой
                    $objects[] = $object;
                }

                // Оставляем только уникальные планировки (1+2, 2+2 и т.д.)
                $layouts = array_unique(array_column(json_decode($row->objects), 'apartment_layout'), SORT_STRING);

                $price_array[0] = array_column(json_decode($row->objects), 'price');
                $price_array[1] = array_column(json_decode($row->objects), 'price_code');

                $min_price_arr = [];
                // Отбор минимальной цены
                if(count($price_array[0]) <= 1) {
                    $min_price = $this->currency->getPrice($price_array[0][0], isset($price_array[1][0]) ? $price_array[1][0] : "EUR");
                } else {
                    $i = 0;
                    foreach ($price_array[0] as $key => $price) {
                        $min_price_arr[$key] = $this->currency->getPrice($price, $price_array[1][$key] ?? "EUR");
                        if ($i === 0) {
                            $min_price = (int) str_replace(" ", "", $min_price_arr[$key]["EUR"]);
                        } else {
                            $min_price = (int) str_replace(" ", "", $min_price_arr[$key]["EUR"]) < (int) str_replace(" ", "", $min_price) ? (int) str_replace(" ", "", $min_price_arr[$key]["EUR"]) : (int) str_replace(" ", "", $min_price);
                        }

                        $i++;
                    }

                    $min_price = $this->currency->getPrice($min_price, "EUR");
                }

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
                $sort = $this->sort->quicksort($layouts_sort_arr);

                // Вывод планировок (1+2, 2+2 и пр.)
                foreach ($sort as $layout) {
                    $layouts_result .= !next($sort) ? implode("+", $layout) : implode("+", $layout) . ", ";
                }
                unset($layouts);


                $row->objects = json_encode($objects, JSON_UNESCAPED_UNICODE);
                unset($objects);
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
                "layouts_count" => !is_null($row->objects) ? count(json_decode($row->objects)) : 0,
                "price_size" => $this->currency->getPriceSize((int)$row->price, (int)$row->size, $row->price_code),
                "price" => $this->currency->getPrice($row->price, $row->price_code),
                "min_price" => !is_null($row->objects) ? $min_price : 0,
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

    public function getAll(FilterRequest $request)
    {
        $data = $request->validated();
        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data]);
        $houses = Product::filter($filter)->with('photo')->with('peculiarities')->get()->transform(function ($row) {
            return [
                'id' => $row->id,
                'coordinate' => $row->lat.','.$row->long,
                "price" => $this->currency->getPrice($row->price),
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
