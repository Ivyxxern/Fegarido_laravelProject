<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'model_name',
        'status' // optional if you track availability
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}


