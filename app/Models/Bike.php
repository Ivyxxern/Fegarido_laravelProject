<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'bike_name',
        'customer_name',
        'phone',
        'address',
        'is_rented',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

