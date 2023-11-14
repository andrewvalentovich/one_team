<?php

namespace App\Console\Commands\Products;

use App\Models\Locale;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Models\ProductLocale;
use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:translate-description-disposition';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate description and disposition fields to products table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");
        $products = Product::doesntHave('locale_fields')->get();
        $locales = Locale::all();

        $progressBar = $this->output->createProgressBar(count($products));
        $progressBar->start();
        foreach ($products as $product) {
            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

            $this->line("\n");
            foreach ($locales as $locale) {
                $this->line("- Translate for " . $locale->code);
                $tmp_description = !empty($product->description) ? $tr->trans($product->description, $locale->code, "ru") : null;
                $tmp_disposition = !empty($product->disposition) ? $tr->trans($product->disposition, $locale->code, "ru") : null;

                ProductLocale::create([
                    "product_id" => $product->id,
                    "locale_id" => $locale->id,
                    "description" => $tmp_description,
                    "disposition" => $tmp_disposition,
                ]);

                unset($tmp_description, $tmp_disposition);
            }

            // Шаг для прогрессбара
            $progressBar->advance();
        }
        $progressBar->finish();

        $this->line("\n");
        $this->line("End command");
    }
}
