<?php

namespace App\Console\Commands\Sitemap;

use App\Models\CountryAndCity;
use App\Models\Peculiarities;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class Generate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");
        $productsitmap = Sitemap::create();

        // Добавляем url для каталога по странам
        CountryAndCity::whereNull('parent_id')->has('product_country')->get()->each(function (CountryAndCity $country) use ($productsitmap) {
            $productsitmap->add(
                Url::create("/houses/?country_id={$country->id}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        // Добавляем url для каталога по регионам
        CountryAndCity::whereNotNull('parent_id')->has('product_city')->get()->each(function (CountryAndCity $city) use ($productsitmap) {
            $productsitmap->add(
                Url::create("/houses/?city_id={$city->id}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        $productsitmap->writeToFile(public_path('sitemap.xml'));
        $this->line("End command");
    }
//        $path = public_path('sitemap.xml');
//        SitemapGenerator::create(config('app.url'))->getSitemap()->writeToFile($path);
//
//    }
}
