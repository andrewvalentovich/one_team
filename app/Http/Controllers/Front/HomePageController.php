<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;

class HomePageController extends Controller
{
    public function home_page(){
        $all_country = CountryAndCity::where('parent_id', null)->withCount('product_country')
            ->orderBy('product_country_count', 'desc')->limit(15)->get();
        $citizenship_div = CountryAndCity::where('name', 'Турция')->first();
        if (app()->getLocale() == 'en'){
            $citizenship_div->div = $citizenship_div->div_en;
        }elseif (app()->getLocale() == 'tr'){
            $citizenship_div->div = $citizenship_div->div_tr;

        }
        return view('project.index', compact('all_country','citizenship_div'));
    }


    public function city_from_map(Request $request, $id = null){
        if( isset($id) ) {
            $get_turkey = CountryAndCity::where('id', $id)->first();

            $get_turkey_city = CountryAndCity::where('parent_id', $get_turkey->id)->get();

            $data = array();
            foreach ($get_turkey_city as $city){
                if (app()->getLocale() == 'en'){
                    $city->name = $city->name_en;
                }
                if (app()->getLocale() == 'tr'){
                    $city->name = $city->name_tr;
                }
                $data[] =
                    [
                        'id' => $city->id,
                        'coordinate' => $city->lat.','.$city->long,
                        'name' => $city->name,
                        'count' => $city->product_city->count()
                    ];
            }
        } else {
            // Получаем Страну Турция
            $get_turkey = CountryAndCity::where('name', 'Турция')->first();

            // Получаем города Турции
            $get_turkey_city = CountryAndCity::where('parent_id', $get_turkey->id)->get();

            $data = array();
            foreach ($get_turkey_city as $city){
                if (app()->getLocale() == 'en'){
                    $city->name = $city->name_en;
                }
                if (app()->getLocale() == 'tr'){
                    $city->name = $city->name_tr;
                }
                // Получаем id, координаты, название города Турции и количество объектов которые ему принадлежат
                $data[] =
                    [
                        'id' => $city->id,
                        'coordinate' => $city->lat.','.$city->long,
                        'name' => $city->name,
                        'count' => $city->product_city->count()
                    ];
            }
        }


        return response()->json([
           'status' => true,
           'data' => $data
        ],200);

    }


}
