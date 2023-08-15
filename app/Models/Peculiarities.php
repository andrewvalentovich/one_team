<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peculiarities extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function product() {
        return $this->belongsToMany(Product::class, 'product_categories', 'peculiarities_id', 'product_id');
    }
}
