<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Http\Filters\RealEstateFilter;
use App\Http\Requests\RealEstate\FilterRequest;
use App\Models\ExchangeRate;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Models\CountryAndCity;
use App\Models\ProductCategory;

class HousesController extends Controller
{
    public function index(FilterRequest $request)
    {

        $data = $request->validated();
        $exchange_rates = ExchangeRate::where('direct_val', 'EUR')->get();
        $exchanges = [];

        foreach ($exchange_rates as $exchange_rate) {
            $exchanges[$exchange_rate->relative_val] = $exchange_rate->sell_val;
        }

        $get_product = Product::orderby('price','desc')->paginate(10);
        $country = CountryAndCity::where('id', 17)->first();
        $get_city = \App\Models\CountryAndCity::where('parent_id', 17)->get();
        $count = $get_product->count();
        return view('project.houses', compact('get_product', 'count', 'country', 'exchanges'));
    }
}
