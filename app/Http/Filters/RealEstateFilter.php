<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class RealEstateFilter extends AbstractFilter
{
    const SALE_OR_RENT = 'sale_or_rent';
    const ORDER_BY = 'order_by';
    const OWNER = 'ot_zastroishika';

    protected function getCallbacks(): array
    {
        return [
            self::SALE_OR_RENT => [$this, 'sale_or_rent'],
            self::ORDER_BY => [$this, 'order_by'],
            self::OWNER => [$this, 'owner'],
        ];
    }

    protected function sale_or_rent(Builder $builder, $value)
    {
        $builder->where('sale_or_rent', $value);
    }

    protected function owner(Builder $builder, $value)
    {
        if ($value == "true") {
            $builder->where('owner', "Застройщик");
        }
    }

    protected function order_by(Builder $builder, $value)
    {
        // Получаем $value = 'price-asc' -> $val_arr[0] = 'price', $val_arr[1] = 'asc';
        $val_arr = explode('-', $value);
        $builder->orderBy($val_arr[0], $val_arr[1]);
    }
}
