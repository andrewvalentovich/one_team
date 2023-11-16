<?php

namespace App\Http\Middleware;

use App\Models\Locale;
use Closure;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Locale::where('code', $request->session()->get('locale'))->first();

        if (!is_null($locale)) {
            app()->setLocale($locale->code);
        }

        return $next($request);
//        app()->setLocale($request->segment(1));
//
//        URL::defaults(['locale' => $request->segment(1)]);
//
//        return $next($request);
    }
}
