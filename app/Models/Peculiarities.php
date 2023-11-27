<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Peculiarities extends Model
{
    use HasFactory, Sluggable;
    protected $guarded =[];

    public function product() {
        return $this->belongsToMany(Product::class, 'product_categories', 'peculiarities_id', 'product_id');
    }

    public function locale_fields()
    {
        return $this->hasMany(PeculiarityLocale::class, 'peculiarity_id', 'id');
    }

    public function getTranslatedName($locale)
    {
        return $this->locale_fields->where('locale.code', $locale)->first()->name;
    }

    public function getSlugOnEnAttribute()
    {
        $tr = new GoogleTranslate();
        $slug = '';

        if ($this->type === 'Гостиные' || $this->type === 'Ванные' || $this->type === 'Спальни') {
            $slug = (int)$this->name . $tr->trans(strtolower($this->type), 'en', 'ru');
        } else {
            $slug = $tr->trans($this->name, 'en', 'ru');
        }

        return $slug;
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
                'source' => 'slug_on_en'
            ]
        ];
    }
}
