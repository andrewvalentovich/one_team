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

        $countries = CountryAndCity::all('name_en', 'lat', 'long');
        foreach ($countries as $index => $item) {
            if (in_array(strtolower($item->name_en), $categories_array)) {
                $country = $item;
            }
        }

        return view('project.houses', compact('country'));
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
        }
        $title = 'Oneteam / ';
        if (app()->getLocale() == 'en'){
            $name .= __('в') . ' '. $country->name_en;
        } elseif (app()->getLocale() == 'tr') {
            $name .= __('в') . ' '. $country->name_tr;
        } elseif (app()->getLocale() == 'de') {
            $name .= __('в') . ' '. $country->name_de;
        }
        $title .= $name;

        return $title;
    }
}
