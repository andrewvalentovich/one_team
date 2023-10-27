<?php

use App\Models\Landing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function ($subdomain) {
    if ($subdomain === "www") {
        $url = (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443 ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return redirect(str_replace('www.', '', $url));
    } else {
        $currentLanding = Landing::where('subdomain', $subdomain)->get();

        if (!$currentLanding->isEmpty()) {
            $landing = $currentLanding[0];
            $path = $landing->template->path;

            if ($path === "complex") {
                $filter = \App\Models\Product::with('photo.category')->find($landing['relation_id']);

                abort_if(!isset($filter), 404);

                $categories =
                    DB::table('products')->select(['photo_categories.id', 'photo_categories.name'])
                        ->where('products.id', $filter->id)
                        ->join('photo_tables', 'photo_tables.parent_id', '=', 'products.id')
                        ->join('photo_categories', 'photo_categories.id', '=', 'photo_tables.category_id')
                        ->groupBy('id')
                        ->orderBy('id')
                        ->get();

                return view("landings/$path", compact('landing', 'filter', 'categories'));
            }

            if ($path === "region") {
                $filter = \App\Models\CountryAndCity::find($landing['relation_id']);
                abort_if(!isset($filter), 404);
                $types = \App\Models\Peculiarities::where('type', 'Типы')->has('product')->get();
                return view("landings/$path", compact('landing', 'filter', 'types'));
            }

            if ($path === "country") {
                $filter = \App\Models\CountryAndCity::find($landing['relation_id']);
                abort_if(!isset($filter), 404);
                $cities = \App\Models\CountryAndCity::whereNotNull('parent_id')->has('product_city')->get();
                $types = \App\Models\Peculiarities::where('type', 'Типы')->has('product')->get();
                return view("landings/$path", compact('landing', 'filter', 'types', 'cities'));
            }

            unset($path);
        }

        abort_if(!isset($landing), 404);

        return false;
    }
});
