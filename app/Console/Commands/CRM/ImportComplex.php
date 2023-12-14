<?php

namespace App\Console\Commands\CRM;

use App\Models\CountryAndCity;
use App\Models\Product;
use App\Services\API\CRM\LayoutsForComplexService;
use App\Services\API\CRM\LayoutsService;
use App\Services\API\CRM\ObjectSimpleService;
use App\Services\API\CRM\ObjectsService;
use App\Services\GeocodingService;
use App\Services\ImportCrmDataService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportComplex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:import-complex {--update}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import (create, update, delete) complex from API';

    /**
     * Url for creating Http request
     *
     * @var string
     */
    private $endpoint_objects;

    /**
     * Url for creating Http request
     *
     * @var string
     */
    private $endpoint_layouts;

    /**
     * Token for API access
     *
     * @var string
     */
    private $token;

    /**
     * ImportCrmDataService
     *
     * @var ImportCrmDataService
     */
    private $importCrmDataService;

    private $objectSimpleService;
    private $layoutsService;

    public function __construct(
        ImportCrmDataService $importCrmDataService,
        ObjectSimpleService $objectSimpleService,
        LayoutsForComplexService $layoutsService,
        GeocodingService $geocodingService
    )
    {
        parent::__construct();
        $this->endpoint_objects = config('app.api_crm_url_complexes');
        $this->endpoint_layouts = config('app.api_crm_url_properties');
        $this->token = config('app.api_crm_token');
        $this->importCrmDataService = $importCrmDataService;
        $this->objectSimpleService = $objectSimpleService;
        $this->layoutsService = $layoutsService;
        $this->geocodingService = $geocodingService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start handle complexes');
        $this->objectSimpleService->handle($this->endpoint_objects, $this->token, $this->argument('id'), $this->option('update') ?? null);
        $this->info('Finish handle complexes');

        $this->info('Start handle object');
        $this->layoutsService->handle($this->endpoint_layouts, $this->token, $this->argument('id'), $this->option('update') ?? null);
        $this->info('Finish handle object');
    }
}
