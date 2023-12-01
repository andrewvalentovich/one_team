<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Locale;
use App\Services\LocaleUrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetLocaleController extends Controller
{
    private $localeUrlService;

    public function __construct(LocaleUrlService $localeUrlService)
    {
        $this->localeUrlService = $localeUrlService;
    }

    public function setLocale(Request $request, $new_locale)
    {
        $defaultLocale = 'ru';

        // Если предпочитаемого языка не существует - устанавливаем дефолтный
        if (!in_array($new_locale, config('app.available_locales'))) {
            $new_locale = $defaultLocale;
        }

        // Проверяем наличие новой локали в бд
        if (in_array($new_locale, config('app.available_locales'))) {
            Session::put('locale', $new_locale);
            app()->setLocale($new_locale);

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function getLocale()
    {
        $locale = app()->getLocale();

        return $locale;
    }
}

