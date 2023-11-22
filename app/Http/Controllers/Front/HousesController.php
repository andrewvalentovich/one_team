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

        return view('project.houses', compact('region', 'title'));
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
