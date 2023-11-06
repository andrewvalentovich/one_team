<?php

namespace App\Console\Commands\Regions;

use App\Models\CountryAndCity;
use App\Models\PhotoTable;
use Exception;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;

class UpdateSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'country_and_cities:update-slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update slug for countries and cities';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $country_and_cities = CountryAndCity::whereNull('slug')->orWhere('slug', '')->get();

        $progressBar = $this->output->createProgressBar(count($country_and_cities));
        $progressBar->start();

        foreach ($country_and_cities as $region) {
            $region->update();

            // Шаг для прогрессбара
            $progressBar->advance();
        }

        $progressBar->finish();
    }
}
