<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // У objects image может быть массивом или текстовым полем, аккуратно!
    use HasFactory, Filterable;
    protected $guarded = [];

    // Привязка продукта к опции (много продуктов к одной опции)
    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }

    public function ProductCategory() {
        return $this->hasMany(ProductCategory::class,'product_id');
    }

    public function peculiarities() {
        return $this->belongsToMany(Peculiarities::class, 'product_categories', 'product_id', 'peculiarities_id');
    }

    public function city()
    {
        return $this->belongsTo(CountryAndCity::class, 'city_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(CountryAndCity::class, 'country_id', 'id');
    }

    public function photo() {
        return $this->hasMany(PhotoTable::class,'parent_id')->where('parent_model','\App\Models\Product');
    }

    public function favorite() {
        return $this->hasMany(favorite::class);
    }

    public function Drawing() {
        return $this->hasMany(ProductDrawing::class,'product_id');
    }

    public function type_vid() {
        return $this->hasmany(ProductCategory::class,'product_id')->where('type','Вид');
    }
    public function do_more() {
        return $this->hasmany(ProductCategory::class,'product_id')->where('type','До моря');
    }
    public function spalni() {
        return $this->hasmany(ProductCategory::class,'product_id')->where('type','Спальни');
    }
    public function vanie() {
        return $this->hasmany(ProductCategory::class,'product_id')->where('type','Ванные');
    }
    public function gostinnie() {
        return $this->hasmany(ProductCategory::class,'product_id')->where('type','Гостиные');
    }
}
