<?php


namespace App\Http\Filters;


use App\Models\ExchangeRate;
use App\Models\Layout;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class HousesFilter extends AbstractFilter
{
    // Имена переменных присваиваем константам
    const SALE_OR_RENT = 'sale_or_rent';
//    const ORDER_BY = 'order_by';
    const TOP_LEFT = 'top_left';
    const BOTTOM_RIGHT = 'bottom_right';
    const COUNTRY_ID = 'country_id';
    const COUNTRY = 'country';
    const TYPE_ID = 'type_id';
    const TYPE = 'type';
    const PRICE = 'price';
    const BEDROOMS = 'bedrooms';
    const BATHROOMS = 'bathrooms';
    const PECULIARITIES = 'peculiarities';
    const VIEW = 'view';
    const TO_SEA = 'to_sea';
    const SIZE = 'size';
    const CITY_ID = 'city_id';
    const CITY = 'city';
    const IS_SECONDARY = 'is_secondary';

    protected $currencyService;

    public function __construct(array $queryParams, CurrencyService $currencyService)
    {
        parent::__construct($queryParams, $currencyService);
        $this->currencyService = $currencyService;
    }

    protected function getCallbacks(): array
    {
        // Прописываем переменные ($this) и методы в 'метод'
        return [
            self::SALE_OR_RENT => [$this, 'sale_or_rent'],
//            self::ORDER_BY => [$this, 'order_by'],
            self::TOP_LEFT => [$this, 'top_left'],
            self::BOTTOM_RIGHT => [$this, 'bottom_right'],
            self::BEDROOMS => [$this, 'peculiarities_bedrooms'],
            self::BATHROOMS => [$this, 'peculiarities_bathrooms'],
            self::VIEW => [$this, 'peculiarities_by_name'],
            self::TO_SEA => [$this, 'peculiarities_by_name'],
            self::COUNTRY_ID => [$this, 'country_by_id'],
            self::COUNTRY => [$this, 'country_by_slug'],
            self::TYPE => [$this, 'peculiarities_by_name'],
            self::PECULIARITIES => [$this, 'peculiarities'],
            self::PRICE => [$this, 'price'],
            self::SIZE => [$this, 'size'],
            self::CITY_ID => [$this, 'city_by_id'],
            self::CITY => [$this, 'city_by_slug'],
            self::IS_SECONDARY => [$this, 'is_secondary'],
        ];
    }

    protected function is_secondary(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->where('is_secondary', filter_var($value, FILTER_VALIDATE_BOOLEAN));
        }
    }

    protected function city_by_id(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->where('city_id', $value);
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
//                $query->where('name_en', "$value");
                $query->where('slug', $value);
            });
        }
    }

    protected function sale_or_rent(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->where('sale_or_rent', $value);
        }
    }

    protected function top_left(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->where('lat', '>', $value["lat"]);
            $builder->where('long', '>', $value["long"]);
        }
    }

    protected function bottom_right(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->where('lat', '<', $value["lat"]);
            $builder->where('long', '<', $value["long"]);
        }
    }

    protected function peculiarities_by_id(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('peculiarities', function ($query) use ($value) {
                $query->where('peculiarities.id', $value);
            });
        }
    }

    protected function peculiarities_by_name(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('peculiarities', function ($query) use ($value) {
//                $query->where('peculiarities.name_en', "$value");
                $query->whereRaw('LOWER(`name_en`) LIKE ? ',['%'.$value.'%']);
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

    protected function peculiarities(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('peculiarities', function ($query) use ($value) {
                $query->whereIn('peculiarities.id', array_keys($value));
            });
        }
    }

    protected function country(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('country', function ($query) use ($value) {
                $query->where('name_en', "$value");
            });
        }
    }

    protected function price(Builder $builder, $value)
    {
        if (isset($value['min']) && isset($value['max'])) {
            $builder->where(function ($query) use ($value) {
                $query->where('complex_or_not', 'Нет')
                    ->where(function ($query) use ($value) {
                        $query->where('products.base_price', '>=', $this->currencyService->convertPriceToEur($value['min'], $value['currency'] ?? null));
                        $query->where('products.base_price', '<=', $this->currencyService->convertPriceToEur($value['max'], $value['currency'] ?? null));
                    })
                    ->orWhereHas('layouts', function (Builder $query) use ($value) {
                        $query->where('layouts.base_price', '>=', $this->currencyService->convertPriceToEur($value['min'], $value['currency'] ?? null));
                        $query->where('layouts.base_price', '<=', $this->currencyService->convertPriceToEur($value['max'], $value['currency'] ?? null));
                    });
            });
        } else {
            if (isset($value['min'])) {
                $builder->where(function ($query) use ($value) {
                    $query->where('complex_or_not', 'Нет')
                        ->where('products.price', '>=', $this->currencyService->convertPriceToEur($value['min'], $value['currency'] ?? null))
                        ->orWhereHas('layouts', function (Builder $query) use ($value) {
                            $query->where('layouts.base_price', '>=', $this->currencyService->convertPriceToEur($value['min'], $value['currency'] ?? null));
                        });
                });
            }

            if (isset($value['max'])) {
                $builder->where(function ($query) use ($value) {
                    $query->where('complex_or_not', 'Нет')
                        ->where('products.price', '<=', $this->currencyService->convertPriceToEur($value['max'], $value['currency'] ?? null))
                        ->orWhereHas('layouts', function (Builder $query) use ($value) {
                            $query->where('layouts.base_price', '<=', $this->currencyService->convertPriceToEur($value['max'], $value['currency'] ?? null));
                        });
                });
            }
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

//    protected function order_by(Builder $builder, $value)
//    {
        // Получаем $value = 'price-asc' -> $val_arr[0] = 'price', $val_arr[1] = 'asc';
//        $val_arr = explode('-', $value);
//        if ($val_arr[0] == 'price') {
//            $builder->orderBy('min_price', $val_arr[1]);
//        } else {
//            $builder->orderBy($val_arr[0], $val_arr[1]);
//        }
//        $builder->addSelect('products.*', DB::raw('(CASE WHEN complex_or_not = "Да" THEN layouts.price ELSE products.price END) as min_price'))
//            ->join('layouts', function ($join) {
//                $join->on('products.id', '=', 'layouts.complex_id')
//                    ->where('products.complex_or_not', 'Да');
//            })->orderBy('min_price');

        // $builder->orderBy($val_arr[0], $val_arr[1]);
//    }
}
