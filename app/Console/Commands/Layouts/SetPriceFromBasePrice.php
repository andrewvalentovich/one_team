<?php

namespace App\Console\Commands\Layouts;

use App\Models\Layout;
use App\Services\CurrencyService;
use Illuminate\Console\Command;

class SetPriceFromBasePrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'layouts:set-price-from-base-price';

    private $currencyService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set price from base price for layouts';

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

        $layouts = Layout::whereNull('price')->get();
        $progressBar = $this->output->createProgressBar(count($layouts));
        $progressBar->start();
        foreach ($layouts as $layout) {
            $layout->update([
                'price' => $this->currencyService->displayWithCurrency($layout->base_price, $layout->price_code)
            ]);

            // Шаг для прогрессбара
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->line("End command");
    }
}
