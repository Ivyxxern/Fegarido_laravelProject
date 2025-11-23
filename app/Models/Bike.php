<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = ['bike_name', 'status', 'brand_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

