<?php

use App\Models\Landing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function ($subdomain) {
    if ($subdomain === "www") {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return redirect(str_replace('www.', '', $url));
    } else {
        $currentLanding = Landing::where('subdomain', $subdomain)->get();

        if (!$currentLanding->isEmpty()) {
            $landing = $currentLanding[0];

            if ($landing->template->path === "complex") {
                $filter = \App\Models\Product::with('photo.category')->find($landing['relation_id']);

                abort_if(!isset($filter), 404);

                $categories =
                    DB::table('products')->select(['photo_categories.id', 'photo_categories.name'])
                        ->where('products.id', $filter->id)
                        ->join('photo_tables', 'photo_tables.parent_id', '=', 'products.id')
                        ->join('photo_categories', 'photo_categories.id', '=', 'photo_tables.category_id')
                        ->get();

                return view("landings/complex", compact('landing', 'filter', 'categories'));
            }

            if ($landing->template->path === "region") {
                $filter = \App\Models\CountryAndCity::find($landing['relation_id']);
                abort_if(!isset($filter), 404);
                $types = \App\Models\Peculiarities::where('type', 'Типы')->get();
                return view("landings/region", compact('landing', 'filter', 'types'));
            }

            if ($landing->template->path === "country") {
                $filter = \App\Models\CountryAndCity::find($landing['relation_id']);
                abort_if(!isset($filter), 404);
                $types = \App\Models\Peculiarities::where('type', 'Типы')->get();
                return view("landings/country", compact('landing', 'filter', 'types'));
            }
        }

        abort_if(!isset($landing), 404);

        return false;
    }
});
