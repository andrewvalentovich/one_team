<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $table = 'exchange_rates';
    protected $guarded = [];
    protected $fillable = [];
    public static $names = ["RUB", "EUR", "USD", "TRY"];

    // Пример: рубль (direct) к евро (relative), то есть сколько евро в одном рубле

    public function getExchangeRateGroupAttribute()
    {
        return true;
    }

    static function getExchangeNames()
    {
        return self::$names;
    }
}
