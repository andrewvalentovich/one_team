<?php

namespace App\Console\Commands\CRM;

use App\Models\Product;
use App\Services\API\CRM\ComplexService;
use App\Services\API\CRM\LayoutsService;
use App\Services\API\CRM\ObjectsService;
use App\Services\ImportCrmDataService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:import-data {--no-complexes} {--no-objects} {--update} {--layouts-only}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import (create, update, delete) data from API';

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

    private $objectsService;
    private $layoutsService;

    public function __construct(
        ImportCrmDataService $importCrmDataService,
        ObjectsService $objectsService,
        LayoutsService $layoutsService
    )
    {
        parent::__construct();
        $this->endpoint_objects = config('app.api_crm_url_complexes');
        $this->endpoint_layouts = config('app.api_crm_url_properties');
        $this->token = config('app.api_crm_token');
        $this->importCrmDataService = $importCrmDataService;
        $this->objectsService = $objectsService;
        $this->layoutsService = $layoutsService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('no-complexes') && !$this->option('layouts-only')) {
            $this->info('Start handle complexes');
            Log::info('Start handle complexes');
            $this->objectsService->handle($this->endpoint_objects, $this->token, $this->option('update'));
            $this->info('Finish handle complexes');
            Log::info('Finish handle complexes');
        }

        if (!$this->option('no-objects')) {
            $this->info('Start handle object');
            Log::info('Start handle object');
            $this->layoutsService->handle($this->endpoint_layouts, $this->token, $this->option('update'), $this->option('layouts-only'));
            $this->info('Finish handle object');
            Log::info('Finish handle object');
        }
    }
}
