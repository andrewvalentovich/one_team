<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Metric;
use App\Models\CountryAndCity;

class AllLocationController extends Controller
{
    public function all_location(){
        $metric = Metric::orderBy('name')->has('country')->get();
        $count = CountryAndCity::where('parent_id', null)->count();
        return view('project.all_location', compact('metric','count'));
    }
}
