<?php

namespace App\Http\Controllers\API\FlatsRequests;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\FlatsRequests\StoreRequest;
use App\Models\FlatsRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $str = "";

        $str = "Тип недвижимости: {$request['type']}\nПланируемая дата покупки: {$request['date-to-buy']}\nИнтересующие вопросы:";
        if(isset($request['questions'])) {
            foreach ($request['questions'] as $key => $value) {
                $str .= $key.". ".$value."\n";
            }
        }
        $str = "Вопрос клиента: {$request['myQuestion']}\nБюджет: {$request['budget']}";
        var_dump($str);
        return response(['success' => 'FlatsRequest created successfully', 'data' => $str], 200);

//
//        $data = [
//          "phone" => $validated['phone'],
//          "first_name" => $validated['name'],
//          "utm_content" => $str,
//        ];
//
//        FlatsRequest::create($data);
//
//        return response(['success' => 'FlatsRequest created successfully'], 200);
    }
}
