<?php

namespace App\Console\Commands\CRM;

use App\Services\API\CRM\ComplexService;
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
    protected $signature = 'crm:import-data';

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
    private $endpoint_complexes;

    /**
     * Url for creating Http request
     *
     * @var string
     */
    private $endpoint_objects;

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

    private $complexService;
    private $objectService;

    public function __construct(
        ImportCrmDataService $importCrmDataService,
        ComplexService $complexService,
        ObjectsService $objectService
    )
    {
        parent::__construct();
        $this->endpoint_complexes = config('app.api_crm_url_complexes');
        $this->endpoint_objects = config('app.api_crm_url_properties');
        $this->token = config('app.api_crm_token');
        $this->importCrmDataService = $importCrmDataService;
        $this->complexService = $complexService;
        $this->objectService = $objectService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start handle complexes');
        $this->complexService->handle($this->endpoint_complexes, $this->token);
        $this->info('Finish handle complexes');

//        $this->info('Start handle object');
//        $this->objectService->handle($this->endpoint_objects, $this->token);
//        $this->info('Finish handle object');
    }
}
