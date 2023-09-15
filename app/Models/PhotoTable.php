<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoTable extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Привязка фотографий к категории (много фотографий к одной категории)
    public function category()
    {
        return $this->belongsTo(PhotoCategory::class, 'category_id', 'id');
    }
}
