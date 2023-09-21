<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\LandingFilter;
use App\Http\Requests\Landing\FilterRequest;
use App\Models\Product;
use App\Models\Peculiarities;

class LandingsController extends Controller
{
    private $exchanges = [];
    private $peculiarities = [];

    public function __construct()
    {
        // Получаем массив с кодом валюты и коэффициентом
        $this->peculiarities = Peculiarities::all();
    }

    public function getWithFilter(FilterRequest $request)
    {
        $data = $request->validated();
        // Фильтр элементов
        $filter = app()->make(LandingFilter::class, ['queryParams' => $data]);
        $products = Product::filter($filter)
            ->with('photo')
            ->with('option')
            ->with('peculiarities')
            ->get()
            ->transform(function ($row) {
                if (!empty(json_decode($row->objects))) {
                    // Оставляем только уникальные планировки (1+2, 2+2 и т.д.)
                    $layouts = array_unique(array_column(json_decode($row->objects), 'apartment_layout'), SORT_STRING);

                    // Вывод планировок (1+2, 2+2 и пр.)
                    $layouts_result = "";
                    foreach ($layouts as $key => $layout) {
                        $layouts_result .= (count($layouts)-1 == $key) ? $layout : $layout . ", ";
                    }

                    // Выборка из полей: size
                    $size = array_column(json_decode($row->objects), 'size');
                    $min_size = min($size);
                    $max_size = max($size);
                    $size_result = ($min_size == $max_size) ? $max_size : $min_size."-".$max_size;

                    // Возврат значений
                    return [
                        "id" => $row->id,
                        "name" => $row->name,
                        "address" => $row->address,
                        "price" => min(array_column(json_decode($row->objects), 'price'))." €",
                        "layouts" => $layouts_result,
                        "size" => $size_result." м2",
                        "to_sea" => $row->peculiarities->where('type', 'До моря')->pluck('name')->all()[0] ?? null,
                        "photo" => $row->photo ?? null,
                        "option" => $row->option->name ?? null,
                    ];
                } else {
                    return [
                        "id" => $row->id,
                        "name" => $row->name,
                        "address" => $row->address,
                        "price" => $row->price." €",
                        "layouts" => (int) $row->peculiarities->where('type', 'Спальни')->pluck('name')->all() . "+" . (int) $row->peculiarities->where('type', 'Гостиные')->pluck('name')->all(),
                        "size" => $row->size." м2",
                        "to_sea" => $row->peculiarities->where('type', 'До моря')->pluck('name')->all()[0] ?? null,
                        "photo" => $row->photo ?? null,
                        "option" => $row->option->name ?? null,
                    ];
                }
            });

        return response()->json($products);
    }
}
