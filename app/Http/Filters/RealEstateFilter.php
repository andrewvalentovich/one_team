<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class RealEstateFilter extends AbstractFilter
{
    const SALE_OR_RENT = 'sale_or_rent';

    protected function getCallbacks(): array
    {
        return [
            self::SALE_OR_RENT => [$this, 'sale_or_rent'],
        ];
    }

    protected function sale_or_rent(Builder $builder, $value)
    {
        $builder->where('sale_or_rent', $value);
    }
}
