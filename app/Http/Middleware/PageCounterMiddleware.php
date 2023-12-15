<?php

namespace App\Http\Middleware;

use App\Services\LocaleUrlService;
use App\Services\UtmGoalsService;
use Closure;
use Illuminate\Http\Request;
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
//        // Если пользователь зашёл первый раз - будет null
//        $session_page_count = !empty($request->session()->get('page_count')) ? $request->session()->get('page_count') : 0;
//        $session_pages = !empty($request->session()->get('pages')) ? $request->session()->get('pages') : [];
//        $session_pages[] = request()->headers->get('referer');
//        dump($session_pages);
//        $session_page_count++;
//        $request->session()->put('page_count', $session_page_count);
//        $request->session()->put('pages', $session_pages);

        return $next($request);
    }
}
