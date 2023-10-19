<?php


namespace App\Services;


use App\Models\CountryAndCity;
use App\Models\ExchangeRate;
use App\Models\Layout;
use App\Models\LayoutPhoto;
use App\Models\PhotoTable;
use App\Models\Product;

class ImportCrmDataService
{
    private $currencyService;
    private $photoCategories;
    private $previewImageService;
    private $imageService;

    public function __construct(
        CurrencyService $currencyService,
        PhotoCategoryService $photoCategoryService,
        PreviewImageService $previewImageService,
        ImageService $imageService
    )
    {
        $this->currencyService = $currencyService;
        $this->previewImageService = $previewImageService;
        $this->imageService = $imageService;
        $this->photoCategories = $photoCategoryService->getArray();
    }

    public function getData(array $data)
    {
        foreach ($data as $id => $object) {
            // Проверка на наличие комплекса в объекте
            if (is_null($object['complex_id'])) {
                $this->no_complex($object);
            } else {
                $this->with_complex($object);
            }
        }
    }

    private function no_complex($data)
    {
        // create
        // or
        // update
        dump('no_complex');
    }

    private function with_complex($data)
    {
        // Получаем фотографии комплекса
        $complexPhotos = $data['complex']['photos'];
        // Получаем параметры для создания комплекса
        $complexParams = $this->validateDataForComplex($data);

        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
        $complex = Product::where('id_in_crm', $data['complex_id'])->firstOr(function () use ($complexParams, $complexPhotos) {
//            return Product::create($complexParams);
            // Фотографий пока нет
//
//            foreach ($complexPhotos as $key => $category) {
//                foreach ($category as $index => $photo) {
//                    $this->imageService->saveFromRemote($photo);
//                    PhotoTable::create([
//                        'parent_model'=> '\App\Models\Product',
//                        'parent_id' => $complex->id,
//                        'photo' => ,
//                        'preview' => $this->previewImageService->update(),
//                        'category_id' => $this->photoCategories[$key]
//                    ]);
//                }
//            }
        });

        // Получаем фотографии планировки (квартиры)
        $layoutPhotos = $data['photos'];
        $this->imageService->saveFromRemote("ewfwef");
        // Получаем параметры для создания планировки (квартиры)
//        $layoutParams = $this->validateDataForLayout($data, $complex->id);

        // Если найден то возвращаем, иначе создаём, вместе с фотографиями
//        $layout = Layout::where('id_in_crm', $data['id'])->firstOr(function () use ($layoutParams, $layoutPhotos) {
//            $layout = Layout::create($layoutParams);
//            $this->createLayoutPhotos($layoutPhotos, $layout->id);
//        });
    }

    private function validateDataForComplex($data) : array
    {
        $country = CountryAndCity::select('id')->whereNull('parent_id')->where('name', $data['complex']['country_name'])->firstOr(function () {
            return null;
        });
        $country_id = is_null($country) ? null : $country->id;

        $city = CountryAndCity::select('id')->whereNotNull('parent_id')->where('name', $data['complex']['city_name'])->firstOr(function () {
            return null;
        });
        $city_id = is_null($city) ? null : $city->id;

        $address = $data['complex']['country_name'] . ", " . $data['complex']['country_name']
            . ", " . $data['complex']['street_name']. ", " . $data['complex']['house_number'];

        $citizenship = "";
        $residence_permit = "";
        if (isset($data['complex']['suitable_for'])) {
            $citizenship = in_array('citizenship', $data['complex']['suitable_for']) ? 'Да' : 'Нет';
            $residence_permit = in_array('residence_permit', $data['complex']['suitable_for']) ? 'Да' : 'Нет';
        }

        $parking = "";
        if (isset($data['complex']['accessible_housing'])) {
            $parking = in_array('parking_place', $data['complex']['accessible_housing']) ? 'Да' : 'Нет';
        }

        return [
            'country_id'        => $country_id,
            'city_id'           => $city_id,
            'name'              => $data['complex']['name'],
            'address'           => $address,
            'size'              => null,
            'size_home'         => null,
            'description'       => $data['complex']['description'],
            'lat'               => $data['complex']['lat'],
            'long'              => $data['complex']['lon'],
            'citizenship'       => $citizenship,
            'grajandtstvo'      => $citizenship,
            'status'            => null,
            'disposition'       => null,
            'parking'           => $parking,
            'vnj'               => $residence_permit,
            'complex_or_not'    => "Да",
            'video'             => null,
            'is_secondary'      => $data['complex']['seller_type'] == "builder" ? 0 : 1,
            'id_in_crm'         => $data['complex']['id']
        ];
    }

    private function validateDataForLayout($data, $complex_id) : array
    {
        return [
            'building'          => isset($data['block']['name']) ? $data['block']['name'] : null,
            'type'              => $data['type'],
            'name'              => $data['complex']['name'],
            'price'             => $this->currencyService->convertPriceToEur($data['price'], $data['price_currency']),
            'price_code'        => $data['price_currency'],
            'total_size'        => $data['total_size'],
            'living_size'       => $data['living_size'],
            'number_rooms'      => $data['number_rooms'],
            'floor'             => $data['floor_number'],
            'number_bedrooms'   => $data['number_bedrooms'],
            'number_bathrooms'  => $data['number_bathrooms'],
            'number_balconies'  => $data['number_balconies'],
            'complex_id'        => $complex_id,
            'id_in_crm'         => $data['id'],
        ];
    }

    private function createLayoutPhotos($data, $layout_id) {
        foreach ($data as $key => $category) {
            // Если категория не пустая - запускаем foreach
            if(!empty($category)) {
                foreach ($category as $index => $photo) {
                    LayoutPhoto::create([
                        'url' => $this->imageService->saveFromRemote($photo),
                        'layout_id' => $layout_id
                    ]);
                }
            }
        }
    }
}
