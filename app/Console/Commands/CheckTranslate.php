<?php

namespace App\Console\Commands;

use App\Models\Locale;
use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CheckTranslate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check translate';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tr = new GoogleTranslate();
        $locales = Locale::all();

        foreach ($locales as $locale) {
            $this->info($locale->code);
            dump($tr->trans(
                "Высокий уровень вовлечения представителей целевой аудитории является четким доказательством простого факта: высокотехнологичная концепция общественного уклада не даёт нам иного выбора, кроме определения укрепления моральных ценностей. В частности, постоянное информационно-пропагандистское обеспечение нашей деятельности напрямую зависит от поставленных обществом задач. Современные технологии достигли такого уровня, что высококачественный прототип будущего проекта, в своём классическом представлении, допускает внедрение поставленных обществом задач.",
                $locale->code,
                "ru"
            ));
        }
    }
}
