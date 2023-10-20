<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryAndCity extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cities()
    {
        return $this->hasMany(CountryAndCity::class, 'parent_id')->withCount('product_city')->orderby('product_city_count','DESC');
    }

    public function country()
    {
        return $this->belongsto(CountryAndCity::class, 'parent_id');
    }

    public function product_city()
    {
        return $this->hasMany(Product::class, 'city_id');
    }

    public function product_country()
    {
        return $this->hasMany(Product::class, 'country_id');
    }


}
