<?php


namespace App\Services;


use Illuminate\Support\Facades\Session;

class LocaleUrlService
{
    public function addLocaleToUrl($request, $new_locale)
    {
        $url = $request->url();
        $new_locale = '/' . $new_locale;

        // Добавление $new_locale в $url
        return substr_replace($url, $new_locale, stripos($url, config('app.url')) + strlen(config('app.url')), 0);
    }

    public function replaceLocaleInUrl($request, $new_locale)
    {
        $url = $request->url();
        $segment = $request->segment(1);

        // Замена текущего языка на новый $new_locale
        return preg_replace("/$segment/", $new_locale, $url, 1);
    }

    public function insertLocaleIntoUrl($request, $new_locale)
    {
        $url = $request->url();
        $new_locale = $new_locale . '/';

        // Добавление $new_locale в $url
        return substr_replace($url, $new_locale, stripos($url, config('app.url')) + strlen(config('app.url')), 0);
    }
}
