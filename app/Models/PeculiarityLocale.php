<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeculiarityLocale extends Model
{
    use HasFactory;
    protected $table = "peculiarity_locale";
    protected $guarded = [];
    protected $fillable = [];

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'locale_id', 'id');
    }
}
