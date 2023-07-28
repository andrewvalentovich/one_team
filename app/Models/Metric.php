<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;
    protected $guarded =[];


    public function country(){
        return $this->hasMany(CountryAndCity::class, 'metric_id');
    }
}
