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
        $regions = CountryAndCity::doesntHave('locale_fields')->get();
        $locales = Locale::all();

        $progressBar = $this->output->createProgressBar(count($regions));
        $progressBar->start();
        foreach ($regions as $region) {
            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

            $this->line("\n");
            foreach ($locales as $locale) {
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

            // Шаг для прогрессбара
            $progressBar->advance();
        }
        $progressBar->finish();

        $this->line("\n");
        $this->line("End command");
    }
}
