<?php

namespace App\Console\Commands\Products;

use App\Models\Peculiarities;
use App\Models\Product;
use App\Services\SlugService;
use Illuminate\Console\Command;

class UpdateTextFieldsToBoolean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:update-text-fields-to-boolean';

    private $slugService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update text fields to boolean';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");
        $products = Product::withTrashed()->get();
        $progressBar = $this->output->createProgressBar(count($products));
        $progressBar->start();
        foreach ($products as $product) {
            // Гражданство
            if ($product->citizenship == 'Да') {
                $product->citizenship = 1;
            }
            if (!$product->citizenship || $product->citizenship == 'Нет') {
                $product->citizenship = 0;
            }

            // Гражданство
            if ($product->grajandstvo == 'Да') {
                $product->grajandstvo = 1;
            }
            if (!$product->grajandstvo || $product->grajandstvo == 'Нет') {
                $product->grajandstvo = 0;
            }

            // Парковка
            if ($product->parking == 'Да') {
                $product->parking = 1;
            }
            if (!$product->parking || $product->parking == 'Нет') {
                $product->parking = 0;
            }

            // Вил на жительство
            if ($product->vnj == 'Да') {
                $product->vnj = 1;
            }
            if (!$product->vnj || $product->vnj == 'Нет') {
                $product->vnj = 0;
            }

            // Комиссия
            if ($product->commissions == 'Да') {
                $product->commissions = 1;
            }
            if (!$product->commissions || $product->commissions == 'Нет') {
                $product->commissions = 0;
            }

            // Криптовалюта
            if ($product->cryptocurrency == 'Да') {
                $product->cryptocurrency = 1;
            }
            if (!$product->cryptocurrency || $product->cryptocurrency == 'Нет') {
                $product->cryptocurrency = 0;
            }

            // Криптовалюта
            if ($product->complex_or_not == 'Да') {
                $product->complex_or_not = 1;
            }
            if (!$product->complex_or_not || $product->complex_or_not == 'Нет') {
                $product->complex_or_not = 0;
            }

            $product->save();

            // Шаг для прогрессбара
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->line("End command");
    }
}
