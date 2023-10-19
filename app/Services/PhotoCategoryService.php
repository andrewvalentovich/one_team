<?php


namespace App\Services;


use App\Models\CountryAndCity;
use App\Models\ExchangeRate;
use App\Models\Layout;
use App\Models\PhotoCategory;
use App\Models\PhotoTable;
use App\Models\Product;

class PhotoCategoryService
{
    public function getArray() : array
    {
        $category = PhotoCategory::all();

        return [
            "interior"          => $category->where('name', 'Интерьер')->values()->all()[0]['id'],
            "exterior"          => $category->where('name', 'Экстерьер')->values()->all()[0]['id'],
            "infrastructure"    => $category->where('name', 'Инфраструктура')->values()->all()[0]['id'],
            "territory"         => $category->where('name', 'Территория')->values()->all()[0]['id'],
            "lobby"             => $category->where('name', 'Лобби')->values()->all()[0]['id'],
            "swimming_pool"     => $category->where('name', 'Бассейн')->values()->all()[0]['id'],
        ];
    }
}
