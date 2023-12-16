<?php


namespace App\Services\API\CRM;


use App\Models\CountryAndCity;
use App\Models\Product;
use App\Services\CurrencyService;
use App\Services\GeocodingService;

class ValidateDataService
{
    private $geocodingService;
    private $currencyService;

    public function __construct(
        CurrencyService $currencyService,
        GeocodingService $geocodingService
    )
    {
        $this->currencyService = $currencyService;
        $this->geocodingService = $geocodingService;
    }

    /**
     * Validate all parameters for complex and return array with it (params)
     *
     * @param $data
     * @return array
     */
    public function handleComplex($data, $method_name = null) : array
    {
        // Id страны
        $country = CountryAndCity::select('id')->whereNull('parent_id')->where('name', $data['country_name'])->firstOr(function () {
            return null;
        });
        $country_id = is_null($country) ? null : $country->id;

        // Id города
        $city = CountryAndCity::select('id')->whereNotNull('parent_id')->where('name', $data['city_name'])->firstOr(function () {
            return null;
        });
        $tmp_city = null;

        if (is_null($city)) {
            if ($data['tr_geo_ilce_name'] == 'SERİK') {
                if (isset(CountryAndCity::where('name', 'Серик')->first()->id)) {
                    $tmp_city = CountryAndCity::where('name', 'Серик')->first();
                }
            } elseif ($data['tr_geo_ilce_name'] == 'SERIK') {
                if (isset(CountryAndCity::where('name', 'Серик')->first()->id)) {
                    $tmp_city = CountryAndCity::where('name', 'Серик')->first();
                }
            } elseif ($data['tr_geo_ilce_name'] == 'KEMER') {
                if (isset(CountryAndCity::where('name', 'Кемер')->first()->id)) {
                    $tmp_city = CountryAndCity::where('name', 'Кемер')->first();
                }
            } elseif ($data['tr_geo_ilce_name'] == 'GAZIPAŞA') {
                if (isset(CountryAndCity::where('name', 'Газипаша')->first()->id)) {
                    $tmp_city = CountryAndCity::where('name', 'Газипаша')->first();
                }
            } elseif ($data['tr_geo_ilce_name'] == 'KAŞ') {
                if (isset(CountryAndCity::where('name', 'Каш')->first()->id)) {
                    $tmp_city = CountryAndCity::where('name', 'Каш')->first();
                }
            } elseif ($data['tr_geo_ilce_name'] == 'FINIKE') {
                if (isset(CountryAndCity::where('name', 'Финике')->first()->id)) {
                    $tmp_city = CountryAndCity::where('name', 'Финике')->first();
                }
            } elseif ($data['tr_geo_ilce_name'] == 'ALANYA') {
                if (CountryAndCity::where('name', 'Аланья')->first()) {
                    $tmp_city = CountryAndCity::where('name', 'Аланья')->first();
                }
            } elseif ($data['tr_geo_il_name'] == 'ANTALYA') {
                if (CountryAndCity::where('name', 'Анталия')->first()) {
                    $tmp_city = CountryAndCity::where('name', 'Анталия')->first();
                }
            }
        } else {
            $tmp_city = $city;
        }

        // Адресс
        $address = !is_null($data['tr_geo_il_name']) ? $data['tr_geo_il_name'] : '';
        $address .= !is_null($data['tr_geo_ilce_name']) ? '/' . $data['tr_geo_ilce_name'] : '';

        // Координаты
        $coordinates = ['lat' => null, 'long' => null];
        $object = Product::select('id', 'lat', 'long')->where('id_in_crm', $data['id'])->first();

        if (!is_null($object)) {
            if (is_null($object->lat) || is_null($object->long)) {
                $coordinates = $this->geocodingService->getCoordinates($data, true, $tmp_city);
            } else {
                $coordinates['lat'] = $object->lat;
                $coordinates['long'] = $object->long;
            }
        } else {
            $coordinates = $this->geocodingService->getCoordinates($data, $method_name === 'create', $tmp_city);
        }

        // Гражданство и ВНЖ
        $citizenship = '';
        $residence_permit = '';
        if (isset($data['suitable_for'])) {
            $citizenship = in_array('citizenship', $data['suitable_for']) ? 'Да' : 'Нет';
            $residence_permit = in_array('residence_permit', $data['suitable_for']) ? 'Да' : 'Нет';
        }

        // Паркинг
        $parking = "";
        if (isset($data['accessible_housing'])) {
            $parking = in_array('parking_place', $data['accessible_housing']) ? 'Да' : 'Нет';
        }

        // Тип сделки
        $deal_type = null;
        if (isset($data['deal_type'])) {
            $deal_type = ($data['deal_type'] === 'sell') ? 'sale' : 'rent';
        } else {
            $deal_type = 'sale';
        }

        // Цена и код валюты
        $base_price = null;
        $price = isset($data['price']) ? $data['price'] : null;
        $price_currency = isset($data['price_currency']) ? $data['price_currency'] : null;
        if (isset($data['price']) && !is_null($data['price'])) {
            $base_price = $this->currencyService->convertPriceToEur($price, $price_currency);
        }

        // complex_or_not
        $complex_or_not = 'Нет';
        if (isset($data['complex']['name'])) {
            $complex_or_not = is_null($data['complex']['name']) ? 'Нет' : 'Да';
        } else {
            $complex_or_not = $data['seller_type'] == 'builder' ? 'Да' : 'Нет';
        }

        $is_commercial = 0;
        if (isset($data['type'])) {
            $is_commercial = $data['type'] == 'commercial' ? 1 : 0;
        }

        return [
            'country_id'        => $country_id ?? null,
            'city_id'           => $tmp_city->id ?? null,
            'name'              => $data['name'] ?? null,
            'address'           => $address ?? null,
            'size'              => $data['living_size'] ?? null,
            'size_home'         => $data['total_size'] ?? null,
            'base_price'        => $base_price,
            'price'             => $price,
            'price_code'        => $price_currency,
            'description'       => $data['description'] ?? null,
            'lat'               => $coordinates['lat'] ?? null,
            'long'              => $coordinates['long'] ?? null,
            'citizenship'       => $citizenship ?? null,
            'grajandstvo'       => $citizenship ?? null,
            'status'            => null,
            'disposition'       => $data['disposition'] ?? null,
            'parking'           => $parking,
            'vnj'               => $residence_permit,
            'sale_or_rent'      => $deal_type,
            'complex_or_not'    => $complex_or_not,
            'video'             => null,
            'is_secondary'      => $data['seller_type'] == "builder" ? 0 : 1,
            'is_commercial'     => $is_commercial,
            'id_in_crm'         => $data['id']
        ];
    }
}

