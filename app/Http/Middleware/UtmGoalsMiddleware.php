<?php

namespace App\Http\Middleware;

use App\Services\LocaleUrlService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use function Illuminate\Mail\Mailables\subject;

class UtmGoalsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Если пользователь зашёл первый раз - будет null
        $session_utm_source = Session::get('utm_source');
//        dump($session_utm_source);
//        if (is_null($session_utm_source)) {
//
//        }

        return $next($request);
    }
}
