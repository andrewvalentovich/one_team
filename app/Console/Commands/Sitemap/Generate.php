<?php

namespace App\Console\Commands\Sitemap;

use App\Models\CompanySelect;
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
        $sitemap = Sitemap::create();

        // Добавим главную страницу
        $sitemap->add(
            Url::create("/")
                ->setPriority(1)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        );

        // Статические страницы
        $staticLinks = [
            "/all_location",
            "/investments",
            "/residence_and_citizenship",
            "/installment_plan",
            "/contacts",
            "/my_favorites",
        ];

        // Добавим статические страницы
        foreach ($staticLinks as $link) {
            $sitemap->add(
                Url::create($link)
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        // Добавляем url для страниц стран (country page)
        CountryAndCity::whereNull('parent_id')->has('product_country')->get()->each(function (CountryAndCity $country) use ($sitemap) {
            $sitemap->add(
                Url::create("/country/country_id={$country->id}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        // Добавляем url для каталога по странам
        CountryAndCity::whereNull('parent_id')->has('product_country')->get()->each(function (CountryAndCity $country) use ($sitemap) {
            $sitemap->add(
                Url::create("/houses/?country_id={$country->id}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        // Добавляем url для каталога по регионам
        CountryAndCity::whereNotNull('parent_id')->has('product_city')->get()->each(function (CountryAndCity $city) use ($sitemap) {
            $sitemap->add(
                Url::create("/houses/?city_id={$city->id}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        // Добавляем url для каталога по типам недвижимости
        Peculiarities::where('type', 'Типы')->has('product')->get()->each(function (Peculiarities $peculiarity) use ($sitemap) {
            $sitemap->add(
                Url::create("/houses/?type={$peculiarity->id}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        // Добавляем url для каталога по типам сделки
        $sitemap->add(
            Url::create("/houses/?sale_or_rent=sale")
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        );
        $sitemap->add(
            Url::create("/houses/?sale_or_rent=rent")
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        );

        // Добавляем url для каталога по страницам (company_select)
        CompanySelect::orderBy('status' , 'asc')->get()->each(function (CompanySelect $page) use ($sitemap) {
            $sitemap->add(
                Url::create("/company_page/page_id={$page->id}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->line("End command");
    }
}
