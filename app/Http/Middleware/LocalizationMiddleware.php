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
        $defaultLocale = 'ru';

        if ($request->segment(1) == 'admin') {
            return $next($request);
        }

        if (stripos($request->url(), '.')) {
            return $next($request);
        }

        if (is_null($session_locale)) {
            // Получаем предпочитаемый пользователем язык
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            $segment = $request->segment(1);

            // Если предпочитаемого языка не существует - устанавливаем дефолтный
            if (!in_array($locale, config('app.available_locales'))) {
                $locale = $defaultLocale;
            }

            // Проверка имеется ли в урле язык
            if (is_null($segment)) {
                return redirect($this->addLocaleToUrl($request, $locale));
            } else {
                // Проверка первого сегмента: язык или не язык
                if (in_array($segment, config('app.available_locales'))) {
                    return redirect($this->replaceLocaleInUrl($request, $locale));
                } else {
                    return redirect($this->insertLocaleIntoUrl($request, $locale));
                }
            }
        } else {
            // Получаем язык из url
            $locale = $request->segment(1);
            // Если язык есть в конфиге, то продолжаем маршрут
            if (in_array($locale, config('app.available_locales'))) {
                app()->setLocale($locale);
                return $next($request);
            } else {
                // Иначе устанавливаем дефольный язык
                app()->setLocale($defaultLocale);
                return $next($request);
            }
        }

        return $next($request);
    }

    private function addLocaleToUrl($request, $new_locale)
    {
        $url = $request->url();

        Session::put('locale', $new_locale);
        $new_locale = '/' . $new_locale;

        // Добавление $new_locale в $url
        return substr_replace($url, $new_locale, stripos($url, config('app.url')) + strlen(config('app.url')), 0);
    }

    private function replaceLocaleInUrl($request, $new_locale)
    {
        $url = $request->url();
        $segment = $request->segment(1);

        Session::put('locale', $new_locale);

        // Замена текущего языка на новый $new_locale
        return preg_replace("/$segment/", $new_locale, $url, 1);
    }

    private function insertLocaleIntoUrl($request, $new_locale)
    {
        $url = $request->url();

        Session::put('locale', $new_locale);
        $new_locale = $new_locale . '/';

        // Добавление $new_locale в $url
        return substr_replace($url, $new_locale, stripos($url, config('app.url')) + strlen(config('app.url')), 0);
    }
}
