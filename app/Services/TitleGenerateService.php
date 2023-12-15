<?php


namespace App\Services;


class TitleGenerateService
{
    /**
     * @param $title_string
     * @param $region
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|\Illuminate\Foundation\Application|string|null
     */
    public function handle($title_string, $region)
    {
        if (!is_null($region)) {
            // Формируем заголовок
            $title = __($title_string, ['name' => $region->locale_fields->where('locale.code', app()->getLocale())->first()->name]);
        } else {
            $title = null;
        }

        return $title;
    }
}
