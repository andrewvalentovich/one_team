<?php


namespace App\Services;


use Illuminate\Support\Facades\Session;

class UtmGoalsService
{
    public function handle()
    {
        $getUtmSource = $_GET['utm_source'] ?? null;
        $sessionUtmSource = Session::get('utm_source');
//        dump($getUtmSource);
//        dump($sessionUtmSource);

        if (!is_null($getUtmSource)) {
            if (is_null($sessionUtmSource)) {
                Session::put('utm_source', $getUtmSource);
            }
        }
    }
}
