<?php

namespace Database\Seeders;

use App\Models\Bike;
use App\Models\BikeCategory;
use Illuminate\Database\Seeder;

class BikeSeeder extends Seeder
{
    public function run(): void
    {
        $categories = BikeCategory::all();

        $bikes = [
            [
                'bike_name' => 'Trail Master X1',
                'model' => 'TM-X1-2024',
                'price_per_day' => 25.00,
                'status' => 'available',
                'bike_category_id' => $categories->where('name', 'Mountain Bike')->first()?->id,
            ],
            [
                'bike_name' => 'Speed Racer Pro',
                'model' => 'SRP-2024',
                'price_per_day' => 30.00,
                'status' => 'available',
                'bike_category_id' => $categories->where('name', 'Road Bike')->first()?->id,
            ],
            [
                'bike_name' => 'E-Power 500',
                'model' => 'EP-500',
                'price_per_day' => 40.00,
                'status' => 'rented',
                'bike_category_id' => $categories->where('name', 'Electric Bike')->first()?->id,
            ],
            [
                'bike_name' => 'City Cruiser',
                'model' => 'CC-2024',
                'price_per_day' => 20.00,
                'status' => 'available',
                'bike_category_id' => $categories->where('name', 'City Bike')->first()?->id,
            ],
            [
                'bike_name' => 'Comfort Hybrid',
                'model' => 'CH-2024',
                'price_per_day' => 22.00,
                'status' => 'maintenance',
                'bike_category_id' => $categories->where('name', 'Hybrid Bike')->first()?->id,
            ],
            [
                'bike_name' => 'Mountain Explorer',
                'model' => 'ME-2024',
                'price_per_day' => 28.00,
                'status' => 'available',
                'bike_category_id' => $categories->where('name', 'Mountain Bike')->first()?->id,
            ],
            [
                'bike_name' => 'Road Warrior',
                'model' => 'RW-2024',
                'price_per_day' => 35.00,
                'status' => 'available',
                'bike_category_id' => $categories->where('name', 'Road Bike')->first()?->id,
            ],
            [
                'bike_name' => 'Urban Rider',
                'model' => 'UR-2024',
                'price_per_day' => 18.00,
                'status' => 'available',
                'bike_category_id' => $categories->where('name', 'City Bike')->first()?->id,
            ],
        ];

        foreach ($bikes as $bike) {
            Bike::create($bike);
        }
    }
}
