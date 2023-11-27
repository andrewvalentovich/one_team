<?php

namespace App\Console\Commands\Products;

use App\Models\Peculiarities;
use App\Models\Product;
use App\Services\SlugService;
use Illuminate\Console\Command;

class UpdateSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:update-slug';

    private $slugService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update slug for all products';

    public function __construct(SlugService $slugService)
    {
        parent::__construct();
        $this->slugService = $slugService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");
        $products = Product::all();

        $progressBar = $this->output->createProgressBar(count($products));
        $progressBar->start();
        foreach ($products as $product) {
            $product->update([
                'slug' => $this->slugService->make($product->id)
            ]);

            // Шаг для прогрессбара
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->line("End command");
    }
}
