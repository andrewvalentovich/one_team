<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Product extends Model
{
    // У objects image может быть массивом или текстовым полем, аккуратно!
    use HasFactory, Filterable, SoftDeletes, HasEagerLimit;

    protected $guarded = [];

    public function scopeForSale($query)
    {
        return $query->where('sale_or_rent', 'sale');
    }

    public function scopeForRent($query)
    {
        return $query->where('sale_or_rent', 'rent');
    }

    public function scopeCatalog($query, $price = null)
    {
        $query
            ->leftJoin('layouts', function ($join) {
                $join->on('products.id', '=', 'layouts.complex_id')
                    ->where('products.complex_or_not', 1)
                    ->addSelect(DB::raw('id, price, base_price, price_code, total_size'))
                    ->orderBy('layouts.base_price', 'asc');
            });

        if (isset($price['min'])) {
            $query->where('layouts.base_price', '>=', $price['min']);
        }

        if (isset($price['max'])) {
            $query->where('layouts.base_price', '<=', $price['max']);
        }

        $query->select(
            'products.id',
            'products.name',
            'products.city_id',
            'products.country_id',
            'products.price',
            'products.base_price',
            'products.price_code',
            'products.size',
            'products.slug',
            'products.lat',
            'products.long',
            'products.is_secondary',
            'products.commissions',
            'products.grajandstvo',
            'products.created_at'
        )
            ->groupBy('products.id')
            ->with(['layouts' => function($query) use ($price) {
                // Ограничиваем вывод, только те у которых цена соответствует
                $query
//                    ->select('id', 'price', 'base_price', 'price_code', 'total_size')
                    ->with('photos')
                    ->orderBy('layouts.base_price', 'asc');

                if (isset($price['min'])) {
                    $query->where('layouts.base_price', '>=', $price['min']);
                }
                if (isset($price['max'])) {
                    $query->where('layouts.base_price', '<=', $price['max']);
                }
            }])
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(layouts.base_price)) ELSE products.base_price END) as min_price'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(layouts.total_size)) ELSE products.size END) as min_size'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(max(layouts.total_size)) ELSE products.size END) as max_size'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(products.base_price) / min(products.size)) ELSE products.base_price / products.size END) as price_size'))
            ->with(['country' => function($query) {
                $query->select('id', 'name', 'slug');
            }])
            ->with(['city' => function($query) {
                $query->select('id', 'name', 'slug');
            }]);

        return $query;
    }

    public function scopeRealty($query, $price = null)
    {
        $query
            ->leftJoin('layouts', function ($join) {
                $join->on('products.id', '=', 'layouts.complex_id')
                    ->where('products.complex_or_not', 1)
                    ->addSelect(DB::raw('id, price, base_price, price_code, total_size'))
                    ->orderBy('layouts.base_price', 'asc');
            });

        if (isset($price['min'])) {
            $query->where('layouts.base_price', '>=', $price['min']);
        }

        if (isset($price['max'])) {
            $query->where('layouts.base_price', '<=', $price['max']);
        }

        $query->select(
            'products.id',
            'products.name',
            'products.city_id',
            'products.country_id',
            'products.price',
            'products.base_price',
            'products.price_code',
            'products.size',
            'products.lat',
            'products.long',
            'products.address',
            'products.is_secondary',
            'products.commissions',
            'products.grajandstvo',
            'products.created_at'
        )
            ->groupBy('products.id')
            ->where(function ($query) {
                $query->where('complex_or_not', 0)
                    ->where(function ($query)  {
                        $query->where('products.base_price', '>', 0);
                    })
                    ->orWhereHas('layouts');
            })
            ->with(['layouts' => function($query) use ($price) {
                // Ограничиваем вывод, только те у которых цена соответствует
                $query
//                    ->select('id', 'price', 'base_price', 'price_code', 'total_size')
                    ->with('photos')
                    ->orderBy('layouts.base_price', 'asc');

                if (isset($price['min'])) {
                    $query->where('layouts.base_price', '>=', $price['min']);
                }
                if (isset($price['max'])) {
                    $query->where('layouts.base_price', '<=', $price['max']);
                }
            }])
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(layouts.base_price)) ELSE products.base_price END) as min_price'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(layouts.total_size)) ELSE products.size END) as min_size'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(max(layouts.total_size)) ELSE products.size END) as max_size'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(products.base_price) / min(products.size)) ELSE products.base_price / products.size END) as price_size'))
            ->with(['country' => function($query) {
                $query->select('id', 'name', 'slug');
            }])
            ->with(['city' => function($query) {
                $query->select('id', 'name', 'slug');
            }]);

        return $query;
    }

    public function scopeSimple($query, $id, $price = null)
    {
        $query
            ->whereId($id)
            ->leftJoin('layouts', function ($join) {
                $join->on('products.id', '=', 'layouts.complex_id')
                    ->where('products.complex_or_not', 1)
                    ->addSelect(DB::raw('id, price, base_price, price_code, total_size'))
                    ->orderBy('layouts.base_price', 'asc');
            });

        if (isset($price['min'])) {
            $query->where('layouts.base_price', '>=', $price['min']);
        }

        if (isset($price['max'])) {
            $query->where('layouts.base_price', '<=', $price['max']);
        }

        $query->select('products.*')
            ->groupBy('products.id')
            ->where(function ($query) {
                $query->where('complex_or_not', 0)
                    ->where(function ($query)  {
                        $query->where('products.base_price', '>', 0);
                    })
                    ->orWhereHas('layouts');
            })
            ->with(['layouts' => function($query) use ($price) {
                // Ограничиваем вывод, только те у которых цена соответствует
                $query
//                    ->select('id', 'price', 'base_price', 'price_code', 'total_size')
                    ->with('photos')
                    ->orderBy('layouts.base_price', 'asc');

                if (isset($price['min'])) {
                    $query->where('layouts.base_price', '>=', $price['min']);
                }
                if (isset($price['max'])) {
                    $query->where('layouts.base_price', '<=', $price['max']);
                }
            }])
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(layouts.base_price)) ELSE products.base_price END) as min_price'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(layouts.total_size)) ELSE products.size END) as min_size'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(max(layouts.total_size)) ELSE products.size END) as max_size'))
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(products.base_price) / min(products.size)) ELSE products.base_price / products.size END) as price_size'))
            ->with(['country' => function($query) {
                $query->select('id', 'name', 'slug');
            }])
            ->with(['city' => function($query) {
                $query->select('id', 'name', 'slug');
            }]);

        return $query;
    }

    public function scopeMap($query, $id, $price = null)
    {
        $query
            ->leftJoin('layouts', function ($join) {
                $join->on('products.id', '=', 'layouts.complex_id')
                    ->where('products.complex_or_not', 1)
                    ->addSelect(DB::raw('id, price, base_price, price_code, total_size'))
                    ->orderBy('layouts.base_price', 'asc');
            });

        if (isset($price['min'])) {
            $query->where('layouts.base_price', '>=', $price['min']);
        }

        if (isset($price['max'])) {
            $query->where('layouts.base_price', '<=', $price['max']);
        }

        $query->select(
            'products.id',
            'products.name',
            'products.city_id',
            'products.country_id',
            'products.base_price',
            'products.size',
            'products.lat',
            'products.long',
            'products.address',
            'products.complex_or_not'
        )
            ->groupBy('products.id')
            ->where(function ($query) {
                $query->where('complex_or_not', 0)
                    ->where(function ($query)  {
                        $query->where('products.base_price', '>', 0);
                    })
                    ->orWhereHas('layouts');
            })
            ->addSelect(DB::raw('(CASE WHEN complex_or_not = 1 THEN any_value(min(layouts.base_price)) ELSE products.base_price END) as min_price'))
            ->with(['country' => function($query) {
                $query->select('id', 'name', 'slug');
            }])
            ->with(['city' => function($query) {
                $query->select('id', 'name', 'slug');
            }]);

        return $query;
    }

    public function scopeWithCountryBySlug(Builder $query, $country = null)
    {
        if (!is_null($country)) {
            return $query->whereHas('country', function ($query) use ($country) {
                $query->where('slug', $country);
            });
        } else {
            return $query;
        }
    }

    // Привязка продукта к опции (много продуктов к одной опции)
    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }

    public function locales()
    {
        return $this->belongsToMany(Locale::class, 'product_locale', 'product_id', 'locale_id');
    }

    public function locale_fields()
    {
        return $this->hasMany(ProductLocale::class, 'product_id', 'id');
    }

    public function translated_fields($locale_id)
    {
        return $this->hasMany(ProductLocale::class, 'product_id', 'id')->where('locale_id', $locale_id)->latest()->limit(1);
    }

    public function descriptions() {
        return $this->hasMany(ProductLocale::class,'product_id');
    }

    public function ProductCategory() {
        return $this->hasMany(ProductCategory::class,'product_id');
    }

    // Привязка планировок к объекту (много планировок к одному объекту)
    public function layouts() {
        return $this->hasMany(Layout::class,'complex_id');
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

    public function preview() {
        return $this->hasOne(PhotoTable::class,'parent_id')->where('parent_model','\App\Models\Product')->orderBy('id', 'asc');
    }

    public function limitPhoto() {
        return $this->hasMany(PhotoTable::class,'parent_id')->where('parent_model','\App\Models\Product')->limit(6);
    }

    public function favorite() {
        return $this->hasMany(favorite::class);
    }

    public function Drawing() {
        return $this->hasMany(ProductDrawing::class,'product_id');
    }

    public function type_vid() {
        return $this->hasMany(ProductCategory::class,'product_id')->where('type','Вид');
    }
    public function do_more() {
        return $this->hasMany(ProductCategory::class,'product_id')->where('type','До моря');
    }
    public function spalni() {
        return $this->hasMany(ProductCategory::class,'product_id')->where('type','Спальни');
    }
    public function vanie() {
        return $this->hasMany(ProductCategory::class,'product_id')->where('type','Ванные');
    }
    public function gostinnie() {
        return $this->hasMany(ProductCategory::class,'product_id')->where('type','Гостиные');
    }

    public function bedrooms()
    {
        if (!empty($this->peculiarities->whereIn('type', 'Спальни')->first())) {
            return $this->peculiarities->whereIn('type', 'Спальни')->first()->name;
        }
        return null;
    }

    public function bathrooms()
    {
        if (!empty($this->peculiarities->whereIn('type', 'Ванные')->first())) {
            return $this->peculiarities->whereIn('type', 'Ванные')->first()->name;
        }
        return null;
    }

    public function living_rooms()
    {
        if (!empty($this->peculiarities->whereIn('type', 'Гостиные')->first())) {
            return $this->peculiarities->whereIn('type', 'Гостиные')->first()->name;
        }
        return null;
    }

    public function to_sea()
    {
        if (!empty($this->peculiarities->whereIn('type', "До моря")->first())) {
            return $this->peculiarities->whereIn('type', "До моря")->first()->name;
        }
        return null;
    }

    public function is_swimming()
    {
        if (!empty($this->peculiarities->where('name', 'Бассейн')->first())) {
            return true;
        }
        return null;
    }

    public function getIsSwimmingAttribute()
    {
        if (!empty($this->peculiarities->where('name', 'Бассейн')->first())) {
            return true;
        }
        return null;
    }

    public function view()
    {
        if (!empty($this->peculiarities->whereIn('type', "Вид")->first())) {
            return $this->peculiarities->whereIn('type', "Вид")->first()->name;
        }
        return null;
    }

    public function getTranslatedDescription($locale)
    {
        return $this->locale_fields->where('locale.code', $locale)->first()->description;
    }

    public function getTranslatedDisposition($locale)
    {
        return $this->locale_fields->where('locale.code', $locale)->first()->disposition;
    }

    public function getTags($locale)
    {
        $tags = [];

        if ($this->grajandstvo === 'Да') {
            $tags[] = __('Гражданство', [], $locale);
        }
        if ($this->commissions === 'Да' && $this->is_secondary == 0) {
            $tags[] = __('Рассрочка 0%', [], $locale);
        }
        $tags[] = $this->is_secondary === 0 ? __('Новостройка', [], $locale) : __('Вторичка', [], $locale);

        $this->tags = $tags;
    }
}
