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
use App\Services\TitleGenerateService;
use App\Services\UrlParametersService;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    private $peculiarities;
    private $currencyService;
    private $layoutService;
    private $urlParametersService;
    private $titleGenerateService;

    public function __construct(
        CurrencyService $currencyService,
        LayoutService $layoutService,
        UrlParametersService $urlParametersService,
        TitleGenerateService $titleGenerateService
    ) {
        $this->peculiarities = Peculiarities::all();
        $this->currencyService = $currencyService;
        $this->layoutService = $layoutService;
        $this->urlParametersService = $urlParametersService;
        $this->titleGenerateService = $titleGenerateService;
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

        if (!isset($data['locale'])) {
            $data['locale'] = 'ru';
        }

        // Генерация заголовков
        $title = $this->titleGenerateService->titleForHouses($data);
        $title_catalog = $this->titleGenerateService->titleCatalogForHouses($data);


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
//            ->with(['locale_fields' => function($query) use ($data) {
//                $query->whereHas('locale', function($query) use ($data) {
//                    $query->where('code', $data['locale']);
//                })->orderByDesc('id')->limit(1);
//            }])
            ->limit(12)
            ->filter($filter)
            ->get();

        $products_count = count($products);

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

        return view('project.houses', compact('products_first_list', 'products_second_list', 'title', 'title_catalog', 'products_count'));
//        return view('project.houses', compact('region', 'title'));
    }
}
