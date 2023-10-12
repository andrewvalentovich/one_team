<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LayoutService
{
    private $sortService;

    public function __construct(SortService $sortService)
    {
        $this->sortService = $sortService;
    }

    public function getUniqueNumberRooms($array)
    {
        $number_rooms_unique = "";

        // Получаем из массива коллекций только поле с типом планировки
        $layouts = [];
        foreach ($array as $key => $item) {
            $layouts[] = $item->number_rooms;
        }

        // Оставляем только уникальные планировки (1+2, 2+2 и т.д.)
        $layouts = array_unique($layouts, SORT_STRING);

        // массив для сортировки
        $layouts_sort_arr = [];
        foreach ($layouts as $layout) {
            if($layout === "" || $layout === " ") {
                continue;
            } else {
                $layouts_sort_arr[] = explode("+", $layout);
            }
        }

        // Сортировка
        $sort = $this->sortService->quicksort($layouts_sort_arr);
        unset($layouts_sort_arr);

        // Вывод планировок (1+2, 2+2 и пр.)
        foreach ($sort as $layout) {
            $number_rooms_unique .= !next($sort) ? implode("+", $layout) : implode("+", $layout) . ", ";
        }
        unset($layouts);

        return $number_rooms_unique;
    }
}
