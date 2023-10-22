<?php

namespace App\Console\Commands\CRM;

use App\Services\API\CRM\ComplexService;
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

    private $complexService;

    public function __construct(ImportCrmDataService $importCrmDataService, ComplexService $complexService)
    {
        parent::__construct();
        $this->endpoint_complexes = config('app.api_crm_url_complexes');
        $this->endpoint_layouts = config('app.api_crm_url_properties');
        $this->token = config('app.api_crm_token');
        $this->importCrmDataService = $importCrmDataService;
        $this->complexService = $complexService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start handle complexes');

        $this->complexService->handle($this->endpoint_complexes, $this->token);

        $this->info('Finish handle complexes');
//        try {
//            $client = new \GuzzleHttp\Client(['headers' => ['Authorization' => 'Bearer ' . $this->token]]);
//
//            $guzzleResponse = $client->get('https://crm.one-team.pro' . $this->endpoint . '?token=' . $this->token);
//
//            // Логирование статуса ответа
//            Log::info(Carbon::now()." Get data from API " . $guzzleResponse->getStatusCode());
//
//            if($guzzleResponse->getStatusCode() == 200) {
//                $response = json_decode($guzzleResponse->getBody(),true);
//                // perform your action with $response
//                $this->importCrmDataService->handle($response);
//            }
//        }
//        catch(\GuzzleHttp\Exception\RequestException $e) {
//            // you can catch here 40X response errors and 500 response errors
//            Log::info(Carbon::now() . " Catch API request error with status code - " . $guzzleResponse->getStatusCode());
//            $this->error(Carbon::now() . $e->getMessage());
//            Log::info(Carbon::now() . $e->getMessage());
//        } catch(Exception $e) {
//            // other errors
//            Log::info(Carbon::now() . " Catch API request error with status code - " . $guzzleResponse->getStatusCode());
//            $this->error(Carbon::now() . $e->getMessage());
//            Log::info(Carbon::now() . $e->getMessage());
//        }
    }
}
