<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bike extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bike_category_id',
        'bike_name',
        'model',
        'price_per_day',
        'status',
        'photo',
    ];

    public function bikeCategory()
    {
        return $this->belongsTo(BikeCategory::class);
    }

    /**
     * Get the bike's initials for avatar display
     */
    public function initials(): string
    {
        $words = explode(' ', $this->bike_name);
        $initials = '';
        
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        
        return $initials ?: strtoupper(substr($this->bike_name, 0, 2));
    }
}

