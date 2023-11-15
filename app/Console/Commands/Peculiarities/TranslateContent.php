<?php

namespace App\Console\Commands\Peculiarities;

use App\Models\Locale;
use App\Models\Peculiarities;
use App\Models\PeculiarityLocale;
use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'peculiarities:translate-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate content for peculiarities';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");
        $peculiarities = Peculiarities::doesntHave('locale_fields')->get();
        $locales = Locale::all();

        $progressBar = $this->output->createProgressBar(count($peculiarities));
        $progressBar->start();
        foreach ($peculiarities as $peculiarity) {
            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

            $this->line("\n");
            foreach ($locales as $locale) {
                $this->line("- Translate for " . $locale->code);
                $tmp_name = !empty($peculiarity->name) ? $tr->trans($peculiarity->name, $locale->code, "ru") : null;

                PeculiarityLocale::create([
                    "peculiarity_id" => $peculiarity->id,
                    "locale_id" => $locale->id,
                    "name" => $tmp_name,
                ]);

                unset($tmp_name);
            }

            // Шаг для прогрессбара
            $progressBar->advance();
        }
        $progressBar->finish();

        $this->line("\n");
        $this->line("End command");
    }
}
