<?php


namespace App\Http\Filters;


use App\Models\ExchangeRate;
use App\Models\Layout;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CatalogFilter extends AbstractFilter
{
    // Имена переменных присваиваем константам
    const ORDER_BY = 'order_by';
    const COUNTRY_ID = 'country_id';
    const PRICE = 'price';
    const CITY_ID = 'city_id';
    const COUNTRY = 'country';
    const CITY = 'city';
    const SALE_OR_RENT = 'sale_or_rent';
    const TYPE = 'type';
    const BEDROOMS = 'bedrooms';
    const BATHROOMS = 'bathrooms';
    const PECULIARITIES = 'peculiarities';
    const IS_SECONDARY = 'is_secondary';
    const VIEW = 'view';
    const TO_SEA = 'to_sea';
    const SIZE = 'size';

    protected function getCallbacks(): array
    {
        // Прописываем переменные ($this) и методы в 'метод'
        return [
            self::ORDER_BY => [$this, 'order_by'],
            self::COUNTRY_ID => [$this, 'country_by_id'],
            self::CITY_ID => [$this, 'city_by_id'],
            self::PRICE => [$this, 'price'],
            self::CITY => [$this, 'city_by_slug'],
            self::COUNTRY => [$this, 'country_by_slug'],
            self::SALE_OR_RENT => [$this, 'sale_or_rent'],
            self::BEDROOMS => [$this, 'peculiarities_bedrooms'],
            self::BATHROOMS => [$this, 'peculiarities_bathrooms'],
            self::VIEW => [$this, 'peculiarity_by_slug'],
            self::TO_SEA => [$this, 'peculiarity_by_slug'],
            self::TYPE => [$this, 'peculiarity_by_slug'],
            self::PECULIARITIES => [$this, 'peculiarities_by_slug'],
            self::SIZE => [$this, 'size'],
            self::IS_SECONDARY => [$this, 'is_secondary'],
        ];
    }

    protected function city_by_id(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->where('city_id', $value);
        }
    }

    protected function country_by_id(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->where('country_id', $value);
        }
    }

    protected function country_by_slug(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('country', function ($query) use ($value) {
                $query->where('slug', $value);
            });
        }
    }

    protected function peculiarity_by_slug(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('peculiarities', function ($query) use ($value) {
                $query->where('peculiarities.slug', "$value");
            });
        }
    }

    protected function peculiarities_by_slug(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('peculiarities', function ($query) use ($value) {
                $query->whereIn('peculiarities.slug', array_values($value));
            });
        }
    }

    protected function peculiarities_bedrooms(Builder $builder, $value)
    {
        if(isset($value)) {
            $value = (int)$value . "+";
            $builder->whereHas('peculiarities', function ($query) use ($value) {
                $query->where('peculiarities.type', "Спальни");
                $query->where('peculiarities.name', "$value");
            });
        }
    }

    protected function peculiarities_bathrooms(Builder $builder, $value)
    {
        if(isset($value)) {
            $value = (int)$value . "+";
            $builder->whereHas('peculiarities', function ($query) use ($value) {
                $query->where('peculiarities.type', "Ванные");
                $query->where('peculiarities.name', "$value");
            });
        }
    }

    protected function city_by_slug(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('city', function ($query) use ($value) {
                $query->where('slug', $value);
            });
        }
    }

    protected function size(Builder $builder, $value)
    {
        if (isset($value['min'])) {
            $builder->where('size', ">=", $value['min']);
        }

        if (isset($value['max'])) {
            $builder->where('size', "<=", $value['max']);
        }
    }

    protected function price(Builder $builder, $value)
    {
        if (isset($value['min']) && isset($value['max'])) {
            $builder->where(function ($query) use ($value) {
                $query->where('complex_or_not', 'Нет')
                    ->where(function ($query) use ($value) {
                        $query->where('products.base_price', '>=', $value['min']);
                        $query->where('products.base_price', '<=', $value['max']);
                    })
                    ->orWhereHas('layouts', function (Builder $query) use ($value) {
                        $query->where('layouts.base_price', '>=', $value['min']);
                        $query->where('layouts.base_price', '<=', $value['max']);
                    });
            });
        } else {
            if (isset($value['min'])) {
                $builder->where(function ($query) use ($value) {
                    $query->where('complex_or_not', 'Нет')
                        ->where('products.base_price', '>=', $value['min'])
                        ->orWhereHas('layouts', function (Builder $query) use ($value) {
                            $query->where('layouts.base_price', '>=', $value['min']);
                        });
                });
            }

            if (isset($value['max'])) {
                $builder->where(function ($query) use ($value) {
                    $query->where('complex_or_not', 'Нет')
                        ->where('products.base_price', '<=', $value['max'])
                        ->orWhereHas('layouts', function (Builder $query) use ($value) {
                            $query->where('layouts.base_price', '<=', $value['max']);
                        });
                });
            }
        }
    }

    protected function order_by(Builder $builder, $value)
    {
        if ($value == 'popular') {
            $builder->inRandomOrder();
        } elseif ($value == 'size') {
            $builder->orderByDesc('min_size');
        } elseif ($value == 'price_size') {
            $builder->orderByDesc('price_size');
        } else {
            $builder->orderByDesc($value);
        }
    }
}
