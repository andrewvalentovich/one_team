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


Route::get('/houses/by_coordinates/with_filter', [\App\Http\Controllers\API\HousesController::class, 'getByCoordinatesWithFilter'])->name('api.houses.get.by_coordinates.with_filter'); //
Route::get('/houses/all', [\App\Http\Controllers\API\HousesController::class, 'getAll'])->name('api.houses.get.all'); //
Route::get('/houses/filter_params', [\App\Http\Controllers\API\SearchController::class, 'getParams'])->name('api.search.get.params'); //

// Новый
Route::get('/export', [\App\Http\Controllers\API\ExportController::class, 'export'])->name('api.export');

// Старые
Route::get('/export_req', [\App\Http\Controllers\API\ExportController::class, 'export_req'])->name('api.export_req');
Route::get('/flats_requests/export', [\App\Http\Controllers\API\ExportController::class, 'flats_request_export'])->name('api.flats_requests.export');
