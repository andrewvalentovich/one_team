<?php

namespace App\Http\Middleware;

use App\Models\Locale;
use Closure;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
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
