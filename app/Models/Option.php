<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';
    protected $guarded = [];
    protected $fillable = [];

    // Привязка категории к продуктам (одна категория имеет несколько продуктов)
    public function products()
    {
        return $this->HasMany(Product::class);
    }

}
