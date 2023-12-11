<?php

namespace App\Http\Middleware;

use App\Services\LocaleUrlService;
use App\Services\UtmGoalsService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use function Illuminate\Mail\Mailables\subject;

class LocalizationMiddleware
{
    private $localeUrlService;
    private $utmGoalsService;

    public function __construct(LocaleUrlService $localeUrlService, UtmGoalsService $utmGoalsService)
    {
        $this->localeUrlService = $localeUrlService;
        $this->utmGoalsService = $utmGoalsService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // UTM-метки
        $this->utmGoalsService->handle();
        // Если пользователь зашёл первый раз - будет null
        $session_locale = !empty($request->session()->get('locale')) ? $request->session()->get('locale') : null;
        $defaultLocale = 'ru';

        if ($request->segment(1) == 'admin') {
            return $next($request);
        }

        if (stripos(substr($request->url(), 0, stripos($request->url(), config('app.domain'))), '.')) {
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

            Session::put('locale', $locale);
            app()->setLocale($locale);

            // Проверка имеется ли в урле язык
            if (is_null($segment)) {
                return redirect($this->localeUrlService->addLocaleToUrl($request, $locale));
            } else {
                // Проверка первого сегмента: язык или не язык
                if (in_array($segment, config('app.available_locales'))) {
                    if ($segment !== $locale) {
                        return redirect($this->localeUrlService->replaceLocaleInUrl($request, $locale));
                    } else {
                        return $next($request);
                    }
                } else {
                    return redirect($this->localeUrlService->insertLocaleIntoUrl($request, $locale));
                }
            }
	} else {
            // Получаем язык из url
            $segment = $request->segment(1);
            app()->setLocale($session_locale);
            Log::info(app()->getLocale());

            if ($session_locale == $segment) {
                return $next($request);
            } else {
                // Проверка имеется ли в урле язык
                if (is_null($segment)) {
                    return redirect($this->localeUrlService->addLocaleToUrl($request, $session_locale));
                } else {
                    // Проверка первого сегмента: язык или не язык
                    if (in_array($segment, config('app.available_locales'))) {
                        if ($segment !== $session_locale) {
                            return redirect($this->localeUrlService->replaceLocaleInUrl($request, $session_locale));
                        } else {
                            return $next($request);
                        }
                    } else {
                        return redirect($this->localeUrlService->insertLocaleIntoUrl($request, $session_locale));
                    }
                }
            }
        }

        return $next($request);
    }
}
