<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLocale extends Model
{
    use HasFactory;
    protected $table = "product_locale";
    protected $guarded = [];
    protected $fillable = [];

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'locale_id', 'id');
    }
}
