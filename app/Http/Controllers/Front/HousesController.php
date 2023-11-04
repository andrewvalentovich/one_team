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
}
