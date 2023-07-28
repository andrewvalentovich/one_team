<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;
use App\Models\Product;

class CounrtryController extends Controller
{
    public function country($id){
        $get = CountryAndCity::where('parent_id', $id)->withCount('product_city')->orderby('product_city_count','DESC')->get();


        $country = CountryAndCity::where('id', $id)->first();
        $citizenship_product = Product::where('country_id', $id)->where('grajandstvo','Да')->inRandomOrder()->limit(10)->get();
        return view('project.country', compact('get','country', 'citizenship_product'));
    }
}
