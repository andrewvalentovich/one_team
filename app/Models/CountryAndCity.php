<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stichoza\GoogleTranslate\GoogleTranslate;

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

    public function locales()
    {
        return $this->belongsToMany(Locale::class, 'region_locale', 'region_id', 'locale_id');
    }

    public function locale_fields()
    {
        return $this->hasMany(RegionLocale::class, 'region_id', 'id');
    }

    public function getNameByLocale($locale)
    {
        return $this->locale_fields->where('code', $locale)->first()->name;
    }

    public function getTranslatedName($locale)
    {
        return $this->locale_fields->where('locale.code', $locale)->first()->name;
    }

    public function getTranslatedDiv($locale)
    {
        return $this->locale_fields->where('locale.code', $locale)->first()->div;
    }

    public function getNameOnEnAttribute()
    {
        $tr = new GoogleTranslate();
        return $tr->trans($this->name, 'en', 'ru');
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
                'source' => 'name_on_en'
            ]
        ];
    }
}
