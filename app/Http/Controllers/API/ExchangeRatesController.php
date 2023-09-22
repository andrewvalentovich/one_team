<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use App\Models\PhotoCategory;

class ExchangeRatesController extends Controller
{
    public function getAll()
    {
        $exchangeRates = ExchangeRate::where('direct', "RUB")
            ->get()
            ->transform(function ($row) {
                return [
                    'name' => $row->relative
                ];
            })
            ->toArray();

        $exchangeRates[] = ["name" => "RUB"];

        return response()->json($exchangeRates);
    }
}
