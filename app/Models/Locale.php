<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [];

    public function getIconPathAttribute()
    {
        return "uploads/" . $this->icon;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_locale', 'locale_id', 'product_id');
    }
}
