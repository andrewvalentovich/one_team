<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CountryAndCity;
use App\Models\ProductCategory;
use App\Models\Kurs;
use App\Models\Peculiarities;
class CityController extends Controller
{
    public function city($id, Request $request){

         $get = Product::query();;
        $get_kurs  = Kurs::first();

        if (isset($request->city_id)){
            $id = $request->city_id;
        }


//        dd($request);

        if (isset($request->osobenost)){
            $keys = array_keys($request->osobenost);
            $type = ProductCategory::wherein('peculiarities_id', $keys)->get('product_id')->pluck('product_id')->toarray();
            $get->wherein('id', $type);
        }

            if (isset($request->vid_id)){
                $type = ProductCategory::where('peculiarities_id', $request->vid_id)->get('product_id')->pluck('product_id')->toarray();
                $get->wherein('id', $type);
            }
            if (isset($request->all_size)){
                $get->where('size', $request->all_size);
            }
        if (isset($request->home_size)){
            $get->where('size_home', $request->home_size);
        }

            if (isset($request->do_more_id)){
                $type = ProductCategory::where('peculiarities_id', $request->do_more_id)->get('product_id')->pluck('product_id')->toarray();
                $get->wherein('id', $type);
            }

        if (isset($request->spalni_id)){
            dd($request->spalni_id);
            $type = ProductCategory::where('peculiarities_id', $request->spalni_id)->get('product_id')->pluck('product_id')->toarray();
          $cat=  Peculiarities::where('id',  $request->spalni_id)->first()->name;
          if ($cat != 'Неважно'){
              $get->wherein('id', $type);
          }
        }

        if (isset($request->vannie_id)){
            $type = ProductCategory::where('peculiarities_id', $request->vannie_id)->get('product_id')->pluck('product_id')->toarray();
            $cat=  Peculiarities::where('id',  $request->vannie_id)->first()->name;
            if ($cat != 'Неважно'){
                $get->wherein('id', $type);
            }
        }

        if (isset($request->type)){
             $type = ProductCategory::where('peculiarities_id', $request->type)->get('product_id')->pluck('product_id')->toarray();
             $get->wherein('id', $type);
         }


        if (isset($request->currency_type) && $request->currency_type == 'lira' && isset($request->max_price)){
            $request->max_price = $request->max_price / $get_kurs->lira;
        }
        if (isset($request->currency_type) && $request->currency_type == 'lira' && isset($request->min_price)){

            $request->min_price = $request->min_price / $get_kurs->lira;
        }

        if (isset($request->currency_type) && $request->currency_type == 'rub' && isset($request->min_price)){

            $request->max_price = $request->max_price / $get_kurs->rub;
        }

        if (isset($request->currency_type) && $request->currency_type == 'rub' && isset($request->min_price)){

            $request->min_price = $request->min_price / $get_kurs->rub;
        }






        if (isset($request->min_price) && isset($request->max_price) ){
            $get->whereBetween('price', [$request->min_price , $request->max_price]);
        }

        if (isset($request->min_price) && !isset($request->max_price)){
            $get->where('price', '>=', $request->min_price);
        }


        if (!isset($request->min_price) && isset($request->max_price)){
            $get->where('price', '<=', $request->max_price);
        }

        if (isset($request->ot_zastroishika)){
            $get->where('owner', 'Застройщик');
        }
        if (isset($request->orderby)){
            if ($request->orderby == 'price_asc'){
                $get->orderby('price', 'asc');
            }
            if ($request->orderby == 'price_desc'){
                $get->orderby('price', 'desc');
            }
            if ($request->orderby == 'new'){
                $get->orderby('id', 'desc');
            }
        }
        $country = CountryAndCity::where('id',$id) ->first();


        $count = $get->where('city_id', $id)->count();


        $get_product = $get-> where('city_id', $id)->orderby('price','asc')->paginate(10);


        return view('project.city', compact('get_product', 'country','count'));
    }

    public function product_from_map($id, Request $request){

        $get = Product::query();;
        $get_kurs  = Kurs::first();

        if (isset($request->city_id)){
            $id = $request->city_id;
        }


        if (isset($request->osobenost)){
            $keys = array_keys($request->osobenost);
            $type = ProductCategory::wherein('peculiarities_id', $keys)->get('product_id')->pluck('product_id')->toarray();
            $get->wherein('id', $type);
        }

        if (isset($request->vid_id)){
            $type = ProductCategory::where('peculiarities_id', $request->vid_id)->get('product_id')->pluck('product_id')->toarray();
            $get->wherein('id', $type);
        }
        if (isset($request->all_size)){
            $get->where('size', $request->all_size);
        }
        if (isset($request->home_size)){
            $get->where('size_home', $request->home_size);
        }

        if (isset($request->do_more_id)){
            $type = ProductCategory::where('peculiarities_id', $request->do_more_id)->get('product_id')->pluck('product_id')->toarray();
            $get->wherein('id', $type);
        }

        if (isset($request->spalni_id)){
            $type = ProductCategory::where('peculiarities_id', $request->spalni_id)->get('product_id')->pluck('product_id')->toarray();
            $cat=  Peculiarities::where('id',  $request->spalni_id)->first()->name;
            if ($cat != 'Неважно'){
                $get->wherein('id', $type);
            }
        }

        if (isset($request->vannie_id)){
            $type = ProductCategory::where('peculiarities_id', $request->vannie_id)->get('product_id')->pluck('product_id')->toarray();
            $cat=  Peculiarities::where('id',  $request->vannie_id)->first()->name;
            if ($cat != 'Неважно'){
                $get->wherein('id', $type);
            }
        }

        if (isset($request->type)){
            $type = ProductCategory::where('peculiarities_id', $request->type)->get('product_id')->pluck('product_id')->toarray();
            $get->wherein('id', $type);
        }


        if (isset($request->currency_type) && $request->currency_type == 'lira' && isset($request->max_price)){
            $request->max_price = $request->max_price / $get_kurs->lira;
        }
        if (isset($request->currency_type) && $request->currency_type == 'lira' && isset($request->min_price)){

            $request->min_price = $request->min_price / $get_kurs->lira;
        }

        if (isset($request->currency_type) && $request->currency_type == 'rub' && isset($request->min_price)){

            $request->max_price = $request->max_price / $get_kurs->rub;
        }

        if (isset($request->currency_type) && $request->currency_type == 'rub' && isset($request->min_price)){

            $request->min_price = $request->min_price / $get_kurs->rub;
        }






        if (isset($request->min_price) && isset($request->max_price) ){
            $get->whereBetween('price', [$request->min_price , $request->max_price]);
        }

        if (isset($request->min_price) && !isset($request->max_price)){
            $get->where('price', '>=', $request->min_price);
        }


        if (!isset($request->min_price) && isset($request->max_price)){
            $get->where('price', '<=', $request->max_price);
        }

        if (isset($request->ot_zastroishika)){
            $get->where('owner', 'Застройщик');
        }
        if (isset($request->orderby)){
            if ($request->orderby == 'price_asc'){
                $get->orderby('price', 'asc');
            }
            if ($request->orderby == 'price_desc'){
                $get->orderby('price', 'desc');
            }
            if ($request->orderby == 'new'){
                $get->orderby('id', 'desc');
            }
        }
        $country = CountryAndCity::where('id',$id) ->first();


        $count = $get->where('city_id', $id)->count();


        $get_product = $get-> where('city_id', $id)->orderby('price','desc')->paginate(10);



        $data =  array();
        foreach ($get_product as $city){

            foreach ($city->ProductCategory->where('type', 'Спальни') as $spalni ){
                $spalni = $spalni->category->name;
            }
            foreach ($city->ProductCategory->where('type', 'Ванные') as $vannie ){
                $vannie = $vannie->category->name;
            }

            $data[] =
                [
                    'id' => $city->id,
                    'coordinate' => $city->lat.','.$city->long,
                    'name' => $city->name,
                    'price' => $city->price,
                    'spalni' =>str_replace('+','',$spalni),
                    'vannie' =>str_replace('+','',$vannie),
                    'kv' => $city->size,
                    'address' => $city->address,
                    'photo' => asset('uploads/'.$city->photo[0]->photo)
                ];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ],200);
    }
}
