<?php


namespace App\Services;


use App\Models\ExchangeRate;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class GeocodingService
{
    /**
     * @param $address
     * [0] - long, [1] - lat
     * @return false|string[]
     */
    public function coordinatesFromAddress($address)
    {
        $ch = curl_init('https://geocode-maps.yandex.ru/1.x/?apikey=3337b512-9d91-4719-98bf-a2c8df5832ad&format=json&geocode=' . urlencode($address));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($res, true);
        Log::info($res);
        if (isset($res['response']['GeoObjectCollection']['featureMember'][0])) {
            $coordinates = $res['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
            $coordinates = explode(' ', $coordinates);
        } else {
             $coordinates = [null, null];
        }

        return [
            'lat'  => $coordinates[1],
            'long' => $coordinates[0]
        ];
    }

    public function generateAddress($data)
    {
        $tmp_address = '';
        if ($data['tr_geo_il_name']) {
            $tmp_address .= $data['tr_geo_il_name'];
        }

        if ($data['tr_geo_ilce_name']) {
            $tmp_address .= ', '. $data['tr_geo_ilce_name'];
        }

        if ($data['tr_geo_semt_name']) {
            $tmp_address .= ', '. $data['tr_geo_semt_name'];
        }

        if ($data['tr_geo_mahalle_name']) {
            $tmp_address .= ', '. $data['tr_geo_mahalle_name'];
        }

        if ($data['name']) {
            $tmp_address .= ', '. $data['name'];
        }

        return $tmp_address;
    }

    public function getCoordinates($data, $city = null)
    {
        $coordinates = ['lat' => null, 'long' => null];
        if ((is_null($data['lon']) || is_null($data['lat']))) {
            $tmp_address = $this->generateAddress($data);
            $coordinates = $this->coordinatesFromAddress($tmp_address);

            if (is_null($coordinates['lat']) && is_null($coordinates['long'])) {
                if (!is_null($city)) {
                    $i = 0;
                    do {
                        dump($i);
                        $coordinates['lat'] = $city->lat + (rand(0,2000) - 1000) / 1000000;
                        $coordinates['long'] = $city->long + (rand(0,2000) - 1000) / 1000000;
                        $i++;
                    } while (!is_null(Product::withTrashed()->where('lat', $coordinates['lat'])->where('long', $coordinates['long'])->first()) || $i > 5);
                }
            } else {
                if (!is_null($city)) {
                    if (!is_null(Product::withTrashed()->where('lat', $coordinates['lat'])->where('long', $coordinates['long'])->first())) {
                        $i = 0;
                        while (!is_null(Product::withTrashed()->where('lat', $coordinates['lat'])->where('long', $coordinates['long'])->first()) || $i > 4) {
                            dump($i);
                            $coordinates['lat'] = $city->lat + (rand(0, 2000) - 1000) / 1000000;
                            $coordinates['long'] = $city->long + (rand(0, 2000) - 1000) / 1000000;
                            $i++;
                        }
                    }
                }
            }
            unset($tmp_address);
        } else {
            $coordinates = [
                'lat' => $data['lat'],
                'long' => $data['lon']
            ];
        }
        return $coordinates;
    }
}
