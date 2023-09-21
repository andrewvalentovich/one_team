<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\House\FilterRequest;
use App\Models\CountryAndCity;
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
                "price_size" => $this->getPriceSize((int)$row->price, (int)$row->size, $row->price_code),
                "price" => $this->getCurrencyPrice($row->price, $row->price_code),
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

        $location = [];
        if(isset($data['city_id'])) {
            $location = CountryAndCity::where('id', $data['city_id'])->get()->transform(function ($row) {
                $name = 'name_'.App::currentLocale();
                return [
                    'id' => $row->id,
                    'lat' => $row->lat,
                    'long' => $row->long,
                    'name' => (App::currentLocale() === 'ru') ? $row->name : $row[$name],
                ];
            });
        } elseif(isset($data['country'])) {
            $location = CountryAndCity::where('id', $data['country'])->get()->transform(function ($row) {
                $name = 'name_'.App::currentLocale();
                return [
                    'id' => $row->id,
                    'lat' => $row->lat,
                    'long' => $row->long,
                    'name' => (App::currentLocale() === 'ru') ? $row->name : $row[$name],
                ];
            });
        }
        $custom = collect(['location' => $location]);
        $data = $custom->merge($houses);

        return response()->json($data);
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
                'image' => count($row->photo) > 0 ? '/uploads/'.$row->photo[0]->photo : null,
            ];
        });

        return response()->json($houses);
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

    private function getCurrencyPrice(int $price, string $price_code = null): array
    {
        if(is_null($price_code) || $price_code === "") {
            $price_code = "EUR";
        }

        $price_array = [
            "RUB" => number_format(($price_code === "RUB") ? $price : ($price / $this->exchanges[$price_code]), 0, '.', ' ')." ₽",
            "USD" => number_format(($price_code === "RUB") ? $price * $this->exchanges['USD'] : $price / $this->exchanges[$price_code] * $this->exchanges['USD'], 0, '.', ' ')." $",
            "EUR" => number_format(($price_code === "RUB") ? $price * $this->exchanges['EUR'] : $price / $this->exchanges[$price_code] * $this->exchanges['EUR'], 0, '.', ' ')." €",
            "TRY" => number_format(($price_code === "RUB") ? $price * $this->exchanges['TRY'] : $price / $this->exchanges[$price_code] * $this->exchanges['TRY'], 0, '.', ' ')." ₺",
        ];

        return $price_array;
    }

    private function getPriceSize(int $price, int $size = 0, string $price_code = null): array
    {
        if(is_null($price_code) || $price_code === "") {
            $price_code = "EUR";
        }

        return [
            "RUB" => number_format(ceil(($price_code === "RUB") ? $price : ($price / $this->exchanges[$price_code]) / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." ₽",
            "USD" => number_format(ceil(($price_code === "RUB") ? $price * $this->exchanges['USD'] : $price / $this->exchanges[$price_code] * $this->exchanges['USD'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." $",
            "EUR" => number_format(ceil(($price_code === "RUB") ? $price * $this->exchanges['EUR'] : $price / $this->exchanges[$price_code] * $this->exchanges['EUR'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." €",
            "TRY" => number_format(ceil(($price_code === "RUB") ? $price * $this->exchanges['TRY'] : $price / $this->exchanges[$price_code] * $this->exchanges['TRY'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." ₺",
        ];
    }
}
