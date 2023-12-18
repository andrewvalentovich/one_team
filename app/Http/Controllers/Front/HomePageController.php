<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Admin\Peculiarities;
use App\Http\Resources\Map\ProductsCollection;
use App\Http\Resources\Map\ProductsResource;
use App\Models\CompanySelect;
use App\Models\Product;
use App\Services\CurrencyService;
use App\Services\LayoutService;
use App\Services\SortService;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;
use DB;

class HomePageController extends Controller
{
    private $currencyService;

    public function __construct(CurrencyService $currencyService, SortService $sortService, LayoutService $layoutService)
    {
        $this->currencyService = $currencyService;
        $this->sortService = $sortService;
        $this->layoutService = $layoutService;
    }

    public function home_page(){
        $all_country = CountryAndCity::where('parent_id', null)
            ->with(['product_country' => function($query) {
                $query->where(function ($query) {
                    $query->where('complex_or_not', 'Нет')
                        ->where(function ($query)  {
                            $query->where('products.base_price', '>', 0);
                        })
                        ->orWhereHas('layouts');
                });
            }])
            ->withCount('product_country')
            ->with('locale_fields.locale')
            ->orderBy('product_country_count', 'desc')
            ->limit(15)
            ->get();

        $citizenship_div = CountryAndCity::where('name', 'Турция')->with('locale_fields.locale')->first()->locale_fields->where('locale.code', app()->getLocale())->first()->div;

        $title = __('Oneteam — лицензированное агентство недвижимости');

        $products = [];
        $products = Product::with('favorite')
            ->with('photo')
            ->with('ProductCategory')
            ->where(function ($query) {
                $query->where('complex_or_not', 'Нет')
                    ->where(function ($query)  {
                        $query->where('products.base_price', '>', 0);
                    })
                    ->orWhereHas('layouts');
            })
            ->with('peculiarities')
            ->with(['layouts' => function ($query) {
                $query->with('photos');
                $query->orderBy('price', 'asc');
            }])
            ->has('photo')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
        for ($i = 0; $i < count($products); $i++) {
            if (isset($products[$i]->layouts) && count($products[$i]->layouts) > 0) {
                $products[$i]->base_price = $products[$i]->layouts[0]->base_price;
                $products[$i]->price = $products[$i]->layouts[0]->price;
                $products[$i]->price_code = $products[$i]->layouts[0]->price_code;
            }
        }

        // Меняем параметры (для фронта)
        foreach ($products as $key => $object) {
            // Тэги
            $object->getTags(app()->getLocale());

            $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->base_price, (int)$object->size);
            $object->price = $this->currencyService->getPriceFromDB((int)$object->base_price);
            if(isset($object->country)) {
                $object->price_credit = $this->currencyService->getCreditPrice((int)$object->base_price, $object->country->inverse_credit_ratio);
            }

            // Получаем уникальные планировки
            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);

            // Цена за квартиру и за метр для планировок
            if (isset($object->layouts)) {
                foreach ($object->layouts as $index => $layout) {
                    if(isset($object->country)) {
                        $layout->price_credit = $this->currencyService->getCreditPrice((int)$layout->base_price, $object->country->inverse_credit_ratio);
                    }
                    $layout->price_size = $this->currencyService->getPriceSizeFromDB((int)$layout->price, (int)$layout->total_size);
                    $layout->price = $this->currencyService->getPriceFromDB((int)$layout->price);
                }
            }

            // Особенности
            // Можно использовать Scopes!!!
            $object->gostinnie = !empty($object->peculiarities->whereIn('type', "Гостиные")->first()) ? $object->peculiarities->whereIn('type', "Гостиные")->first()->name : null;
            $object->vanie = !empty($object->peculiarities->whereIn('type', "Ванные")->first()) ? $object->peculiarities->whereIn('type', "Ванные")->first()->name : null;
            $object->spalni = !empty($object->peculiarities->whereIn('type', "Спальни")->first()) ? $object->peculiarities->whereIn('type', "Спальни")->first()->name : null;
            $object->do_more = !empty($object->peculiarities->whereIn('type', "До моря")->first()) ? $object->peculiarities->whereIn('type', "До моря")->first()->name : null;
            $object->type_vid = !empty($object->peculiarities->whereIn('type', "Вид")->first()) ? $object->peculiarities->whereIn('type', "Вид")->first()->name : null;
            $object->peculiarities = !empty($object->peculiarities->whereIn('type', "Особенности")->all()) ? $object->peculiarities->whereIn('type', "Особенности")->all() : null;
        }

        $get_footer_link =  CompanySelect::orderby('status' , 'asc')->orderby('updated_at', 'desc')->get();

        return view('project.index', compact('all_country','citizenship_div', 'title', 'products', 'get_footer_link'));
    }


    public function products_from_map(Request $request){
        $get_products = Product::where('country_id', 17)->get();

        $spalni = [];
        $vanie = [];
        foreach ($get_products as $product) {
            $spalni[] = $product->spalni[0]->peculiarities_id;
            $vanie[] = $product->vanie[0]->peculiarities_id;
        }

        $args = array_unique(array_merge($spalni, $vanie));
        $get_peculiarities = DB::table('peculiarities')->whereIn('id', $args)->get();

        $data = array();
        foreach ($get_products as $product) {
            if (app()->getLocale() == 'en') {
//                    $city->name = $product->name_en;
            }
            if (app()->getLocale() == 'tr') {
//                    $city->name = $product->name_tr;
            }
            foreach ($get_peculiarities as $peciliarity) {
                if ($peciliarity->id = $product->spalni[0]->peculiarities_id) {
                    $spalni = $peciliarity->name;
                }
            }
            foreach ($get_peculiarities as $peciliarity) {
                if ($peciliarity->id = $product->vanie[0]->peculiarities_id) {
                    $vanie = $peciliarity->name;
                }
            }

            $data[] =
                [
                    'id' => $product->id,
                    'coordinate' => $product->lat . ',' . $product->long,
                    'price' => $product->price,
                    'spalni' => $spalni,
                    'vannie' => $vanie,
                    'kv' => $product->size,
                    'address' => $product->name,
                    'image' => 'uploads/' . $product->photo[0]->photo,
                ];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ],200);

    }
}
