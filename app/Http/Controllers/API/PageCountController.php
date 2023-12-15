<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PageCountController extends Controller
{
    public function increase(Request $request)
    {
        $getPageCountcookie = Cookie::get('visited_pages_count');
        if ($getPageCountcookie) {
            $getPageCountcookie++;
        } else {
            $getPageCountcookie = 1;
        }
        $cookie = Cookie::make('visited_pages_count', $getPageCountcookie, 1440, '', config('app.domain'));

        return response('Hello World')->cookie($cookie);
    }
}
