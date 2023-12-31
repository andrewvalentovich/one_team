<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'https://onetime.justcode.am'),
    'domain' => env('APP_DOMAIN', 'localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | API access
    |--------------------------------------------------------------------------
    |
    |   Авторизация
    |   во всех запросах в параметре token передавать токен
    |   Пример /api/external/properties?token={token}
    |   Endpoints
    |   GET /api/external/complexes - Список комплексов
    |   GET /api/external/complexes/{complex_id}/blocks - Список блоков в комплексе
    |   GET /api/external/blocks/{block_id}/layouts - Список планировок в блоке
    |   GET /api/external/properties/{property_id} - Объект недвижимости
    |   GET /api/external/properties - Список объектов недвижимости
    |   Фильтрация объектов (только для /api/external/properties): В параметры запроса передать название поля,
    |   по которому нужна фильтрация и значение. Работает только с полями которые не имеют множественных значений.
    |   Пример /api/external/properties?token={token}&country_name=Турция
    |
    */

    'api_crm_token' => env('API_CRM_TOKEN', 'wjP0OxkzUPx0KG9wIkyQrS15BT3FvoVt'),
    'api_crm_url_complexes' => env('API_CRM_URL_COMPLEXES', '/api/external/complexes'),
    'api_crm_url_blocks' => env('API_CRM_URL_BLOCKS', '/api/external/complexes/{complex_id}/blocks'),
    'api_crm_url_layouts' => env('API_CRM_URL_LAYOUTS', '/api/external/blocks/{block_id}/layouts'),
    'api_crm_url_properties_id' => env('API_CRM_URL_PROPERTIES_ID', '/api/external/properties/{property_id}'),
    'api_crm_url_properties' => env('API_CRM_URL_PROPERTIES', '/api/external/properties/'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Europe/Moscow',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'ru',

    /*
    |--------------------------------------------------------------------------
    | Application Available Locales Configuration
    |--------------------------------------------------------------------------
    |
    | All available locales
    |
    */

    'available_locales' => [
        'en',
        'uk',
        'ru',
        'tr',
        'fa',
        'ar',
        'tg',
        'uz',
        'kk',
        'de',
        'fr',
        'sv',
        'no',
        'nl',
        'da'
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY','dywegye0a4nevledtew9amxoe8u9oyft'),
    'token' => env('APP_TOKEN','4b66-afa1-dd72a4c43515'),
    'templates_token' => env('APP_TEMPLATES','4487-8209-2f3ecd682e7c'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        App\Providers\ViewServiceProvider::class,
        \App\Services\Localization\LocalizationServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
        'Image' => Intervention\Image\Facades\Image::class
    ])->toArray(),

];
