<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlatsRequest extends Model
{
    use HasFactory;

    protected $table = 'flats_requests';
    protected $guarded = [];
    protected $fillable = [];

    public function getCreatedDateDayMonthYearFormatAttribute() // created_date_day_month_year_format
    {
        return Date('Y-m-d H:i:s', strtotime($this->created_at));
    }
}
