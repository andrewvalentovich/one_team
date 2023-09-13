<?php


namespace App\Http\Filters;


use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Builder;

class LandingFilter extends AbstractFilter
{
    // Имена переменных присваиваем константам
    const SALE_OR_RENT = 'sale_or_rent';
    const ORDER_BY = 'order_by';
    const TOP_LEFT = 'top_left';
    const BOTTOM_RIGHT = 'bottom_right';
    const COUNTRY = 'country';
    const TYPE = 'type';
    const PRICE = 'price';
    const BEDROOMS = 'bedrooms';
    const BATHROOMS = 'bathrooms';
    const PECULIARITIES = 'peculiarities';
    const VIEW = 'view';
    const TO_SEA = 'to_sea';
    const CITY = 'city_id';

    protected function getCallbacks(): array
    {
        // Прописываем переменные ($this) и методы в 'метод'
        return [
            self::SALE_OR_RENT => [$this, 'sale_or_rent'],
            self::ORDER_BY => [$this, 'order_by'],
            self::TOP_LEFT => [$this, 'top_left'],
            self::BOTTOM_RIGHT => [$this, 'bottom_right'],
            self::BEDROOMS => [$this, 'peculiarities_by_id'],
            self::BATHROOMS => [$this, 'peculiarities_by_id'],
            self::VIEW => [$this, 'peculiarities_by_id'],
            self::TO_SEA => [$this, 'peculiarities_by_id'],
            self::COUNTRY => [$this, 'country'],
            self::TYPE => [$this, 'peculiarities_by_name'],
            self::PECULIARITIES => [$this, 'peculiarities'],
            self::PRICE => [$this, 'price'],
            self::CITY => [$this, 'city_by_id'],
        ];
    }

    protected function city_by_id(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->where('city_id', $value);
        }
    }


    protected function sale_or_rent(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->where('sale_or_rent', $value);
        }
    }

    protected function order_by(Builder $builder, $value)
    {
        if(isset($value)) {
            // Получаем $value = 'price-asc' -> $val_arr[0] = 'price', $val_arr[1] = 'asc';
            $val_arr = explode('-', $value);
            $builder->orderBy($val_arr[0], $val_arr[1]);
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
                $query->where('name', "$value");
            });
        }
    }

    protected function price(Builder $builder, $value)
    {
        $exchange_rates = "";

        if (isset($value['code']) && $value['code'] != "EUR") {
            $exchange_rates = ExchangeRate::where('direct_val', 'EUR')->where('relative_val', $value['code'])->first();
        }

        if (isset($value['min_price'])) {
            $value['min_price'] = (isset($value['code']) && $value['code'] != "EUR") ? (int) $value['min_price'] / $exchange_rates->sell_val : $value['min_price'];
            $builder->where('price', ">=", $value['min_price']);
        }

        if (isset($value['max_price'])) {
            $value['max_price'] = (isset($value['code']) && $value['code'] != "EUR") ? (int) $value['max_price'] / $exchange_rates->sell_val : $value['max_price'];
            $builder->where('price', "<=", $value['max_price']);
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
}
