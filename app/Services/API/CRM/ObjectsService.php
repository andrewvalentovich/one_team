<?php


namespace App\Services\API\CRM;


use App\Models\CountryAndCity;
use App\Models\Locale;
use App\Models\PhotoTable;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductLocale;
use App\Services\CurrencyService;
use App\Services\GeocodingService;
use App\Services\ImageService;
use App\Services\PhotoCategoryService;
use App\Services\PreviewImageService;
use App\Services\SlugService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ObjectsService
{
    private $photoCategories;
    private $previewImageService;
    private $imageService;
    private $ids_in_crm_for_complexes;
    private $categoriesService;
    private $currencyService;
    private $slugService;
    private $geocodingService;

    public function __construct(
        PhotoCategoryService $photoCategoryService,
        PreviewImageService $previewImageService,
        ImageService $imageService,
        CategoriesService $categoriesService,
        CurrencyService $currencyService,
        SlugService $slugService,
        GeocodingService $geocodingService
    )
    {
        $this->previewImageService = $previewImageService;
        $this->imageService = $imageService;
        $this->photoCategories = $photoCategoryService->getArray();
        $this->categoriesService = $categoriesService;
        $this->currencyService = $currencyService;
        $this->slugService = $slugService;
        $this->geocodingService = $geocodingService;

        // Получаем все id_in_crm, чтобы сравнить с id полученными из запроса
        $this->ids_in_crm_for_complexes = Product::select('id_in_crm')->whereNotNull('id_in_crm')->get()->transform(function ($row) {
            return $row->id_in_crm;
        })->toArray();
    }

    public function handle($endpoint, $token)
    {
//        try {
            $client = new \GuzzleHttp\Client(['headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-type' => 'application/json'
            ]]);

            $guzzleResponse = $client->get('https://crm.one-team.pro' . $endpoint . '?token=' . $token);
            // Логирование статуса ответа
            Log::info(Carbon::now()." Get complexes data from API " . $guzzleResponse->getStatusCode());

            if($guzzleResponse->getStatusCode() == 200) {
                $response = json_decode($guzzleResponse->getBody(),true);
                // Если комплекс с текущим id существует в бд, обновляем или удаляем, иначе создаём
                foreach ($response as $index => $complex) {
                    if (in_array($complex['id'], $this->ids_in_crm_for_complexes)) {
                        $this->updateOrDelete($complex);
                    } else {
                        $this->create($complex);
                    }
                }
            }
//        }
//        catch(\GuzzleHttp\Exception\RequestException $e) {
//            // you can catch here 40X response errors and 500 response errors
//            Log::info(Carbon::now() . "Complexes data. Catch API request error");
//            Log::info(Carbon::now() . $e->getMessage());
//            dump(Carbon::now() . $e->getMessage());
//        } catch(Exception $e) {
//            // other errors
//            Log::info(Carbon::now() . "Complexes data. Catch API request error");
//            Log::info(Carbon::now() . $e->getMessage());
//            dump(Carbon::now() . $e->getMessage());
//        }
    }

    public function updateOrDelete($data)
    {
        $updated_at = $data['updated_at'];
        // Если не удалён объект
        if ($data['deleted_at'] === null) {
//             Если время с момента обновления прошло больше чем 86400 секунд, т.е. 1 день
//            if (strtotime('now') - strtotime($updated_at) <= 86400) {
                $this->update($data);
//            }
        } else {
            $complex = Product::where('id_in_crm', $data['id'])->firts();
            dump('Delete product - id: ' . $complex->id);
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
        dump('Update product - id: ' . $complex->id);
        $complex->update($complexParams);
        foreach ($complex->photo as $photo)
        {
            $photo->delete();
        }
        // Обновление текстовых полей description и disposition
        $this->updateDescription($complex, $data['description']);

        // Обновление категорий
        $categories = ProductCategory::where('product_id', $complex->id)->get();
        foreach ($categories as $key => $category) {
            $category->delete();
        }
        $this->addCategories($data, $complex->id);

//        Нужно добавить проверку по lastModified
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
                break;
            }
            break;
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
            dump('Create product - id: ' . $complex['id']);

            // Создаём slug для объекта
            if (is_null($complex->slug)) {
                $complex->update([
                    'slug' => $this->slugService->make($complex->id)
                ]);
            }

            // Перевод и добавление полей описаний
            if (!is_null($complex->description)) {
                $this->translateForNew($complex->id, $complex->description);
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
                    break;
                }
                break;
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
        $city_id = null;

        if (is_null($city)) {
            if ($data['tr_geo_semt_name'] == 'MAHMUTLAR') {
                if (isset(CountryAndCity::where('name', 'Махмутлар')->first()->id)) {
                    $city_id = CountryAndCity::where('name', 'Махмутлар')->first()->id;
                }
            } elseif ($data['tr_geo_ilce_name'] == 'SERIK') {
                if (isset(CountryAndCity::where('name', 'Серик')->first()->id)) {
                    $city_id = CountryAndCity::where('name', 'Серик')->first()->id;
                }
            } elseif ($data['tr_geo_ilce_name'] == 'KEMER') {
                if (isset(CountryAndCity::where('name', 'Кемер')->first()->id)) {
                    $city_id = CountryAndCity::where('name', 'Кемер')->first()->id;
                }
            } elseif ($data['tr_geo_ilce_name'] == 'GAZIPAŞA') {
                if (isset(CountryAndCity::where('name', 'Газипаша')->first()->id)) {
                    $city_id = CountryAndCity::where('name', 'Газипаша')->first()->id;
                }
            } elseif ($data['tr_geo_ilce_name'] == 'KAŞ') {
                if (isset(CountryAndCity::where('name', 'Каш')->first()->id)) {
                    $city_id = CountryAndCity::where('name', 'Каш')->first()->id;
                }
            } elseif ($data['tr_geo_ilce_name'] == 'FINIKE') {
                if (isset(CountryAndCity::where('name', 'Финике')->first()->id)) {
                    $city_id = CountryAndCity::where('name', 'Финике')->first()->id;
                }
            } elseif ($data['tr_geo_ilce_name'] == 'ALANYA') {
                if (CountryAndCity::where('name', 'Аланья')->first()) {
                    $city_id = CountryAndCity::where('name', 'Аланья')->first()->id;
                }
            } elseif ($data['tr_geo_il_name'] == 'ANTALYA') {
                if (CountryAndCity::where('name', 'Анталия')->first()) {
                    $city_id = CountryAndCity::where('name', 'Анталия')->first()->id;
                }
            }
        } else {
            $city_id = $city->id;
        }

        // Адресс
        $address = !is_null($data['tr_geo_il_name']) ? $data['tr_geo_il_name'] : "";
        $address .= !is_null($data['tr_geo_ilce_name']) ? ", " . $data['tr_geo_ilce_name'] : "";

        // Координаты
        $coordinates = $this->geocodingService->getCoordinates($data);

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
        if (isset($data['complex_name'])) {
            $complex_or_not = is_null($data['complex_name']) ? 'Нет' : 'Да';
        } else {
            $complex_or_not = $data['seller_type'] == 'builder' ? 'Да' : 'Нет';
        }

        return [
            'country_id'        => $country_id ?? null,
            'city_id'           => $city_id ?? null,
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
            'id_in_crm'         => $data['id']
        ];
    }


    private function getCategories($data)
    {
        $category_ids = [];

        // Вид
        $category_ids[$this->categoriesService->getToSea($data['to_sea'])] = 'До моря';

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
        if (isset($data['type'])) {
            $category_ids[$type[$data['type']]] = 'Типы';
        } else {
            $category_ids[$type['apartment']] = 'Типы';
        }

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
        $bedrooms = 'Спальни';
        if (isset($data['number_bedrooms'])) {
            if (!is_null($data['number_bedrooms']) && $data['number_bedrooms'] != 0) {
                $category_ids[$this->categoriesService->getRooms($bedrooms, $data['number_bedrooms'])] = $bedrooms;
            }
        }

        // Ванные
        $bathrooms = 'Ванные';
        if (isset($data['number_bathrooms'])) {
            if (!is_null($data['number_bedrooms']) && $data['number_bedrooms'] != 0) {
                $category_ids[$this->categoriesService->getRooms($bathrooms, $data['number_bathrooms'])] = $bathrooms;
            }
        }

        return $category_ids;
    }

    private function addCategories($data, $complex_id)
    {
        foreach ($this->getCategories($data) as $id => $type) {
            ProductCategory::create([
                'product_id'        => $complex_id,
                'peculiarities_id'  => $id,
                'type'              => $type,
                'created_at'        => date('Y-m-d H:i:s', strtotime('now')),
                'updated_at'        => date('Y-m-d H:i:s', strtotime('now'))
            ]);
        }
    }

    private function translateForNew($product_id, $description)
    {
        $locales = Locale::all();

        foreach ($locales as $locale) {
            try {
                $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
                $tmp_description = !empty($description) ? $tr->trans($description, $locale->code) : null;

                ProductLocale::create([
                    'product_id' => $product_id,
                    'locale_id' => $locale->id,
                    'description' => $tmp_description,
                ]);

                unset($tmp_description);

            } catch(Exception $e) {
                dump($e->getMessage());
                Log::error($e->getMessage());
            }
        }
    }

    private function updateDescription($product, $description = null)
    {
        $locales = Locale::all();

        if (!is_null($description)) {
            $description = $this->translateDescription($description);

            foreach ($product->locale_fields as $key => $value) {
                if (!is_null($locales->where('code', $value->locale->code)->first())) {
                    unset($locales[$locales->where('code', $value->locale->code)->first()->id - 1]);
                }

                if (isset($description[$value->locale->code])) {
                    $value->description = $description[$value->locale->code];
                    $value->save();
                }
            }

            // Не заполненные поля
            if (!empty($locales)) {
                foreach ($locales as $key => $locale) {

                    ProductLocale::create([
                        "product_id" => $product->id,
                        "locale_id" => $locale->id,
                        "description" => isset($description[$locale->code]) ? $description[$locale->code] : null
                    ]);
                }
            }
        }
    }

    private function translateDescription($description_ru)
    {
        $locales = Locale::all();
        $description[] = '';

        foreach ($locales as $locale) {
            try {
                $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
                $description[$locale->code] = isset($description_ru) ? $tr->trans($description_ru, $locale->code) : null;
            } catch(Exception $e) {
                dump($e->getMessage());
                Log::error($e->getMessage());
            }
        }
        return $description;
    }
}
