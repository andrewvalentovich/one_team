<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CountryAndCity;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $all_country = CountryAndCity::where('parent_id', null)->withCount('product_country')
            ->orderBy('product_country_count', 'desc')->limit(15)->get();
        $citizenship_div = CountryAndCity::where('name', 'Турция')->first();
        if (app()->getLocale() == 'en'){
            $citizenship_div->div = $citizenship_div->div_en;
        }elseif (app()->getLocale() == 'tr'){
            $citizenship_div->div = $citizenship_div->div_tr;
        }
        return view('panel.index', compact('all_country','citizenship_div'));
    }
}
