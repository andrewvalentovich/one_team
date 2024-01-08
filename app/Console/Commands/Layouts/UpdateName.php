<?php

namespace App\Console\Commands\Layouts;

use App\Models\Layout;
use Illuminate\Console\Command;

class UpdateName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'layouts:update-name';

    private $currencyService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update name for layouts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");
        $layouts = Layout::whereNull('name')->get();

        $progressBar = $this->output->createProgressBar(count($layouts));
        $progressBar->start();
        foreach ($layouts as $layout) {
            $layout->update([
                'name' => $layout->number_rooms
            ]);

            // Шаг для прогрессбара
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->line("End command");
    }
}
