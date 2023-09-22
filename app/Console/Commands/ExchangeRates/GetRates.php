<?php

namespace App\Console\Commands\ExchangeRates;

use App\Models\ExchangeRate;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use function Nette\Utils\data;

class GetRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get exchange rates from Russian Central Bank and put data into DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://www.cbr-xml-daily.ru/latest.js');

        // Логирование статуса ответа
        Log::info(Carbon::now()." Get exchange rates with API of Central Bank of Russia - status ".$response->status());

        $response = $response->json();

        $exchangeRates = ExchangeRate::all();

        foreach ($exchangeRates as $exchangeRate) {
            $exchangeRate->update(["value" => $response["rates"][$exchangeRate->relative]]);
        }
    }
}
