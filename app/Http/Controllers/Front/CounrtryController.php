<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;
use App\Models\Product;
use DB;

class CounrtryController extends Controller
{
    private $exchanges = [];

    public function country($id){
        // Получаем массив с кодом валюты и коэффициентом
        $this->exchanges = $this->getExchanges();

        $get = CountryAndCity::where('parent_id', $id)->withCount('product_city')->orderby('product_city_count','DESC')->get();

        $country = CountryAndCity::where('id', $id)->first();

//        $count = DB::table('country_and_cities')->distinct()->leftJoin('products', function($join){
//            $join->on('products.city_id', '=', 'country_and_cities.id');
//        })->get();

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
                $min_price = 9999999999;

                if (isset($row->objects) && count(json_decode($row->objects)) > 0) {
                    foreach (json_decode($row->objects) as $object) {

                        // Формируем новое поле price_size
                        $price_code = isset($row->price_code) ? $row->price_code : null;
                        $object->price_size = $this->getPriceSize((int)$object->price, (int)$object->size, $price_code);

                        // Меняем цену
                        $price = $object->price;
                        $object->price = $this->getCurrencyPrice($price, $price_code);
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
                        $min_price = $this->getCurrencyPrice($price_array[0][0], isset($price_array[1][0]) ? $price_array[1][0] : "EUR");
                    } else {
                        $i = 0;
                        foreach ($price_array[0] as $key => $price) {
                            $min_price_arr[$key] = $this->getCurrencyPrice($price, $price_array[1][$key] ?? "EUR");
                            if ($i === 0) {
                                $min_price = (int) str_replace(" ", "", $min_price_arr[$key]["EUR"]);
                            } else {
                                $min_price = (int) str_replace(" ", "", $min_price_arr[$key]["EUR"]) < (int) str_replace(" ", "", $min_price) ? (int) str_replace(" ", "", $min_price_arr[$key]["EUR"]) : (int) str_replace(" ", "", $min_price);
                            }

                            $i++;
                        }

                        $min_price = $this->getCurrencyPrice($min_price, "EUR");
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
                    $sort = $this->quicksort($layouts_sort_arr);

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

                $row->price = $this->getCurrencyPrice($row->price, $row->price_code);
                $row->price_size = $this->getPriceSize((int)$row->price, (int)$row->size, $row->price_code);

                return $row;
            });
        return view('project.country', compact('get','country', 'citizenship_product', 'count'));
    }

    private function getExchanges(): array
    {
        // Получаем валюту
        $exchange_rates = ExchangeRate::where('direct', 'RUB')->get();
        $exchanges = [];

        // Преобразуем в массив вида - ["EUR" => 2.24]
        foreach ($exchange_rates as $exchange_rate) {
            $exchanges[$exchange_rate->relative] = $exchange_rate->value;
        }

        return $exchanges;
    }

    private function getCurrencyPrice(int $price = null, string $price_code = null): array
    {
        if(is_null($price_code) || $price_code === "") {
            $price_code = "EUR";
        }

        if(is_null($price)) {
            return [
                "RUB" => "0",
                "USD" => "0",
                "EUR" => "0",
                "TRY" => "0",
            ];
        }

        return [
            "RUB" => number_format(($price_code === "RUB") ? $price : ($price / $this->exchanges[$price_code]), 0, '.', ' '),
            "USD" => number_format(($price_code === "RUB") ? $price * $this->exchanges['USD'] : $price / $this->exchanges[$price_code] * $this->exchanges['USD'], 0, '.', ' '),
            "EUR" => number_format(($price_code === "RUB") ? $price * $this->exchanges['EUR'] : $price / $this->exchanges[$price_code] * $this->exchanges['EUR'], 0, '.', ' '),
            "TRY" => number_format(($price_code === "RUB") ? $price * $this->exchanges['TRY'] : $price / $this->exchanges[$price_code] * $this->exchanges['TRY'], 0, '.', ' '),
        ];
    }

    private function getPriceSize(int $price, int $size = 0, string $price_code = null): array
    {
        if(is_null($price_code) || $price_code === "") {
            $price_code = "EUR";
        }

        return [
            "RUB" => number_format(ceil(($price_code === "RUB") ? $price : ($price / $this->exchanges[$price_code]) / (($size) < 1 ? 1 : $size)), 0, '.', ' '),
            "USD" => number_format(ceil(($price_code === "RUB") ? $price * $this->exchanges['USD'] : $price / $this->exchanges[$price_code] * $this->exchanges['USD'] / (($size) < 1 ? 1 : $size)), 0, '.', ' '),
            "EUR" => number_format(ceil(($price_code === "RUB") ? $price * $this->exchanges['EUR'] : $price / $this->exchanges[$price_code] * $this->exchanges['EUR'] / (($size) < 1 ? 1 : $size)), 0, '.', ' '),
            "TRY" => number_format(ceil(($price_code === "RUB") ? $price * $this->exchanges['TRY'] : $price / $this->exchanges[$price_code] * $this->exchanges['TRY'] / (($size) < 1 ? 1 : $size)), 0, '.', ' '),
        ];
    }

    private function quicksort($arr)
    {
        if (count($arr) < 2) {
            return $arr;
        } else {
            $pivot = $arr[0];
            $less = [];
            $greater = [];
            for ($i = 1; $i < count($arr); $i++) {
                if ($arr[$i] <= $pivot) {
                    array_push($less, $arr[$i]);
                }
                if ($arr[$i] > $pivot) {
                    array_push($greater, $arr[$i]);
                }
            }
            return array_merge($this->quicksort($less), [$pivot], $this->quicksort($greater));
        }
    }
}
