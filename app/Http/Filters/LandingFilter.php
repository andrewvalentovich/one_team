<?php


namespace App\Http\Filters;


use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Builder;

class LandingFilter extends AbstractFilter
{
    // Имена переменных присваиваем константам
    const COUNTRY = 'country_id';
    const TYPE = 'type';
    const CITY = 'city_id';
    const OFFSET = 'offset';
    const LIMIT = 'limit';

    protected function getCallbacks(): array
    {
        // Прописываем переменные ($this) и методы в 'метод'
        return [
            self::COUNTRY => [$this, 'country_by_id'],
            self::TYPE => [$this, 'peculiarities_by_id'],
            self::CITY => [$this, 'city_by_id'],
            self::OFFSET => [$this, 'offset'],
            self::LIMIT => [$this, 'limit'],
        ];
    }

    protected function offset(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->offset($value);
        }
    }

    protected function limit(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->limit($value + 1);
        }
    }

    protected function city_by_id(Builder $builder, $value)
    {

        if(isset($value) && (int) $value !== 0) {
            $builder->where('city_id', $value);
        }
    }

    protected function country_by_id(Builder $builder, $value)
    {
        if(isset($value) && (int) $value !== 0) {
            $builder->where('country_id', $value);
        }
    }

    protected function peculiarities_by_id(Builder $builder, $value)
    {
        if(isset($value) && (int) $value !== 0) {
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

    protected function country(Builder $builder, $value)
    {
        if(isset($value)) {
            $builder->whereHas('country', function ($query) use ($value) {
                $query->where('name', "$value");
            });
        }
    }
}
