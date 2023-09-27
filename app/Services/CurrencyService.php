<?php


namespace App\Services;


use App\Models\ExchangeRate;

class CurrencyService
{
    private $exchanges;

    public function __construct()
    {
        // Получаем активные валюты
        $this->exchanges = $this->getExchanges();
    }

    /**
     * Get array from DB with active currency where direct exchange is RUB and relative: EUR, USD, TRY
     *
     * @return array
     */
    private function getExchanges(): array
    {
        // Получаем валюту
        $exchange_rates = ExchangeRate::where('direct', 'RUB')->get();
        $exchanges = [];

        // Преобразуем в массив вида - ["EUR" => 2.24]
        foreach ($exchange_rates as $exchange_rate) {
            $exchanges[$exchange_rate->relative] = $exchange_rate->value;
        }

        return $exchanges;
    }

    /**
     * Get array with exchange rates and its value
     * Look like ["EUR" => 0.01, "RUB" => 1,..]
     *
     * @param int|null $price
     * @param string|null $price_code
     * @return array|string[]
     */
    public function getPrice(int $price = null, string $price_code = null): array
    {
        if(is_null($price_code) || $price_code === "") {
            $price_code = "EUR";
        }

        if(is_null($price)) {
            return [
                "RUB" => "0 ₽",
                "USD" => "0 $",
                "EUR" => "0 €",
                "TRY" => "0 ₺",
            ];
        }

        return [
            "RUB" => number_format(($price_code === "RUB") ? $price : ($price / $this->exchanges[$price_code]), 0, '.', ' ')." ₽",
            "USD" => number_format(($price_code === "RUB") ? $price * $this->exchanges['USD'] : $price / $this->exchanges[$price_code] * $this->exchanges['USD'], 0, '.', ' ')." $",
            "EUR" => number_format(($price_code === "RUB") ? $price * $this->exchanges['EUR'] : $price / $this->exchanges[$price_code] * $this->exchanges['EUR'], 0, '.', ' ')." €",
            "TRY" => number_format(($price_code === "RUB") ? $price * $this->exchanges['TRY'] : $price / $this->exchanges[$price_code] * $this->exchanges['TRY'], 0, '.', ' ')." ₺",
        ];
    }

    /**
     * Get array with exchange rates and its value by 1 sq.m.
     * Look like ["EUR" => 0.01, "RUB" => 1,..]
     *
     * @param int $price
     * @param int|int $size
     * @param string|null $price_code
     * @return array|string[]
     */
    public function getPriceSize(int $price, int $size = 0, string $price_code = null): array
    {
        if(is_null($price_code) || $price_code === "") {
            $price_code = "EUR";
        }

        return [
            "RUB" => number_format(ceil(($price_code === "RUB") ? $price : ($price / $this->exchanges[$price_code]) / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." ₽",
            "USD" => number_format(ceil(($price_code === "RUB") ? $price * $this->exchanges['USD'] : $price / $this->exchanges[$price_code] * $this->exchanges['USD'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." $",
            "EUR" => number_format(ceil(($price_code === "RUB") ? $price * $this->exchanges['EUR'] : $price / $this->exchanges[$price_code] * $this->exchanges['EUR'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." €",
            "TRY" => number_format(ceil(($price_code === "RUB") ? $price * $this->exchanges['TRY'] : $price / $this->exchanges[$price_code] * $this->exchanges['TRY'] / (($size) < 1 ? 1 : $size)), 0, '.', ' ')." ₺",
        ];
    }
}
