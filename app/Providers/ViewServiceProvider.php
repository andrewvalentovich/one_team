<?php

namespace App\Providers;


use App\Http\ViewComposers\HeaderViewComposer;
use App\Http\ViewComposers\LocaleViewComposer;
use App\Models\Locale;
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
        View::composer(['project.includes.header', 'admin.Product.single'], HeaderViewComposer::class);
        View::composer(['project.includes.header', 'admin.Product.single'], LocaleViewComposer::class);
    }
}
