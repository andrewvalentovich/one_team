<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use App\Services\CurrencyService;
use App\Services\SortService;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;
use App\Models\Product;
use DB;

class CounrtryController extends Controller
{
    private $currencyService;
    private $sortService;

    public function __construct(CurrencyService $currencyService, SortService $sortService)
    {
        $this->currencyService = $currencyService;
        $this->sortService = $sortService;
    }

    public function country($id){

        $get = CountryAndCity::where('parent_id', $id)->withCount('product_city')->orderby('product_city_count','DESC')->get();
        $country = CountryAndCity::where('id', $id)->first();
        $count = CountryAndCity::has('product_city')->get()->count();

        $citizenship_product = Product::where('country_id', $id)
            ->where('grajandstvo','Да')
            ->with('favorite')
            ->has('photo')
            ->inRandomOrder()
            ->limit(10)
            ->get()
            ->transform(function ($row) {
                $objects = [];
                $layouts_result = null;
                $min_price = 0;

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
                    unset($objects);

                    $row->min_price = !is_null($row->objects) ? $min_price : 0;
                    $row->layouts = $layouts_result;
                }

                $row->price_size = $this->currencyService->getPriceSizeFromDB((int)$row->price, (int)$row->size);
                $row->price = $this->currencyService->getPriceFromDB($row->price);
                return $row;
            });

        return view('project.country', compact('get','country', 'citizenship_product', 'count'));
    }
}
