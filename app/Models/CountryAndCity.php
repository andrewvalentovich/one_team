<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryAndCity extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = [];

    public function cities()
    {
        return $this->hasMany(CountryAndCity::class, 'parent_id')->withCount('product_city')->orderby('product_city_count','DESC');
//        return $this->hasMany(CountryAndCity::class, 'parent_id');
    }

    public function country()
    {
        return $this->belongsTo(CountryAndCity::class, 'parent_id');
    }

    public function product_city()
    {
        return $this->hasMany(Product::class, 'city_id');
    }

    public function product_country()
    {
        return $this->hasMany(Product::class, 'country_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }
}
