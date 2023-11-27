<?php

namespace App\Console\Commands\Products;

use App\Models\Product;
use App\Services\CurrencyService;
use Illuminate\Console\Command;

class SetPriceFromBasePrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:set-price-from-base-price';

    private $currencyService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set price from base price for products';

    public function __construct(CurrencyService $currencyService)
    {
        parent::__construct();
        $this->currencyService = $currencyService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");
        $products = Product::whereNull('price')->get();

        $progressBar = $this->output->createProgressBar(count($products));
        $progressBar->start();
        foreach ($products as $product) {
            $product->update([
                'price' => $this->currencyService->displayWithCurrency($product->base_price, $product->price_code)
            ]);

            // Шаг для прогрессбара
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->line("End command");
    }
}
