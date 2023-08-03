<?php

use App\Http\Controllers\Front\RealEstateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\CountryAndCityController;
use App\Http\Controllers\Admin\Peculiarities;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\KursController;
use App\Http\Controllers\Admin\VngAndGrjController;
use App\Http\Controllers\Admin\InvestPageController;
use App\Http\Controllers\Admin\PolicyAndPrivice;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\RasrochkaController;
use App\Http\Controllers\Admin\CompanySelectController;
use App\Http\Controllers\Front\HomePageController;
use App\Http\Controllers\Front\AllLocationController;
use App\Http\Controllers\Front\CounrtryController;
use App\Http\Controllers\Front\CityController;
use App\Http\Controllers\Front\SetLocaleController;
use App\Http\Controllers\Front\RequestController;
use App\Http\Controllers\Front\FavoriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//
//Route::get('/', function () {
//redirect()->route('home_page');
//
//});





Route::view('test','test2');


Route::get('setLocale/{local}', [SetLocaleController::class,'setLocale'])->name('setLocale');


//Route::prefix(app()->getLocale())->group(function () {
Route::get('/', [HomePageController::class, 'home_page'])->name('home_page');
Route::get('city_from_map/{id?}',[HomePageController::class, 'city_from_map'])->name('city_from_map');
Route::get('all_location',[AllLocationController::class, 'all_location'])->name('all_location');
Route::get('country/country_id={id}',[CounrtryController::class,'country'])->name('country');
Route::get('city/city_id={id}',[CityController::class,'city'])->name('city');

Route::get('/real_estate', [RealEstateController::class, 'index'])->name('real_estate.index'); // Отображаем недвижимость по фильтру

Route::post('product_from_map/{id}',[CityController::class,'product_from_map'])->name('product_from_map');
Route::get('investments', [InvestPageController::class, 'investments'])->name('investments');
Route::get('residence_and_citizenship', [VngAndGrjController::class, 'residence_and_citizenship'])->name('residence_and_citizenship');
Route::get('installment_plan',[RasrochkaController::class,'installment_plan'])->name('installment_plan');
Route::get('company_page/page_id={id}', [CompanySelectController::class, 'company_page'])->name('company_page');
Route::get('contacts', [ContactsController::class,'contacts'])->name('contacts');
Route::get('my_favorites', [FavoriteController::class,'my_favorites'])->name('my_favorites');
Route::get('delete_my_all_favorite', [FavoriteController::class,'delete_my_all_favorite'])->name('delete_my_all_favorite');
Route::post('deleteFavorite', [FavoriteController::class,'deleteFavorite'])->name('deleteFavorite');
Route::get('order_by_filter', [FavoriteController::class, 'order_by_filter'])->name('order_by_filter');
//});

Route::post('add_or_delete_in_favorite', [FavoriteController::class, 'add_or_delete_in_favorite'])->name('add_or_delete_in_favorite');

Route::post('send_request', [RequestController::class,'send_request'])->name('send_request');

Route::get('personal_data_processing_policy', [PolicyAndPrivice::class,'personal_data_processing_policy'])->name('personal_data_processing_policy');
Route::get('user_agreement_when_using_the_site', [PolicyAndPrivice::class,'user_agreement_when_using_the_site'])->name('user_agreement_when_using_the_site');


Route::prefix('admin')->group(function () {
    Route::middleware(['NoAuthUser'])->group(function () {
        Route::get('/login',[AdminLoginController::class,'login'])->name('login');
        Route::post('/logined',[AdminLoginController::class,'logined'])->name('logined');
    });


    Route::middleware(['AuthUser'])->group(function () {

        Route::get('all_requests_new', [RequestController::class, 'all_requests_new'])->name('all_requests_new');
        Route::get('requests_old', [RequestController::class, 'requests_old'])->name('requests_old');
        Route::get('update_status_one/{id}', [RequestController::class, 'update_status_one'])->name('update_status_one');
        Route::get('update_status_two/{id}', [RequestController::class, 'update_status_two'])->name('update_status_two');
        Route::get('single_page_request/{id}', [RequestController::class, 'single_page_request'])->name('single_page_request');

        Route::get('invest_page',[InvestPageController::class,'invest_page'])->name('invest_page');
        Route::post('invest_page_create',[InvestPageController::class,'invest_page_create'])->name('invest_page_create');
        Route::get('vng_page',[VngAndGrjController::class,'vng_page'])->name('vng_page');
        Route::post('vng_page_create',[VngAndGrjController::class,'vng_page_create'])->name('vng_page_create');
        Route::get('rasrochka_page',[RasrochkaController::class,'rasrochka_page'])->name('rasrochka_page');
        Route::post('rasrochka_page_create',[RasrochkaController::class,'rasrochka_page_create'])->name('rasrochka_page_create');

        Route::get('contacts_page', [ContactsController::class, 'contacts_page'])->name('contacts_page');
        Route::post('contacts_page_create', [ContactsController::class, 'contacts_page_create'])->name('contacts_page_create');


        Route::get('police', [PolicyAndPrivice::class,'police'])->name('police');
        Route::post('police_create', [PolicyAndPrivice::class,'police_create'])->name('police_create');

        Route::get('privice', [PolicyAndPrivice::class,'privice'])->name('privice');
        Route::post('privice_create', [PolicyAndPrivice::class,'privice_create'])->name('privice_create');

        Route::get('all_company_select', [CompanySelectController::class, 'all_company_select'])->name('all_company_select');
        Route::get('all_company_select_page', [CompanySelectController::class, 'all_company_select_page'])->name('all_company_select_page');
        Route::post('all_company_select_page_create', [CompanySelectController::class, 'all_company_select_page_create'])->name('all_company_select_page_create');
        Route::get('company_select_single/page_id={id}', [CompanySelectController::class,'company_select_single'])->name('company_select_single');
        Route::post('update_select_page', [CompanySelectController::class, 'update_select_page'])->name('update_select_page');
        Route::get('delete_select_page/select_id={id}', [CompanySelectController::class,'delete_select_page'])->name('delete_select_page');

            Route::get('value_page', [KursController::class,'value_page'])->name('value_page');

        Route::group(['as' => 'admin.'], function() {
            Route::resource('/exchange_rates', \App\Http\Controllers\Admin\ExchangeRateController::class); // CRUD model ExchangeRate
        });

            Route::post('update_value', [KursController::class,'update_value'])->name('update_value');

        Route::get('HomePage', [AdminLoginController::class,'HomePage'])->name('HomePage');
        Route::get('logoutAdmin', [AdminLoginController::class,'logoutAdmin'])->name('logoutAdmin');


        Route::get('settingView', [AdminLoginController::class, 'settingView'])->name('settingView');
        Route::post('updatePassword', [AdminLoginController::class, 'updatePassword'])->name('updatePassword');



        Route::get('all_country' , [CountryAndCityController::class, 'all_country'])->name('all_country');
        Route::get('new_country_page' , [CountryAndCityController::class, 'new_country_page'])->name('new_country_page');
        Route::post('create_country' , [CountryAndCityController::class, 'create_country'])->name('create_country');
        Route::get('single_country/country_id={id}' , [CountryAndCityController::class, 'single_country'])->name('single_country');
        Route::post('update_country' , [CountryAndCityController::class, 'update_country'])->name('update_country');
        Route::get('delete_country/country_id={id}' , [CountryAndCityController::class, 'delete_country'])->name('delete_country');
        Route::post('get_city', [CountryAndCityController::class,'get_city'])->name('get_city');


        Route::get('peculiarities_peculiarities/{string}',[Peculiarities::class,'peculiarities_peculiarities'])->name('peculiarities_peculiarities');
        Route::get('new_peculiarities/{string}',[Peculiarities::class,'new_peculiarities'])->name('new_peculiarities');
        Route::post('create_peculiarities',[Peculiarities::class,'create_peculiarities'])->name('create_peculiarities');
        Route::post('update_peculiarities',[Peculiarities::class,'update_peculiarities'])->name('update_peculiarities');
        Route::get('single_peculiarities/peculiarities_id={id}',[Peculiarities::class,'single_peculiarities'])->name('single_peculiarities');
        Route::get('delete_peculiarities/peculiarities_id={id}',[Peculiarities::class,'delete_peculiarities'])->name('delete_peculiarities');


        Route::get('rent_product/category_ids={id}',[ProductController::class,'rent_product'])->name('rent_product');
        Route::get('all_product/category_id={id}',[ProductController::class,'all_product'])->name('all_product');
        Route::get('create_product_page/category_id={id}',[ProductController::class,'create_product_page'])->name('create_product_page');
        Route::get('single_page_product/product_id={id}',[ProductController::class,'single_page_product'])->name('single_page_product');
        Route::get('delete_osobenosti/osobenosty_id={id}',[ProductController::class,'delete_osobenosti'])->name('delete_osobenosti');
        Route::get('delete_product_photo/photo_id={id}',[ProductController::class,'delete_product_photo'])->name('delete_product_photo');
        Route::get('delete_drawing/photo_id={id}',[ProductController::class,'delete_drawing'])->name('delete_drawing');


        Route::get('delete_product/photo_id={id}',[ProductController::class,'delete_product'])->name('delete_product');
        Route::post('create_product',[ProductController::class,'create_product'])->name('create_product');
        Route::post('update_product',[ProductController::class,'update_product'])->name('update_product');
    });

});
