<?php

namespace App\Console\Commands\API;

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
    protected $signature = 'app:import-data';

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
    private $endpoint;

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

    public function __construct(ImportCrmDataService $importCrmDataService)
    {
        parent::__construct();
        $this->endpoint = config('app.api_crm_url_properties');
        $this->token = config('app.api_crm_token');
        $this->importCrmDataService = $importCrmDataService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $client = new \GuzzleHttp\Client(['headers' => ['Authorization' => 'Bearer ' . $this->token]]);

            $guzzleResponse = $client->get('https://crm.one-team.pro' . $this->endpoint . '?token=' . $this->token);

            // Логирование статуса ответа
            Log::info(Carbon::now()." Get data from API " . $guzzleResponse->getStatusCode());

            if($guzzleResponse->getStatusCode() == 200) {
                $response = json_decode($guzzleResponse->getBody(),true);
                // perform your action with $response
                $this->importCrmDataService->getData($response);
            }
        }
        catch(\GuzzleHttp\Exception\RequestException $e) {
            // you can catch here 40X response errors and 500 response errors
            Log::info(Carbon::now() . " Catch API request error with status code - " . $guzzleResponse->getStatusCode());
            Log::info(Carbon::now() . $e->getMessage());
        } catch(Exception $e) {
            // other errors
            Log::info(Carbon::now() . " Catch API request error with status code - " . $guzzleResponse->getStatusCode());
            Log::info(Carbon::now() . $e->getMessage());
        }
    }
}
