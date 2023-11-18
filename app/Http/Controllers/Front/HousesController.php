<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Models\CountryAndCity;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    public function index()
    {
        $country = CountryAndCity::where('id', 17)->first();
        $countries = CountryAndCity::all();
        return view('project.houses', compact('country', 'countries'));
    }

    public function realty(Request $request, $categories)
    {
        $categories_array = explode('/', $categories);

        $country = null;
        foreach ($categories_array as $category) {
            $country = CountryAndCity::whereRaw('`slug` LIKE ? ', ['%'.$category.'%'])->first();
            unset($country_name);

            if (!is_null($country)) {
                break;
            }
        }

        // Генерация заголовка
        $title = $this->generateTitle($country);

        $countries = CountryAndCity::all('slug', 'lat', 'long');
        foreach ($countries as $index => $item) {
            if (in_array(strtolower($item->slug), $categories_array)) {
                $country = $item;
            }
        }

        return view('project.houses', compact('country', 'title'));
    }

    private function generateTitle($country)
    {
        if (!is_null($country)) {
            // Формируем заголовок
            $name = __('Покупка недвижимости');
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
        } else {
            $title = null;
        }

        return $title;
    }
}
