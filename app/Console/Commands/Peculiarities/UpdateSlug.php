<?php

namespace App\Console\Commands\Peculiarities;

use App\Models\CountryAndCity;
use App\Models\Peculiarities;
use Illuminate\Console\Command;

class UpdateSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'peculiarities:update-slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update slug for peculiarities';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $peculiarities = Peculiarities::whereNull('slug')->orWhere('slug', '')->get();

        $progressBar = $this->output->createProgressBar(count($peculiarities));
        $progressBar->start();

        foreach ($peculiarities as $peculiarity) {
            $peculiarity->update();

            // Шаг для прогрессбара
            $progressBar->advance();
        }

        $progressBar->finish();
    }
}
