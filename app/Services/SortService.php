<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SortService
{
    public function quicksort($arr)
    {
        if (count($arr) < 2) {
            return $arr;
        } else {
            $pivot = $arr[0];
            $less = [];
            $greater = [];
            for ($i = 1; $i < count($arr); $i++) {
                if ($arr[$i] <= $pivot) {
                    array_push($less, $arr[$i]);
                }
                if ($arr[$i] > $pivot) {
                    array_push($greater, $arr[$i]);
                }
            }
            return array_merge($this->quicksort($less), [$pivot], $this->quicksort($greater));
        }
    }
}
