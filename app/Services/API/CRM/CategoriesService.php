<?php


namespace App\Services\API\CRM;


use App\Models\Peculiarities;

class CategoriesService
{
    public function getTypes()
    {
        $types = Peculiarities::where('type', 'Типы')->get();

        return [
            "apartment"  => $types->where('name_en', "Apartments")->first()["id"],
            "house"      => $types->where('name_en', "Villas, cottages")->first()["id"],
            "land"       => null,
            "hotel"      => null,
            "commercial" => null
        ];
    }

    public function getPeculiarities()
    {
        $types = Peculiarities::where('type', 'Особенности')->get();

        $tmpArray = [];
        foreach ($types as $type) {
            $tmpArray[strtolower($type->name_en)] = $type->id;
        }

        return $tmpArray;
    }

    public function getToSea($value) : int
    {
        $to_sea = Peculiarities::where('type', 'До моря')->get();
        $tmpCategoryId = null;
        $up_to = [];
        $more = [];

        foreach ($to_sea as $item) {
            if ($item->name === "Первая линия") {
                // За первую линию принимаем расстояние составляюещее не более 100 метров
                $up_to[$item->id] = 100;
            }

            $toPos = stripos($item->name, 'До');
            if ($toPos !== false) {
                $tmpSubstr = explode(" ", mb_substr($item->name, $toPos + 3, iconv_strlen($item->name) - $toPos - 3));

                if ($tmpSubstr[1] === "км") {
                    $tmpSubstr[0] = (int)$tmpSubstr[0] * 1000;
                } else {
                    $tmpSubstr[0] = (int)$tmpSubstr[0];
                }

                $up_to[$item->id] = $tmpSubstr[0];

                unset($tmpSubstr);
            }

            $morePos = stripos($item->name, 'Более');
            if ($morePos !== false) {
                $tmpSubstr = explode(" ", mb_substr($item->name, $morePos + 6, iconv_strlen($item->name) - $morePos - 6));

                if ($tmpSubstr[1] === "км") {
                    $tmpSubstr[0] = (int)$tmpSubstr[0] * 1000;
                } else {
                    $tmpSubstr[0] = (int)$tmpSubstr[0];
                }

                $more[$item->id] = $tmpSubstr[0];

                unset($tmpSubstr);
            }
        }

        asort($up_to);
        arsort($more);

        foreach ($up_to as $i => $el) {
            if ($value <= $el) {
                $tmpCategoryId = $i;
                break;
            }
        }

        if ($tmpCategoryId === null) {
            foreach ($more as $i => $el) {
                if ($value >= $el) {
                    $tmpCategoryId = $i;
                    break;
                }
            }
        }

        return $tmpCategoryId;
    }
}

