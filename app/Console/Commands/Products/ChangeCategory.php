<?php

namespace App\Console\Commands\Products;

use App\Models\Peculiarities;
use App\Models\Product;
use Illuminate\Console\Command;

class ChangeCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change category from houses to apartments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $villa = Peculiarities::where('name_en', 'Villas, cottages')->get()[0];
        $apartment = Peculiarities::where('name_en', 'Apartments')->get()[0];

        $products = Product::whereHas('peculiarities', function ($query) use ($villa) {
            $query->where('peculiarities.id', $villa->id);
        })->with('peculiarities')->get();

        foreach ($products as $product) {
            try {
                $product->peculiarities()->detach($villa->id);
                $product->peculiarities()->attach($apartment->id);
                $this->line($product->id . " - Success!");
            } catch (\Exception $exception) {
                $this->error($product->id . " - Error!\n" . $exception->getMessage());
            }
        }

        $this->line("End command");
    }
}
