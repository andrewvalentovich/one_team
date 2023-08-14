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
//        $filter = app()->make(RealEstateFilter::class, ['queryParams' => $data]);
//        $real_estates = Product::filter($filter)->paginate(10);

        $exchange_rates = ExchangeRate::where('direct_val', 'EUR')->get();
        $exchanges = [];

        foreach ($exchange_rates as $exchange_rate) {
            $exchanges[$exchange_rate->relative_val] = $exchange_rate->sell_val;
        }
//
//        $get = Product::query();
//        if (isset($request->osobenost)){
//            $keys = array_keys($request->osobenost);
//            $type = ProductCategory::wherein('peculiarities_id', $keys)->get('product_id')->pluck('product_id')->toarray();
//            $get->wherein('id', $type);
//        }
//        if (isset($request->vid_id)){
//            $type = ProductCategory::where('peculiarities_id', $request->vid_id)->get('product_id')->pluck('product_id')->toarray();
//            $get->wherein('id', $type);
//        }
//        if (isset($request->all_size)){
//            $get->where('size', $request->all_size);
//        }
//        if (isset($request->home_size)){
//            $get->where('size_home', $request->home_size);
//        }
//        if (isset($request->do_more_id)){
//            $type = ProductCategory::where('peculiarities_id', $request->do_more_id)->get('product_id')->pluck('product_id')->toarray();
//            $get->wherein('id', $type);
//        }
//        if (isset($request->country_id)){
//            $get->where('country_id', $request->country_id);
//        }
//        if (isset($request->spalni_id)){
////            dd($request->spalni_id);
//            $type = ProductCategory::where('peculiarities_id', $request->spalni_id)->get('product_id')->pluck('product_id')->toarray();
//            $cat=  Peculiarities::where('id',  $request->spalni_id)->first()->name;
//            if ($cat != 'Неважно'){
//                $get->wherein('id', $type);
//            }
//        }
//        if (isset($request->vannie_id)){
//            $type = ProductCategory::where('peculiarities_id', $request->vannie_id)->get('product_id')->pluck('product_id')->toarray();
//            $cat=  Peculiarities::where('id',  $request->vannie_id)->first()->name;
//            if ($cat != 'Неважно'){
//                $get->wherein('id', $type);
//            }
//        }
//        if (isset($request->type)){
//            $type = ProductCategory::where('peculiarities_id', $request->type)->get('product_id')->pluck('product_id')->toarray();
//            $get->wherein('id', $type);
//        }
//
//        if (isset($request->currency_type) && $request->currency_type == 'lira' && isset($request->max_price)){
//            $request->max_price /= $exchanges['TRY'];
//        }
//        if (isset($request->currency_type) && $request->currency_type == 'lira' && isset($request->min_price)){
//            $request->min_price /= $exchanges['TRY'];
//        }
//        if (isset($request->currency_type) && $request->currency_type == 'rub' && isset($request->max_price)){
//            $request->max_price /= $exchanges['RUB'];
//        }
//        if (isset($request->currency_type) && $request->currency_type == 'rub' && isset($request->min_price)){
//            $request->min_price /= $exchanges['RUB'];
//        }
//        if (isset($request->currency_type) && $request->currency_type == 'usd' && isset($request->max_price)){
//            $request->max_price /= $exchanges['USD'];
//        }
//        if (isset($request->currency_type) && $request->currency_type == 'usd' && isset($request->min_price)){
//            $request->min_price /= $exchanges['USD'];
//        }
//        if (isset($request->min_price) && isset($request->max_price) ){
//            $get->whereBetween('price', [$request->min_price , $request->max_price]);
//        }
//        if (isset($request->min_price) && !isset($request->max_price)){
//            $get->where('price', '>=', $request->min_price);
//        }
//        if (!isset($request->min_price) && isset($request->max_price)){
//            $get->where('price', '<=', $request->max_price);
//        }
//        if (isset($request->ot_zastroishika)){
//            $get->where('owner', 'Застройщик');
//        }
//        if (isset($request->sale_or_rent)){
//            $get->where('sale_or_rent', $request->sale_or_rent);
//        }
//        if (isset($request->order_by)){
//            if ($request->order_by == 'price-asc'){
//                $get->orderby('price', 'asc');
//            }
//            if ($request->order_by == 'price-desc'){
//                $get->orderby('price', 'desc');
//            }
//            if ($request->order_by == 'created_at-desc'){
//                $get->orderby('created_at', 'desc');
//            }
//        }

        $get_product = Product::orderby('price','desc')->paginate(10);
        $country = CountryAndCity::where('id', 17)->first();
        $count = $get_product->count();
        return view('project.houses', compact('get_product', 'count', 'country', 'exchanges'));
    }
}
