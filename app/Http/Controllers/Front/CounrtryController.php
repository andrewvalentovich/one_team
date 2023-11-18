<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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
        $get = CountryAndCity::where('slug', $slug)->withCount('product_city')->orderby('product_city_count','DESC')->get();
        $country = CountryAndCity::where('slug', $slug)->with('product_country')->with('locale_fields.locale')->with('cities.product_city')->first();

        $title = $this->generateTitle($country);
        $citizenship_for_invesment = $this->citizenship_for_invesment($country);

        $count = CountryAndCity::where('parent_id', $country->id)->has('product_city')->get()->count();
        $get_footer_link =  CompanySelect::orderby('status' , 'asc')->orderby('updated_at', 'desc')->get();

        $citizenship_product = Product::where('country_id', $country->id)
            ->where('grajandstvo','Да')
            ->with('favorite')
            ->with('photo')
            ->with('ProductCategory')
            ->with('peculiarities')
            ->with(['layouts' => function($query) {
                $query->with('photos');
                $query->orderBy('price', 'asc');
            }])
            ->has('photo')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
        for ($i = 0; $i < count($citizenship_product); $i++) {
            if (isset($citizenship_product[$i]->layouts) && count($citizenship_product[$i]->layouts) > 0) {
                $citizenship_product[$i]->price = $citizenship_product[$i]->layouts[0]->price;
            }
        }

        // Меняем параметры (для фронта)
        foreach ($citizenship_product as $key => $object) {
            $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->price, (int)$object->size);
            $object->price = $this->currencyService->getPriceFromDB((int)$object->price);

            // Получаем уникальные планировки
            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);

            // Цена за квартиру и за метр для планировок
            if (isset($object->layouts)) {
                foreach ($object->layouts as $index => $layout) {
                    $layout->price_credit = $this->currencyService->getPriceCreditFromDB((int)$layout->price);
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

        return view('project.country', compact('get','country', 'citizenship_product', 'count', 'get_footer_link', 'title', 'citizenship_for_invesment'));
    }

    private function generateTitle($country)
    {
        // Формируем заголовок
        $name = __('Недвижимость');
        if(app()->getLocale() == 'ru') {
            if ($country->name == 'Турция') {
                $name .= ' в Турции';
            }
            if ($country->name == 'Северный Кипр') {
                $name .= ' на Северном Кипре';
            }
            if ($country->name == 'Черногория') {
                $name .= ' в Черногории';
            }
            if ($country->name == 'ОАЭ') {
                $name .= ' в ОАЭ';
            }
            if ($country->name == 'Катар') {
                $name .= ' в Катаре';
            }
        } else {
            $name .= ' ' . __('в') . ' '. $country->locale_fields->where('locale.code', app()->getLocale())->first()->name;
        }
        $title = 'Oneteam / ';
        $title .= $name;

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
