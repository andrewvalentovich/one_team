<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoCategory extends Model
{
    use HasFactory;

    protected $table = 'photo_categories';
    protected $guarded = [];
    protected $fillable = [];

    // Привязка категории к фото (одна категория имеет несколько фотографий)
    public function photos()
    {
        return $this->HasMany(PhotoTable::class);
    }
}
