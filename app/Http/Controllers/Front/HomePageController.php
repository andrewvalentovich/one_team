<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Admin\Peculiarities;
use App\Http\Resources\Map\CitiesCollection;
use App\Http\Resources\Map\CitiesResource;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;
use DB;

class HomePageController extends Controller
{
    public function home_page(){
        $all_country = CountryAndCity::where('parent_id', null)
            ->withCount('product_country')
            ->with('product_country')
            ->with('locale_fields.locale')
            ->orderBy('product_country_count', 'desc')
            ->limit(15)
            ->get();

        $citizenship_div = CountryAndCity::where('name', 'Турция')->first();
        $title = 'Oneteam — лицензированное агентство недвижимости';
        if (app()->getLocale() == 'en'){
            $title = 'Oneteam — licensed real estate agency';
            $citizenship_div->div = $citizenship_div->div_en;
        } elseif (app()->getLocale() == 'tr') {
            $title = 'Oneteam — lisanslı emlak acentesi';
            $citizenship_div->div = $citizenship_div->div_tr;
        } elseif (app()->getLocale() == 'de') {
            $title = 'Oneteam — lizenzierte Immobilienagentur';
            $citizenship_div->div = $citizenship_div->div_de;
        }

        return view('project.index', compact('all_country','citizenship_div', 'title'));
    }


    public function city_from_map(int $id = null)
    {
        // 17 - id страны (Турции)
        $id = is_null($id) ? 17 : $id;

        // Получаем города выбранной страны
        $cities = CountryAndCity::where('parent_id', $id)->with('locale_fields.locale')->has('product_city')->get();

        return response()->json([
           'status' => true,
           'data' => CitiesResource::collection($cities)->setLocale(app()->getLocale()),
        ],200);
    }


    public function products_from_map(Request $request){
        $get_products = Product::where('country_id', 17)->get();

        $spalni = [];
        $vanie = [];
        foreach ($get_products as $product) {
            $spalni[] = $product->spalni[0]->peculiarities_id;
            $vanie[] = $product->vanie[0]->peculiarities_id;
        }

        $args = array_unique(array_merge($spalni, $vanie));
        $get_peculiarities = DB::table('peculiarities')->whereIn('id', $args)->get();

        $data = array();
        foreach ($get_products as $product) {
            if (app()->getLocale() == 'en') {
//                    $city->name = $product->name_en;
            }
            if (app()->getLocale() == 'tr') {
//                    $city->name = $product->name_tr;
            }
            foreach ($get_peculiarities as $peciliarity) {
                if ($peciliarity->id = $product->spalni[0]->peculiarities_id) {
                    $spalni = $peciliarity->name;
                }
            }
            foreach ($get_peculiarities as $peciliarity) {
                if ($peciliarity->id = $product->vanie[0]->peculiarities_id) {
                    $vanie = $peciliarity->name;
                }
            }

            $data[] =
                [
                    'id' => $product->id,
                    'coordinate' => $product->lat . ',' . $product->long,
                    'price' => $product->price,
                    'spalni' => $spalni,
                    'vannie' => $vanie,
                    'kv' => $product->size,
                    'address' => $product->name,
                    'image' => 'uploads/' . $product->photo[0]->photo,
                ];
        }



        return response()->json([
            'status' => true,
            'data' => $data
        ],200);

    }


}
