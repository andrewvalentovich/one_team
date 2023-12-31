<?php

namespace App\Http\Middleware;

use App\Services\LocaleUrlService;
use App\Services\UtmGoalsService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use function Illuminate\Mail\Mailables\subject;

class PageCounterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        ob_start();
        // Если пользователь зашёл первый раз - будет null
//        $session_page_count = !empty($request->session()->get('page_count')) ? $request->session()->get('page_count') : 0;
//        $session_pages = !empty($request->session()->get('pages')) ? $request->session()->get('pages') : [];
//        $session_pages[] = request()->headers->get('referer');
//        dump($session_pages);
//        $request->session()->put('pages', $session_pages);
//        $session_page_count++;
//        $request->session()->put('page_count', $session_page_count);

        $getPageCountCookie = Cookie::get('visited_pages_count');
        dump($getPageCountCookie);
//        if ($getPageCountCookie) {
            $getPageCountCookie++;
//        } else {
//            $getPageCountCookie = 2;
//        }
//        Cookie::queue(Cookie::make('visited_pages_count', $getPageCountCookie, 1, '/', config('app.domain')));
//        return $next($request)->cookie('visited_pages_count', $getPageCountCookie, 1, '/', config('app.domain'));
        return $next($request);
    }
}
