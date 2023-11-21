<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Если пользователь зашёл первый раз - будет null
        $session_locale = !empty(session('locale')) ? session('locale') : null;
        if (is_null($session_locale)) {
            // Получаем предпочитаемый пользователем язык
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            $segment = $request->segment(1);

            // Если язык в url совпадает с предпочитаемым языком пользователя, то устанавливаем язык и продолжаем маршрут
            if ($locale === $segment) {
                Session::put('locale', $locale);
                app()->setLocale($locale);
                return $next($request);
            } else {
                $url = $this->changeUrl($request, $locale);
                return redirect($url);
            }
        } else {
            // Получаем язык из url
            $locale = $request->segment(1);

            // Если язык есть в конфиге, то продолжаем маршрут
            if (in_array($locale, config('app.available_locales'))) {
                app()->setLocale($locale);
                return $next($request);
            } else {
                // Иначе устанавливаем язык - ru
                app()->setLocale("ru");
                return $next($request);
            }
        }
    }

    private function changeUrl($request, $new_locale)
    {
        $url = $request->url();
        $segment = $request->segment(1);

        if (in_array($segment, config('app.available_locales'))) {
            Session::put('locale', $segment);
            $url = preg_replace("/$segment/", $new_locale, $url, 1);
        } else {
            // Устанавливаем русский если нет совпадений
            $new_locale = 'ru';
            Session::put('locale', $new_locale);
            $new_locale = '/'.  $new_locale;
            $url = substr_replace($url, $new_locale, stripos($url, config('app.url')) + strlen(config('app.url')), 0);
        }

        unset($segment);

        return $url;
    }
}
