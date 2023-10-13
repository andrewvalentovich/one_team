<?php


namespace App\Http\Filters;


use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterInterface
{
    private $queryParams = [];
    private $currencyService;

    public function __construct(array $queryParams, CurrencyService $currencyService)
    {
        $this->queryParams = $queryParams;
        $this->currencyService = $currencyService;
    }

    abstract protected function getCallbacks(): array;

    public function apply(Builder $builder)
    {
        $this->before($builder);

        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->queryParams[$name])) {
                call_user_func($callback, $builder, $this->queryParams[$name]);
            }
        }
    }

    protected function before(Builder $builder)
    {

    }
}
