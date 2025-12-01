<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['brand_name'];

    // A brand has many bikes
    public function bikes()
    {
        return $this->hasMany(Bike::class);
    }
}
