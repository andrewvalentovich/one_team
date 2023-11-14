<?php


namespace App\Http\ViewComposers;


use App\Models\Locale;
use Illuminate\View\View;

class LocaleViewComposer
{
    public function compose(View $view): void
    {
        // Получаем все языки
        $view->with('locales', Locale::all());
    }
}
