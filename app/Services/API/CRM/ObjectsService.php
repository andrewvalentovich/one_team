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
    private $validateDataService;

    public function __construct(
        PhotoCategoryService $photoCategoryService,
        PreviewImageService $previewImageService,
        ImageService $imageService,
        CategoriesService $categoriesService,
        CurrencyService $currencyService,
        SlugService $slugService,
        GeocodingService $geocodingService,
        ValidateDataService $validateDataService
    )
    {
        $this->previewImageService = $previewImageService;
        $this->imageService = $imageService;
        $this->photoCategories = $photoCategoryService->getArray();
        $this->categoriesService = $categoriesService;
        $this->currencyService = $currencyService;
        $this->slugService = $slugService;
        $this->geocodingService = $geocodingService;
        $this->validateDataService = $validateDataService;

        // Получаем все id_in_crm, чтобы сравнить с id полученными из запроса
        $this->ids_in_crm_for_complexes = Product::withTrashed()->select('id_in_crm')->whereNotNull('id_in_crm')->get()->transform(function ($row) {
            return $row->id_in_crm;
        })->toArray();
    }

    public function handle($endpoint, $token, $update)
    {
        try {
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
                        $this->updateOrDelete($complex, $update);
                    } else {
                        $this->create($complex);
                    }
                }
            }
        }
        catch(\GuzzleHttp\Exception\RequestException $e) {
            // you can catch here 40X response errors and 500 response errors
            Log::info(Carbon::now() . "Complexes data. Catch API request error");
            Log::info(Carbon::now() . $e->getMessage());
            dump(Carbon::now() . $e->getMessage());
        } catch(Exception $e) {
            // other errors
            Log::info(Carbon::now() . "Complexes data. Catch API request error");
            Log::info(Carbon::now() . $e->getMessage());
            dump(Carbon::now() . $e->getMessage());
        }
    }

    public function updateOrDelete($data, $update)
    {
        $updated_at = $data['updated_at'];
        // Если не удалён объект
        if ($data['deleted_at'] === null) {
//             Если время с момента обновления прошло больше чем 86400 секунд, т.е. 1 день
            if ($update) {
                $this->update($data);
            } else {
                if (strtotime('now') - strtotime($updated_at) <= 7200) {
                    $this->update($data);
                }
            }

        } else {
            $complex = Product::withTrashed()->where('id_in_crm', $data['id'])->firts();
            dump('Delete product - id: ' . $complex->id);
            $complex->delete();
        }
    }

    private function update($data)
    {
        // Получаем фотографии комплекса
        $complexPhotos = $data['photos'];

        // Получаем параметры для обновления комплекса
        $complexParams = $this->validateDataService->handleComplex($data, __FUNCTION__);

        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
        $complex = Product::withTrashed()->where('id_in_crm', $data['id'])->first();
        dump('Update product - id: ' . $complex->id);
        Log::info('Update product - id: ' . $complex->id);
        $complex->update($complexParams);

        // Обновление текстовых полей description и disposition
        $this->updateDescription($complex, $data['description']);

        // Обновление категорий
        $this->categoriesService->update($data, $complex->id);

//        Нужно добавить проверку по lastModified
        // Обновление фото
//        foreach ($complex->photo as $photo)
//        {
//            $photo->delete();
//        }
//        foreach ($complexPhotos as $key => $category) {
//            foreach ($category as $index => $photo) {
//                $filename = $this->imageService->saveFromRemote($photo);
//
//                PhotoTable::create([
//                    'parent_model'=> '\App\Models\Product',
//                    'parent_id' => $complex->id,
//                    'photo' => $filename,
//                    'preview' => $this->previewImageService->update($filename),
//                    'category_id' => $this->photoCategories[$key]
//                ]);
//            }
//        }

        return $complex;
    }

    public function create($data)
    {
        // Получаем фотографии комплекса
        $complexPhotos = $data['photos'];

        // Получаем параметры для создания комплекса
        $complexParams = $this->validateDataService->handleComplex($data, __FUNCTION__);

        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
        $complex = Product::withTrashed()->where('id_in_crm', $data['id'])->firstOr(function () use ($complexParams, $complexPhotos, $data) {
            $complex = Product::create($complexParams);
            dump('Create product - id: ' . $complex['id']);
            Log::info('Create product - id: ' . $complex['id']);

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

            $this->categoriesService->add($data, $complex->id);

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
