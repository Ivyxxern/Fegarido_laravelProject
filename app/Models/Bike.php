<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_category_id',
        'bike_name',
        'model',
        'price_per_day',
        'status',
    ];

    public function bikeCategory()
    {
        return $this->belongsTo(BikeCategory::class);
    }
}

