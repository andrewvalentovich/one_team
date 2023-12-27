<?php


namespace App\Services\API\CRM;


use App\Models\Peculiarities;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoriesService
{
    /**
     * Get categories
     *
     * @param $data
     * @return array
     */
    public function get($data)
    {
        $category_ids = [];

        // Вид
        $category_ids[$this->getToSea($data['to_sea'])] = 'До моря';

        // Особенности
        $peculiarities = [];
        foreach ($data['internal_features'] as $feature) {
            $peculiarities[] = $feature;
        }
        foreach ($data['external_features'] as $feature) {
            $peculiarities[] = $feature;
        }
        foreach ($data['nearliness'] as $feature) {
            $peculiarities[] = $feature;
        }
        foreach ($data['transportation'] as $feature) {
            $peculiarities[] = $feature;
        }

        // id => type
        $getPeculiarities = $this->getPeculiarities();
        foreach ($peculiarities as $i => $name) {
            if (key_exists($name, $getPeculiarities)) {
                $category_ids[$getPeculiarities[$name]] = 'Особенности';
            }
        }

        // Тип недвижимости
        $type = $this->getTypes();
        if (isset($data['type'])) {
            $category_ids[$type[$data['type']]] = 'Типы';
        } else {
            // Получим тип первой планировки данного комплекса
            $tmp_type = $this->getComplexObjectType($data['id']);

            if ($tmp_type) {
                $category_ids[$type[$tmp_type]] = 'Типы';
            } else {
                $category_ids[$type['apartment']] = 'Типы';
            }

            unset($tmp_type);
        }

        // Вид
        $tmpViews = isset($data['view']) ? $data['view'] : null;
        $views = !is_null($tmpViews) ? $this->getView($tmpViews) : null;
        unset($tmpViews);
        if (!is_null($views)) {
            foreach ($views as $i => $view) {
                $category_ids[$view['id']] = $view['type'];
            }
        }

        // Спальни
        $bedrooms = 'Спальни';
        if (isset($data['number_bedrooms'])) {
            if (!is_null($data['number_bedrooms']) && $data['number_bedrooms'] != 0) {
                $category_ids[$this->getRooms($bedrooms, $data['number_bedrooms'])] = $bedrooms;
            }
        }

        // Ванные
        $bathrooms = 'Ванные';
        if (isset($data['number_bathrooms'])) {
            if (!is_null($data['number_bedrooms']) && $data['number_bedrooms'] != 0) {
                $category_ids[$this->getRooms($bathrooms, $data['number_bathrooms'])] = $bathrooms;
            }
        }

        return $category_ids;
    }



    /**
     * Add categories
     *
     * @param $data
     * @param $complex_id
     */
    public function add($data, $complex_id)
    {
        $categories = $this->get($data);
        foreach ($categories as $id => $type) {
            ProductCategory::create([
                "product_id"        => $complex_id,
                "peculiarities_id"  => $id,
                "type"              => $type,
                "created_at"        => date('Y-m-d H:i:s', strtotime("now")),
                "updated_at"        => date('Y-m-d H:i:s', strtotime("now"))
            ]);
        }
        unset($categories);
    }

    /**
     * Update categories - remove old, add new
     *
     * @param $data
     * @param $complex_id
     */
    public function update($data, $complex_id)
    {
        // Обновление категорий
        $categories = ProductCategory::where('product_id', $complex_id)->get();
        foreach ($categories as $key => $category) {
            $category->delete();
        }

        $categories = $this->get($data);
        foreach ($categories as $id => $type) {
            ProductCategory::create([
                "product_id"        => $complex_id,
                "peculiarities_id"  => $id,
                "type"              => $type,
                "created_at"        => date('Y-m-d H:i:s', strtotime("now")),
                "updated_at"        => date('Y-m-d H:i:s', strtotime("now"))
            ]);
        }
        unset($categories);
    }

    public function getTypes()
    {
        $types = Peculiarities::where('type', 'Типы')->get();

        return [
            'apartment'  => $types->where('slug', 'apartments')->first()->id,
            'house'      => $types->where('slug', 'houses')->first()->id,
            'land'       => null,
            'hotel'      => null,
            'commercial' => null
        ];
    }

    public function getPeculiarities()
    {
        $types = Peculiarities::where('type', 'Особенности')->get();

        $tmpArray = [];
        foreach ($types as $type) {
            $tmpArray[str_replace('-', '_', $type->slug)] = $type->id;
        }

        return $tmpArray;
    }

    public function getView(array $value)
    {
        $types = Peculiarities::query()->select('id', 'slug')->where('type', 'Вид');

        foreach($value as $view){
            $types->orWhereRaw('LOWER(`slug`) LIKE ? ',['%'.$view.'%']);
        }

        $types->get()->toArray();

        return $types;
    }

    public function getToSea($value) : mixed
    {
        $to_sea = Peculiarities::where('type', 'До моря')->get();
        $tmpCategoryId = null;
        $up_to = [];
        $more = [];

        foreach ($to_sea as $item) {
            if ($item->name === "Первая линия") {
                // За первую линию принимаем расстояние составляюещее не более 100 метров
                $up_to[$item->id] = 100;
            }

            $toPos = stripos($item->name, 'До');
            if ($toPos !== false) {
                $tmpSubstr = explode(" ", mb_substr($item->name, $toPos + 3, iconv_strlen($item->name) - $toPos - 3));

                if ($tmpSubstr[1] === "км") {
                    $tmpSubstr[0] = (int)$tmpSubstr[0] * 1000;
                } else {
                    $tmpSubstr[0] = (int)$tmpSubstr[0];
                }

                $up_to[$item->id] = $tmpSubstr[0];

                unset($tmpSubstr);
            }

            $morePos = stripos($item->name, 'Более');
            if ($morePos !== false) {
                $tmpSubstr = explode(" ", mb_substr($item->name, $morePos + 6, iconv_strlen($item->name) - $morePos - 6));

                if ($tmpSubstr[1] === "км") {
                    $tmpSubstr[0] = (int)$tmpSubstr[0] * 1000;
                } else {
                    $tmpSubstr[0] = (int)$tmpSubstr[0];
                }

                $more[$item->id] = $tmpSubstr[0];

                unset($tmpSubstr);
            }
        }

        asort($up_to);
        arsort($more);

        foreach ($up_to as $i => $el) {
            if ($value <= $el) {
                $tmpCategoryId = $i;
                break;
            }
        }

        if ($tmpCategoryId === null) {
            foreach ($more as $i => $el) {
                if ($value >= $el) {
                    $tmpCategoryId = $i;
                    break;
                }
            }
        }

        return $tmpCategoryId;
    }

    public function getRooms($type, $value) : int
    {
        $bedrooms = Peculiarities::where('type', $type)->get();
        $tmpArr = [];
        $tmpCategoryId = null;

        foreach ($bedrooms as $item) {
            if ($item->slug === "Doesn't matter") {
                continue;
            }

            $tmpArr[$item->id] = (int)$item->name;
        }

        arsort($tmpArr);

        if ($tmpCategoryId === null) {
            foreach ($tmpArr as $i => $el) {
                if ($value >= $el) {
                    $tmpCategoryId = $i;
                    break;
                }
            }
        }

        unset($tmpArr);
        return $tmpCategoryId;
    }

    public function getComplexObjectType($complex_id)
    {
        $type = null;

        try {
            $client = new \GuzzleHttp\Client(['headers' => [
                'Authorization' => 'Bearer wjP0OxkzUPx0KG9wIkyQrS15BT3FvoVt',
                'Accept' => 'application/json',
                'Content-type' => 'application/json'
            ]]);

            $guzzleResponse = $client->get('https://crm.one-team.pro/api/external/properties?token=wjP0OxkzUPx0KG9wIkyQrS15BT3FvoVt&complex_id=' . $complex_id);

            // Логирование статуса ответа
            Log::info(Carbon::now()." Get complexes data from API " . $guzzleResponse->getStatusCode());

            if($guzzleResponse->getStatusCode() == 200) {
                $response = json_decode($guzzleResponse->getBody(), true);

                if (!empty($response)) {
                    $type = $response[0]['type'];
                }
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }

        return $type;
    }
}

