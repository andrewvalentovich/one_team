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
//        $locale = Locale::where('code', $request->session()->get('locale'))->first();
//
//        if (!is_null($locale)) {
//            app()->setLocale($locale->code);
//        }
//
//        return $next($request);
        $locale = Locale::where('code', $request->segment(1))->first();

        if ($request->segment(1) === "admin") {
            return $next($request);
        } else {
            if (!is_null($locale)) {
                app()->setLocale($locale->code);
                URL::defaults(['locale' => $request->segment(1)]);
                return $next($request);
            } else {
                app()->setLocale("ru");
                URL::defaults(['locale' => "ru"]);
                return redirect()->to(str_replace($request->segment(1), "ru", $request->url()));
            }
        }
    }
}
