<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layout extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    // Привязка планировки к компексу/объекту (много планировок к одному комплексу/объекту)
    public function complex()
    {
        return $this->belongsTo(Product::class, 'complex_id', 'id');
    }

    // Привязка фотографий к планировке (много фотографий к одной планировке)
    public function photos() {
        return $this->hasMany(LayoutPhoto::class,'layout_id');
    }
}
