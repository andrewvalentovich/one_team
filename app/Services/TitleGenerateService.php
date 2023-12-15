<?php


namespace App\Services;


use App\Models\CountryAndCity;

class TitleGenerateService
{
    /**
     * @param $title_string
     * @param $region
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|\Illuminate\Foundation\Application|string|null
     */
    public function titleForHouses($data)
    {
        $locale = isset($data['locale']) ? $data['locale'] : 'ru';
        $region = null;
        $title = 'One-team';
        if (isset($data['city'])) {
            $region = CountryAndCity::where('slug', $data['city'])->first();
        } else {
            if (isset($data['country'])) {
                $region = CountryAndCity::where('slug', $data['country'])->first();
            }
        }

        if (!is_null($region)) {
            // Формируем заголовок
            if (isset($data['sale_or_rent'])) {
                if ($data['sale_or_rent'] == 'rent') {
                    $title .= ' / ' . __('Аренда недвижимости в регионе :name', ['name' => $region->locale_fields->where('locale.code', $locale)->first()->name]);
                } else {
                    $title .= ' / ' . __('Покупка недвижимости в регионе :name', ['name' => $region->locale_fields->where('locale.code', $locale)->first()->name]);
                }
            } else {
                $title .= ' / ' . __('Недвижимость в регионе :name', ['name' => $region->locale_fields->where('locale.code', $locale)->first()->name]);
            }
        } else {
            if (isset($data['sale_or_rent'])) {
                if ($data['sale_or_rent'] == 'rent') {
                    $title .= ' / ' . __('Аренда недвижимости');
                } else {
                    $title .= ' / ' . __('Покупка недвижимости');
                }
            } else {
                $title .= ' / ' . __('Вся недвижимость');
            }
        }
        unset($region);

        return $title;
    }

    public function titleCatalogForHouses($data)
    {
        $locale = isset($data['locale']) ? $data['locale'] : 'ru';
        $region = null;
        $title = null;
        if (isset($data['city'])) {
            $region = CountryAndCity::where('slug', $data['city'])->first();
        } else {
            if (isset($data['country'])) {
                $region = CountryAndCity::where('slug', $data['country'])->first();
            }
        }

        if (!is_null($region)) {
            // Формируем заголовок
            if (isset($data['sale_or_rent'])) {
                if ($data['sale_or_rent'] == 'rent') {
                    $title .= __('Аренда недвижимости в регионе :name', ['name' => $region->locale_fields->where('locale.code', $locale)->first()->name]);
                } else {
                    $title .= __('Покупка недвижимости в регионе :name', ['name' => $region->locale_fields->where('locale.code', $locale)->first()->name]);
                }
            } else {
                $title .= __('Недвижимость в регионе :name', ['name' => $region->locale_fields->where('locale.code', $locale)->first()->name]);
            }
        } else {
            if (isset($data['sale_or_rent'])) {
                if ($data['sale_or_rent'] == 'rent') {
                    $title .= __('Аренда недвижимости');
                } else {
                    $title .= __('Покупка недвижимости');
                }
            } else {
                $title .= __('Вся недвижимость');
            }
        }
        unset($region);

        return $title;
    }
}
