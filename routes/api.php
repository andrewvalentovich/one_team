<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/export', [\App\Http\Controllers\API\ExportController::class, 'request_export'])->name('api.export');
Route::get('/houses/by_coordinates/with_filter', [\App\Http\Controllers\API\HousesController::class, 'getByCoordinatesWithFilter'])->name('api.houses.get.by_coordinates.with_filter'); //
Route::get('/houses/filter_params', [\App\Http\Controllers\API\SearchController::class, 'getParams'])->name('api.search.get.params'); //

Route::get('/flats_requests/export', [\App\Http\Controllers\API\ExportController::class, 'flats_request_export'])->name('api.flats_requests.export');
