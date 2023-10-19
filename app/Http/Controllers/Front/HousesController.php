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
    public function index()
    {
//        $data = $request->validated();
//        $exchange_rates = ExchangeRate::where('direct', 'RUB')->get();
//        $exchanges = [];
//
//        foreach ($exchange_rates as $exchange_rate) {
//            $exchanges[$exchange_rate->relative] = $exchange_rate->value;
//        }
//        $exchanges[$exchange_rates[0]->direct] = 1;
//
//        $get_product = Product::orderby('price','desc')->paginate(10);
        $country = CountryAndCity::where('id', 17)->first();
//        $countries = CountryAndCity::all();
//        $get_city = \App\Models\CountryAndCity::where('parent_id', 17)->get();
//        $count = $get_product->count();
//        return view('project.houses', compact('get_product', 'count', 'country', 'exchanges', 'countries'));
        return view('project.houses', compact('country'));
    }
}
