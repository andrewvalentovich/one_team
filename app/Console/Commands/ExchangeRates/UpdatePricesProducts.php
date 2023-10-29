<?php

namespace App\Console\Commands\ExchangeRates;

use App\Models\ExchangeRate;
use App\Models\Product;
use App\Services\CurrencyService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use function Nette\Utils\data;

class UpdatePricesProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-prices-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update prices for products table, where direct price is EUR';

    /**
     * Execute the console command.
     */
    public function handle(CurrencyService $currencyService)
    {
        $products = Product::whereNotNull('price_code')->get();

        foreach ($products as $product) {
            $objects = json_decode($product->objects);
            if (is_countable($objects)) {
                foreach ($objects as $object) {
                    $object->price = $currencyService->convertPriceToEur($object->price, $object->price_code);
                }
            }

            $product->update([
                'price' => $currencyService->convertPriceToEur($product->price, $product->price_code),
                'objects' => json_encode($objects)
            ]);

            unset($objects);
        }
    }
}
