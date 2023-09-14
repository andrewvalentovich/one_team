<?php

namespace App\Http\Middleware;


use App\Models\Landing;
use Closure;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Массив доменов, с которых будем принимать запросы.
     *
     * @var array
     */
    protected $domains = [];

    public function __construct()
    {
        $this->domains = Landing::select('domain')->pluck('domain');
    }

    /**
     * Метод, который обрабатывает все запросы, приходящие на сервер.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        header('Access-Control-Allow-Origin', '*');
        header('Access-Control-Allow-Methods', '*');
        header('Access-Control-Allow-Headers', '*');

        return $next($request);
    }
}
