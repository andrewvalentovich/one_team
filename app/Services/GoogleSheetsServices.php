<?php


namespace App\Services;


use Google\Client;
use Revolution\Google\Sheets\Facades\Sheets;

class GoogleSheetsServices
{
    public function getData()
    {
        $sheets = Sheets::spreadsheet('1J9zGcYd1nmHmjVTiwmEoRH8I_DZ5KuxC_JOmc5fGf7o')->sheet('Translations')->get();
        $header = $sheets->pull(0);
        $posts = Sheets::collection($header, $sheets);

        $data = $posts->toArray();

        if ($data) {
            foreach ($data as $key => $value) {
                dump($value);
            }
        }else{
            dump('data not found');
        }
    }
}
