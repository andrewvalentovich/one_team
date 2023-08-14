<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class HousesFilter extends AbstractFilter
{
    // Имена переменных присваиваем константам
    const SALE_OR_RENT = 'sale_or_rent';
    const ORDER_BY = 'order_by';
    const TOP_LEFT = 'top_left';
    const BOTTOM_RIGHT = 'bottom_right';
    const MIN_PRICE = 'min_price';

    protected function getCallbacks(): array
    {
        // Прописываем переменные ($this) и методы в 'метод'
        return [
            self::SALE_OR_RENT => [$this, 'sale_or_rent'],
            self::ORDER_BY => [$this, 'order_by'],
            self::TOP_LEFT => [$this, 'top_left'],
            self::BOTTOM_RIGHT => [$this, 'bottom_right'],
            self::MIN_PRICE => [$this, 'min_price'],
        ];
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

    protected function min_price(Builder $builder, $value)
    {
        dd($value);
    }
}
