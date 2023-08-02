<?php

namespace App\Http\Controllers\API\FlatsRequests;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\FlatsRequests\StoreRequest;
use App\Models\FlatsRequest;
use Illuminate\Http\Request;
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
        if (isset($request['type'])) {
            $str .= "Тип недвижимости: {$request['type']}\n";
        }
        if (isset($request['date-to-buy'])) {
            $str .= "Планируемая дата покупки: {$request['date-to-buy']}\n";
        }
        if(isset($request['questions'])) {
            $str .= "Интересующие вопросы:";
            foreach ($request['questions'] as $key => $value) {
                $str .= $key.". ".$value."\n";
            }
        }
        if(isset($request['myQuestion'])) {
            $str .= "Вопрос клиента: {$request['myQuestion']}\n";
        }
        if(isset($request['budget'])) {
            $str .= "Бюджет: {$request['budget']}";
        }
        var_dump($str);
        return response(['success' => 'FlatsRequest created successfully'], 200);

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
