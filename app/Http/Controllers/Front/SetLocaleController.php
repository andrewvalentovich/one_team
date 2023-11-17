<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Locale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetLocaleController extends Controller
{
    public function setLocale(Request $request, $prev_locale, $new_locale)
    {
        // Проверяем наличие новой локали в бд
        $locale = Locale::where('code', $new_locale)->first();

        if (!empty($locale)) {
            Session::put('locale', $new_locale);
            $request->session()->put('locale', $new_locale);
            app()->setLocale($new_locale);

            // Заменяме локаль в url
            $url = back()->getTargetUrl();
            $url = str_replace($prev_locale, $new_locale, $url);
            return redirect($url);
        } else {
            return redirect()->back();
        }

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

