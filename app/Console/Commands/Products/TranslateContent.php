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
    protected $signature = 'products:translate-content';

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
        $products = Product::with('locale_fields.locale')->get();
        $locales = Locale::all();

        $progressBar = $this->output->createProgressBar(count($products));
        $progressBar->start();

        foreach ($products as $product) {
            $tmp_locales = $locales;
            // Проходимся по полям продукта
            foreach ($tmp_locales as $key => $value) {
                // Если существует язык для которого выполнен перевод, то удаляем его из массива $locales
                if (!is_null($product->locale_fields->where('locale.code', $value->code)->first())) {
                    unset($tmp_locales[$key]);
                }
//                if (!is_null($tmp_locales->where('code', $value->locale->code)->first())) {
//                    unset($tmp_locales[$tmp_locales->where('code', $value->locale->code)->first()->id - 1]);
//                }
            }

            // Если существуют языки, на которых нет перевода, выполняем перевод
            if (!empty($tmp_locales)) {
                $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

                $this->line("\n");
                foreach ($tmp_locales as $key => $locale) {
                    $this->line("- Translate for " . $locale->code);
                    $tmp_description = !empty($product->description) ? $tr->trans($product->description, $locale->code, "ru") : null;
                    $tmp_disposition = !empty($product->disposition) ? $tr->trans($product->disposition, $locale->code, "ru") : null;
                    $tmp_deadline = !empty($product->deadline) ? $tr->trans($product->deadline, $locale->code, "ru") : null;

                    ProductLocale::create([
                        "product_id" => $product->id,
                        "locale_id" => $locale->id,
                        "description" => $tmp_description,
                        "disposition" => $tmp_disposition,
                        "deadline" => $tmp_deadline,
                    ]);
                    unset($tmp_description, $tmp_disposition, $tmp_deadline);
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
