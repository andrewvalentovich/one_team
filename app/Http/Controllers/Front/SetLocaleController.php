<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetLocaleController extends Controller
{
    public function setLocale(Request $request, $locale)
    {


        Session::put('locale', $locale);
        $request->session()->put('locale', $locale);
        app()->setLocale($locale);
        return redirect()->back();

//
//        if (in_array($locale, config('app.locales'))) {
//            app()->setLocale($locale);
//            Session::put('locale', $locale);
//        }

//        return redirect()->back();
    }
    public function getLocale()
    {
        $locale = app()->getLocale();

        return $locale;
    }
}

