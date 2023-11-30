<?php


namespace App\Services;


use Google\Client;
use Illuminate\Support\Facades\Log;
use Revolution\Google\Sheets\Facades\Sheets;
use Stichoza\GoogleTranslate\GoogleTranslate;

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

            // Проходимся по строкам
            foreach ($item as $index => $value) {
                // Если ячейка - пустая
                if (empty($value)) {
                    // И не пустой ключ (на русском)
                    if (!empty($item['Key'])) {
                        try {
                            // Выполняем перевод
                            $tr = new GoogleTranslate();
                            $tmp[] = $tr->trans($item['Key'], $index, "ru");
                            unset($tr);

                        } catch (\Exception $e) {
                            dump('Row - ' . $key . ', col - ' . $index);
                            dump('Translate google sheets with error - ' . $e->getMessage());
                            Log::info('Row - ' . $key . ', col - ' . $index);
                            Log::info('Translate google sheets with error - ' . $e->getMessage());
                        }
                    }
                } else {
                    $tmp[] = $value;
                }
            }
            Sheets::sheet('Translations')->range('A' . $key + 1)->update([$tmp]);
            unset($tmp);
        }
    }
}
