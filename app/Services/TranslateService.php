<?php


namespace App\Services;


use App\Models\Locale;
use App\Models\ProductLocale;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateService
{
    private function forNew($product_id, $description, $disposition)
    {
        $locales = Locale::all();

        foreach ($locales as $locale) {
            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

            $tmp_description = !empty($description) ? $tr->trans($description, $locale->code, "ru") : null;
            $tmp_disposition = !empty($disposition) ? $tr->trans($disposition, $locale->code, "ru") : null;

            ProductLocale::create([
                "product_id" => $product_id,
                "locale_id" => $locale->id,
                "description" => $tmp_description,
                "disposition" => $tmp_disposition,
            ]);

            unset($tmp_description, $tmp_disposition);
        }
    }
}
