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

class LayoutsService
{
    private $photoCategories;
    private $previewImageService;
    private $imageService;
    private $ids_in_crm_all;
    private $categoriesService;
    private $objectsService;
    private $currencyService;
    private $validateDataService;

    public function __construct(
        PhotoCategoryService $photoCategoryService,
        PreviewImageService $previewImageService,
        ImageService $imageService,
        CategoriesService $categoriesService,
        ObjectsService $objectsService,
        CurrencyService $currencyService,
        ValidateDataService $validateDataService
    )
    {
        $this->previewImageService = $previewImageService;
        $this->imageService = $imageService;
        $this->photoCategories = $photoCategoryService->getArray();
        $this->categoriesService = $categoriesService;
        $this->objectsService = $objectsService;
        $this->currencyService = $currencyService;
        $this->validateDataService = $validateDataService;

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

    public function handle($endpoint, $token, $update, $only_layouts)
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
                foreach ($response as $index => $object) {
                    // Отсчитываем оступ
                    if (in_array($object['id'], $this->ids_in_crm_all)) {
                        // Если нет поля complex_id - обновляем или удаляем объект
                        if (is_null($object['complex_id'])) {
                            if (!$only_layouts) {
                                $this->objectsService->updateOrDelete($object, $update);
                            }
                        } else {
                            // иначе - планировка
                            $this->updateOrDelete($object, $update);
                        }
                    } else {
                        // Если нет поля complex_id - создаём
                        if (is_null($object['complex_id'])) {
                            if (!$only_layouts) {
                                $this->objectsService->create($object);
                            }
                        } else {
                            // иначе - планировка
                            $this->create($object);
                        }
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

    private function updateOrDelete($data, $update)
    {
        $updated_at = $data['updated_at'];

        // Если не удалён объект
        if ($data['deleted_at'] === null) {
            // Если время с момента обновления прошло больше чем 86400 секунд, т.е. 1 день
            if ($update) {
                $this->update($data);
            } else {
                if (strtotime('now') - strtotime($updated_at) <= 7200) {
                    $this->update($data);
                }
            }
        } else {
            $layout = Layout::where('id_in_crm', $data['id'])->firts();
            dump('Delete layout - id: ' . $layout->id);
            $layout->delete();
        }
    }

    private function create($data)
    {
        // Получаем фотографии планировки
        $layoutPhotos = is_null($data['layout_id']) ? $data['photos'] : $data['layout']['photos'];
        // Получаем параметры для создания планировки
        $layoutParams = $this->validateData($data);

        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
        $layout = Layout::withTrashed()->where('id_in_crm', $data['id'])->firstOr(function () use ($layoutParams, $layoutPhotos, $data) {
            $layout = Layout::create($layoutParams);
            dump('Create layout - id: ' . $layout->id);
            Log::info('Create layout - id: ' . $layout->id);

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
        });
    }

    private function update($data)
    {
        // Получаем фотографии планировки
        $layoutPhotos = is_null($data['layout_id']) ? $data['photos'] : $data['layout']['photos'];

        // Получаем параметры для создания планировки
        $layoutParams = $this->validateData($data);

        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
        $layout = Layout::withTrashed()->where('id_in_crm', $data['id'])->first();
        dump('Update layout - id: ' . $layout->id);
        Log::info('Update layout - id: ' . $layout->id);
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

    private function validateData($data) : array
    {
        $complex = Product::withTrashed()->where('id_in_crm', $data['complex_id'])->firstOr(function ($data) {
            return $this->objectsService->create($data['complex']);
        });

        return $this->validateDataService->handleLayout($data, $complex->id);
    }
}
