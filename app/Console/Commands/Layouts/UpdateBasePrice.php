<?php

namespace App\Console\Commands\Layouts;

use App\Models\Layout;
use App\Services\CurrencyService;
use Illuminate\Console\Command;

class UpdateBasePrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'layouts:update-base-price';

    private $currencyService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update base price for layouts';

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
        $layouts = Layout::all();

        $progressBar = $this->output->createProgressBar(count($layouts));
        $progressBar->start();
        foreach ($layouts as $layout) {
            $layout->update([
                'base_price' => $this->currencyService->convertPriceToEur($layout->price, $layout->price_code)
            ]);

            // Шаг для прогрессбара
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->line("End command");
    }
}
