<?php

namespace App\Console\Commands\Products;

use App\Models\Peculiarities;
use App\Models\Product;
use Illuminate\Console\Command;

class ChangeCategoryById extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-category-by-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change apartments category to houses category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $product_id = (int)$this->ask('Write product id?');
        $product = Product::with('peculiarities')->find($product_id);
        $product->peculiarities()->detach(2);
        $product->peculiarities()->attach(6);
        dump($product->peculiarities);
    }
}
