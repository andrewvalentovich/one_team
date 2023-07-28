<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Metric as Metrics;
class Metric extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Metrics::create([
            'name' => 'Европа',
        ]);
        Metrics::create([
            'name' => 'Азия',
        ]);
        Metrics::create([
            'name' => 'Африка',
        ]);
        Metrics::create([
            'name' => 'Северная Америка',
        ]);
        Metrics::create([
            'name' => 'Южная Америка',
        ]);
        Metrics::create([
            'name' => 'Австралия',
        ]);
        Metrics::create([
            'name' => 'Антарктида',
        ]);
    }
}
