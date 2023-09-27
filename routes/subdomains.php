<?php

use App\Models\Landing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function ($subdomain) {
    $currentLanding = Landing::where('subdomain', $subdomain)->get();

    if (!$currentLanding->isEmpty()) {
        $landing = $currentLanding[0];

        if($landing->template->path === "complex") {
            $filter = \App\Models\Product::whereId($landing['relation_id'])->with('photo.category')->first();

            abort_if(!isset($filter), 404);

            $filter = $filter->get();
            $categories =
                DB::table('products')->select(['photo_categories.id', 'photo_categories.name'])
                    ->where('products.id', $landing['filter_' . $landing->template->path])
                    ->join('photo_tables', 'photo_tables.parent_id', '=', 'products.id')
                    ->join('photo_categories', 'photo_categories.id', '=', 'photo_tables.category_id')
                    ->distinct('name')
                    ->get();

            return view("landings/{$landing->template->path}", compact('landing', 'filter', 'categories'));
        }

        if($landing->template->path === "region") {
            $filter = \App\Models\CountryAndCity::find($landing['relation_id']);
            abort_if(!isset($filter), 404);
            $types = \App\Models\Peculiarities::where('type', 'Типы')->get();
            return view("landings/{$landing->template->path}", compact('landing', 'filter', 'types'));
        }

        if($landing->template->path === "country") {
            $filter = \App\Models\CountryAndCity::find($landing['relation_id']);
            abort_if(!isset($filter), 404);
            $types = \App\Models\Peculiarities::where('type', 'Типы')->get();
            return view("landings/{$landing->template->path}", compact('landing', 'filter', 'types'));
        }
    }

    abort_if(!isset($landing), 404);

    return false;
});
