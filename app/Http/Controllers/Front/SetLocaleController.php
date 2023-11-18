<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Locale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetLocaleController extends Controller
{
    public function setLocale(Request $request, $new_locale)
    {
        // Проверяем наличие новой локали в бд

        if (in_array($new_locale, config('app.available_locales'))) {
            Session::put('locale', $new_locale);
            $request->session()->put('locale', $new_locale);
            app()->setLocale($new_locale);

            // Заменяме локаль в url
            $url = back()->getTargetUrl();
            $segment = $request->segment(1);

            if (in_array($segment, config('app.available_locales'))) {
                $url = preg_replace("/$segment/", $new_locale, $url, 1);
            } else {
                $new_locale .= '/';
                $url = substr_replace($url, $new_locale, stripos($url, config('app.url')) + strlen(config('app.url')), 0);
            }

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

