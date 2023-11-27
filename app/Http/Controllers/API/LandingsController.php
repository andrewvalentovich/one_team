<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Filters\LandingFilter;
use App\Http\Requests\Landing\FilterRequest;
use App\Models\Product;
use App\Models\Peculiarities;
use App\Services\LayoutService;
use Illuminate\Support\Facades\Log;

class LandingsController extends Controller
{
    private $exchanges = [];
    private $peculiarities = [];
    private $layoutService = [];

    public function __construct(LayoutService $layoutService)
    {
        // Получаем массив с кодом валюты и коэффициентом
        $this->peculiarities = Peculiarities::all();
        $this->layoutService = $layoutService;
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
            ->with('layouts')
            ->orderBy('created_at', 'desc')
            ->get()
            ->transform(function ($row) {
                if (count($row->layouts) > 0) {
                    // Получаем уникальные планировки
                    $layouts_result = $this->layoutService->getUniqueNumberRooms($row->layouts);

                    // Выборка из полей: size
                    $size = [];
                    $price = [];
                    foreach ($row->layouts as $key => $layout) {
                        $size[] = $layout->total_size;
                        $price[] = $layout->base_price;
                    }

                    $min_size = count($size) >= 1 ? min($size) : 0;
                    $max_size = count($size) >= 1 ? max($size) : 0;
                    $size_result = ($min_size == $max_size) ? $max_size : $min_size."-".$max_size;

                    // Возврат значений
                    return [
                        "id" => $row->id,
                        "name" => $row->name,
                        "address" => $row->address,
                        "price" => count($price) >= 1 ? number_format(max($price), 0, '.', ' ') . " €" : 0 . " €",
                        "layouts" => $layouts_result,
                        "size" => $size_result." м2",
                        "to_sea" => $row->peculiarities->where('type', 'До моря')->pluck('name')->all()[0] ?? null,
                        "photo" => isset($row->photo) ? $row->photo : null,
                        "option" => $row->option->name ?? null,
                    ];
                } else {
                    return [
                        "id" => $row->id,
                        "name" => $row->name,
                        "address" => $row->address,
                        "price" => number_format($row->base_price, 0, '.', ' ') . " €",
                        "layouts" => (int) $row->peculiarities->where('type', 'Спальни')->pluck('name')->all() . "+" . (int) $row->peculiarities->where('type', 'Гостиные')->pluck('name')->all(),
                        "size" => $row->size." м2",
                        "to_sea" => $row->peculiarities->where('type', 'До моря')->pluck('name')->all()[0] ?? null,
                        "photo" => isset($row->photo) ? $row->photo : null,
                        "option" => $row->option->name ?? null,
                    ];
                }
            });

        return response()->json($products);
    }
}
