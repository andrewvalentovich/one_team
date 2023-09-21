<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\PhotoCategory;

class PhotoCategoriesController extends Controller
{
    public function getParams()
    {
        $categories = PhotoCategory::all()
            ->transform(function ($row) {
                return [
                    'id' => $row->id,
                    'name' => $row->name,
                ];
            })
            ->toArray();

        return response()->json($categories);
    }
}
