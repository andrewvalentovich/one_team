<?php


namespace App\Services\API\CRM;


use App\Models\CountryAndCity;
use App\Models\Layout;
use App\Models\LayoutPhoto;
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

class LayoutsForComplexService
{
    private $photoCategories;
    private $previewImageService;
    private $imageService;
    private $ids_in_crm_all;
    private $categoriesService;
    private $objectSimpleService;
    private $currencyService;

    public function __construct(
        PhotoCategoryService $photoCategoryService,
        PreviewImageService $previewImageService,
        ImageService $imageService,
        CategoriesService $categoriesService,
        ObjectSimpleService $objectSimpleService,
        CurrencyService $currencyService
    )
    {
        $this->previewImageService = $previewImageService;
        $this->imageService = $imageService;
        $this->photoCategories = $photoCategoryService->getArray();
        $this->categoriesService = $categoriesService;
        $this->objectSimpleService = $objectSimpleService;
        $this->currencyService = $currencyService;

        // Получаем все id_in_crm, чтобы сравнить с id полученными из запроса
        $ids_in_crm_for_complexes = Product::withTrashed()->select('id_in_crm')->whereNotNull('id_in_crm')->get()->transform(function ($row) {
            return $row->id_in_crm;
        })->toArray();
        $ids_in_crm_for_layouts = Layout::withTrashed()->select('id_in_crm')->whereNotNull('id_in_crm')->get()->transform(function ($row) {
            return $row->id_in_crm;
        })->toArray();
        $this->ids_in_crm_all = $ids_in_crm_for_complexes;
        $this->ids_in_crm_all = array_merge($ids_in_crm_for_complexes, $ids_in_crm_for_layouts);
        unset($ids_in_crm_for_layouts, $ids_in_crm_for_complexes);
    }

    public function handle($endpoint, $token, $complex_id, $update = null)
    {
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
            foreach ($response as $index => $object) {
                // Если объекта существует id компекса - это планировка
                if (isset($object['complex']['id'])) {
                    if ($object['complex']['id'] == $complex_id) {
                        // Проверка планировок
                        if (in_array($complex_id, $this->ids_in_crm_all)) {
                            if ($update) {
                                $this->update($object);
                            } else {
                                $this->updateOrDelete($object);
                            }
                        } else {
                            $this->create($object);
                        }
                    }
                } else {
                    // Проверка объектов
                    if ($object['id'] == $complex_id) {
                        if (in_array($complex_id, $this->ids_in_crm_all)) {
                            if ($update) {
                                $this->objectSimpleService->update($object);
                            } else {
                                $this->objectSimpleService->updateOrDelete($object);
                            }
                        } else {
                            $this->objectSimpleService->create($object);
                        }
                    }
                }
            }
        }
    }

    private function updateOrDelete($data)
    {
        $updated_at = $data['updated_at'];

        // Если не удалён объект
        if ($data['deleted_at'] === null) {

            // Если время с момента обновления прошло больше чем 86400 секунд, т.е. 1 день
            if (strtotime('now') - strtotime($updated_at) <= 86400) {
                $this->update($data);
            }
        } else {
            $layout = Layout::where('id_in_crm', $data['id'])->firts();
            dump('Delete layout - id: ' . $layout->id);
            $layout->delete();
        }
    }

    private function create($data, $complex_id)
    {
        // Получаем фотографии планировки
        $layoutPhotos = is_null($data['layout_id']) ? $data['photos'] : $data['layout']['photos'];
        // Получаем параметры для создания планировки
        $layoutParams = $this->validateData($data);
        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
        $layout = Layout::where('layout_id_in_crm', $data['layout']['id'])->first();

        // Если существует планировка с таким же id_in_crm
        if (!is_null($layout)) {
            $new_base_price = $this->currencyService->convertPriceToEur($data['price'], $data['price_code']);
            // Если старая цена больше новой, то:
            if ($layout->base_price > $new_base_price) {
                // Обновим цену
                $layout->price = $data['price'];
                $layout->price_code = $data['price_code'];
                $layout->base_price = $new_base_price;

                $layout->update();
            }
        } else {
            // Если не существует, то создадим
            $layout = Layout::create($layoutParams);
            dump('Create layout - id: ' . $layout->id);

            foreach ($layoutPhotos as $key => $category) {
                foreach ($category as $index => $photo) {
                    $filename = $this->imageService->saveFromRemote($photo);

                    LayoutPhoto::create([
                        'url' => "uploads/" . $filename,
                        'layout_id' => $layout->id,
                    ]);
                }
            }
        }
    }

    private function update($data)
    {
        // Получаем фотографии планировки
        $layoutPhotos = is_null($data['layout_id']) ? $data['photos'] : $data['layout']['photos'];

        // Получаем параметры для создания планировки
        $layoutParams = $this->validateData($data);

        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
        $layout = Layout::where('id_in_crm', $data['id'])->first();
        dump('Update layout - id: ' . $layout->id);
        $layout->update($layoutParams);

        if (!is_null($layout->photos)) {
            foreach ($layout->photos as $photo)
            {
                $photo->delete();
            }
        }

//        Нужно добавить проверку по lastModified
        foreach ($layoutPhotos as $key => $category) {
            foreach ($category as $index => $photo) {
                $filename = $this->imageService->saveFromRemote($photo);

                LayoutPhoto::create([
                    'url' => "uploads/" . $filename,
                    'layout_id' => $layout->id,
                ]);
            }
        }

        return $layout;
    }

    /**
     * Validate all parameters for complex and return array with it (params)
     *
     * @param $data
     * @return array
     */
    private function validateData($data) : array
    {
        $name = !is_null($data['layout_id']) ? $data['layout']['name'] : $data['name'];

        // Если у планировки есть, комплекс но его нет в базе - создаём
        $complex = Product::where('id_in_crm', $data['complex_id'])->firstOr(function ($data) {
            return $this->objectSimpleService->create($data['complex']);
        });

        $base_price = null;
        if (isset($data['price']) && !is_null($data['price']) && isset($data['price_currency'])) {
            $base_price = $this->currencyService->convertPriceToEur($data['price'], $data['price_currency']);
        }

        return [
            'building'          => !is_null($data['block_id']) ? $data['block']['name'] : null,
            'name'              => $name,
            'type'              => $data['type'] ?? null,
            'base_price'        => $base_price,
            'price'             => $data['price'] ?? null,
            'price_code'        => $data['price_currency'] ?? null,
            'total_size'        => $data['total_size'] ?? null,
            'living_size'       => $data['living_size'] ?? null,
            'number_rooms'      => $data['number_rooms'] ?? null,
            'floor'             => $data['floor_number'] ?? null,
            'number_bedrooms'   => $data['number_bedrooms'] ?? null,
            'number_bathrooms'  => $data['number_bathrooms'] ?? null,
            'number_balconies'  => $data['number_balconies'] ?? null,
            'complex_id'        => $complex->id ?? null,
            'id_in_crm'         => $data['id'],
            'layout_id_in_crm'  => $data['layout']['id']
        ];
    }
}
