<?php

namespace App\Console\Commands\Regions;

use App\Models\CountryAndCity;
use App\Models\Locale;
use App\Models\RegionLocale;
use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regions:translate-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate content for countries and cities';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");
        $regions = CountryAndCity::with('locale_fields.locale')->get();
        $locales = Locale::all();

        $progressBar = $this->output->createProgressBar(count($regions));
        $progressBar->start();

        foreach ($regions as $region) {
            $tmp_locales = $locales;
            // Проходимся по полям продукта
            foreach ($tmp_locales as $key => $value) {
                // Если существует язык для которого выполнен перевод, то удаляем его из массива $locales
                if (!is_null($region->locale_fields->where('locale.code', $value->code)->first())) {
                    unset($tmp_locales[$key]);
                }
            }

            // Если существуют языки, на которых нет перевода, выполняем перевод
            if (!empty($tmp_locales)) {
                $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

                $this->line("\n");
                foreach ($tmp_locales as $key => $locale) {
                    $this->line("- Translate for " . $locale->code);
                    $tmp_name = !empty($region->name) ? $tr->trans($region->name, $locale->code, "ru") : null;
                    $tmp_div = !empty($region->div) ? $tr->trans($region->div, $locale->code, "ru") : null;

                    RegionLocale::create([
                        "region_id" => $region->id,
                        "locale_id" => $locale->id,
                        "name" => $tmp_name,
                        "div" => $tmp_div,
                    ]);

                    unset($tmp_name, $tmp_div);
                }
            }

            // Шаг для прогрессбара
            $progressBar->advance();
        }
        $progressBar->finish();

        $this->line("\n");
        $this->line("End command");
    }
}
