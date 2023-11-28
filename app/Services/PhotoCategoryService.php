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
            "common"            => null,
            "interior"          => $category->where('name', 'Интерьер')->values()->first()['id'],
            "exterior"          => $category->where('name', 'Экстерьер')->values()->first()['id'],
            "infrastructure"    => $category->where('name', 'Инфраструктура')->values()->first()['id'],
            "territory"         => $category->where('name', 'Территория')->values()->first()['id'],
            "lobby"             => $category->where('name', 'Лобби')->values()->first()['id'],
            "swimming_pool"     => $category->where('name', 'Бассейн')->values()->first()['id'],
        ];
    }
}
