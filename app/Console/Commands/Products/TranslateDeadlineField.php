<?php

namespace App\Console\Commands\Products;

use App\Models\Locale;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Models\ProductLocale;
use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateDeadlineField extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:translate-deadline {--id=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate deadline field to products table for single or multiple product';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");
        $ids = $this->option('id');

        if (empty($ids)) {
            $this->error("Option '--id=' is required");
            return false;
        }

        $products = Product::with('locale_fields.locale')->whereIn('id', $ids)->get();
        $locales = Locale::all();

        $progressBar = $this->output->createProgressBar(count($products));
        $progressBar->start();

        foreach ($products as $product) {
            $tmp_locales = $locales;
            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
            // Проходимся по полям продукта
            foreach ($product->locale_fields as $key => $value) {
                $this->line("- Translate for " . $value->locale->code);

                if (is_null($value->deadline)) {
                    $tmp_deadline = !empty($product->locale_fields->where('locale.code', 'ru')->first()) ? $tr->trans($product->locale_fields->where('locale.code', 'ru')->first()->deadline, $value->locale->code, "ru") : null;
                    $value->deadline = $tmp_deadline;
                    $value->save();
                }
                unset($tmp_deadline);
            }

            // Шаг для прогрессбара
            $progressBar->advance();
        }
        $progressBar->finish();

        $this->line("\n");
        $this->line("End command");
    }
}
