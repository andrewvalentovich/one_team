<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\House\FilterRequest;
use App\Models\ExchangeRate;
use App\Models\Product;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    private $exchanges = [];

    public function __construct()
    {
        // Получаем массив с кодом валюты и коэффициентом
        $this->exchanges = $this->getExchanges();
    }

    public function getByCoordinatesWithFilter(FilterRequest $request)
    {
        $data = $request->validated();

        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data]);
        $houses = Product::filter($filter)->with('gostinnie')->with('vanie')->with('spalni')->with('do_more')->with('type_vid')->with('photo')->with(['favorite' => function ($query) use ($data) {
            $query->where('user_id', $data['user_id']);
        }])->transform(
            
        )->paginate(10);

        // Преобразование цены для записей и поля объекты
//        foreach ($houses as $house) {
//            $price = $house['price'];
//            $objects = [];
//
//            // Формируем новое поле price_size
//            $house['price_size'] = $this->getPriceSize($house['price'], (int) $house['size']);
//
//            // Кладём массив с валютой
//            $house['price'] = $this->getCurrencyPrice($price);
//            unset($price);
//
//
//            // Если у записи есть объекты
//            if(isset($house->objects)) {
//                foreach (json_decode($house->objects) as $object) {
//                    // Формируем новое поле price_size
//                    $object->price_size = $this->getPriceSize((int) $object->price, (int) $object->size);
//
//                    // Меняем цену
//                    $price = $object->price;
//                    $object->price = $this->getCurrencyPrice($price);
//                    unset($price);
//
//                    // Присваиваем объект временной переменой
//                    $objects[] = $object;
//                }
//                $house['objects'] = json_encode($objects, JSON_UNESCAPED_UNICODE);
//                unset($objects);
//            }
//        }

        return response()->json($houses);
    }

    private function getExchanges(): array
    {
        // Получаем валюту
        $exchange_rates = ExchangeRate::where('direct_val', 'EUR')->get();
        $exchanges = [];

        // Преобразуем в массив вида - ["EUR" => 2.24]
        foreach ($exchange_rates as $exchange_rate) {
            $exchanges[$exchange_rate->relative_val] = $exchange_rate->sell_val;
        }

        return $exchanges;
    }

    private function getCurrencyPrice(int $price): array
    {
        return [
            "EUR" => number_format($price, 0, '.', ' ')." €",
            "USD" => number_format($price * $this->exchanges['USD'], 0, '.', ' ')." $",
            "RUB" => number_format($price * $this->exchanges['RUB'], 0, '.', ' ')." ₽",
            "TRY" => number_format($price * $this->exchanges['TRY'], 0, '.', ' ')." ₤",
        ];
    }

    private function getPriceSize(int $price, int $size = 0): array
    {
        return [
            "EUR" => number_format(ceil($price / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." € / кв.м.",
            "USD" => number_format(ceil($price * $this->exchanges['USD'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." $ / кв.м.",
            "RUB" => number_format(ceil($price * $this->exchanges['RUB'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." ₽ / кв.м.",
            "TRY" => number_format(ceil($price * $this->exchanges['TRY'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." ₤ / кв.м.",
        ];
    }
}
