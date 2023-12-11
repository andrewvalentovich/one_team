<?php


namespace App\Services;


use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class UtmGoalsService
{
    public function handle()
    {
        $getUtmSource = $_GET['utm_source'] ?? null;
        $cookieUtmSource = Session::get('utm_source');

        $getUtmMedium = $_GET['utm_medium'] ?? null;
        $cookieUtmMedium = Session::get('utm_medium');

        $getUtmCampaign = $_GET['utm_campaign'] ?? null;
        $cookieUtmCampaign = Session::get('utm_campaign');

        $getUtmTerm = $_GET['utm_term'] ?? null;
        $cookieUtmTerm = Session::get('utm_term');

        $getUtmContent = $_GET['utm_content'] ?? null;
        $cookieUtmContent = Session::get('utm_content');

        if (!is_null($getUtmSource)) {
            if (is_null($cookieUtmSource)) {
                Session::put('utm_source', $getUtmSource);
            }
        }

        if (!is_null($getUtmMedium)) {
            if (is_null($cookieUtmMedium)) {
                Session::put('utm_medium', $getUtmMedium);
            }
        }

        if (!is_null($getUtmCampaign)) {
            if (is_null($cookieUtmCampaign)) {
                Session::put('utm_campaign', $getUtmCampaign);
            }
        }

        if (!is_null($getUtmTerm)) {
            if (is_null($cookieUtmTerm)) {
                Session::put('utm_term', $getUtmTerm);
            }
        }

        if (!is_null($getUtmContent)) {
            if (is_null($cookieUtmContent)) {
                Session::put('utm_content', $getUtmContent);
            }
        }
    }
}
