<?php

namespace App\Providers;


use App\Http\ViewComposers\HeaderViewComposer;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        View::composer('*', HeaderViewComposer::class);
    }
}
