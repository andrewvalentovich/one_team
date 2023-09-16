<?php

use App\Models\Landing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function ($subdomain) {
    $currentLanding = Landing::where('subdomain', $subdomain)->get();
    $filter = "";
    $content = "";

    if (!$currentLanding->isEmpty()) {
        $landing = $currentLanding[0];

        if($landing->template->path === "complex") {
            $filter = \App\Models\Product::find($landing['filter_'.$landing->template->path]);
//            $filter = \App\Models\Product::where('id', $landing['filter_'.$landing->template->path])->with('photo.category')->get();
//            $categories =
//                DB::table('products')
//                ->where('products.id', $landing['filter_'.$landing->template->path])
//                ->join('photo_tables', 'photo_tables.parent_id', '=', 'products.id')
//                ->join('photo_categories', 'photo_categories.id', '=', 'photo_tables.category_id')
//                ->get();
            $categories = \App\Models\PhotoCategory::all();
            return view("landings/{$landing->template->path}", compact('landing', 'filter'));
        }

        if($landing->template->path === "region") {
            $filter = \App\Models\CountryAndCity::find($landing['filter_'.$landing->template->path]);
            $types = \App\Models\Peculiarities::where('type', 'Типы')->get();
            return view("landings/{$landing->template->path}", compact('landing', 'filter', 'types'));
        }

        if($landing->template->path === "country") {
            $filter = \App\Models\CountryAndCity::find($landing['filter_'.$landing->template->path]);
            $types = \App\Models\Peculiarities::where('type', 'Типы')->get();
            return view("landings/{$landing->template->path}", compact('landing', 'filter', 'types'));
        }
    }

    abort_if(!isset($landing), 404);

    return false;
});
