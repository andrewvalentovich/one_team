<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function product() {
        return $this->belongsto(Product::class,'product_id');
    }
}
