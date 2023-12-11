<?php


namespace App\Services;


use App\Models\CountryAndCity;
use App\Models\ExchangeRate;
use App\Models\Locale;
use App\Models\Peculiarities;

class UrlParametersService
{
    const PECULIARITIES_KEYS = [
        'Типы' => 'type',
        'Спальни' => 'bedrooms',
        'Ванные' => 'bathrooms',
        'Особенности' => 'peculiarities',
        'Вид' => 'view',
        'До моря' => 'to_sea',
    ];

    public function validateParams(string $params_string)
    {
        $validate_array = [];
        $categories_array = explode('/', $params_string);

        $peculiarities = Peculiarities::select('id', 'slug', 'type')->get();
        $regions = CountryAndCity::select('id', 'slug', 'parent_id')->get();

        $locale = Locale::where('code', request()->segment(1))->first();
        if ($locale) {
            $validate_array['locale'] = $locale->code;
        }

        // Собираем валюту
        $currency = ExchangeRate::get('relative');
        $currency[] = collect(['relative' => 'RUB']);

        foreach ($categories_array as $key => $value) {
            // Проверка цены
            if (stripos($value, 'price') !== false) {
                $tmp_price = explode('-', $value);
                if (stripos($tmp_price[0], 'min') !== false) {
                    $validate_array['price']['min'] = intval($tmp_price[1]);
                } else {
                    $validate_array['price']['max'] = intval($tmp_price[1]);
                }
                unset($tmp_price);
                continue;
            }

            // Проверка валюты
            $is_currency = $currency->where('relative', strtoupper($value))->first();
            if ($is_currency) {
                $validate_array['price']['currency'] = strtoupper($value);
                unset($is_currency);
                continue;
            }

            // Проверка размеров
            if (stripos($value, 'size') !== false) {
                $tmp_size = explode('-', $value);
                if (stripos($tmp_size[0], 'min') !== false) {
                    $validate_array['size']['min'] = intval($tmp_size[1]);
                } else {
                    $validate_array['size']['max'] = intval($tmp_size[1]);
                }
                unset($tmp_size);
                continue;
            }

            // Проверка на от застройщика
            if (stripos($value, 'new') !== false) {
                $validate_array['is_secondary'] = 0;
                continue;
            }

            // Проверка на вторичку
            if (stripos($value, 'secondary') !== false) {
                $validate_array['is_secondary'] = 1;
                continue;
            }

            // Проверка на покупку-продажу
            if (stripos($value, 'sale') !== false) {
                $validate_array['sale_or_rent'] = 'sale';
                continue;
            }

            // Проверка на покупку-продажу
            if (stripos($value, 'buy') !== false) {
                $validate_array['sale_or_rent'] = 'sale';
                continue;
            }

            // Проверка на аренду
            if (stripos($value, 'rent') !== false) {
                $validate_array['sale_or_rent'] = 'rent';
                continue;
            }

            // Проверка на order_by
            if (stripos($value, 'first') !== false) {
                $validate_array['order_by'] = $value;
                continue;
            }

            // Проверка на город или страну
            $is_region = $regions->where('slug', $value)->first();
            if ($is_region) {
                if ($is_region->parent_id) {
                    $validate_array['city'] = $is_region->slug;
                } else {
                    $validate_array['country'] = $is_region->slug;
                }
                unset($is_region);
                continue;
            }
            unset($is_region);

            // Проверка на особенность
            $is_peculiarity = $peculiarities->where('slug', $value)->first();
            if ($is_peculiarity) {
                if ($is_peculiarity->type == 'Особенности') {
                    $validate_array[self::PECULIARITIES_KEYS[$is_peculiarity->type]][] = $value;
                } else {
                    $validate_array[self::PECULIARITIES_KEYS[$is_peculiarity->type]] = $value;
                }
                unset($is_peculiarity);
                continue;
            }
            unset($is_peculiarity);
        }

        return $validate_array;
    }
}
