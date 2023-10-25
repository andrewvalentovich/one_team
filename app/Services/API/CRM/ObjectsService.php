<?php


namespace App\Services\API\CRM;


use App\Models\CountryAndCity;
use App\Models\PhotoTable;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\CurrencyService;
use App\Services\ImageService;
use App\Services\PhotoCategoryService;
use App\Services\PreviewImageService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class ObjectsService
{
    private $photoCategories;
    private $previewImageService;
    private $imageService;
    private $ids_in_crm_for_complexes;
    private $categoriesService;
    private $currencyService;

    public function __construct(
        PhotoCategoryService $photoCategoryService,
        PreviewImageService $previewImageService,
        ImageService $imageService,
        CategoriesService $categoriesService,
        CurrencyService $currencyService
    )
    {
        $this->previewImageService = $previewImageService;
        $this->imageService = $imageService;
        $this->photoCategories = $photoCategoryService->getArray();
        $this->categoriesService = $categoriesService;
        $this->currencyService = $currencyService;

        // Получаем все id_in_crm, чтобы сравнить с id полученными из запроса
        $this->ids_in_crm_for_complexes = Product::select('id_in_crm')->whereNotNull('id_in_crm')->get()->transform(function ($row) {
            return $row->id_in_crm;
        })->toArray();
    }

    public function handle($endpoint, $token)
    {
        try {
            $client = new \GuzzleHttp\Client(['headers' => ['Authorization' => 'Bearer ' . $token]]);

            $guzzleResponse = $client->get('https://crm.one-team.pro' . $endpoint . '?token=' . $token);

            // Логирование статуса ответа
            Log::info(Carbon::now()." Get complexes data from API " . $guzzleResponse->getStatusCode());

            if($guzzleResponse->getStatusCode() == 200) {
                $response = json_decode($guzzleResponse->getBody(),true);

                // Если комплекс с текущим id существует в бд, обновляем или удаляем, иначе создаём
                foreach ($response as $index => $complex) {
                    if (in_array($complex['id'], $this->ids_in_crm_for_complexes)) {
                        dump("update or delete");
                        $this->updateOrDelete($complex);
                    } else {
                        dump("create");
                        $this->create($complex);
                    }
                }
            }
        }
        catch(\GuzzleHttp\Exception\RequestException $e) {
            // you can catch here 40X response errors and 500 response errors
            Log::info(Carbon::now() . "Complexes data. Catch API request error with status code - " . $guzzleResponse->getStatusCode());
            Log::info(Carbon::now() . $e->getMessage());
        } catch(Exception $e) {
            // other errors
            Log::info(Carbon::now() . "Complexes data. Catch API request error with status code - " . $guzzleResponse->getStatusCode());
            Log::info(Carbon::now() . $e->getMessage());
        }
    }

    public function updateOrDelete($data)
    {
        $updated_at = $data['updated_at'];

        // Если не удалён объект
        if ($data['deleted_at'] === null) {

            // Если время с момента обновления прошло больше чем 86400 секунд, т.е. 1 день
            if (strtotime('now') - strtotime($updated_at) <= 86400) {
                $this->update($data);
            }
        } else {
            $complex = Product::where('id_in_crm', $data['id'])->firts();
            $complex->delete();
        }
    }

    private function update($data)
    {
        // Получаем фотографии комплекса
        $complexPhotos = $data['photos'];

        // Получаем параметры для создания комплекса
        $complexParams = $this->validateData($data);

        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
        $complex = Product::where('id_in_crm', $data['id'])->first();
        $complex->update($complexParams);

        foreach ($complex->photo as $photo)
        {
            $photo->delete();
        }

        // Обновление категорий
        $categories = ProductCategory::where('product_id', $complex->id)->get();
        foreach ($categories as $key => $category) {
            $category->delete();
        }
        $this->addCategories($data, $complex->id);

        foreach ($complexPhotos as $key => $category) {
            foreach ($category as $index => $photo) {
                $filename = $this->imageService->saveFromRemote($photo);

                PhotoTable::create([
                    'parent_model'=> '\App\Models\Product',
                    'parent_id' => $complex->id,
                    'photo' => $filename,
                    'preview' => $this->previewImageService->update($filename),
                    'category_id' => $this->photoCategories[$key]
                ]);
            }
        }

        return $complex;
    }

    public function create($data)
    {
        // Получаем фотографии комплекса
        $complexPhotos = $data['photos'];
        // Получаем параметры для создания комплекса
        $complexParams = $this->validateData($data);
        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
        $complex = Product::where('id_in_crm', $data['id'])->firstOr(function () use ($complexParams, $complexPhotos, $data) {
            $complex = Product::create($complexParams);

            $this->addCategories($data, $complex->id);

            foreach ($complexPhotos as $key => $category) {
                foreach ($category as $index => $photo) {
                    $filename = $this->imageService->saveFromRemote($photo);

                    PhotoTable::create([
                        'parent_model'=> '\App\Models\Product',
                        'parent_id' => $complex->id,
                        'photo' => $filename,
                        'preview' => $this->previewImageService->update($filename),
                        'category_id' => $this->photoCategories[$key]
                    ]);
                }
            }

            return $complex;
        });

        return $complex;
    }

    /**
     * Validate all parameters for complex and return array with it (params)
     *
     * @param $data
     * @return array
     */
    private function validateData($data) : array
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
        $city_id = is_null($city) ? null : $city->id;

        // Адресс
        $address = !is_null($data['country_name']) ? $data['country_name'] : "";
        $address .= !is_null($data['city_name']) ? ", " . $data['city_name'] : "";
        $address .= !is_null($data['street_name']) ? ", " . $data['street_name'] : "";
        $address .= !is_null($data['house_number']) ? ", " . $data['house_number'] : "";

        // Гражданство и ВНЖ
        $citizenship = "";
        $residence_permit = "";
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
            $deal_type = ($data['deal_type'] === "sell") ? "sale" : "rent";
        }

        // Цена и код валюты
        $price = null;
        $price_currency = isset($data['price_currency']) ? $data['price_currency'] : null;
        if (isset($data['price']) && !is_null($data['price'])) {
            $price = $this->currencyService->convertPriceToEur($data['price'], $price_currency);
        }

        return [
            'country_id'        => $country_id ?? null,
            'city_id'           => $city_id ?? null,
            'name'              => $data['name'] ?? null,
            'address'           => $address ?? null,
            'size'              => $data['living_size'] ?? null,
            'size_home'         => $data['total_size'] ?? null,
            'price'             => $price,
            'price_code'        => $price_currency,
            'description'       => $data['description'] ?? null,
            'description_en'    => $data['description_en'] ?? null,
            'description_tr'    => $data['description_tr'] ?? null,
            'description_de'    => $data['description_de'] ?? null,
            'lat'               => $data['lat'] ?? null,
            'long'              => $data['lon'] ?? null,
            'citizenship'       => $citizenship ?? null,
            'grajandstvo'       => $citizenship ?? null,
            'status'            => null,
            'disposition'       => $data['disposition'] ?? null,
            'disposition_en'    => $data['disposition_en'] ?? null,
            'disposition_tr'    => $data['disposition_tr'] ?? null,
            'disposition_de'    => $data['disposition_de'] ?? null,
            'parking'           => $parking,
            'vnj'               => $residence_permit,
            'sale_or_rent'      => $deal_type,
            'complex_or_not'    => isset($data['complex_name']) ? "Нет" : "Да",
            'video'             => null,
            'is_secondary'      => $data['seller_type'] == "builder" ? 0 : 1,
            'id_in_crm'         => $data['id']
        ];
    }


    private function getCategories($data)
    {
        $category_ids = [];

        // Вид
        $category_ids[$this->categoriesService->getToSea($data["to_sea"])] = 'До моря';

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
        $getPeculiarities = $this->categoriesService->getPeculiarities();
        foreach ($peculiarities as $i => $name) {
            if (key_exists($name, $getPeculiarities)) {
                $category_ids[$getPeculiarities[$name]] = $name;
            }
        }

        // Тип недвижимости
        $type = $this->categoriesService->getTypes();
        $category_ids[$type['apartment']] = "Типы";

        // Вид
        $tmpViews = isset($data['view']) ? $data['view'] : null;
        $views = !is_null($tmpViews) ? $this->categoriesService->getView($tmpViews) : null;
        unset($tmpViews);
        if (!is_null($views)) {
            foreach ($views as $i => $view) {
                $category_ids[$view['id']] = $view['type'];
            }
        }

        // Спальни
        $bedrooms = "Спальни";
        if (isset($data["number_bedrooms"])) {
            $category_ids[$this->categoriesService->getRooms($bedrooms, $data["number_bedrooms"])] = $bedrooms;
        }

        // Спальни
        $bathrooms = "Ванные";
        if (isset($data["number_bathrooms"])) {
            $category_ids[$this->categoriesService->getRooms($bathrooms, $data["number_bathrooms"])] = $bathrooms;
        }

        return $category_ids;
    }

    private function addCategories($data, $complex_id)
    {
        foreach ($this->getCategories($data) as $id => $type) {
            ProductCategory::create([
                "product_id"        => $complex_id,
                "peculiarities_id"  => $id,
                "type"              => $type,
                "created_at"        => date('Y-m-d H:i:s', strtotime("now")),
                "updated_at"        => date('Y-m-d H:i:s', strtotime("now"))
            ]);
        }
    }
}
