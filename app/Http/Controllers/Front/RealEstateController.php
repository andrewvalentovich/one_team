<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Http\Filters\RealEstateFilter;
use App\Http\Requests\RealEstate\FilterRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CountryAndCity;
use App\Models\ProductCategory;
use App\Models\Kurs;
use App\Models\Peculiarities;

class RealEstateController extends Controller
{
    public function index(FilterRequest $request){

        $data = $request->validated();
        $filter = app()->make(RealEstateFilter::class, ['queryParams' => $data]);
        $real_estates = Product::filter($filter)->paginate(10);
        $get_product = $real_estates;
        $country = CountryAndCity::where('id', 17)->first();
        $count = $real_estates->count();

        return view('project.real_estate', compact('get_product', 'count', 'country'));
    }
}
