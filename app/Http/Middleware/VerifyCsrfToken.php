<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'admin/*',
        'login/',
        'send_request',
        'login/',
        'logined/',
        'add_or_delete_in_favorite/',
        'deleteFavorite/',
        'delete_my_all_favorite/',
        'landings/',
        'landings/*',
    ];
}
