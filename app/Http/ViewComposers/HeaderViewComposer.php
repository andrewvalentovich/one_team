<?php


namespace App\Http\ViewComposers;


use App\Models\favorite;
use Illuminate\View\View;

class HeaderViewComposer
{
    public function compose(View $view): void
    {
        // Получаем количество "сердечек"
        $view->with('fav_count', favorite::where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null)->count());
    }
}
