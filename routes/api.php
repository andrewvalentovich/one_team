<?php

use App\Http\Controllers\API\MapCityController;
use App\Http\Controllers\API\NewSiteController;
use App\Http\Controllers\Front\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::domain(config('app.domain'))->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Favorite
    Route::post('add_or_delete_in_favorite', [FavoriteController::class, 'add_or_delete_in_favorite'])->name('add_or_delete_in_favorite');
    Route::post('deleteFavorite', [FavoriteController::class, 'deleteFavorite'])->name('deleteFavorite');

    // Отдаются объекты для карт по фильтру
    Route::get('/houses/by_coordinates/with_filter', [\App\Http\Controllers\API\HousesController::class, 'getByCoordinatesWithFilter'])->name('api.houses.get.by_coordinates.with_filter');
    // Отдаются объекты для карт все
    Route::get('/houses/all', [\App\Http\Controllers\API\HousesController::class, 'getAll'])->name('api.houses.get.all');
    // Отдаются (все) параметры для фильтра
    Route::get('/houses/filter_params', [\App\Http\Controllers\API\SearchController::class, 'getParams'])->name('api.search.get.params');
    // Отдаётся объект для popup-карточки (например, в houses)
    Route::get('/houses/simple', [\App\Http\Controllers\API\HousesController::class, 'getSimple'])->name('api.houses.get.simple');

    // Отдаются (все) параметры для фильтра
    Route::get('/photo_categories/filter_params', [\App\Http\Controllers\API\PhotoCategoriesController::class, 'getParams'])->name('api.photo_categories.get.params');

    // Отдаются (все) exchange_rates (с учётом базовой или прямой)
    Route::get('exchange_rates/all', [\App\Http\Controllers\API\ExchangeRatesController::class, 'getAll'])->name('api.exchange_rates.get.all');

    // Получение стран
    Route::get('get_cities', [MapCityController::class, 'getCities'])->name('city_from_map');

    // Отдаются объекты для лендингов по фильтру
    Route::get('/landings/with_filter', [\App\Http\Controllers\API\LandingsController::class, 'getWithFilter'])->name('api.landings.get.with_filter');

    // Отдаём заявки в зависимости от токена (у каждого типа лендинга свой токен, который задаётся в panel.one-team.pro)
    Route::post('/requests/send', [\App\Http\Controllers\API\RequestsController::class, 'getRequest'])->name('api.requests.get');
    Route::post('/requests/lead', [\App\Http\Controllers\API\RequestsController::class, 'lead'])->name('api.requests.lead');
    Route::get('/requests/export', [\App\Http\Controllers\API\RequestsController::class, 'export'])->name('api.requests.export');
    Route::get('/requests/test', function () {
        dump(date('Y-m-d H:i:s', strtotime('now')));
        dd(strtotime('now'));
    })->name('api.requests.test');

    // API для нового сайта
    Route::get('/new_site/index', [NewSiteController::class, 'index'])->name('api.new_site.index');
    // Отдаётся каталог объектов для нового сайта
    Route::get('/houses/catalog', [\App\Http\Controllers\API\NewSiteController::class, 'catalog'])->name('api.houses.get.catalog');
    // Отдаётся объект для нового сайта
    Route::get('/houses/detail', [\App\Http\Controllers\API\NewSiteController::class, 'detail'])->name('api.houses.get.detail');
    // Отдаются объекты для нового сайта для карты
    Route::get('/houses/map', [\App\Http\Controllers\API\NewSiteController::class, 'map'])->name('api.houses.get.map');
    // Отдаются объекты для нового сайта для карты
    Route::get('/houses/favorite', [\App\Http\Controllers\API\NewSiteController::class, 'favorite'])->name('api.houses.get.favorite');

    // Отдаются объекты для нового сайта для карты
    Route::get('/cookies/page_count/increase', [\App\Http\Controllers\API\PageCountController::class, 'increase'])->name('api.cookies.page_count.increase');
});
