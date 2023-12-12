<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Http\Requests\House\FilterRequest;
use App\Models\Locale;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Models\CountryAndCity;
use App\Models\ProductCategory;
use App\Services\CurrencyService;
use App\Services\LayoutService;
use App\Services\UrlParametersService;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    private $peculiarities;
    private $currencyService;
    private $layoutService;
    private $urlParametersService;

    public function __construct(
        CurrencyService $currencyService,
        LayoutService $layoutService,
        UrlParametersService $urlParametersService
    ) {
        $this->peculiarities = Peculiarities::all();
        $this->currencyService = $currencyService;
        $this->layoutService = $layoutService;
        $this->urlParametersService = $urlParametersService;
    }

    public function index()
    {
        $country = CountryAndCity::where('id', 17)->first();
        $countries = CountryAndCity::all();
        return view('project.houses', compact('country', 'countries'));
    }

    public function realty(Request $request, $categories)
    {
        $data = $this->urlParametersService->validateParams($categories);

        if (!isset($data['order_by'])) {
            $data['order_by'] = 'new-first';
        }

        // Генерация заголовка

        $filter = app()->make(HousesFilter::class, ['queryParams' => $data, 'currencyService' => $this->currencyService]);
        $products = Product::realty($data['price'] ?? null)
            ->withCount('photo')
            ->with(['photo' => function($query) {
                $query->orderBy('id', 'asc')->limit(5);
            }])
            ->with('peculiarities.locale_fields.locale')
            ->with(['favorite' => function ($query) use ($data) {
                $query->where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : time());
            }])
            ->with(['locale_fields' => function($query) use ($data) {
                $query->whereHas('locale', function($query) use ($data) {
                    $query->where('code', $data['locale']);
                })->orderByDesc('id')->limit(1);
            }])
            ->limit(12)
            ->filter($filter)
            ->get();

        // Меняем параметры (для фронта)
        foreach ($products as $key => $object) {
            // Тэги
            $object->getTags('ru');

            // Получаем уникальные планировки
            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);

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

        return view('project.houses', compact('products_first_list', 'products_second_list'));
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
