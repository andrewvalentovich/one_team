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
            self::ORDER_BY => [$this, 'order_by'],
            self::COUNTRY_ID => [$this, 'country_by_id'],
            self::CITY_ID => [$this, 'city_by_id'],
            self::PRICE => [$this, 'price'],
            self::CITY => [$this, 'city_by_slug'],
            self::COUNTRY => [$this, 'country_by_slug'],
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

    protected function city_by_slug(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('city', function ($query) use ($value) {
                $query->where('slug', $value);
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

    protected function order_by(Builder $builder, $value)
    {
        if ($value == 'popular') {
            $builder->inRandomOrder();
        } elseif ($value == 'size') {
            $builder->orderByDesc('min_size');
        } elseif ($value == 'price_size') {
            $builder->orderByDesc('price_size');
        } else {
            $builder->orderByDesc('id');
        }
    }
}
