<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class ProductLocale extends Model
{
    use HasFactory, HasEagerLimit;
    protected $table = 'product_locale';
    protected $guarded = [];
    protected $fillable = [];

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'locale_id', 'id');
    }
}
