<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\House\FilterRequest;
use App\Models\ExchangeRate;
use App\Models\Product;
use App\Models\Peculiarities;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    private $exchanges = [];
    private $peculiarities = [];

    public function __construct()
    {
        // Получаем массив с кодом валюты и коэффициентом
        $this->exchanges = $this->getExchanges();
        $this->peculiarities = Peculiarities::all();
    }

    public function getByCoordinatesWithFilter(FilterRequest $request)
    {
        $locale = App::currentLocale();
        $data = $request->validated();
        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data]);
        $houses = Product::filter($filter)->with('photo')->with('peculiarities')->with(['favorite' => function ($query) use ($data) {
            $query->where('user_id', isset($data['user_id']) ? $data['user_id'] : time());
        }])->paginate(10)->through(function ($row) {
            $objects = [];
            if (isset($row->objects)) {
                foreach (json_decode($row->objects) as $object) {
                    // Формируем новое поле price_size
                    $object->price_size = $this->getPriceSize((int)$object->price, (int)$object->size);

                    // Меняем цену
                    $price = $object->price;
                    $object->price = $this->getCurrencyPrice($price);
                    unset($price);

                    // Присваиваем объект временной переменой
                    $objects[] = $object;
                }

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
                "price_size" => $this->getPriceSize((int)$row->price, (int)$row->size),
                "price" => $this->getCurrencyPrice($row->price),
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
        $locale = App::currentLocale();
        $data = $request->validated();
        // Фильтр элементов
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data]);
        $houses = Product::filter($filter)->with('photo')->with('peculiarities')->get()->transform(function ($row) {
            return [
                'id' => $row->id,
                'coordinate' => $row->lat.','.$row->long,
                "price" => $this->getCurrencyPrice($row->price),
                "vanie" => !empty($row->peculiarities->whereIn('type', "Ванные")->first()) ? $row->peculiarities->whereIn('type', "Ванные")->first()->name : null,
                "spalni" => !empty($row->peculiarities->whereIn('type', "Спальни")->first()) ? $row->peculiarities->whereIn('type', "Спальни")->first()->name : null,
                'kv' => $row->size,
                'address' => $row->address,
                'image' => config('app.url').'uploads/'.$row->photo[0]->photo,
            ];
        });

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
            "TRY" => number_format($price * $this->exchanges['TRY'], 0, '.', ' ')." ₺",
        ];
    }

    private function getPriceSize(int $price, int $size = 0): array
    {
        return [
            "EUR" => number_format(ceil($price / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." €",
            "USD" => number_format(ceil($price * $this->exchanges['USD'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." $",
            "RUB" => number_format(ceil($price * $this->exchanges['RUB'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." ₽",
            "TRY" => number_format(ceil($price * $this->exchanges['TRY'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." ₺",
        ];
    }
}
