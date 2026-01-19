<?php

namespace Database\Seeders;

use App\Models\BikeCategory;
use Illuminate\Database\Seeder;

class BikeCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Mountain Bike'],
            ['name' => 'Road Bike'],
            ['name' => 'Electric Bike'],
            ['name' => 'Hybrid Bike'],
            ['name' => 'City Bike'],
            ['name' => 'BMX Bike'],
        ];

        foreach ($categories as $category) {
            BikeCategory::create($category);
        }
    }
}
