<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Http\Requests\House\FilterRequest;
use App\Models\Locale;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Models\CountryAndCity;
use App\Models\ProductCategory;
use App\Services\CurrencyService;
use App\Services\LayoutService;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    private $peculiarities;
    private $currencyService;
    private $layoutService;

    public function __construct(CurrencyService $currencyService, LayoutService $layoutService)
    {
        $this->peculiarities = Peculiarities::all();
        $this->currencyService = $currencyService;
        $this->layoutService = $layoutService;
    }

    public function index()
    {
        $country = CountryAndCity::where('id', 17)->first();
        $countries = CountryAndCity::all();
        return view('project.houses', compact('country', 'countries'));
    }

    public function realty(Request $request, $categories)
    {
//        $data = $request->validated();
        $categories_array = explode('/', $categories);

        $region = null;
        foreach ($categories_array as $category) {
            $country = CountryAndCity::whereRaw('`slug` LIKE ? ', ['%'.$category.'%'])->first();
            unset($country_name);

            if (!is_null($country)) {
                break;
            }
        }

        // Генерация заголовка
        $title = $this->generateTitle($country);

        $regions = CountryAndCity::with('locale_fields.locale')->with('country.locale_fields.locale')->get();
        foreach ($regions as $index => $item) {
            if (in_array(strtolower($item->slug), $categories_array)) {
                $region = $item;
            }
        }
        $locale = Locale::where('code', 'ru')->first();

        $products = Product::with(['layouts' => function($query) {
            // Ограничиваем вывод, только те у которых цена соответствует
            $query->with('photos');
            $query->orderBy('base_price', 'asc');
        }])
            ->where('country_id', 17)
            ->with('photo')
            ->with('locale_fields.locale')
            ->with(['favorite' => function ($query) {
                $query->where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : time());
            }])
            ->latest()
            ->limit(10)
            ->get();

        for ($i = 0; $i < count($products); $i++) {
            if (isset($products[$i]->layouts) && count($products[$i]->layouts) > 0) {
                $products[$i]->price = $products[$i]->layouts[0]->price;
                $products[$i]->price_code = $products[$i]->layouts[0]->price_code;
                $products[$i]->base_price = $products[$i]->layouts[0]->base_price;
            }
        }

        // Меняем параметры (для фронта)
        foreach ($products as $key => $object) {
            // Тэги
            $object->getTags('ru');

            $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->base_price, (int)$object->size);
            $object->price = $this->currencyService->exchangeGetAll($object->price, $object->price_code);
            if(isset($object->country)) {
                $object->price_credit = $this->currencyService->getCreditPrice((int)$object->base_price, $object->country->inverse_credit_ratio);
            }

            if (!is_null($object->locale_fields->where('locale_id', $locale->id)->first())) {
                $object->description = !is_null($object->locale_fields->where('locale_id', $locale->id)->first()->description) ? $object->locale_fields->where('locale_id', $locale->id)->first()->description : null;
                $object->disposition = !is_null($object->locale_fields->where('locale_id', $locale->id)->first()->diposition) ? $object->locale_fields->where('locale_id', $locale->id)->first()->disposition : null;
                $object->deadline = !is_null($object->locale_fields->where('locale_id', $locale->id)->first()->deadline) ? __('Срок сдачи', [], $locale->code) . ': ' . $object->locale_fields->where('locale_id', $locale->id)->first()->deadline : null;
            }

            // Получаем уникальные планировки
            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);

            // Цена за квартиру и за метр для планировок
            if (isset($object->layouts)) {
                foreach ($object->layouts as $index => $layout) {
                    if(isset($object->country)) {
                        $layout->price_credit = $this->currencyService->getCreditPrice((int)$layout->base_price, $object->country->inverse_credit_ratio);
                    }
                    $layout->price_size = $this->currencyService->getPriceSizeFromDB((int)$layout->base_price, (int)$layout->total_size);
                    $layout->price = $this->currencyService->exchangeGetAll($layout->price, $layout->price_code);
                }
            }

            // Особенности
            $object->gostinnie = $object->living_rooms();
            $object->vanie = $object->bathrooms();
            $object->spalni = $object->bedrooms();
            $object->do_more = $object->to_sea();
            $object->type_vid = $object->view();
        }

        $products_first_list = $products->splice(0, 4)->all();
        $products_second_list = $products->all();

        unset($products);

        return view('project.houses', compact('region', 'title', 'products_first_list', 'products_second_list'));
//        return view('project.houses', compact('region', 'title'));
    }

    private function generateTitle($country)
    {
        if (!is_null($country)) {
            // Формируем заголовок
            $title = __('Покупка недвижимости в регионе :name', ['name' => $country->locale_fields->where('locale.code', app()->getLocale())->first()->name]);
        } else {
            $title = null;
        }

        return $title;
    }
}
