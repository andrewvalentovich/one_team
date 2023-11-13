<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getIconPathAttribute()
    {
        return "uploads/" . $this->icon;
    }
}
