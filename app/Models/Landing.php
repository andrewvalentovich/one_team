<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function template() {
        return $this->belongsTo(Template::class,'template_id', 'id');
    }

    public function requests() {
        return $this->hasMany(Request::class);
    }
}
