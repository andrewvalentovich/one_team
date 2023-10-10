<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layouts extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Привязка планировки к компексу/объекту (много планировок к одному комплексу/объекту)
    public function complex()
    {
        return $this->belongsTo(Product::class, 'complex_id', 'id');
    }
}
