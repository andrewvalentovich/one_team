<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Filters\HousesFilter;
use App\Models\CompanySelect;
use App\Models\ExchangeRate;
use App\Services\CurrencyService;
use App\Services\LayoutService;
use App\Services\SortService;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;
use App\Models\Product;
use DB;

class CounrtryController extends Controller
{
    private $currencyService;
    private $sortService;
    private $layoutService;

    public function __construct(CurrencyService $currencyService, SortService $sortService, LayoutService $layoutService)
    {
        $this->currencyService = $currencyService;
        $this->sortService = $sortService;
        $this->layoutService = $layoutService;
    }

    public function countries($slug)
    {
//        $get = CountryAndCity::where('slug', $slug)->withCount('product_city')->orderby('product_city_count','DESC')->get();
        $country = CountryAndCity::where('slug', $slug)->with(['product_country' => function($query) {
                $query->where(function ($query) {
                    $query->where('complex_or_not', 'Нет')
                        ->where(function ($query)  {
                            $query->where('products.base_price', '>', 0);
                        })
                        ->orWhereHas('layouts');
                });
            }])
            ->with('locale_fields.locale')
            ->with(['cities' => function($query) {
                $query
                    ->has('product_city')
                    ->with('locale_fields.locale')
                    ->with(['product_city' => function($query) {
                        $query->where(function ($query) {
                            $query->where('complex_or_not', 'Нет')
                                ->where(function ($query)  {
                                    $query->where('products.base_price', '>', 0);
                                })
                                ->orWhereHas('layouts');
                        });
                    }]);
            }])
            ->first();

        $title = $this->generateTitle($country);
        $citizenship_for_invesment = $this->citizenship_for_invesment($country);

        $get_footer_link =  CompanySelect::orderby('status' , 'asc')->orderby('updated_at', 'desc')->get();

        // Для гражданства от 400тыс
        $data['price']['min'] = 400000;
        $filter = app()->make(HousesFilter::class, ['queryParams' => $data, 'currencyService' => $this->currencyService]);

        $citizenship_product = [];
        if ($country->slug !== 'northern-cyprus') {
            $citizenship_product = Product::where('country_id', $country->id)
                ->where('grajandstvo', 'Да')
                ->with('favorite')
                ->with('photo')
                ->with('country')
                ->with('ProductCategory')
                ->with('peculiarities')
                ->where(function ($query) {
                    $query->where('complex_or_not', 'Нет')
                        ->where(function ($query)  {
                            $query->where('products.base_price', '>', 0);
                        })
                        ->orWhereHas('layouts');
                })
                ->with(['layouts' => function ($query) use ($data) {
                    // Ограничиваем вывод, только те у которых цена соответствует
                    if (isset($data['price']['min'])) {
                        $query->where('layouts.base_price', '>=', $data['price']['min']);
                    }
                    $query->with('photos');
                    $query->orderBy('price', 'asc');
                }])
                ->has('photo')
                ->filter($filter)
                ->inRandomOrder()
                ->limit(10)
                ->get();

            // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
            for ($i = 0; $i < count($citizenship_product); $i++) {
                if (isset($citizenship_product[$i]->layouts) && count($citizenship_product[$i]->layouts) > 0) {
                    $citizenship_product[$i]->base_price = $citizenship_product[$i]->layouts[0]->base_price;
                    $citizenship_product[$i]->price = $citizenship_product[$i]->layouts[0]->price;
                    $citizenship_product[$i]->price_code = $citizenship_product[$i]->layouts[0]->price_code;
                }
            }

            // Меняем параметры (для фронта)
            foreach ($citizenship_product as $key => $object) {
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
        }

        return view('project.country', compact('country', 'citizenship_product', 'get_footer_link', 'title', 'citizenship_for_invesment'));
    }

    private function generateTitle($country)
    {
        // Формируем заголовок
        $title = __('Недвижимость в регионе :name', ['name' => $country->locale_fields->where('locale.code', app()->getLocale())->first()->name]);

        return $title;
    }

    private function citizenship_for_invesment($country)
    {
        // Формируем заголовок
        $name = "";
        if(app()->getLocale() == 'ru') {
            if ($country->name == 'Турция') {
                $name = 'Турции';
            }
            if ($country->name == 'Северный Кипр') {
                $name = 'Северного Кипра';
            }
            if ($country->name == 'Черногория') {
                $name = 'Черногории';
            }
            if ($country->name == 'ОАЭ') {
                $name = 'ОАЭ';
            }
            if ($country->name == 'Катар') {
                $name = 'Катара';
            }
        } else {
            $name .= __('в') . ' '. $country->locale_fields->where('locale.code', app()->getLocale())->first()->name;
        }

        $text = __('Объекты для получения гражданства :name за инвестиции', ['name' => $name]);

        return $text;
    }
}
