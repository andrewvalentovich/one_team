<?php

namespace App\Http\Controllers\API\FlatsRequests;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\FlatsRequests\StoreRequest;
use App\Models\FlatsRequest;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $str = "";
        $validated = $request->validated();

        foreach($validated as $key=>$value) {
            if($key != "name" && $key != "phone" && isset($value)) {
                $str .= $key.": ".$value."\n";
            }
        }

        $data = [
          "phone" => $validated['phone'],
          "first_name" => $validated['name'],
          "utm_content" => $str,
        ];

        FlatsRequest::create($data);

        return response(['success' => 'FlatsRequest created successfully'], 200);
    }
}
