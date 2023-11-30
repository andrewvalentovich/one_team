<?php


namespace App\Services;


use Google\Client;
use Revolution\Google\Sheets\Facades\Sheets;

class GoogleSheetsServices
{
    protected $letters;

    public function __construct()
    {
        $this->letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'l', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    }

    public function getData()
    {
        $sheets = Sheets::spreadsheet('1J9zGcYd1nmHmjVTiwmEoRH8I_DZ5KuxC_JOmc5fGf7o')->sheet('Translations')->get();
        $header = $sheets->pull(0);
        $posts = Sheets::collection($header, $sheets);

        // Headers - массив с заголовками
        // Sheets - массив с колонками
        $data = $posts->toArray();

        foreach ($data as $key => $item) {
            $tmp = [];
            foreach ($item as $index => $value) {
                if (empty($value)) {
                    $value = 1;
                } else {
                    $tmp[] = $value;
                }
                $tmp[] = $value;
                dump($index . " - " . $value);
            }
            dd($tmp);
//            Sheets::sheet('Sheet 1')->range('A4')->get();
            unset($tmp);
            dd($key + 1); // Номер строки
        }
        dd($data[3]);



        if ($data) {
            foreach ($data as $key => $value) {
                dump($value);
            }
        }else{
            dump('data not found');
        }
    }
}
