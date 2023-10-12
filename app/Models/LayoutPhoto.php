<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayoutPhoto extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'layout_photos';

    // Привязка фотографий к планировкам (много фотографий к одной планировке)
    public function layouts()
    {
        return $this->belongsTo(Layout::class, 'layout_id', 'id');
    }
}
